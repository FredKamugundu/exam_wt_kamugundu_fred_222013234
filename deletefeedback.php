<?php
// Database connection
include ('connection/conn.php');

// Check if the feedback ID is provided via URL parameter
if (isset($_GET['id'])) {
    $feedback_id = $_GET['id'];

    // SQL query to delete the feedback record
    $delete_sql = "DELETE FROM feedback WHERE feedback_id='$feedback_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Feedback deleted successfully');</script>";
        echo "<script>window.location.href = 'viewfeedback.php';</script>"; // Redirect to view feedback page
    } else {
        echo "Error deleting feedback: " . $conn->error;
    }
} else {
    echo "No feedback ID provided";
    exit;
}

// Close connection
$conn->close();
?>
