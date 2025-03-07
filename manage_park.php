<?php include 'db_connect.php' ?>
<?php 

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT p.*,c.name as cname,l.location as lname FROM parked_list p INNER JOIN category c ON c.id = p.category_id INNER JOIN parking_locations l ON l.id = p.location_id WHERE p.id= ".$_GET['id']);
	foreach($qry->fetch_assoc() as $k => $v){
		$$k = $v;
	}
}
?>

<div class="container-fluid mt-4 animated-container">
	<div class="card animated-card">
		<div class="card-header">
			<span><b><?php echo isset($id) ? "Manage" : "New" ?> Vehicle</b></span>
		</div>
		<div class="card-body">
			<form action="" id="manage-vehicle"> 
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="col-lg-12">
					<div class="row form-group animated-input">
						<div class="col-md-5">
							<label for="" class="control-label">Vehicle Category</label>
							<select name="category_id" id="category_id" class="custom-select select2">
								<option value=""></option>
								<?php
									$category = $conn->query("SELECT * FROM category ORDER BY name ASC");
									while($row= $category->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?> data-rate="<?php echo $row['rate'] ?>"><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="col-md-5">
							<label for="" class="control-label">Area</label>
							<select name="location_id" id="location_id" class="custom-select select2" required>
								<option value=""></option>
								<?php
									$category = $conn->query("SELECT * FROM parking_locations ORDER BY location ASC");
									while($row= $category->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>" data-cid="<?php echo $row['category_id'] ?>" <?php echo isset($category_id) ? (isset($location_id) && $location_id == $row['id'] ? 'selected' : '') : "disabled" ?>><?php echo $row['location'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="row form-group animated-input">
						<div class="col-md-5">
							<label for="" class="control-label">Vehicle Name</label>
							<input type="text" class="form-control" name="vehicle_brand" value="<?php echo isset($vehicle_brand) ? $vehicle_brand : '' ?>">
						</div>
						<div class="col-md-5">
							<label for="" class="control-label">Vehicle Registration No.</label>
							<input type="text" class="form-control" name="vehicle_registration" value="<?php echo isset($vehicle_registration) ? $vehicle_registration : '' ?>">
						</div>
					</div>
					<div class="row form-group animated-input">
						<div class="col-md-5">
							<label for="" class="control-label">Owner Name</label>
							<input type="text" class="form-control" name="owner" value="<?php echo isset($owner) ? $owner : '' ?>">
						</div>
					</div>
					<div class="row form-group animated-input">
						<div class="col-md-5">
							<label for="" class="control-label">Vehicle Description</label>
							<textarea cols="30" rows="2" class="form-control" name="vehicle_description"><?php echo isset($vehicle_description) ? $vehicle_description : '' ?></textarea>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-sm btn-primary btn-block col-sm-3 float-right animated-button">Save</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<style>
	/* General Animation Styles */
	.animated-container {
		opacity: 0;
		transform: translateY(-20px);
		animation: fadeInUp 0.8s ease-in-out forwards;
	}

	.animated-card {
		opacity: 0;
		transform: scale(0.95);
		animation: fadeInScale 0.6s ease-in-out forwards 0.3s;
	}

	.animated-input {
		opacity: 0;
		transform: translateY(10px);
		animation: fadeInUp 0.5s ease-in-out forwards 0.4s;
	}

	.animated-button {
		transition: all 0.3s ease-in-out;
		transform: scale(1);
	}

	.animated-button:hover {
		transform: scale(1.1);
		box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
	}

	/* Keyframe Animations */
	@keyframes fadeInUp {
		from {
			opacity: 0;
			transform: translateY(-20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	@keyframes fadeInScale {
		from {
			opacity: 0;
			transform: scale(0.95);
		}
		to {
			opacity: 1;
			transform: scale(1);
		}
	}
</style>

<script>
	$(document).ready(function() {
		$('#category_id').change(function() {
			var parent = $(this).parent();
			var id = $(this).val();
			var rate = $(this).find('option[value="'+id+'"]').attr('data-rate');

			if(parent.find('small').length > 0)
				parent.find('small').remove();

			parent.append("<small><b><i>Rate: "+rate+"</i></b></small>");
			$('#location_id option').attr('disabled', true);
			$('#location_id option[data-cid="'+id+'"]').attr('disabled', false);
			$('#location_id').val('').trigger('change');
		});

		$('#manage-vehicle').submit(function(e) {
			e.preventDefault();
			start_load();
			
			$.ajax({
				url: "ajax.php?action=save_vehicle",
				method: "POST",
				data: $(this).serialize(),
				success: function(resp) {
					resp = JSON.parse(resp);
					if (resp.status == 1) {
						alert_toast("Data successfully saved.", "success");
						if ('<?php echo !isset($id) ?>' == 1) {
							var nw = window.open("print_receipt.php?id="+resp.id, "_blank", "height=500,width=800");
							nw.print();
							setTimeout(function() {
								nw.close();
								location.href = "index.php?page=view_parked_details&id="+resp.id;
							}, 500);
						} else {
							setTimeout(function() {
								location.href = "index.php?page=view_parked_details&id="+resp.id;
							}, 1000);
						}
					} else {
						alert_toast("An error occurred.", 'danger');
						end_load();
					}
				}
			});
		});
	});
</script>
