<?php
// Database connection
include ('connection/conn.php');

// Initialize variables
$quiz_id = $course_id = $title = $total_marks = "";
$errors = [];

// Check if the form is submitted for quizzes update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quizzes'])) {
    // Retrieve the submitted form data
    $quiz_id = $conn->real_escape_string($_POST['quiz_id']);
    $course_id = $conn->real_escape_string($_POST['course_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $total_marks = $conn->real_escape_string($_POST['total_marks']);
    
    // Update the quizzes record in the database
    $update_sql = "UPDATE quizzes SET course_id='$course_id', title='$title', total_marks='$total_marks' WHERE quiz_id='$quiz_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Quizzes updated successfully');</script>";
        echo "<script>window.location.href = 'viewquizzes.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating quizzes: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['id'])) {
    $quiz_id = $conn->real_escape_string($_GET['id']);
    $select_sql = "SELECT * FROM quizzes WHERE quiz_id='$quiz_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the quizzes data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $course_id = $row['course_id'];
        $title = $row['title'];
        $total_marks = $row['total_marks'];
    } else {
        echo "Quizzes not found";
        header('Location: viewquizzes.php');
        exit;
    }
} else {
    echo "No quizzes ID provided";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Quizzes</title>
</head>
<body>
    <center>
        <h2>Update Quizzes</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
            <label for="course_id">Course ID:</label>
            <input type="text" id="course_id" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>" required><br><br>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required><br><br>
            <label for="total_marks">Total Marks:</label>
            <input type="text" id="total_marks" name="total_marks" value="<?php echo htmlspecialchars($total_marks); ?>" required><br><br>
            <input type="submit" name="update_quizzes" value="Update Quizzes">
            <ul><li><a href="home.html">BACK</a></li></ul>
        </form>
    </center>
</body>
</html>
