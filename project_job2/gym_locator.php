<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Locator - Fitness Hub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <h1>Gym Locator</h1>
    </header>

    <nav class="navbar">
        <a href="bmi_calc.php">Home</a>
        <a href="supplement_store.php">Store</a>
        <a href="gym_locator.php">Gym Locator</a>
    </nav>

    <main class="main-content">
        <div class="gym-locator-form">
            <h2>Find Gyms Near You</h2>
            <form action="" method="POST">
                <label for="zipcode">Enter your ZIP code:</label>
                <input type="text" id="zipcode" name="zipcode" required>
                <button type="submit" name="find_gyms" class="btn">Find Gyms</button>
            </form>
        </div>

        <div id="gym-results">
            <?php
            if (isset($_POST['find_gyms'])) {
                $zipcode = $_POST['zipcode'];
                
                // Mock gym data (in a real application, this would come from an API or database)
                $gyms = [
                    ['name' => 'FitZone Gym', 'address' => '123 Main St, ' . $zipcode],
                    ['name' => 'PowerLift Center', 'address' => '456 Elm St, ' . $zipcode],
                    ['name' => 'Flex Fitness', 'address' => '789 Oak Ave, ' . $zipcode],
                ];
            
                echo "<h3>Gyms near " . htmlspecialchars($zipcode) . ":</h3>";
                echo "<ul class='gym-list'>";
                foreach ($gyms as $gym) {
                    echo "<li class='gym-item'>";
                    echo "<strong>" . htmlspecialchars($gym['name']) . "</strong><br>";
                    echo htmlspecialchars($gym['address']);
                    echo "</li>";
                }
                echo "</ul>";
            }
            ?>
            
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2025 Fitness Hub. All rights reserved.</p>
    </footer>
</body>
</html>
