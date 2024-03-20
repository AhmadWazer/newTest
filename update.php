<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>updateClass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<!--update Class Table--->
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

        $class_id = $_GET['id'];
        $sql = "SELECT class_name FROM class_1 WHERE classid = $class_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $class_name = $row["class_name"];
        // echo $class_name;

        //this code will save the updated data in database
        if (isset($_POST["update_btn"])) {
                 $new_class_name = $_POST["class_name"];

            $update_sql = "UPDATE class_1 SET class_name = '$new_class_name' WHERE classid = '$class_id'";
                 
            if ($conn->query($update_sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Class updated successfully!</div>';
                 } else {
                     echo '<div class="alert alert-danger" role="alert">Error updating class: ' . $conn->error . '</div>';
                   }
               }
        ?>
        <h2>Edit Class</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $class_id; ?>">
            <div class="mb-3">
                <label for="class_name" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="class_name" name="class_name" value="<?php echo $class_name ?>">
            </div>
            <button type="submit"id="update_btn" name="update_btn" class="btn btn-primary">Update</button>
            <a href="class_result.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
