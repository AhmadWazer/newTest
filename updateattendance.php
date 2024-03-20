<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Section</title>
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
        

        $attendance_id = $_GET['id'];
        $sql = "SELECT attend_id, student.student_id, student.sname, class_1.classid, class_1.class_name, attendance FROM 
        attendance AS attendance JOIN class_1 AS class_1 ON attendance.classid = class_1.classid JOIN student 
        AS student ON attendance.student_id = student.student_id WHERE attend_id = '$attendance_id'";
        $result = $conn->query($sql);
        if ($result === false) {
            die("Query failed: " . $conn->error);
        }
        $row = $result->fetch_assoc();
        $attend_id = $row["attend_id"];
        $student_name = $row["sname"];
        $class_name = $row["class_name"];
        $attendance = $row["attendance"];

  ?>
        <h2>Edit Section</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $attendance_id; ?>">
        <div class="mb-3">
                <label for="attend" class="form-label"> Attendance-ID</label>
                <input type="text" class="form-control" id="attend" name="attend" value="<?php echo $attend_id ?>">
            </div>    
        <div class="mb-3">
                <label for="student_id" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $student_name ?>">
            </div>    
        <div class="mb-3">
                <label for="class_id" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="class_id" name="class_id" value="<?php echo $class_name ?>">
            </div>   
        <div class="mb-3">
                <label for="attendance" class="form-label">Attendance</label>
                <input type="text" class="form-control" id="attendance" name="attendance" value="<?php echo $attendance ?>">
            </div>
            <button type="submit"id="update_btn" name="update_btn" class="btn btn-primary">Update</button>
            <a href="attendanceTable.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <!--this code will save the updated data in database-->
<?php
    if (isset($_POST["update_btn"])) {
                 $new_attendance = $_POST["attendance"];

            $update_sql = "UPDATE attendance SET attendance ='$new_attendance' WHERE attend_id = $attend_id";
                 
            if ($conn->query($update_sql) === TRUE) {
              // echo '<div class="alert alert-success" role="alert">Class updated successfully!</div>';                  
                 header("Location: attendanceTable.php");
                 } else {
                     echo '<div class="alert alert-danger" role="alert">Error updating class: ' . $conn->error . '</div>';
                }
               }
        ?>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
