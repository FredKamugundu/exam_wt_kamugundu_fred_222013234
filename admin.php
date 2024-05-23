<?php
session_start();

// Database connection
include ('connection/conn.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both fields are not empty
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        // Extract data from the form
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);

        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if an admin is found
        if ($result->num_rows > 0) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $email;
            // Redirect to the admin dashboard
            header('Location: adminhome.php');
            exit();
        } else {
            // Redirect back to login page with error
            header('Location: admin_login.php?error=1');
            exit();
        }

        // Close statement
        $stmt->close();
    } else {
        // Redirect back to login page with error
        header('Location: admin_login.php?error=1');
        exit();
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 300px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Admin Login</h2>
        <form action="admin.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="error-message">
            <?php 
                if (isset($_GET['error'])) {
                    echo '<p>Invalid email or password</p>';
                }
            ?>
        </div>
    </div>
</body>
</html>
