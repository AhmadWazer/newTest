<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seclect-Class</title>
    <link rel="stylesheet" href="class.css">
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
      <ul class="navbar-nav nav nav-tabs">
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
          <a class="nav-link active" href="attendanceClass.php">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="searchAttendance.php">Search</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h2><b>Class</b></h2>
<form action="attendance.php" method="post">
    <div class="mb-3">
        <label for="class_name" class="form-label m-2">Class Name:</label><br>
        <select name="class_name" class="form-select" id="class_name">
            <option value="">Select a class</option>
            <?php
            
            // Connection to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wazir1";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve data from the class table
            $sql = "SELECT classid, class_name FROM class_1";//studentClass JOIN class_1 ON studentClass.classid = class_1.classid ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['classid'] . '">' . $row['class_name'] . '</option>';
                }
                
            }
            $conn->close();
          
            ?>
        </select>
    </div>
            
    <div class="btn-toolbar justify-content-between">
        <button href="attendance.php" type="submit" name="submit" id="submit" value="submit" class="btn btn-primary m-3">Submit</button>
        <a href="attendanceTable.php" class="btn btn-success m-3">AttendanceTable</a>
    </div>

</form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>