<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form-Submition</title>
    <link rel="stylesheet" href="class.css">
    <style>
        body{
            text-align:center;
        }
table, th, td {
    border: 1px solid black;
}
table{
    margin-left:660px;
}
</style>
</head>
<body>
    <div class="class">
        <a href="class.php">Class</a>
        <a href="student.php">Student</a>
    </div>

<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $classname = $_POST["classname"];
    $classsection = $_POST["classsection"];

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
    $sql = "INSERT INTO class (class_name, class_section) VALUES ('$classname', '$classsection')";

    if ($conn->query($sql) === TRUE) {
        echo "New data added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
    <form action="" method="post">
        <label for="classname">Class Name:</label><br>
        <input type="text" name="classname" id="classname"><br><br>
        <label for="classsection">Class Secction:</label><br>
        <input type="text" name="classsection" id="classsection"><br><br>
        <input type="submit" name="submit" value="submit">
    </form>
    <hr>
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wazir1";
   
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
       if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql ="SELECT * FROM 'class'";
        $result = mysqli_query($conn, $sql);
        //find the numbers of recods return
        $sql = "SELECT id, class_name, class_section FROM class";
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            echo "<table><tr><th>ClassName</th><th>ClassSection</th></tr>";
           // output data of each row
            while($row = $result->fetch_assoc()) {
             echo "<tr><td>". $row["class_name"]. "</td><td>". $row["class_section"] .  "</td></tr>";
            }
            echo "</table>";
        } else {
          echo "0 results";
        }
    ?>
    <hr>

</body>
</html>