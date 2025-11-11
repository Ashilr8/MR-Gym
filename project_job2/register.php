<?php
// Database connection would be needed here in real implementation
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_NUMBER_FLOAT);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_NUMBER_FLOAT);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);

    // Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }

    if ($height < 50 || $height > 250) {
        $errors[] = "Height must be between 50cm and 250cm";
    }

    if ($weight < 30 || $weight > 300) {
        $errors[] = "Weight must be between 30kg and 300kg";
    }

    if ($age < 13 || $age > 120) {
        $errors[] = "Age must be between 13 and 120";
    }

    if (empty($errors)) {
        // In real implementation: Hash password and store in database
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, rgba(12, 12, 218, 0.95), rgba(18, 19, 27, 0.78));
        }

        .container {
            background-color: rgba(255, 255, 255, 0.4); /* Adjusted for more fade */
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type='number'],
        input[type='email'],
        input[type='password'] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.6);
        }

        button {
            padding: 10px;
            background-color: #2923DD;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #F80637;
        }

        .footer {
            margin-top: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #F80637;
            margin-bottom: 15px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 4px;
        }

        .success-message {
            color: #2923DD;
            margin-bottom: 15px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 4px;
        }

        .header-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 200px; /* Reduced size of image */
            max-width: 80%;  /* Make it responsive */
            box-shadow: 0 0 20px 5px rgba(12, 12, 218, 0.7);
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="Screenshot 2025-03-12 174511.png" alt="Company Logo" class="header-image">
        <h2>Register</h2>

        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message">
                <p>Registration successful! <a href="login.php">Login here</a></p>
            </div>
        <?php else: ?>
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Email"
                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>

                <input type="password" name="password" placeholder="Password"
                       minlength="8" required>

                <input type="number" name="height" placeholder="Height (cm)"
                       step="0.1" min="50" max="250"
                       value="<?php echo htmlspecialchars($_POST['height'] ?? ''); ?>" required>

                <input type="number" name="weight" placeholder="Weight (kg)"
                       step="0.1" min="30" max="300"
                       value="<?php echo htmlspecialchars($_POST['weight'] ?? ''); ?>" required>

                <input type="number" name="age" placeholder="Age"
                       min="13" max="120"
                       value="<?php echo htmlspecialchars($_POST['age'] ?? ''); ?>" required>

                <button type="submit">Register</button>
            </form>
        <?php endif; ?>

        <div class="footer">
            <a href="login_bmi.php">Already have an account? Login here.</a>
        </div>
    </div>
</body>
</html>
