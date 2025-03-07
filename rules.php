<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Traffic Rules Page</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }
        body {
            font-family: "Poppins", sans-serif;
            background: #f4f4f4;
            color: #333;
        }

        /* Animated Navbar */
        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.8);
            padding: 15px 40px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: background 0.3s ease-in-out;
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
            transform: scale(1.1);
        }

        /* Smooth Section Styles */
        section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 50px;
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .show-section {
            opacity: 1;
            transform: translateY(0);
        }
        #about { background: #ffefba; }
        #services { background: #d4fc79; }
        #contact { background: #a6c1ee; }

        /* Video Styling */
        .video-container {
            margin-top: 20px;
            width: 80%;
            max-width: 800px;
            transform: scale(0.8);
            opacity: 0;
            transition: all 0.6s ease-out;
        }
        .show-video {
            opacity: 1;
            transform: scale(1);
        }
        .video-container iframe {
            width: 100%;
            height: 400px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Animated Slider */
        .slider-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
            position: relative;
            margin-top: 60px;
        }
        .slider {
            display: flex;
            width: 100%;
            height: 100%;
            animation: slide 9s infinite ease-in-out;
        }
        .slide {
            width: 100%;
            flex-shrink: 0;
        }
        .slide img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
            filter: brightness(80%);
        }

        /* Keyframe Animations */
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
        <a href="#about">Traffic Rules</a>
        <a href="#services">Driving Rules</a>
        <a href="#contact">Contact</a>
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

    <!-- About Section -->
    <section id="about">
        <h1>Traffic Rules & Safety</h1>
        <p>Understanding and following traffic rules can save lives. Watch the videos below to learn about important traffic laws.</p>

        <!-- Traffic Rules YouTube Videos -->
        <div class="video-container"><h3>1. Basic Traffic Rules</h3><iframe src="https://www.youtube.com/embed/dy_F5wXtb1A" allowfullscreen></iframe></div>
        <div class="video-container"><h3>2. Traffic Signs Explained</h3><iframe src="https://www.youtube.com/embed/R2VryPAI8Vw" allowfullscreen></iframe></div>
        <div class="video-container"><h3>3. Safe Driving Tips</h3><iframe src="https://www.youtube.com/embed/OtMTK9byOzA" allowfullscreen></iframe></div>
        <div class="video-container"><h3>4. Drunk Driving Dangers</h3><iframe src="https://www.youtube.com/embed/VkXbOcsWqkg" allowfullscreen></iframe></div>
        <div class="video-container"><h3>5. Importance of Helmets</h3><iframe src="https://www.youtube.com/embed/BbIcdvEOlvs" allowfullscreen></iframe></div>
    </section>

    <!-- Services Section -->
    <section id="services">
        <h1>Important Driving Rules</h1>
        <p>Following these driving rules ensures safety for you and others on the road.</p>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <h1>Contact Us</h1>
        <p>Email: contact@company.com</p>
        <p>Phone: +123 456 7890</p>
    </section>

    <!-- JavaScript for Smooth Animations -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Reveal sections on scroll
            const sections = document.querySelectorAll("section");
            const videos = document.querySelectorAll(".video-container");

            function reveal() {
                sections.forEach(section => {
                    const sectionTop = section.getBoundingClientRect().top;
                    if (sectionTop < window.innerHeight - 50) {
                        section.classList.add("show-section");
                    }
                });

                videos.forEach(video => {
                    const videoTop = video.getBoundingClientRect().top;
                    if (videoTop < window.innerHeight - 50) {
                        video.classList.add("show-video");
                    }
                });
            }
            
            window.addEventListener("scroll", reveal);
            reveal();
        });
    </script>

</body>
</html>
