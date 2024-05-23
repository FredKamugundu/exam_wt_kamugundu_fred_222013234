<?php
include ('connection/conn.php');

// Check if enrollment ID is provided via URL parameter
if (isset($_GET['id'])) {
    $enrollment_id = $_GET['id'];

    // Fetch enrollment data based on the provided ID
    $select_sql = "SELECT * FROM enrollments WHERE enrollment_id = ?";
    $stmt = $conn->prepare($select_sql);
    $stmt->bind_param("i", $enrollment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if enrollment data exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];
        $course_id = $row["course_id"];
        $completion_status = $row["completion_status"];
    } else {
        echo "Enrollment not found";
        exit;
    }
} else {
    echo "No enrollment ID provided";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_enrollment'])) {
    $user_id = htmlspecialchars($_POST['user_id']);
    $course_id = htmlspecialchars($_POST['course_id']);
    $completion_status = htmlspecialchars($_POST['completion_status']);

    // Update query
    $update_sql = "UPDATE enrollments SET user_id=?, course_id=?, completion_status=? WHERE enrollment_id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("iisi", $user_id, $course_id, $completion_status, $enrollment_id);

    if ($stmt->execute()) {
        echo "<script>alert('Enrollment updated successfully');</script>";
        echo "<script>window.location.href = 'viewenrollment.php';</script>"; // Redirect to enrollment list page
    } else {
        echo "Error updating enrollment: " . $stmt->error;
    }
}

// Close statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Enrollment</title>
</head>
<body>
    <h2>Update Enrollment</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $enrollment_id; ?>" method="post">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>" required><br><br>
        <label for="course_id">Course ID:</label>
        <input type="number" id="course_id" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>" required><br><br>
        <label for="completion_status">Completion Status:</label>
        <input type="text" id="completion_status" name="completion_status" value="<?php echo htmlspecialchars($completion_status); ?>" required><br><br>
        <input type="submit" name="update_enrollment" value="Update">
    </form>
</body>
</html>
