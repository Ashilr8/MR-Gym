<?php
// In a real application, you'd connect to your database here
// and implement the password reset logic.

$errors = [];
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the email input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Validate the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        // In a real app, you would check if the email exists in your database.
        // If it exists, you'd generate a unique reset token, store it in the database
        // along with the user's email, and send a password reset link to the user's email.

        // For this example, we'll just pretend the email was found and a reset link was sent.
        $success_message = "A password reset link has been sent to your email address.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Forgot Password</title>
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
            background-color: rgba(255, 255, 255, 0.4);
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

        input[type='email'] {
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
        <h2>Forgot Password</h2>

        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="success-message">
                <p><?php echo htmlspecialchars($success_message); ?></p>
            </div>
        <?php else: ?>
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit">Reset Password</button>
            </form>
        <?php endif; ?>

        <div class="footer">
            <a href="login_bmi.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
