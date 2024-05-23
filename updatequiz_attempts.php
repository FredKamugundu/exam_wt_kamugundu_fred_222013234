<?php
include ('connection/conn.php');
// Initialize variables

$attempt_id = $user_id = $quiz_id = $score = "";
$errors = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quiz_attempts'])) {
    $attempt_id = htmlspecialchars($_POST['attempt_id']);
    $user_id = htmlspecialchars($_POST['user_id']);
    $quiz_id = htmlspecialchars($_POST['quiz_id']);
    $score = htmlspecialchars($_POST['score']);

$update_sql = "UPDATE quiz_attempts SET user_id='$user_id', quiz_id='$quiz_id', score='$score' WHERE attempt_id='$attempt_id'";

  if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Course updated successfully');</script>";
        echo "<script>window.location.href = 'viewquiz_attempts.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating course: " . $conn->error;
    }
}





    // Validate inputs
    if (empty($user_id) || empty($quiz_id) || empty($score)) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {
        // Update query using prepared statements
        $stmt = $conn->prepare("UPDATE quiz_attempts SET user_id = ?, quiz_id = ?, score = ? WHERE attempt_id = ?");
        $stmt->bind_param("iiii", $user_id, $quiz_id, $score, $attempt_id);

        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
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
    <title>Update quiz_attempts</title>
</head>
<body>
    <center>
        <h2>Update quiz_attempts</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="user_id">user id:</label>
            <input type="number" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>" required><br><br>
            <label for="quiz_id">quiz id:</label>
            <input type="number" id="quiz_id" name="quiz_id" value="<?php echo htmlspecialchars($quiz_id); ?>" required><br><br>
            <label for="score">score:</label>
            <input type="number" id="score" name="score" value="<?php echo htmlspecialchars($score); ?>" required><br><br>
            
            
            <input type="submit" name="update_quiz_attempts" value="Update">
            <ul><li><a href="home.html">BACK</a></li></ul>
        </form>
    </center>
</body>
</html>
