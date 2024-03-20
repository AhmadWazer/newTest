<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<!---Update Section Table--->
    <div class="container mt-5">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wazir1";

        $conn = new mysqli($servername, $username, $password, $dbname);

        //  Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $student_id = $_GET['id'];
        $sql = "SELECT sname, dob, fname, student_id FROM student WHERE student_id = $student_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $student_name = $row["sname"];
        $dob = $row["dob"];
        $fname = $row["fname"];
        $students_id = $row["student_id"];

  ?>
        <h2>Edit Section</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $student_id; ?>">
        
        <div class="mb-3">
                <label for="stdname" class="form-label">Name:</label>
                <input type="text" class="form-control" id="stdname" name="stdname" value="<?php echo $student_name ?>">
            </div>    
        <div class="mb-3">
                <label for="stddob" class="form-label">DOB:</label>
                <input type="text" class="form-control" id="stddob" name="stddob" value="<?php echo $dob ?>">
            </div>   
        <div class="mb-3">
                <label for="fname" class="form-label">F-Name:</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname ?>">
            </div>   
        <div class="mb-3">
                <label for="class_name" class="form-label">Student-ID:</label>
                <input type="text" class="form-control" id="class_name" name="class_name" value="<?php echo $students_id ?>">
            </div>
            <button type="submit"id="update_btn" name="update_btn" class="btn btn-primary">Update</button>
            <a href="studentTable.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <!--this code will save the updated data in database-->
<?php
    if (isset($_POST["update_btn"])) {
                 $new_student_name = $_POST["stdname"];
                 $new_dob = $_POST["stddob"];
                 $new_fname = $_POST["fname"];
                 $new_class_id = $_POST["class_name"];
                //  echo $new_class_id;
                //  echo $new_class_section;

            $update_sql = "UPDATE student SET sname='$new_student_name' , dob = '$new_dob' , fname = '$new_fname'  WHERE student_id = $student_id";
                 
            if ($conn->query($update_sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Class updated successfully!</div>';
                 } else {
                     echo '<div class="alert alert-danger" role="alert">Error updating class: ' . $conn->error . '</div>';
                }
               }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
