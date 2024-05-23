<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are not empty
    if (
        !empty($_POST["instructor_id"]) &&
        !empty($_POST["title"]) &&
        !empty($_POST["start_date"]) &&
        !empty($_POST["end_date"])
    ) {
        // Extract data from the form
        $instructor_id = $_POST["instructor_id"];
        $title = $_POST["title"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];

        include ('connection/conn.php');

        // Prepare and bind the SQL statement (to prevent SQL injection)
        $stmt = $conn->prepare("INSERT INTO Courses (instructor_id, title, start_date, end_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $instructor_id, $title, $start_date, $end_date);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
            // Redirect to viewcourse.php after successful creation
            header('Location: viewcourse.php');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
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
        input[type="text"], input[type="date"] {
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create Course</h2>
        <form action="course.php" method="post">
            <div class="form-group">
                <label for="instructor_id">Instructor ID:</label>
                <input type="text" id="instructor_id" name="instructor_id" required>
            </div>
            <div class="form-group">
                <label for="title">Course Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <button type="submit">Create Course</button>
        </form>
    </div>
</body>
</html>
