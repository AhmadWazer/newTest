<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "wazir1";

$conn = new mysqli($serveername, $username, $password, $dbname);
if($conn->$connect_error){
  die("connection faild:". $connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the submitted form data
    if(isset($_POST['selected_items']) && is_array($_POST['selected_items'])){
        $selectedItems = $_POST['selected_items'];
        
        echo "You selected the following items:<br>";
        foreach ($selectedItems as $item) {
            echo $item . "<br>";
        }
    } else {
        echo "No items selected.";
    }
}
?>

</body>
</html>