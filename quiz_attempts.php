<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attempt Quiz</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <center>
        <h2>Attempt Quiz</h2><br><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required><br><br>
            <label for="quiz_id">Quiz ID:</label>
            <input type="text" id="quiz_id" name="quiz_id" required><br><br>
            <label for="score">Score:</label>
            <input type="number" id="score" name="score" required><br><br>
            <input type="submit" value="Submit Quiz"><br><br>
            <ul><li><a href="home.html">BACK</a></li></ul>
        </form>
    </center>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all fields are set
        if (
            isset($_POST["user_id"]) &&
            isset($_POST["quiz_id"]) &&
            isset($_POST["score"])
        ) {
            // Extract data from the form
            $user_id = $_POST["user_id"];
            $quiz_id = $_POST["quiz_id"];
            $score = $_POST["score"];
            
            // Database connection
           include ('connection/conn.php');
            
            // SQL query to insert data into the database
            $sql = "INSERT INTO Quiz_Attempts (user_id, quiz_id, score) VALUES ('$user_id', '$quiz_id', '$score')";
            echo "quiz_attempts not found";
        header('Location: viewquiz_attempts.php');
            
            if ($conn->query($sql) === TRUE) {
                echo "Quiz attempted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            // Close the connection
            $conn->close();
        } else {
            echo "All fields are required.";
        }
    }
    ?>
</body>
</html>
