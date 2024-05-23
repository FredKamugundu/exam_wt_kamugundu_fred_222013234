<?php
// Database connection
include ('connection/conn.php');

// Fetch feedback data from the database
$select_sql = "SELECT * FROM feedback";
$result = $conn->query($select_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
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
    <h2>Feedback List</h2>
    <table border="4">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Course ID</th>
                <th>Instructor ID</th>
                <th>Comments</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['course_id'] . "</td>";
                    echo "<td>" . $row['instructor_id'] . "</td>";
                    echo "<td>" . $row['comments'] . "</td>";
                    echo "<td class='action-links'>
                            <a href='updatefeedback.php?id=" . $row['feedback_id'] . "'>Update</a>
                            <a href='deletefeedback.php?id=" . $row['feedback_id'] . "'>Delete</a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No feedback data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
