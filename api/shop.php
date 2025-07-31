<?php session_start(); ?>
<?php
$connect = new mysqli("localhost", "root", "", "jewellery_db");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
$result = $connect->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop - BhoomiJewels</title>
  <link rel="stylesheet" href="/public/shop.css">
</head>
<body>
  <header>
    <h1>BhoomiJewels</h1>
    <nav>
      <a href="/public/index.php">Home</a>
      <a href="/public/shop.php">Shop</a>
      <a href="/public/cart.php">Cart</a>
      <?php if (isset($_SESSION["user_name"])): ?>
    <p>Welcome, <?= $_SESSION["user_name"]; ?> | <a href="/public/logout.php">Logout</a></p>
<?php else: ?>
    <a href="/public/login.php">Login</a> | <a href="/public/register.php">Register</a>
<?php endif; ?>
    </nav>
  </header>

  <section class="products">
    <h2>Our Collection</h2>
    <div class="product-list">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="product">
          <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
          <h3><?php echo $row['name']; ?></h3>
          <p>₹<?php echo $row['price']; ?></p>
          <form action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="add_to_cart">Add to Cart</button>
          </form>
        </div>
      <?php endwhile; ?>
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
