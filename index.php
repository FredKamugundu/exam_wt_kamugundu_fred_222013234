<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Literacy Platform</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('o2.jpg');
        }

        .navbar {
            background-color: darkblue;
            color: white;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
        }

        .title {
            margin-left: 250px;
            font-size: 24px;
        }

        .nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav-links li {
            margin-left: 20px;
            position: relative;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .nav-links a:hover {
            color: #f0a500;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: yellow;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 10px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: gray;
        }

        .nav-links li:hover .dropdown-content {
            display: block;
        }

        .hero {
            color: white;
            text-align: center;
            padding: 100px 0;
        }

        .btn {
            background-color: #f0a500;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn:hover {
            background-color: hotpink;
        }

        .courses {
            padding: 50px 0;
            text-align: center;
        }

        .course-card {
            display: inline-block;
            width: 300px;
            margin: 20px;
            padding: 20px;
            background-color: greenyellow;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer .container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo-container">
                <img class="logo" src="logo.jpeg" alt="image" width="50" height="50">
                <h1 class="title">Financial Literacy Platform</h1>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about_us.html">About</a></li>
                <li><a href="contact_us.html">Contact</a></li>
                <li>
                    <a href="#">Menu</a>
                    <div class="dropdown-content">
                        <a href="usersignup.php"> user Sign In</a>
                        <a href="adminsignup.php">admin Sign In</a>
                        <a href="admin.php">admin Log In</a>
                        <a href="user.php">user Log In</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h2>Welcome to our Financial Literacy Platform</h2>
            <p>Learn essential financial skills to manage your money effectively.</p>
           
        </div>
    </section>

    <!-- Featured Courses Section -->
    <section class="courses">
        <div class="container">
            <h2>Featured Courses</h2>
            <div class="course-card">
                <h3>Introduction to Budgeting</h3>
                <p>Learn how to create and maintain a budget to achieve your financial goals.</p>
                
            </div>
            <div class="course-card">
                <h3>Investing 101</h3>
                <p>Understand the basics of investing and how to build a diversified investment portfolio.</p>
                
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Financial Literacy Platform. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
