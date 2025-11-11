<?php
session_start();

// Define products for the store
$products = [
    "supplements" => [
        ["Whey Protein", "images/whey-protein.jpg", "R500"],
        ["Creatine Monohydrate", "images/creatine.jpg", "R300"],
        ["Pre-Workout", "images/pre-workout.jpg", "R400"],
        ["BCAA Powder", "images/bcaa.jpg", "R350"],
    ],
    "fitness-products" => [
        ["Dumbbells (Set of 2)", "images/dumbbells.jpg", "R800"],
        ["Yoga Mat", "images/yoga-mat.jpg", "R200"],
        ["Kettlebell (10kg)", "images/kettlebell.jpg", "R600"],
        ["Resistance Bands (Set)", "images/resistance-bands.jpg", "R250"],
    ],
];

// Initialize cart if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Add to Cart action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    // Add product to cart
    $_SESSION['cart'][] = [
        'name' => $productName,
        'price' => $productPrice,
    ];
}

// Get category from URL
$category = $_GET['category'] ?? 'all';

// Filter products based on category
$filteredProducts = $category === 'all' ? array_merge(...array_values($products)) : $products[$category] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Hub Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <div class="container">
        <h1>Fitness Hub Store</h1>
        <nav class="navbar">
            <a href="bmi_calc.php">Home</a>
            <a href="?category=all">All Products</a>
            <a href="?category=supplements">Supplements</a>
            <a href="?category=fitness-products">Fitness Products</a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i> View Cart (<?php echo count($_SESSION['cart']); ?>)</a>
        </nav>
    </div>
</header>

<main class="main-content container">
    <?php if ($filteredProducts): ?>
        <div class="product-grid">
            <?php foreach ($filteredProducts as $product): ?>
                <div class="product-item card">
                    <img src="<?php echo $product[1]; ?>" alt="<?php echo $product[0]; ?>" class="product-image">
                    <h4 class="product-title"><?php echo $product[0]; ?></h4>
                    <p class="product-price">Price: <?php echo $product[2]; ?></p>
                    <form action="" method="POST" class="add-to-cart-form">
                        <input type="hidden" name="product_name" value="<?php echo $product[0]; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product[2]; ?>">
                        <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No products found in this category.</p>
    <?php endif; ?>
</main>

<footer class="footer container">
    <p>&copy; 2025 Fitness Hub Store. All rights reserved.</p>
</footer>

<style>
/* Modern styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    margin: auto;
}

.header {
    background: linear-gradient(135deg,rgb(47, 79, 224) 0%,rgb(0, 0, 0) 100%);
    color: #fff;
    padding: 1rem 0;
}

.navbar a {
    color: #fff;
    background: linear-gradient(135deg,rgb(47, 79, 224) 0%,rgb(0, 0, 0) 100%);
    text-decoration: none;
    margin-right: 15px;
}

.navbar a:hover {
    text-decoration: underline;
}

.main-content {
    padding: 2rem 0;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.product-item {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
}

.product-image {
    max-width: 100%;
}

.btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>

<script>
// Optional JavaScript for interactivity
document.querySelectorAll('.btn').forEach(button => {
   button.addEventListener('click', () => alert('Added to cart!'));
});
</script>

</body>
</html>
