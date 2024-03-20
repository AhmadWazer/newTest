<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
</head>
<body>
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

    // Get the ID from the form submission
    $id = $_GET["id"];

    // Prepare and execute the SQL query to delete the record from the 'class' table
    $sql = "DELETE FROM class_1 WHERE classid = $id";

    if ($conn->query($sql) === TRUE) {
        //  You can redirect or show a success message.
        echo "record deleted successfully..!"; 
        header("Location: class_result.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();

?>
</body>
</html>