<?php
session_start();
$connect = new mysqli("localhost", "root", "", "jewellery_db");

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product = $connect->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1
        ];
    }

    header("Location: cart.php");
    exit();
}

// Quantity Update
if (isset($_POST['update_quantity'])) {
    $id = $_POST['product_id'];
    $action = $_POST['action'];

    if (isset($_SESSION['cart'][$id])) {
        if ($action === 'increase') {
            $_SESSION['cart'][$id]['quantity'] += 1;
        } elseif ($action === 'decrease') {
            $_SESSION['cart'][$id]['quantity'] -= 1;
            if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
    }

    header("Location: cart.php");
    exit();
}

// Remove item
if (isset($_POST['remove'])) {
    unset($_SESSION['cart'][$_POST['remove_id']]);
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart - BhoomiJewels</title>
  <link rel="stylesheet" href="/public/cart.css">
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

  <section class="cart">
    <h2>Your Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
      <tr>
        <th>Product</th>
        <th>Price (₹)</th>
        <th>Quantity</th>
        <th>Total (₹)</th>
        <th>Action</th>
      </tr>
      <?php
        $grand_total = 0;
        foreach ($_SESSION['cart'] as $id => $item):
            if (!is_array($item)) continue;
            $total = $item['price'] * $item['quantity'];
            $grand_total += $total;
      ?>
      <tr>
        <td><?= $item['name'] ?></td>
        <td><?= number_format($item['price'], 2) ?></td>
        <td>
          <form method="post" style="display:inline;">
            <input type="hidden" name="product_id" value="<?= $id ?>">
            <input type="hidden" name="action" value="decrease">
            <button type="submit" name="update_quantity">-</button>
          </form>
          <?= $item['quantity'] ?>
          <form method="post" style="display:inline;">
            <input type="hidden" name="product_id" value="<?= $id ?>">
            <input type="hidden" name="action" value="increase">
            <button type="submit" name="update_quantity">+</button>
          </form>
        </td>
        <td><?= number_format($total, 2) ?></td>
        <td>
          <form method="post">
            <input type="hidden" name="remove_id" value="<?= $id ?>">
            <button type="submit" name="remove">Remove</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="3"><strong>Grand Total</strong></td>
        <td colspan="2"><strong>₹<?= number_format($grand_total, 2) ?></strong></td>
      </tr>
    </table>
    <?php else: ?>
      <p>Your cart is empty.</p>
    <?php endif; ?>
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
          <li><a href="index.php">Home</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li><a href="cart.php">Cart</a></li>
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
