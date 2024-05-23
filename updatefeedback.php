<?php
// Database connection
include ('connection/conn.php');

$feedback_id = $user_id = $course_id = $instructor_id = $comments = "";
$errors = [];
$success_message = "";

// Check if the feedback ID is provided via URL parameter
if (isset($_GET['id'])) {
    $feedback_id = $_GET['id'];

    // SQL query to retrieve feedback data based on the ID
    $select_sql = "SELECT * FROM feedback WHERE feedback_id='$feedback_id'";
    $result = $conn->query($select_sql);

    if ($result->num_rows == 1) {
        // Fetch feedback data
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $course_id = $row['course_id'];
        $instructor_id = $row['instructor_id'];
        $comments = $row['comments'];
    } else {
        echo "<script>alert('feedback updated successfully');</script>";
        echo "<script>window.location.href = 'viewfeedback.php';</script>";
        exit;
    }
} else {
    echo "No feedback ID provided";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_feedback'])) {
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $instructor_id = $_POST['instructor_id'];
    $comments = $_POST['comments'];

    // Update query
    $update_sql = "UPDATE feedback SET user_id='$user_id', course_id='$course_id', instructor_id='$instructor_id', comments='$comments' WHERE feedback_id='$feedback_id'";

    if ($conn->query($update_sql) === TRUE) {
        $success_message = "Feedback updated successfully";
        echo "<script>window.location.href = 'viewfeedback.php';</script>";
    } else {
        $errors[] = "Error updating feedback: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Feedback</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Feedback</h2>
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

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $feedback_id; ?>" method="post">
            <input type="hidden" name="feedback_id" value="<?php echo htmlspecialchars($feedback_id); ?>">
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>" required><br><br>
            <label for="course_id">Course ID:</label>
            <input type="number" id="course_id" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>" required><br><br>
            <label for="instructor_id">Instructor ID:</label>
            <input type="number" id="instructor_id" name="instructor_id" value="<?php echo htmlspecialchars($instructor_id); ?>" required><br><br>
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" required><?php echo htmlspecialchars($comments); ?></textarea><br><br>
            <input type="submit" name="update_feedback" value="Update">
        </form>
    </div>
</body>
</html>
