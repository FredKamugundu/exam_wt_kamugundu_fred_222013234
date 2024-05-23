<?php
// Database connection
include ('connection/conn.php');
// Check if the quiz_attempts ID is provided via URL parameter
if (isset($_GET['attempt_id'])) {
    $attempt_id = $conn->real_escape_string($_GET['attempt_id']);

    // SQL query to delete the quiz_attempts
    $delete_sql = "DELETE FROM quiz_attempts WHERE attempt_id='$attempt_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('quiz_attempts deleted successfully');</script>";
        echo "<script>window.location.href = 'viewquiz_attempts.php';</script>"; // Redirect to the view page
    } else {
        echo "Error deleting quiz_attempts: " . $conn->error;
    }
} else {
    echo "No quiz_attempts ID provided";
    exit;
}

$conn->close();
?>
