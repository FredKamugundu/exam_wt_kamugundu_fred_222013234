<?php
include ('connection/conn.php');
// Check if the question ID is provided via URL parameter
if (isset($_GET['id'])) {
    $question_id = $_GET['id'];

    // SQL query to delete the question record
    $delete_sql = "DELETE FROM questions WHERE question_id='$question_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Question deleted successfully');</script>";
        echo "<script>window.location.href = 'viewquestions.php';</script>"; // Redirect to view questions page
    } else {
        echo "Error deleting question: " . $conn->error;
    }
} else {
    echo "No question ID provided";
    exit;
}

// Close connection
$conn->close();
?>
