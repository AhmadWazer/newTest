<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php
   
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "wazir1";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve the attendance data from the form
  $attendanceValue = $_POST['attendance'];
  $class_id = $_POST['classid'];
  $date = $_POST['date'];

  // Save the attendance data received from the client
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // echo '<pre>';print_r($attendanceValue);
  // die;
  foreach($attendanceValue as $index => $value){

    $sql = "INSERT INTO `attendance` ( `student_id`, `classid`, `date`, `attendance`, `updated_date`)
    VALUES ( '$index', $class_id,' $date', '$value', NOW())";

    $conn->query($sql);
       
  }  
  header("Location: attendanceClass.php");
  }
?>
</body>
</html>