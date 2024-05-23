<?php
// Database connection
include ('connection/conn.php');

// Fetch quizzes data from the database
$select_sql = "SELECT * FROM quizzes";
$result = $conn->query($select_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzes List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .action-links a {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px;
        }
        .action-links a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Quizzes List</h2>
    <table border="4">
        <thead>
            <tr>
                <th>Quizzes ID</th>
                <th>Course ID</th>
                <th>Title</th>
                <th>Total Marks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['quiz_id'] . "</td>";
                    echo "<td>" . $row['course_id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['total_marks'] . "</td>";
                    echo "<td class='action-links'>
                            <a href='updatequizzes.php?id=" . $row['quiz_id'] . "'>Update</a>
                            <a href='deletequizzes.php?id=" . $row['quiz_id'] . "'>Delete</a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No quizzes data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
