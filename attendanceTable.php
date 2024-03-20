

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance_Table</title>  
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
          <a class="nav-link active" href="attendanceClass.php">Attendance</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
  <h2><b>Attendance-Table</b></h2>
<!-- Display the table with checkboxes <?php /*echo htmlspecialchars($_SERVER["PHP_SELF"]);*/ ?>-->
<form method="POST" action="checkedupdate.php">
    <table class="table table-bordered border-primary align-middle text-center">
        <tr>
            <th scope="col"><label><input type="checkbox" id="select-all" onclick="toggleCheckboxes()"> Select All</label></th>
            <th scope="col">ID</th>
            <th scope="col">Class Name</th>
            <th scope="col">Student Name</th>
            <th scope="col">Date</th>
            <th scope="col">Attendance</th>
            <th scope="col">Edit</th>
        </tr>


        <?php

        $servername = "localhost";
        $username = 'root';
        $password = "";
        $dbname = "wazir1";
         $conn = new mysqli($servername, $username, $password, $dbname);

         if($conn->connect_error){
            die("connection faild:".$conn->connect_error);
         }
        // Fetch data from your database and loop through rows
        $sql = "SELECT attend_id, class_1.class_name, student.sname, date, attendance, updated_date FROM
                attendance JOIN class_1 ON attendance.classid = class_1.classid JOIN student ON 
                attendance.student_id = student.student_id ORDER BY class_name";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
            echo '<tr>';
            echo '<td><input type="checkbox" name="selected_rows[]" value="' . $row['attend_id'] . '"></td>';
            echo '<td>' . $row['attend_id'] . '</td>';
            echo '<td>' . $row['class_name'] . '</td>';
            echo '<td>' . $row['sname'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['attendance'] . '</td>';
            echo '<td class="d-flax">';
            //echo '<a href="delete_attendance.php?id='.$row['attend_id'].' "  class="btn btn btn-danger edit-btn m-2" >Delete</a>';
            echo '<a href="updateattendance.php?id='.$row['attend_id'].' "  class="btn btn btn-success edit-btn m-2" >Edit</a>';
            echo '</td>';
            echo '</tr>';
        }
    }
        ?>
    </table>
<!-- Include this code within the <head> section of your HTML -->
<script>
    function toggleCheckboxes() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var selectAllCheckbox = document.getElementById('select-all');
        
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = selectAllCheckbox.checked;
        }
    }
</script>

    <button type="submit"href="checkedupdate.php?id='.$row['attend_id'].' " name="edit_selected" class="btn btn btn-primary">Edit Selected Rows</button>

</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>
