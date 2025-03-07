<!-- <!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Front Page</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: transparent;
            padding: 15px;
            color: black;
        }
        .navbar a {
            color: red;
            text-decoration: none;
            padding: 20px 20px;
        }
        .slider-container {
            width: 100%;
            max-width: 100%;
            margin: auto;
            overflow: hidden;
            position: relative;
        }
        .slider {
            display: flex;
            width: 100%;
            animation: slide 10s infinite;
        }
        .slide {
            min-width: 100%;
            transition: 0.5s;
        }
        .slide img {
            width: 100%;
            display: block;
        }
        @keyframes slide {
            0% { transform: translateX(0); }
            33% { transform: translateX(-100%); }
            66% { transform: translateX(-200%); }
            100% { transform: translateX(0); }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
        <a href="login.php" class="login-btn">Login</a>
    </div>
    
    <div class="slider-container">
        <div class="slider">
            <div class="slide"><img src="download.jpeg" alt="Image 1"></div>
            <div class="slide"><img src="OIP.jpeg" alt="Image 2"></div>
            <div class="slide"><img src="OIP (2).jpeg" alt="Image 3"></div>
        </div>
    </div>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Animated Page</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Poppins", sans-serif;
            background: #f4f4f4;
            color: #333;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.7);
            padding: 15px 40px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            font-size: 18px;
            transition: all 0.3s ease;
        }
        .navbar a:hover {
            color: #ff4500;
        }

        /* Slider */
        .slider-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
            position: relative;
            margin-top: 60px; /* Adjusted for navbar */
        }
        .slider {
            display: flex;
            width: 100%;
            height: 100%;
            animation: slide 9s infinite linear;
        }
        .slide {
            width: 100%;
            flex-shrink: 0;
        }
        .slide img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }

        /* Animation */
        @keyframes slide {
            0%, 100% { transform: translateX(0); }
            33% { transform: translateX(-100%); }
            66% { transform: translateX(-200%); }
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
        <a href="login.php">Login</a>
    </div>

    <!-- Slider Section -->
    <div class="slider-container">
        <div class="slider">
            <div class="slide"><img src="download.jpeg" alt="Image 1"></div>
            <div class="slide"><img src="OIP.jpeg" alt="Image 2"></div>
            <div class="slide"><img src="OIP (2).jpeg" alt="Image 3"></div>
        </div>
    </div>

</body>
</html> -->


