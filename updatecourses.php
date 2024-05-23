<?php
// Database connection
include ('connection/conn.php');

// Check if the form is submitted for courses update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_courses'])) {
    // Retrieve the submitted form data
    $course_id = $conn->real_escape_string($_POST['course_id']);
    $instructor_id = $conn->real_escape_string($_POST['instructor_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    
    // Update the courses record in the database
    $update_sql = "UPDATE Courses SET instructor_id='$instructor_id', title='$title', start_date='$start_date', end_date='$end_date' WHERE course_id='$course_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Course updated successfully');</script>";
        echo "<script>window.location.href = 'viewcourse.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating course: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['id'])) {
    $course_id = $conn->real_escape_string($_GET['id']);
    $select_sql = "SELECT * FROM Courses WHERE course_id='$course_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the course data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $instructor_id = $row['instructor_id'];
        $title = $row['title'];
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
    } else {
        echo "Course not found";
        header('Location: viewcourses.php');
        exit;
    }
} else {
    echo "No course ID provided";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
</head>
<body>
    <center>
        <h2>Update Course</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">
            <label for="instructor_id">Instructor ID:</label>
            <input type="text" id="instructor_id" name="instructor_id" value="<?php echo htmlspecialchars($instructor_id); ?>" required><br><br>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required><br><br>
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>" required><br><br>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>" required><br><br>
            <input type="submit" name="update_courses" value="Update">
            <ul><li><a href="home.html">BACK</a></li></ul>
        </form>
    </center>
</body>
</html>

<?php $conn->close(); ?>
