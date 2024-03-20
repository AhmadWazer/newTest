<!-- Add the modal for editing -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editClassID">
                    <div class="mb-3">
                        <label for="editClassName" class="form-label">Class Name</label>
                        <input type="text" class="form-control" id="editClassName">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="updateBtn">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        // When the Edit button is clicked, open the modal with the current class name
        $(document).on('click', '.edit-btn', function () {
            var classID = $(this).closest('tr').data('classid');
            var className = $(this).closest('tr').find('td:eq(1)').text();
            $('#editClassID').val(classID);
            $('#editClassName').val(className);
            $('#editModal').modal('show');
        });

        // When the Update button in the modal is clicked, update the class name and close the modal
        $(document).on('click', '#updateBtn', function () {
            var classID = $('#editClassID').val();
            var newClassName = $('#editClassName').val();

            // Perform an asynchronous POST request to update the class name in the database
            $.post('update_class.php', { id: classID, class_name: newClassName }, function (data) {
                if (data === 'success') {
                    // Update the class name in the table row
                    $('tr[data-classid="' + classID + '"]').find('td:eq(1)').text(newClassName);
                    $('#editModal').modal('hide');
                } else {
                    alert('Error updating class.');
                }
            });
        });
    </script>
</body>
</html>
<h2>Edit Class</h2>
        <form method="post" id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $class_id; ?>">
            <div class="mb-3">
                <label for="class_name" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="class_name" name="class_name" value="">
            </div>
            <button type="submit" id="updateBtn" name="update_btn" class="btn btn-primary">Update</button>
            <a href="class_result.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <!---update code->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wazir1";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get the class ID from the form submission
            $class_id = $_POST["id"];

            // Retrieve the class information based on the class ID
            $sql = "SELECT classid, class_name FROM class_1 WHERE classid = '$class_id'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $class_name = $row["class_name"];

                // Process the form submission for updating the class
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_btn"])) {
                    $new_class_name = $_POST["class_name"];

                    // Perform the update in the database
                    $update_sql = "UPDATE class_1 SET class_name = '$new_class_name' WHERE classid = '$class_id'";
                    if ($conn->query($update_sql) === TRUE) {
                        echo '<div class="alert alert-success" role="alert">Class updated successfully!</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error updating class: ' . $conn->error . '</div>';
                    }
                }
            }
            $conn->close();
        }
        ?>
       <h2>Edit Class</h2>
        <form method="post" id="editForm" action="">
            <input type="hidden" name="id" value="<?php echo $class_id; ?>">
            <div class="mb-3">
                <label for="class_name" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="class_name" name="class_name" value="">
            </div>
            <button type="submit" id="updateBtn" name="update_btn" class="btn btn-primary">Update</button>
            <a href="class_result.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
   <!-- <script>
        // When the Edit button is clicked, open the modal with the current class name
        $(document).on('click', '.edit-btn', function () {
            var classid = $(this).closest('tr').data('classid');
            var class_name = $(this).closest('tr').find('td:eq(1)').text();
            $('#editClassID').val(classid);
            $('#editClassName').val(class_name);
            $('#editModal').modal('show');
        });

        // When the Update button in the modal is clicked, update the class name and close the modal
        $(document).on('click', '#updateBtn', function () {
            var classid = $('#editClassID').val();
            var newClassName = $('#editClassName').val();

            // Perform an asynchronous POST request to update the class name in the database
            $.post('class_result.php', { id: classid, class_name: newClassName }, function (data) {
                if (data === 'success') {
                    // Update the class name in the table row
                    $('tr[data-classid="' + classid + '"]').find('td:eq(1)').text(newClassName);
                    $('#editModal').modal('hide');
                } else {
                    alert('Error updating class.');
                }
            });
        });
    </script>
