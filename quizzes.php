<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quizzes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Add Quizzes</h2>
    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="course_id">Course ID:</label>
        <input type="text" id="course_id" name="course_id" required><br>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="total_marks">Total Marks:</label>
        <input type="text" id="total_marks" name="total_marks" required><br>
        <input type="submit" name="insert_quizzes" value="Insert Quizzes">
    </form>
</body>
</html>

<?php
// Database connection
include ('connection/conn.php');

// Initialize variables
$course_id = $title = $total_marks = "";
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert_quizzes'])) {
    // Retrieve the submitted form data
    $course_id = $conn->real_escape_string($_POST['course_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $total_marks = $conn->real_escape_string($_POST['total_marks']);
    
    // Validate form fields
    if (empty($course_id) || empty($title) || empty($total_marks)) {
        $errors[] = "All fields are required.";
    }

    // If no errors, insert the quizzes record into the database
    if (empty($errors)) {
        $insert_sql = "INSERT INTO quizzes (course_id, title, total_marks) VALUES ('$course_id', '$title', '$total_marks')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>alert('Quizzes inserted successfully');</script>";
            echo "<script>window.location.href = 'viewquizzes.php';</script>"; // Redirect to the view page
        } else {
            echo "Error inserting quizzes: " . $conn->error;
        }
    }
}
        

// Close connection
$conn->close();
?>
