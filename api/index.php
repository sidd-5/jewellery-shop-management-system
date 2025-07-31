<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BhoomiJewels - Home</title>
  <link rel="stylesheet" href="/public/style.css">
</head>
<body>
  <header>
    <h1>BhoomiJewels</h1>
    <nav>
      <a href="/api/index.php">Home</a>
      <a href="/api/shop.php">Shop</a>
      <a href="/api/cart.php">Cart</a>
      <?php if (isset($_SESSION["user_name"])): ?>
    <p>Welcome, <?= $_SESSION["user_name"]; ?> | <a href="/api/logout.php">Logout</a></p>
<?php else: ?>
    <a href="/api/login.php">Login</a> | <a href="/api/register.php">Register</a>
<?php endif; ?>

    </nav>
  </header>

  <section class="hero">
    <h2>Timeless Elegance, Crafted with Love</h2>
    <p>Explore our latest collection of handcrafted jewellery.</p>
    <a href="/api/shop.php" class="btn">Shop Now</a>
  </section>

  <!-- Featured Images Section -->
  <section class="gallery">
    <h2>Our Signature Designs</h2>
    <div class="scroll-container">
      <img src="images/gold-necklace.jpg" alt="Jewellery 1">
      <img src="images/diamond-ring.jpg" alt="Jewellery 2">
      <img src="images/silver-bangles.jpg" alt="Jewellery 3">
      <img src="images/elegant-gold-necklace.jpg" alt="Jewellery 4">
      <img src="images/royal-ruby-ring.jpg" alt="Jewellery 5">
    </div>
  </section>

  <!-- Video Showcase Section -->
  <section class="video-showcase">
    <h2>Behind the Craft</h2>
    <div class="video-container">
      <video controls>
        <source src="/public/videos/1stvideo.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <video controls>
        <source src="/public/videos/video2.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </section>

  <footer>
    <div class="footer-container">
      <div class="footer-about">
        <h3>BhoomiJewels</h3>
        <p>Crafting elegance since 2025. Discover handcrafted jewellery designed to shine forever.</p>
      </div>
  
      <div class="footer-contact">
        <h4>Contact Us</h4>
        <p>Email: support@Bhoomijewels.com</p>
        <p>Phone: +91 98765 43210</p>
        <p>Address: 123 Gold Street, Chennai, India</p>
      </div>
  
      <div class="footer-links">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="/public/index.php">Home</a></li>
          <li><a href="/public/shop.php">Shop</a></li>
          <li><a href="/public/cart.php">Cart</a></li>
        </ul>
      </div>
  
      <div class="footer-social">
        <h4>Follow Us</h4>
        <div class="social-icons">
          <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
          <a href="#"><img src="images/instagram.png" alt="Instagram"></a>
          <a href="#"><img src="images/twitter.jpg" alt="Twitter"></a>
        </div>
      </div>
    </div>
    <p class="copyright">© 2025 BhoomiJewels. All rights reserved.</p>
  </footer>
  
</body>
</html>
