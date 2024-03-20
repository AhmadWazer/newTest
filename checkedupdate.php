<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-3">
    <h3>Selected rows:</h3>
    <?php
        $servername = "localhost";
        $username = 'root';
        $password = "";
        $dbname = "wazir1";

         $conn = new mysqli($servername, $username, $password, $dbname);

         if($conn->connect_error){
            die("connection faild:".$conn->connect_error);
         }

         
         // Handle form submission to edit selected rows
         if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_selected'])) {
             if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
                 $selectedRows = $_POST['selected_rows'];
  
                 foreach ($selectedRows as $selectedId) {

                     $edit_sql = "SELECT class_1.class_name, student.sname,attendance, attend_id FROM attendance 
                     AS attendance JOIN class_1 AS class_1 ON attendance.classid = class_1.classid 
                     JOIN student AS student ON attendance.student_id = student.student_id WHERE attend_id = $selectedId";
                     $edit_result = $conn->query($edit_sql);
                     $edit_row = $edit_result->fetch_assoc();
         
                     // Display the editing form for each selected row
                     echo '<form method="POST" action="' . $_SERVER["PHP_SELF"] . '">';
                     echo '<input type="hidden" name="attend_id" value="' . $edit_row['attend_id'] . '">';

                     echo '<div class="row g-3">';
                     echo ' <div class="col">';
                     echo '<input type="text"class="form-control" name="class_name" value="' . $edit_row['class_name'] . '">';
                     echo '</div>';
                     echo ' <div class="col">';
                     echo '<input type="text"class="form-control" name="sname" value="' . $edit_row['sname'] . '">';
                     echo '</div>';
                    // echo ' <div class="col">';
                     //echo '<input type="text"class="form-control" name="attendance[' . $selectedId . ']" value="' . $edit_row['attendance'] . '">';
                     //echo '</div>';
                     echo '<div class="col">';
                     echo '<select name="attendance[' . $selectedId . ']" class="form-select" value="' . $edit_row['attendance'] . '">';
                     echo '<option value="' . $edit_row['attendance'] . '">' . $edit_row['attendance'] . '</option>';
                     echo '<option value="A">A</option>';
                     echo '<option value="P">P</option>';
                     echo '</select>';
                     echo '</div>';
                     echo '</div>';
                     echo '<br>';
                 }

             } else {
                 echo "No rows selected.";
             }
    }
?>
<input type="submit"class="btn btn-success" name="update_btn" > 
<!-- save_edited_values.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['attendance'])) {
    foreach ($_POST['attendance'] as $selectedId => $editedAttendance) {
        // Update the attendance value in the database for each selected row
        $update_sql = "UPDATE attendance 
                       SET attendance = '$editedAttendance' 
                       WHERE attend_id = $selectedId";
       
        if ($conn->query($update_sql) === TRUE) {
            echo 'Row ' . $selectedId . ' updated successfully.<br>';
        } else {
            echo 'Error updating row ' . $selectedId . ': ' . $conn->error . '<br>';
        }
    }
    header("Location: attendanceTable.php");
}
?>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body> 
</html>