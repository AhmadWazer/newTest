<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="class.css">

    <style>
table, th, td {
    border: 1px solid blue;
}
body{
    text-align:center;
}
</style>
</head>
<body>
    <div class="class">
        <a href="class.php">Class</a>
        <a href="student.php">Student</a>
    </div>

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
   }else{
    echo "connection was successful!";
   }
$sql ="SELECT * FROM 'class'";
$result = mysqli_query($conn, $sql);
//find the numbers of recods return
$sql = "SELECT id, class_name, class_section FROM class";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["id"]. "</td><td>" . $row["class_name"]. " " . $row["class_section"] .  "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


?>
</body>
</html>