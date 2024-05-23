<?php
include ('connection/conn.php');

// Check if quiz ID is provided via URL parameter
if (isset($_GET['quiz_id'])) {
    $quiz_id = $_GET['quiz_id'];

    // Delete query
    $delete_sql = "DELETE FROM quizzes WHERE quiz_id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $quiz_id);

    if ($stmt->execute()) {
        echo "<script>alert('Quiz deleted successfully');</script>";
        echo "<script>window.location.href = 'viewquizzes.php';</script>"; // Redirect to quizzes list page
    } else {
        echo "Error deleting quiz: " . $stmt->error;
    }
} else {
    echo "No quiz ID provided";
    exit;
}

// Close statement
$stmt->close();
?>
