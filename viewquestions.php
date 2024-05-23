<?php
include ('connection/conn.php');

// Fetch questions data from the database
$select_sql = "SELECT * FROM questions";
$result = $conn->query($select_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions List</title>
    <style>
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
    </style>
</head>
<body><center>
    <h2>Questions List</h2>
    <table border="3">
        <thead>
            <tr>
                <th>Question ID</th>
                <th>Quiz ID</th>
                <th>Question Text</th>
                <th>Option 1</th>
                <th>Correct Option</th>
                <th>Action</th>
            </tr>
        </thead>
        <body>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['question_id'] . "</td>";
                    echo "<td>" . $row['quiz_id'] . "</td>";
                    echo "<td>" . $row['question_text'] . "</td>";
                    echo "<td>" . $row['option_1'] . "</td>";
                    echo "<td>" . $row['correct_option'] . "</td>";
                    echo "<td class='action-links'>
                            <a href='updatequestion.php?id=" . $row['question_id'] . "'>Update</a>
                            <a href='deletequestion.php?id=" . $row['question_id'] . "'>Delete</a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No questions available</td></tr>";
            }
            ?>
        </center>
        </body>
    </table>
</body>
</html>
