<?php
include ('connection/conn.php');


$user_id = $course_id = $instructor_id = $comments = "";
$errors = [];
$success_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert_feedback'])) {
    $user_id = htmlspecialchars($_POST['user_id']);
    $course_id = htmlspecialchars($_POST['course_id']);
    $instructor_id = htmlspecialchars($_POST['instructor_id']);
    $comments = htmlspecialchars($_POST['comments']);

    // Validate inputs
    if (empty($user_id) || empty($course_id) || empty($instructor_id) || empty($comments)) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {
        // Insert query
        $insert_sql = "INSERT INTO feedback (user_id, course_id, instructor_id, comments) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("iiis", $user_id, $course_id, $instructor_id, $comments);

        if ($stmt->execute()) {
            $success_message = "Feedback submitted successfully";
        } else {
            $errors[] = "Error submitting feedback: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback</title>
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
        input[type="number"],
        textarea,
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
        <h2>Submit Feedback</h2>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="success">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="number" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>" required>
            </div>

            <div class="form-group">
                <label for="course_id">Course ID:</label>
                <input type="number" id="course_id" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>" required>
            </div>

            <div class="form-group">
                <label for="instructor_id">Instructor ID:</label>
                <input type="number" id="instructor_id" name="instructor_id" value="<?php echo htmlspecialchars($instructor_id); ?>" required>
            </div>

            <div class="form-group">
                <label for="comments">Comments:</label>
                <textarea id="comments" name="comments" required><?php echo htmlspecialchars($comments); ?></textarea>
            </div>

            <input type="submit" name="insert_feedback" value="Submit">
        </form>

        <a href="index.php">Back to Feedback List</a>
    </div>
</body>
</html>
