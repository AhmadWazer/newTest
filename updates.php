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

        $section_id = $_GET['id'];
        $sql = "SELECT class_section, classid FROM section WHERE id = $section_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $class_section = $row["class_section"];
        $class_id = $row["classid"];
        // echo $class_section;
        //echo $class_id;

  ?>
        <h2>Edit Section</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $section_id; ?>">
        
        <div class="mb-3">
                <label for="class_section" class="form-label">Class Section</label>
                <input type="text" class="form-control" id="class_section" name="class_section" value="<?php echo $class_section ?>">
            </div>    
        <div class="mb-3">
                <label for="class_name" class="form-label">Class ID</label>
                <input type="text" class="form-control" id="class_name" name="class_name" value="<?php echo $class_id ?>">
            </div>
            <button type="submit"id="update_btn" name="update_btn" class="btn btn-primary">Update</button>
            <a href="result.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <!--this code will save the updated data in database-->
<?php
    if (isset($_POST["update_btn"])) {
                 $new_class_section = $_POST["class_section"];
                 $new_class_id = $_POST["class_name"];
                //  echo $new_class_id;
                //  echo $new_class_section;

            $update_sql = "UPDATE section SET class_section='$new_class_section' , classid = $new_class_id WHERE id = $section_id";
                 
            if ($conn->query($update_sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Class updated successfully!</div>';
                 } else {
                     echo '<div class="alert alert-danger" role="alert">Error updating class: ' . $conn->error . '</div>';
                }
               }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
