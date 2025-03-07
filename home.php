<?php include 'db_connect.php'; ?>

<!-- Include Bootstrap 5 & FontAwesome for Better Design -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
    /* Custom Styling */
    body {
        background-color: #f8f9fa;
        font-family: "Poppins", sans-serif;
    }
    .summary-card {
        position: relative;
        padding: 20px;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
    }
    .summary-card:hover {
        transform: scale(1.05);
    }
    .summary_icon {
        font-size: 3rem;
        position: absolute;
        right: 1rem;
        color: #ffffff96;
    }
    .table-bordered th, .table-bordered td {
        vertical-align: middle;
    }
    .now-serving {
        text-align: center;
        padding: 20px;
    }
    .queue-box {
        border: 2px solid #007bff;
        padding: 20px;
        border-radius: 10px;
    }
    .btn-animated {
        transition: all 0.3s ease-in-out;
    }
    .btn-animated:hover {
        transform: translateY(-3px);
        box-shadow: 0px 5px 15px rgba(0, 123, 255, 0.3);
    }
</style>

<div class="container-fluid mt-4">

    <!-- Dashboard Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4 offset-md-2">
            <div class="card bg-warning text-white summary-card">
                <div class="card-body">
                    <span class="summary_icon"><i class="fa fa-car"></i></span>
                    <h4><b><?php echo $conn->query("SELECT * FROM parked_list WHERE status = 1")->num_rows; ?></b></h4>
                    <p><b>Total Parked Vehicles</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white summary-card">
                <div class="card-body">
                    <span class="summary_icon"><i class="fa fa-check-circle"></i></span>
                    <h4><b><?php echo $conn->query("SELECT * FROM parked_list WHERE status = 2")->num_rows; ?></b></h4>
                    <p><b>Total Checked-Out Vehicles</b></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Message & Parking Availability Table -->
    <div class="card">
        <div class="card-body">
            <h4>Welcome back, <b><?php echo $_SESSION['login_name']; ?></b>!</h4>
            <hr>
            
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Parking Area</th>
                                <th class="text-center">Available Spaces</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $categories = $conn->query("SELECT * FROM category ORDER BY name ASC");
                            while ($catRow = $categories->fetch_assoc()) {
                                echo "<tr class='table-primary'><th class='text-center' colspan='2'>{$catRow['name']}</th></tr>";

                                $locations = $conn->query("SELECT * FROM parking_locations WHERE category_id = '{$catRow['id']}' ORDER BY location ASC");
                                while ($locRow = $locations->fetch_assoc()) {
                                    $occupied = $conn->query("SELECT * FROM parked_list WHERE status = 1 AND location_id = {$locRow['id']}")->num_rows;
                                    $available = $locRow['capacity'] - $occupied;
                                    echo "<tr><td>{$locRow['location']}</td><td class='text-center'>{$available}</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>          
        </div>
    </div>

    <hr>

    <?php if ($_SESSION['login_type'] == 2): ?>
    <!-- Queue Management Section -->
    <script>
        function queueNow() {
            $.ajax({
                url: 'ajax.php?action=update_queue',
                success: function (resp) {
                    let data = JSON.parse(resp);
                    $('#sname').html(data.name);
                    $('#squeue').html(data.queue_no);
                    $('#window').html(data.wname);
                }
            });
        }
    </script>

    <div class="row mt-4">
        <div class="col-md-4 text-center">
            <a href="javascript:void(0)" class="btn btn-primary btn-lg btn-animated" onclick="queueNow()">Next Serve</a>
        </div>
        <div class="col-md-4">
            <div class="queue-box">
                <h3 class="text-primary"><b>Now Serving</b></h3>
                <hr>
                <h4 class="text-center text-dark" id="sname">-</h4>
                <h3 class="text-center text-danger" id="squeue">-</h3>
                <h5 class="text-center text-muted" id="window">-</h5>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
