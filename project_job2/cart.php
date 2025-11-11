<?php
session_start();

// Retrieve cart items from session
$cartItems = $_SESSION['cart'] ?? [];

// Handle Add to Cart action (not needed here, but useful for future reference)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // This logic is handled in store.php, but you can add it here if needed
}

// Handle Remove from Cart action
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    if (isset($cartItems[$index])) {
        unset($cartItems[$index]);
        $_SESSION['cart'] = array_values($cartItems); // Re-index the array
        header("Location: cart.php");
        exit;
    }
}

// Mock Payment System
if (isset($_POST['checkout'])) {
    // Simulate payment processing
    echo "<p>Payment processed successfully! Thank you for your order.</p>";
    // Clear cart after successful checkout
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Fitness Hub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <h1>Your Shopping Cart</h1>
</header>

<nav class="navbar">
    <a href="bmi_calc.php">Home</a>
    <a href="supplement_store.php">Continue Shopping</a>
</nav>

<main class="main-content">
    <?php if ($cartItems): ?>
        <div class="cart-grid">
            <?php foreach ($cartItems as $index => $item): ?>
                <!-- Display each cart item -->
                <div class="cart-item tile">
                    <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                    <p>Price: <?php echo htmlspecialchars($item['price']); ?></p>
                    <a href="?remove=<?php echo $index; ?>" class="btn">Remove</a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Total Price Calculation -->
        <?php
        $totalPrice = array_reduce($cartItems, function ($total, $item) {
            return $total + floatval(substr($item['price'], 1)); // Extract price value without currency symbol
        }, 0);
        ?>
        <p><strong>Total Price:</strong> R<?php echo number_format($totalPrice, 2); ?></p>

        <!-- Checkout Form -->
        <form action="" method="POST">
            <button type="submit" name="checkout" class="btn">Checkout</button>
        </form>

    <?php else: ?>
        <!-- If cart is empty -->
        <p>Your cart is empty. Start shopping!</p>
        <a href="supplement_store.php" class="btn">Shop Now</a>
    <?php endif; ?>
</main>

<footer class="footer">
    <p>&copy; 2025 Fitness Hub Store. All rights reserved.</p>
</footer>

</body>
</html>
