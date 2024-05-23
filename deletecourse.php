<?php
// Database connection
include ('connection/conn.php');

// Check if the course ID is provided via URL parameter
if (isset($_GET['id'])) {
    $course_id = $conn->real_escape_string($_GET['id']);

    // SQL query to delete the course
    $delete_sql = "DELETE FROM Courses WHERE course_id='$course_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Course deleted successfully');</script>";
        echo "<script>window.location.href = 'viewcourse.php';</script>"; // Redirect to the view page
    } else {
        echo "Error deleting course: " . $conn->error;
    }
} else {
    echo "No course ID provided";
    exit;
}

$conn->close();
?>
