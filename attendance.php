

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>  
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
          <a class="nav-link  active" href="attendanceClass.php">Attendance</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<form id="attendanceForm" method="POST" action="save_attendance.php">
<div class="container mt-5">
  <h2>Attendance:</h2>
            <div class="col-md-2">
                <!-- Display current date using JavaScript 
               <h2> Current Date: <span id="currentDate"></span></h2>-->
              <label for="date" class="col-form-label"><h3>Date:</h3></label>
              <input type="date" class="form-control xm" id="stddob" name="date" required>
            </div>
            <input type="hidden" name="classid" value="<?php $class_id?>">
        <?php
             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              // Save the selected class_id in a session variable
              $_SESSION['selected_class_id'] = $_POST['class_name'];
             }
              
        // Check if the selected class_id exists in the session
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wazir1";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch selected class name from the database
            $selected_class_id = $_SESSION['selected_class_id'];
            $sql_class = "SELECT class_1.class_name, class_1.classid
            FROM studentClass AS studentClass
            JOIN class_1 AS class_1 ON studentClass.classid = class_1.classid
            WHERE studentClass.classid = $selected_class_id";
            


            $result_class = $conn->query($sql_class);
            $class_name = $result_class->fetch_assoc()['class_name'];
            echo '<div style="text-align: left;">';
            echo '<h2 name="cname">Class: ' . $class_name . '</h2>';
            echo '</div>';

            $result_id = $conn->query($sql_class);
            $classid = $result_id->fetch_assoc()['classid'];
            
        ?>

            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th>Class-Name</th>
                        <th>Student-Name</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql_students = "SELECT student.sname, student.student_id, class_1.classid, class_1.class_name
                    FROM studentClass AS studentClass
                    JOIN student AS student ON studentClass.student_id = student.student_id 
                    JOIN class_1 AS class_1 ON studentClass.classid = class_1.classid
                    WHERE studentClass.classid = $selected_class_id";

                    $result_students = $conn->query($sql_students);
                    

                    if ($result_students->num_rows > 0) {
                        while ($row_student = $result_students->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td >' . $row_student['class_name'] . '</td>';
                            echo '<td>' . $row_student['sname'] . '</td>';
                            echo '<td>';
                            echo '<input type="radio" name="attendance[' . $row_student['student_id'] . ']" value="P"> Present';
                            echo '<input type="radio" name="attendance[' . $row_student['student_id'] . ']" value="A"> Absent';
                            echo '</td>';
                            echo '</tr>';
                            echo '<input type="hidden" name="classid" value="'.$row_student['classid'].'"> ';

                        }
                    } else {
                        echo '<tr><td colspan="3">No students found for the selected class.</td></tr>';
                        header("Location: attendanceClass.php"); 
                    }

                    $conn->close();
                    ?>
                    
                </tbody>
            </table>

            <div class="btn-toolbar justify-content-between">
                <button onclick="saveAttendance()"type="submit" id="submit" name="subimt" class="btn btn btn-primary">Submit Attendance</button>
            </div>
    </div>
    </form>
    <script>
        // JavaScript to display current date
       // var currentDateElement = document.getElementById('currentDate');
       // var currentDate = new Date().toLocaleDateString();
       // currentDateElement.textContent = currentDate;
        
  
  function saveAttendance() {
    // Get the form element by its id
    var form = document.getElementById('attendanceForm');

    // Get all the selected radio buttons for attendance
    var radioButtons = form.querySelectorAll('input[type="radio"]:checked');

    // Create an object to hold the attendance data
    var attendanceData = {};

    // Loop through the selected radio buttons and populate the attendanceData object
    for (var i = 0; i < radioButtons.length; i++) {
      var studentName = radioButtons[i].name;
      var attendanceValue = radioButtons[i].value;
      attendanceData[studentName] = attendanceValue;
    }

    // Use AJAX to send the attendance data to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_attendance.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Handle the response from the server if needed
          //alert('Attendance data saved successfully!');
          header("Location: attendanceClass.php");
        } else {
          // Handle any errors that occurred during the request
          alert('Error saving attendance data.');
        }
      }
    };
    xhr.send(JSON.stringify(attendanceData));

        }
    </script>
<?php
//} else {
    // If the class_id is not set in the session, redirect back 
  //  header('Location: mytest.php');
    //exit();
//}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>
