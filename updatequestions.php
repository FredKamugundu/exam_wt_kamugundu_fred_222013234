<?php
// Database connection
include ('connection/conn.php');

// Initialize variables
$question_id = $quiz_id = $question_text = $option_1 = $correct_option = "";
$errors = [];

// Check if the form is submitted for questions update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_question'])) {
    // Retrieve the submitted form data
    $question_id = $conn->real_escape_string($_POST['question_id']);
    $quiz_id = $conn->real_escape_string($_POST['quiz_id']);
    $question_text = $conn->real_escape_string($_POST['question_text']);
    $option_1 = $conn->real_escape_string($_POST['option_1']);
    $correct_option = $conn->real_escape_string($_POST['correct_option']);

    // Update the question record in the database
    $update_sql = "UPDATE questions SET quiz_id='$quiz_id', question_text='$question_text', option_1='$option_1', correct_option='$correct_option' WHERE question_id='$question_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Question updated successfully');</script>";
        echo "<script>window.location.href = 'viewquestions.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating question: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['id'])) {
    $question_id = $conn->real_escape_string($_GET['id']);
    $select_sql = "SELECT * FROM questions WHERE question_id='$question_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the question data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $quiz_id = $row['quiz_id'];
        $question_text = $row['question_text'];
        $option_1 = $row['option_1'];
        $correct_option = $row['correct_option'];
    } else {
        echo "Question not found";
        header('Location: viewquestions.php');
        exit;
    }
} else {
    echo "No question ID provided";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Question</title>
</head>
<body>
    <center>
        <h2>Update Question</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
            <label for="quiz_id">Quiz ID:</label>
            <input type="text" id="quiz_id" name="quiz_id" value="<?php echo htmlspecialchars($quiz_id); ?>" required><br><br>
            <label for="question_text">Question Text:</label>
            <input type="text" id="question_text" name="question_text" value="<?php echo htmlspecialchars($question_text); ?>" required><br><br>
            <label for="option_1">Option 1:</label>
            <input type="text" id="option_1" name="option_1" value="<?php echo htmlspecialchars($option_1); ?>" required><br><br>
            <label for="correct_option">Correct Option:</label>
            <input type="text" id="correct_option" name="correct_option" value="<?php echo htmlspecialchars($correct_option); ?>" required><br><br>
            <input type="submit" name="update_question" value="Update Question">
            <ul><li><a href="home.html">BACK</a></li></ul>
        </form>
    </center>
</body>
</html>
