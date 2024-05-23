<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        <h2>Courses List</h2>
        <table>
            <tr>
                <td colspan="6">Courses List</td>
            </tr>
            <tr>
                <td colspan="6">
                    <?php
                        // Database connection
                       include ('connection/conn.php');

                        // SQL query to fetch courses data
                        $sql = "SELECT course_id, instructor_id, title, start_date, end_date FROM Courses";
                        $result = $conn->query($sql);

                        // Display courses data in a table
                        if ($result->num_rows > 0) {
                            echo "<table border='1'>";
                            echo "<tr><th>Course ID</th><th>Instructor ID</th><th>Title</th><th>Start Date</th><th>End Date</th><th>Action</th></tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["course_id"]."</td>";
                                echo "<td>".$row["instructor_id"]."</td>";
                                echo "<td>".$row["title"]."</td>";
                                echo "<td>".$row["start_date"]."</td>";
                                echo "<td>".$row["end_date"]."</td>";
                                echo "<td>";
                                echo "<a href='updatecourses.php?id=".$row["course_id"]."'>Update</a> | ";
                                echo "<a href='deletecourse.php?id=".$row["course_id"]."' onclick='return confirm(\"Are you sure you want to delete this course?\");'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                                
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="6"><ul><li><a href="home.html">BACK</a></li></ul></td>
            </tr>
        </table>
    </center>
</body>
</html>
