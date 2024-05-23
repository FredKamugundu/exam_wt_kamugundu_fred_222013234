<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Instructors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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
    <div class="container">
        <h2>Instructor List</h2>
        <table>
            <thead>
                <tr>
                    <th>Instructor ID</th>
                    <th>User ID</th>
                    <th>Expertise Area</th>
                    <th>Experience</th>
                    <th colspan="2">Actions</th> <!-- colspan added here -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection
                include ('connection/conn.php');

                // SQL query to fetch data
                $sql = "SELECT instructor_id, user_id, expertise_area, experience FROM instructors";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["instructor_id"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["expertise_area"] . "</td>";
                        echo "<td>" . $row["experience"] . "</td>";
                        echo "<td><a href='updateinstrucation.php?instructor_id=" . $row["instructor_id"] . "'>Update</a></td>"; // Update action
                        echo "<td><a href='deleteinstructors.php?instructor_id=" . $row["instructor_id"] . "'>Delete</a></td>"; // Delete action
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No instructors found</td></tr>"; 
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="add_instructor.php">Add New Instructor</a>
    </div>
</body>
</html>
