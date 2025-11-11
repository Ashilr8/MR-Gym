<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
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
            background-color: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

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

        .header-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 250px; /* Adjust size as needed */
            box-shadow: 0 0 20px 5px rgba(12, 12, 218, 0.7); /* Glow effect */
            border-radius: 8px; /* Optional: for rounded corners on the glow */
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Add the logo or header image -->
        <img src="Screenshot 2025-03-12 174511.png" alt="Company Logo" class="header-image">

        <h2>Login</h2>
        <form action="bmi_calc.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>


        <div class="footer">
            <a href="register.php">Don't have an account? Register here.</a>
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </div>
</body>
