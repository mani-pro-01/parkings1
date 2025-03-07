<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM parking_locations WHERE id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<div class="container-fluid animated-container">
	<div class="card animated-card">
		<div class="card-header text-center">
			<h4 class="mb-0"><?php echo isset($id) ? "Edit" : "New" ?> Parking Location</h4>
		</div>
		<div class="card-body">
			<form action="" id="manage-location">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
				<div class="form-group animated-input">
					<label for="category_id" class="control-label">Vehicle Category</label>
					<select name="category_id" id="category_id" class="custom-select select2">
						<option value=""></option>
						<?php
							$category = $conn->query("SELECT * FROM category ORDER BY name ASC");
							while($row= $category->fetch_assoc()):
						?>
						<option value="<?php echo $row['id'] ?>" 
							<?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?> 
							data-rate="<?php echo $row['rate'] ?>">
							<?php echo $row['name'] ?>
						</option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="form-group animated-input">
					<label for="location" class="control-label">Area Location</label>
					<input type="text" class="form-control" name="location"  
						value="<?php echo isset($location) ? $location :'' ?>" required>
				</div>
				<div class="form-group animated-input">
					<label for="capacity" class="control-label">Area Capacity</label>
					<input type="number" class="form-control text-right" name="capacity" step="any"  
						value="<?php echo isset($capacity) ? $capacity :'' ?>" required>
				</div>
				<div id="msg"></div>
				<hr>
				<div class="form-group text-center">
					<button class="btn btn-primary btn-lg animated-button">Save Location</button>
				</div>
			</form>
		</div>
	</div>
</div>

<style>
	/* ======= General Animations ======= */
	.animated-container {
		opacity: 0;
		transform: translateY(-20px);
		animation: fadeInUp 0.8s ease-in-out forwards;
	}

	.animated-card {
		opacity: 0;
		transform: scale(0.95);
		animation: fadeInScale 0.6s ease-in-out forwards 0.3s;
		box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
		border-radius: 10px;
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
		transform: scale(1.05);
		box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
	}

	/* ======= Input Focus Effects ======= */
	input, select {
		transition: all 0.3s ease-in-out;
		border-radius: 5px;
	}

	input:focus, select:focus {
		border-color: #007bff;
		box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
	}

	/* ======= Loading Animation ======= */
	.loading {
		animation: blink 1s infinite alternate;
	}

	@keyframes blink {
		0% { opacity: 1; }
		100% { opacity: 0.5; }
	}

	/* ======= Keyframe Animations ======= */
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
	$(document).ready(function(){
		// Submit form with animation
		$('#manage-location').submit(function(e){
			e.preventDefault();
			start_load();

			$('#msg').html('<div class="alert alert-info loading">Saving, please wait...</div>');

			$.ajax({
				url:'ajax.php?action=save_location',
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				success:function(resp){
					if(resp==1){
						$('#msg').html('<div class="alert alert-success">Data successfully added!</div>');
						setTimeout(function(){
							location.reload();
						}, 1500);
					} else if(resp==2){
						$('#msg').html("<div class='alert alert-danger'>Name already exists.</div>");
						end_load();
					}
				}
			})
		});
	});
</script>
