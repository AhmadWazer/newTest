

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SearchAttendance</title>  
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    </head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
    <a class="navbar-brand" href="#"><i><b>School</b></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav  nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="Class_1.php">Class_1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Section.php">Section</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="student.php">Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="studentClass.php">Student-Class</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="attendanceClass.php">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="searchAttendance.php">Search</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
  <h2><b>Attendance-Table</b></h2>
<div class="d-flex justify-content-between">
<form action="" method="post" class="form ">
  <div>
  <label for="stdname" class="form-label m-2"><h5>Search by Date:</h5></label>
  <div class="md-4 d-flex">
    <input type="date" class="form-control" id="selectedDate" name="selectedDate" placeholder="Enter Date">
    <button type="submit" href="" name="submit"value="submit" id="submit" class="btn btn-primary m-1">Search</button>
  </div>
  </div>
</form>

  <form action="" method="post" class="form">
  <div>
  <label for="className" class="form-label m-2"><h5>Search by ClassName:</h5></label>
  <div class="mb-3 d-flex">
  <select name="className" class="form-select" id="className" aria-label="Default select example">
            <option value="">Select a class</option>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wazir1";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Retrieve data from the class table
            $sql = "SELECT class_name FROM class_1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option >' . $row['class_name'] . '</option>';
                }
            }
            ?>
        </select>
            <button type="submit" name="submit"value="submit" class="btn btn-primary m-1">Search</button>
  </div>
  </div>
</div>
</form>

<?php

// Check if the form is submitted
if (isset($_POST['selectedDate'])) {
  $selectedDate = $_POST['selectedDate'];

  // Query to retrieve attendance data for the selected date
  
  $query = "SELECT student.student_id, student.sname, class_1.classid, class_1.class_name,attend_id, 
  attendance, date FROM attendance AS attendance JOIN student AS student ON
   attendance.student_id = student.student_id
   JOIN class_1 AS class_1 ON attendance.classid = class_1.classid WHERE date = '$selectedDate'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
      echo '<table  name="table" class="table table-bordered border-primary align-middle text-center">';
      echo '<thead>';
      echo '<tr>';
      echo '<th scope="col">Attend ID</th>';
      echo '<th scope="col">Student Name</th>';
      echo '<th scope="col">Class Name</th>';
      echo '<th scope="col">Attendance</th>';
      echo '<th scope="col">Date</th>';
      echo '<th scope="col">Edit</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo '<td  scope="row">' . $row['attend_id'] . "</td>";
          echo "<td>" . $row['sname'] . "</td>";
          echo "<td>" . $row['class_name'] . "</td>";
          echo "<td>" . $row['attendance'] . "</td>";
          echo "<td>" . $row['date'] . "</td>";
          echo '<td class="d-flax">';
          //echo '<a href="delete_attendance.php?id='.$row['attend_id'].' "  class="btn btn btn-danger edit-btn m-2" >Delete</a>';
          echo '<a href="updateattendance.php?id='.$row['attend_id'].' "  class="btn btn btn-success edit-btn m-2" >Edit</a>';
          echo '</td>';
          echo "</tr>";
      }
      
      echo "</table>";
  } else {
      echo "No attendance data found for the selected date.";
  }
}

?>
<?php
// Check if the form is submitted
if (isset($_POST['className'])) {
    $className = $_POST['className'];

    // Query to retrieve attendance data for the selected student name
    $query = "SELECT student.student_id, student.sname, class_1.classid, class_1.class_name,attend_id, 
    attendance, date FROM attendance AS attendance JOIN student AS student ON
     attendance.student_id = student.student_id
     JOIN class_1 AS class_1 ON attendance.classid = class_1.classid WHERE class_name = '$className'";
    $result = $conn->query($query);

    
    if ($result->num_rows > 0) {
        echo '<table name="table" class="table table-bordered border-primary align-middle text-center">';
         echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Attend ID</th>';
        echo '<th scope="col">Student Name</th>';
        echo '<th scope="col">Class Name</th>';
         echo '<th scope="col">attendance</th>';
        echo '<th scope="col">Date</th>';
        echo '<th scope="col">Edit</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo '<td  scope="row">' . $row['attend_id'] . "</td>";
            echo "<td>" . $row['sname'] . "</td>";
            echo "<td>" . $row['class_name'] . "</td>";
            echo "<td>" . $row['attendance'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo '<td class="d-flax">';
           // echo '<a href="delete_attendance.php?id='.$row['attend_id'].' "  class="btn btn btn-danger edit-btn m-2" >Delete</a>';
            echo '<a href="updateattendance.php?id='.$row['attend_id'].' "  class="btn btn btn-success edit-btn m-2" >Edit</a>';
            echo '</td>';
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo '<p style="text-align:right">No attendance data found for the selected class name.</p>';
    }
}

$conn->close();
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>