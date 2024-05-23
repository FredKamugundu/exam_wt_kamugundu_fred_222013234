<?php
include ('connection/conn.php');

$question_id = $quiz_id = $question_text = $option_1 = $correct_option = "";
$errors = [];
$success_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert_question'])) {
    $quiz_id = htmlspecialchars($_POST['quiz_id']);
    $question_text = htmlspecialchars($_POST['question_text']);
    $option_1 = htmlspecialchars($_POST['option_1']);
    $correct_option = htmlspecialchars($_POST['correct_option']);

    // Validate inputs
    if (empty($quiz_id) || empty($question_text) || empty($option_1) || empty($correct_option)) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {
        // Insert query
        $insert_sql = "INSERT INTO questions (quiz_id, question_text, option_1, correct_option) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("isss", $quiz_id, $question_text, $option_1, $correct_option);

        if ($stmt->execute()) {
            $success_message = "Record inserted successfully";
        } else {
            $errors[] = "Error inserting record: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Question</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto; /* Center the container */
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="number"],
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    
</head>
<body>
    <!-- Your HTML content here -->
    <div class="container">
        <h2>Insert Question</h2>
        <!-- Error and success messages -->
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="success">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <!-- Form for inserting question -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="quiz_id">Quiz ID:</label>
                <input type="number" id="quiz_id" name="quiz_id" value="<?php echo htmlspecialchars($quiz_id); ?>" required>
            </div>

            <div class="form-group">
                <label for="question_text">Question Text:</label>
                <input type="text" id="question_text" name="question_text" value="<?php echo htmlspecialchars($question_text); ?>" required>
            </div>

            <div class="form-group">
                <label for="option_1">Option 1:</label>
                <input type="text" id="option_1" name="option_1" value="<?php echo htmlspecialchars($option_1); ?>" required>
            </div>

            <div class="form-group">
                <label for="correct_option">Correct Option:</label>
                <input type="text" id="correct_option" name="correct_option" value="<?php echo htmlspecialchars($correct_option); ?>" required>
            </div>

            <input type="submit" name="insert_question" value="Insert">
        </form>

        <!-- Links -->
        <a href="index.php">Back to home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="viewquestions.php">View Questions</a>
    </div>
</body>
</html>
