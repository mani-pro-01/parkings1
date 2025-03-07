<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="x-icon" href="m2.jpg"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vehicle Parking Management System</title>

<?php
  session_start();
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
  include('./header.php'); 
?>

<!-- Animate.css for smooth effects -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<!-- Custom Styles -->
<style>
  body {
    background: #80808045;
    opacity: 0;
    animation: fadeIn 1s ease-in-out forwards;
  }

  /* Smooth Preloader Animation */
  #preloader {
    position: fixed;
    width: 100%;
    height: 100vh;
    background: rgba(255, 255, 255, 0.9) url('loading.gif') no-repeat center;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s ease-in-out;
  }

  /* Modal animations */
  .modal.fade .modal-dialog {
    transform: scale(0.8);
    transition: transform 0.3s ease-in-out;
  }

  .modal.show .modal-dialog {
    transform: scale(1);
  }

  /* Button Hover Effect */
  .btn-primary, .btn-secondary {
    transition: all 0.3s ease-in-out;
  }

  .btn-primary:hover, .btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
  }

  /* Smooth Input Focus Effects */
  input, select {
    transition: all 0.3s ease-in-out;
    border-radius: 5px;
  }

  input:focus, select:focus {
    border-color: #007bff;
    box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
  }

  /* Toast Notifications */
  #alert_toast {
    transition: opacity 0.5s ease-in-out;
    position: fixed;
    top: 15px;
    right: 15px;
    z-index: 1050;
  }

  /* Fade In Keyframe */
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
</style>
</head>

<body>
  <!-- Preloader -->
  <div id="preloader"></div>

  <?php include 'topbar.php' ?>
  <?php include 'navbar.php' ?>

  <!-- Toast Notification -->
  <div class="toast animate__animated animate__fadeInUp" id="alert_toast" role="alert">
    <div class="toast-body text-white"></div>
  </div>

  <main id="view-panel">
    <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
    <?php include $page.'.php' ?>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Confirmation Modal -->
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md">
      <div class="modal-content animate__animated animate__fadeIn">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body" id="delete_content"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm'>Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Universal Modal -->
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md">
      <div class="modal-content animate__animated animate__zoomIn">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.start_load = function(){
      $('body').prepend('<div id="preloader2"></div>')
    }

    window.end_load = function(){
      $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
    }

    window.uni_modal = function(title, url, size){
      start_load();
      $.ajax({
        url: url,
        success: function(resp){
          if(resp){
            $('#uni_modal .modal-title').html(title)
            $('#uni_modal .modal-body').html(resp)
            $('#uni_modal .modal-dialog').removeClass().addClass(`modal-dialog ${size}`);
            $('#uni_modal').modal('show');
            end_load();
          }
        }
      });
    }

    window.alert_toast = function(msg, bg){
      $('#alert_toast').removeClass().addClass(`toast bg-${bg} animate__animated animate__fadeInUp`);
      $('#alert_toast .toast-body').html(msg);
      $('#alert_toast').toast({ delay: 3000 }).toast('show');
    }

    $(document).ready(function(){
      $('#preloader').fadeOut('fast', function() { $(this).remove(); });

      $('.select2').select2({
        placeholder: "Please select here",
        width: "100%"
      });

      $('.datetimepicker').datetimepicker({
        format: 'Y/m/d H:i',
        startDate: '+3d'
      });
    });

  </script>
</body>
</html>
