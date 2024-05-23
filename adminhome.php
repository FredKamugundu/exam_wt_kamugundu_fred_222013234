<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to the login page
    header('Location: admin_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('o2.jpg'); /* Replace 'background.jpg' with your image file */
            background-size: cover;
            background-position: center;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            border-radius: 10px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 40px;
        }
        .link-container {
            display: flex;
            justify-content: space-between; /* Align links and logout button */
            flex-wrap: wrap; /* Allow wrapping */
            padding: 10px;
        }
        .link-container .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
            min-width: 160px;
            z-index: 1;
        }
        .dropdown-content a {
            color: #fff;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #0056b3;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .link-container a {
            margin: 10px;
            color: #fff;
            text-decoration: none;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .link-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>You are logged in as <?php echo htmlspecialchars($_SESSION['admin_email']); ?>.</p>
        <div class="link-container">
        <a href="questions.php">questions</a>
        <a href="quiz_attempts.php">quiz attempts</a>
        <a href="quizzes.php">quizzes</a>
            <div class="dropdown">
                <a href="#" class="dropbtn">View all pages</a>
                <div class="dropdown-content">
                    <a href="viewenrollment.php">Enrollments</a>
                    <a href="viewcourse.php">Courses</a>
                    <a href="viewfeedback.php">Feedback</a>
                    <a href="viewquestions.php">Questions</a>
                    <a href="viewquizzes.php">Quizzes</a>
                    <a href="viewquiz_attempts.php">Quiz Attempts</a>
                    <a href="viewinstructors.php">Instructors</a>
                    <a href="viewfinancial_literacy.php">Financial Literacy</a>
                </div>
            </div>
            <a href="logout.php" style="margin-left: auto;">Logout</a>
        </div>
    </div>
</body>
</html>
