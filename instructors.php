<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Instructor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Instructor</h2>
        <!-- HTML form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="instructor_id">Instructor ID:</label>
            <input type="text" id="instructor_id" name="instructor_id" required>

            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>

            <label for="expertise_area">Expertise Area:</label>
            <input type="text" id="expertise_area" name="expertise_area" required>

            <label for="experience">Experience:</label>
            <input type="number" id="experience" name="experience" required>

            <input type="submit" value="Add Instructor">
            <a href="home.html">Back to home</a>
        </form>

        <?php
        // PHP code for form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Include database connection
            include ('connection/conn.php');
            // Get form data and sanitize it
            $instructor_id = mysqli_real_escape_string($conn, $_POST['instructor_id']);
            $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
            $expertise_area = mysqli_real_escape_string($conn, $_POST['expertise_area']);
            $experience = mysqli_real_escape_string($conn, $_POST['experience']);

            // Check for duplicate instructor_id
            $check_sql = "SELECT instructor_id FROM instructors WHERE instructor_id = '$instructor_id'";
            $result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($result) > 0) {

            } else {
                // SQL query to insert data into database
                $sql = "INSERT INTO instructors (instructor_id, user_id, expertise_area, experience) VALUES ('$instructor_id', '$user_id', '$expertise_area', '$experience')";

                // Execute query
                if (mysqli_query($conn, $sql)) {
                    echo "<div class='success'>Instructor added successfully!</div>";
                } else {
                    echo "<div class='error'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</div>";
                }
            }

            // Close connection
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
