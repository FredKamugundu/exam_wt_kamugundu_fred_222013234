<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Instructor</title>
</head>
<body>
    <center>
        <h2>Update Instructor</h2>
        <?php
        // Check if the instructor ID is provided via URL parameter
        if (isset($_GET['instructor_id'])) {
            $instructor_id = $_GET['instructor_id'];

            // Database connection
           include ('connection/conn.php');

            // Fetch instructor data based on the provided ID
            $select_sql = "SELECT * FROM instructors WHERE instructor_id = '$instructor_id'";
            $result = $conn->query($select_sql);

            // Check if instructor data exists
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $user_id = $row["user_id"];
                $expertise_area = $row["expertise_area"];
                $experience = $row["experience"];
            } else {
                echo "Instructor not found";
                exit;
            }

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_instructor'])) {
                $user_id = $_POST['user_id'];
                $expertise_area = $_POST['expertise_area'];
                $experience = $_POST['experience'];

                // Update query
                $update_sql = "UPDATE instructors SET user_id='$user_id', expertise_area='$expertise_area', experience='$experience' WHERE instructor_id='$instructor_id'";

                if ($conn->query($update_sql) === TRUE) {
                    echo "<script>alert('Instructor updated successfully');</script>";
                    echo "<script>window.location.href = 'viewinstructors.php';</script>"; // Redirect to view instructors page
                } else {
                    echo "Error updating instructor: " . $conn->error;
                }
            }

            // Close connection
            $conn->close();
        } else {
            echo "No instructor ID provided";
            exit;
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?instructor_id=' . $instructor_id; ?>" method="post">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>" required><br><br>
            <label for="expertise_area">Expertise Area:</label>
            <input type="text" id="expertise_area" name="expertise_area" value="<?php echo htmlspecialchars($expertise_area); ?>" required><br><br>
            <label for="experience">Experience:</label>
            <input type="text" id="experience" name="experience" value="<?php echo htmlspecialchars($experience); ?>" required><br><br>
            <input type="submit" name="update_instructor" value="Update">
        </form>
    </center>
</body>
</html>
