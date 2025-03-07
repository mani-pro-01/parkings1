<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="x-icon" href="m2.jpg" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin | Vehicle Parking Management System</title>

  <?php include('./header.php'); ?>
  <?php include('./db_connect.php'); ?>
  <?php 
  session_start();
  if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");
  ?>

  <style>
    /* General Styles */
    body {
      width: 100%;
      height: 100vh;
      background: linear-gradient(135deg, #007bff, #00c6ff);
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    main#main {
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transform: translateY(-20px);
      animation: fadeIn 1s ease-in-out forwards;
    }

    /* Login Section */
    #login-right {
      position: relative;
      width: 100%;
      max-width: 400px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
      transform: scale(0.8);
      opacity: 0;
      animation: zoomIn 0.6s ease-out 0.5s forwards;
    }

    /* Background Overlay */
    #login-right::before {
      content: "";
      position: absolute;
      top: -10px;
      left: -10px;
      right: -10px;
      bottom: -10px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      z-index: -1;
      animation: glow 3s infinite alternate;
    }

    /* Form Input Animations */
    .form-control {
      border-radius: 8px;
      border: 2px solid #007bff;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #00c6ff;
      box-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
      transform: scale(1.02);
    }

    /* Button Effects */
    .btn-primary {
      transition: all 0.3s ease;
      padding: 10px;
      border-radius: 8px;
      font-weight: bold;
      background: linear-gradient(135deg, #007bff, #00c6ff);
      border: none;
    }

    .btn-primary:hover {
      transform: scale(1.1);
      background: linear-gradient(135deg, #0056b3, #0095c1);
      box-shadow: 0px 8px 20px rgba(0, 123, 255, 0.3);
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes zoomIn {
      from {
        opacity: 0;
        transform: scale(0.8);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes glow {
      from {
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
      }
      to {
        box-shadow: 0 0 40px rgba(255, 255, 255, 0.6);
      }
    }
  </style>
</head>

<body>

  <main id="main">
    <div id="login-right">
      <h2 class="text-center mb-4">Login</h2>
      <form id="login-form">
        <div class="form-group">
          <label for="username" class="control-label">Username</label>
          <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="password" class="control-label">Password</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <center><button class="btn btn-primary btn-block">Login</button></center>
      </form>
    </div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Smooth login form animation on load
      document.getElementById("login-right").classList.add("animated");

      // Login form submission
      document.getElementById("login-form").addEventListener("submit", function (e) {
        e.preventDefault();
        let button = document.querySelector(".btn-primary");
        button.innerHTML = "Logging in...";
        button.disabled = true;

        setTimeout(() => {
          fetch('ajax.php?action=login', {
            method: 'POST',
            body: new FormData(this),
          })
          .then(response => response.text())
          .then(resp => {
            if (resp == 1) {
              window.location.href = 'index.php?page=home';
            } else if (resp == 2) {
              window.location.href = 'voting.php';
            } else {
              let alertDiv = document.createElement("div");
              alertDiv.className = "alert alert-danger mt-3";
              alertDiv.innerText = "Username or password is incorrect.";
              this.prepend(alertDiv);
              button.innerHTML = "Login";
              button.disabled = false;
            }
          })
          .catch(error => {
            console.error("Error:", error);
            button.innerHTML = "Login";
            button.disabled = false;
          });
        }, 1000);
      });
    });
  </script>

</body>

</html>
