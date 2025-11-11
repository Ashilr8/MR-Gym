<?php
session_start();

// Product Data (Replace with a database if you were actually building an e-commerce site)
$products = [
    1 => [
        'name' => 'Whey Protein - Chocolate',
        'description' => 'High-quality whey protein for muscle recovery and growth.  Delicious chocolate flavor.',
        'price' => 49.99,
        'image' => 'whey_protein.jpg'
    ],
    2 => [
        'name' => 'Creatine Monohydrate',
        'description' => 'Enhance strength and power with pure creatine monohydrate.  Micronized for better absorption.',
        'price' => 29.99,
        'image' => 'creatine.jpg'
    ],
    3 => [
        'name' => 'BCAA Capsules',
        'description' => 'Support muscle recovery and reduce muscle soreness. Convenient capsule form.',
        'price' => 34.99,
        'image' => 'bcaa.jpg'
    ],
    4 => [
        'name' => 'Pre-Workout Powder - Fruit Punch',
        'description' => 'Increase energy and focus for intense workouts.  Amazing fruit punch taste.',
        'price' => 39.99,
        'image' => 'preworkout.jpg'
    ],
    5 => [
        'name' => 'Multivitamin Tablets',
        'description' => 'Essential vitamins and minerals for overall health and performance.  One tablet a day.',
        'price' => 19.99,
        'image' => 'multivitamin.jpg'
    ],
     6 => [
        'name' => 'Glutamine Powder',
        'description' => 'Supports immune function and muscle recovery',
        'price' => 24.99,
        'image' => 'glutamine.jpg'
    ],
];


// Get the product ID from the query string
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Check if the product ID is valid
if (!isset($products[$product_id])) {
    // Redirect to the main store page if the product ID is invalid
    header("Location: supplement_store.php");
    exit();
}

// Get the product details
$product = $products[$product_id];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Supplement Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .product-details {
            display: flex;
            align-items: center;
        }

        .product-image {
            flex: 1;
            text-align: center;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .product-info {
            flex: 2;
            padding-left: 20px;
        }

        .product-info h2 {
            margin-bottom: 10px;
        }

        .product-info p {
            margin-bottom: 15px;
        }

        .product-info .price {
            font-weight: bold;
            color: #007bff;
            font-size: 1.2em;
        }

        .product-info button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product-info button:hover {
            background-color: #218838;
        }

        /* Back to Store Link */
        .back-to-store {
            margin-top: 20px;
            text-align: center;
        }

        .back-to-store a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-to-store a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $product['name']; ?></h1>

        <div class="product-details">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="product-info">
                <h2><?php echo $product['name']; ?></h2>
                <p><?php echo $product['description']; ?></p>
                <p class="price">Price: $<?php echo $product['price']; ?></p>
                <button>Add to Cart</button>
            </div>
        </div>

        <div class="back-to-store">
            <a href="supplement_store.php">Back to Store</a>
        </div>
    </div>
</body>
</html>
