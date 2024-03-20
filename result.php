

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section_Result</title>  
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
          <a class="nav-link active" href="Section.php">Section</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
  <h2><b>Section Table</b></h2>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wazir1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the 'section' table and join with 'class_1' table to get class names
$sql = "SELECT section.id, class_1.class_name, section.class_section FROM section JOIN class_1 ON section.classid = class_1.classid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table name="table" class="table table-bordered border-primary">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">#</th>';
    echo '<th scope="col">ClassName</th>';
    echo '<th scope="col">ClassSection</th>';
    echo '<th scope="col">Edit/Remove</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<th scope="row">' . $row['id'] . '</th>';
        echo '<td>' . $row['class_name'] . '</td>';
        echo '<td>' . $row['class_section'] . '</td>';
        echo '<td class="d-flax">';
        echo '<a href="delete_section.php?id='.$row['id'].' "  class="btn btn btn-danger dlt-btn m-2" >Detele</a>';
        echo '<a href="updates.php?id='.$row['id'].' "  class="btn btn btn-success edit-btn m-2" >Edit</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}

$conn->close();
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
