<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class_1</title>
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
          <a class="nav-link active" aria-current="page" href="Class_1.php">Class_1</a>
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
      </ul>
    </div>
  </div>
</nav>
<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $classname = $_POST["classname"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wazir1"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert data into the table
    $sql = "INSERT INTO class_1 (class_name) VALUES ('$classname')";

    if ($conn->query($sql) === TRUE) {
        //echo "New data added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<div class="container mt-5">
<h2><b>Class_1</b></h2>
<form action="" method="post" class="form">
  <div class="mb-3">
    <label for="classname" class="form-label m-2">Class Name:</label>
    <input type="text" class="form-control xl" id="classname" name="classname" placeholder="Enter Class Name">
  </div>
  <div class="btn-toolbar justify-content-between">
  <button type="submit" name="submit"value="submit" class="btn btn-primary m-3">Submit</button>
  <a href="class_result.php" class="btn btn-success m-3">ClassTable</a>
  </div>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>