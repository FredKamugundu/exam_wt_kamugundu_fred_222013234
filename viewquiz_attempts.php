<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Quiz Attempts</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <center>
        <h2>Quiz Attempts List</h2>
        <table border="1">
            <tr>
                <th>User ID</th>
                <th>Quiz ID</th>
                <th>Score</th>
                <th colspan="2">Action </th>
            </tr>
            <?php
            // Database connection
            include ('connection/conn.php');

            // SQL query to fetch quiz attempts data
            $sql = "SELECT * FROM Quiz_Attempts";
            $result = $conn->query($sql);

            // Display quiz attempts data in a table
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["quiz_id"] . "</td>";
                    echo "<td>" . $row["score"] . "</td>";
                    echo "<td>";
                    echo "<a href='updatequiz_attempts.php?id=" . $row["attempt_id"] . "'>Update</a> | ";
                    echo "<a href='deletequiz_attempts.php?id=" . $row["attempt_id"] . "' onclick='return confirm(\"Are you sure you want to delete this quiz attempt?\");'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No quiz attempts found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </table>
        <ul>
            <li><a href="home.html">BACK</a></li>
        </ul>
    </center>
</body>
</html>
