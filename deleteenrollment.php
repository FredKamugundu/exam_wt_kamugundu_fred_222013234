<?php
include ('connection/conn.php');

// Check if enrollment ID is provided via URL parameter
if (isset($_GET['id'])) {
    $enrollment_id = $_GET['id'];

    // Delete query
    $delete_sql = "DELETE FROM enrollments WHERE enrollment_id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $enrollment_id);

    if ($stmt->execute()) {
        echo "<script>alert('Enrollment deleted successfully');</script>";
        echo "<script>window.location.href = 'viewenrollment.php';</script>"; // Redirect to enrollment list page
    } else {
        echo "Error deleting enrollment: " . $stmt->error;
    }
} else {
    echo "No enrollment ID provided";
    exit;
}

// Close statement
$stmt->close();
?>
