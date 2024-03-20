<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav  nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="updatecheked.php">Attendance</a>
        </li>
      </ul>
    </div>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wazir1";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die ("connection faild:".$conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])){
        $selectedRows = $_POST['selected_rows'];
        
        // Loop through the selected rows and perform your editing logic
        foreach ($selectedRows as $selectedId) {

            echo '<a href="checkedEdit.php?id=' . $selectedId . '">Edit Row ' . $selectedId . '</a><br>';
           
        }
    } else {
        echo "No rows selected.";
    }
    
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $selectedId = $_GET['id'];

    //  code to fetch data for editing
    $sql = "SELECT attend_id, student.student_id, student.sname, class_1.classid, class_1.class_name, attendance FROM 
    attendance AS attendance JOIN class_1 AS class_1 ON attendance.classid = class_1.classid JOIN student 
    AS student ON attendance.student_id = student.student_id WHERE attend_id = $selectedId";
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();

     $cname = $row['class_name'];
     $sname = $row['sname'];
     $attendance = $row['attendance'];
     $attend = $row['attend_id'];
}

   
if (isset($_POST["update_btn"])) {
    $selectedId = $_POST["id"];
    $new_attendance = $_POST["attendance"];

    $update_sql = "UPDATE attendance 
                   SET  attendance = '$new_attendance' 
                   WHERE attend_id = $selectedId";

    if ($conn->query($update_sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Record updated successfully!</div>';                  
        //header("Location: chekedEdit.php?id=" . $selectedId);
    } else {
        echo '<div class="alert alert-danger" role="alert">Error updating record: ' . $conn->error . '</div>';
    }
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $selectedId ; ?>">
<div class="mb-3">
                <label for="attend" class="form-label"> Attendance-ID</label>
                <input type="text" class="form-control" id="attend" name="attend" value="<?php echo $attend ?>">
            </div>    
        <div class="mb-3">
                <label for="student_id" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $sname ?>">
            </div>    
        <div class="mb-3">
                <label for="class_id" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="class_id" name="class_id" value="<?php echo $cname ?>">
            </div>   
        <div class="mb-3">
                <label for="attendance" class="form-label">Attendance</label>
                <input type="text" class="form-control" id="attendance" name="attendance" value="<?php echo $attendance ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $selectedId ?>">
            <button type="submit"id="update_btn" name="update_btn" class="btn btn-primary">Update</button>
        </form>
    </div>

</body>
</html>