--->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            // Submit the form using AJAX
            $("#editForm").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Get form data
                var formData = $(this).serialize();

                // Perform an AJAX POST request to update the class name in the database
                $.ajax({
                    url: "class_1.php",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        if (response === "success") {
                            // Update the class name on the page
                            var newClassName = $("#class_name").val();
                            $(".container h2").after('<div class="alert alert-success" role="alert">Class updated successfully!</div>');
                            setTimeout(function () {
                                $(".alert.alert-success").remove();
                            }, 3000);

                            // Optionally, you can update the class name in the input field in case the user edits it again
                            // $("#class_name").val(newClassName);
                        } else {
                            $(".container h2").after('<div class="alert alert-danger" role="alert">Error updating class.</div>');
                            setTimeout(function () {
                                $(".alert.alert-danger").remove();
                            }, 3000);
                        }
                    },
                    error: function () {
                        $(".container h2").after('<div class="alert alert-danger" role="alert">An error occurred. Please try again later.</div>');
                        setTimeout(function () {
                            $(".alert.alert-danger").remove();
                        }, 3000);
                    }
                });
            });
        });
    </script>


<!--full code for editing the existing value-->$_COOKIE

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["name"])) {
            $selectedValue = $_GET["name"];
        } else {
            // If the page is accessed directly without a selected value, show an error message or redirect.
            echo '<div class="alert alert-danger" role="alert">No class selected for editing.</div>';
            exit; // Exit to stop further execution.
        }
        ?>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wazir1";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get the class ID from the form submission
            $class_id = $_POST["id"];
            
            // Retrieve the class information based on the class ID
            $sql = "SELECT class_name FROM class_1 WHERE classid = '$class_id'";
            $result = $conn->query($sql);

            if ($result->num_rows == 0) {
                $row = $result->fetch_assoc();
                $class_name = $row["class_name"];
                
                // Process the form submission for updating the class
                if (isset($_POST["update_btn"])) {
                    $new_class_name = $_POST["class_name"];

                    // Perform the update in the database
                    $update_sql = "UPDATE class_1 SET class_name = '$new_class_name' WHERE classid = '$class_id'";
                    if ($conn->query($update_sql) === TRUE) {
                        echo '<div class="alert alert-success" role="alert">Class updated successfully!</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error updating class: ' . $conn->error . '</div>';
                    }
                }
            }
            $conn->close();
        }
        ?>
        <h2>Edit Class</h2>
        <form id="editForm">
            <input type="hidden" name="id" value="<?php echo $class_id; ?>">
            <div class="mb-3">
                <label for="class_name" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="class_name" name="class_name" value="">
            </div>
            <button type="submit" name="update_btn" class="btn btn-primary">Update</button>
            <a href="class_result.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</body>
</html>
<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["stdname"];
    $dob = $_POST["stddob"];
    $fname = $_POST["fname"];
    $class_id = $_POST["classid"];

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
    $sql = "INSERT INTO student (sname , dob , fname , classid) VALUES ('$name','$dob', '$fname', '$class_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New data added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!-------->
<label for="classname" class="form-label m-2">Class:</label>
    <select name="class_name" class="form-select" id="classname" aria-label="Default select example">
            <option value="">Select a class</option>
            <?php
            $class_id = $_POST["class_name"];

            // Connection to the database (Replace these credentials with your database connection details)
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

            // Retrieve data from the class table
            $sql = "SELECT classid, class_name FROM class_1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['classid'] . '">' . $row['class_name'] . '</option>';
                }
            }
            
            ?>
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test-Document</title>
    <style>
      .error{
        color:red;
      }
    </style>
</head>
<body>
     <hr>
     &copy;
<!--php form --->
<?php
$d = date("dS F Y");
echo $d;
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";

$name = $email =  $gender =  $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(empty($_POST["name"])){
    $nameErr = "Name is required";
  }else{
    $name = test_input($_POST["name"]);
  }
  if(empty($_POST["email"])){
    $emailErr = "email is requide";
  }else{
    $email = test_input($_POST["email"]);
  }
  if(empty($_POST["website"])){
    $websiteErr = "website URL requide";
  }else{
    $website = test_input($_POST["website"]);
  }
  if(empty($_POST["gender"])){
    $genderErr = "select one option";
  }else{
    $gender = test_input($_POST["gender"]);
  }
  $comment = test_input($_POST["comment"]);
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name; ?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class= "error">*<?php echo $emailErr?></span>
  <br><br>
  Website: <input type="text" name="website">
  <span class= "error">*<?php echo $websiteErr?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class= "error">*<?php echo $genderErr?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>
<hr>
<!------>

</body>
</html>

        </select>
  </body>
</html>
