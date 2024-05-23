<?php
// Check if the instructor ID is provided via URL parameter
if (isset($_GET['instructor_id'])) {
    $instructor_id = $_GET['instructor_id'];

    include ('connection/conn.php');

    // Delete query
    $delete_sql = "DELETE FROM instructors WHERE instructor_id='$instructor_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Instructor deleted successfully');</script>";
        echo "<script>window.location.href = 'viewinstructors.php';</script>"; // Redirect to view instructors page
    } else {
        echo "Error deleting instructor: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "No instructor ID provided";
    exit;
}
?>
