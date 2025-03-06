<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>InvenTrack</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/logo1.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="./assets/css/styles.css" />
  </head>
  <body>
    <nav>
      <a href="index.php">
        <h1 style="color: black;">Inven<span style="color: rgb(247, 170, 70)">Track</span></h1>
      </a>
      <ul>
        <li><a style="text-decoration: none; color: black;" href="#">Home</a></li>
        <li><a style="text-decoration: none; color: black;" href="./pages/services.php">Services</a></li>
        <li><a style="text-decoration: none; color: black;" href="./pages/about.php">About Us</a></li>
      </ul>
      <ul>
        <button class="log-btn">
          <a href="./pages/login.php">Login / Register</a>
        </button>
      </ul>
    </nav>

    <!-- Body Home Page -->

    <div class="homepage">
      <div class="container-1" style="margin-left: 50px;">
        <h1>Inven<span style="color: rgb(247, 170, 70)">Track</span></h1>
        <p style="font-size: large; ">
          InvenTrack is a simple, real-time
          <span style="color: rgb(247, 170, 70)"
            >Inventory Management System</span
          >
          for tracking and managing stock efficiently. It offers secure login
          and easy navigation for
          <span style="color: rgb(247, 170, 70)">businesses of all sizes</span>.
        </p>
        <button class="get-started-btn" > <a href="./pages/register.php">Get Started</a></button>
      </div>
      <div class="container-2">
        <img src="./assets/img/logo1.png" alt="logo" />
      </div>
    </div>
    <!-- End of Body Home Page -->
     <!-- Hello world  -->

    <!-- Footer -->

    <div class="footer">
      <h1>Inven<span style="color: rgb(247, 170, 70)">Track</span></h1>
      <p>
        InvenTrack is a simple, real-time Inventory Management System for
        tracking and managing stock efficiently. It offers secure login and easy
        navigation for businesses of all sizes.
      </p>
      <div class="social-icons">
        <a href="#"> <i class="fa-brands fa-facebook"></i> &nbsp;Facebook</a>
        <a href="#"> <i class="fa-brands fa-instagram"></i> &nbsp;Instagram</a>
        <a href="#"> <i class="fa-brands fa-twitter"></i> &nbsp;Twitter</a>
      </div>
      <p>&copy; 2024 InvenTrack. All rights reserved.</p>
      <p>
        Made with ❤️ by <span style="color: rgb(247, 170, 70)">InvenTrack</span>
      </p>
      <ul style="display: flex; flex-direction: row; gap: 20px; color: white; justify-content: center; align-items: center; margin-top: 20px;">
        <li><a style="text-decoration: none; color: white; background-color: #2a2d38; padding: 7px; border-radius: 4px; transition: 0.3s ease-in;" href="./pages/user/register.php">Become a client</a></li>
        <li><a style="text-decoration: none; color: white; background-color: #2a2d38; padding: 7px; border-radius: 4px; transition: 0.3s ease-in;" href="./pages/admin/index.php">Login as Admin</a></li>
      </ul>
    </div>

    <!-- End of Footer -->
  </body>
</html>
