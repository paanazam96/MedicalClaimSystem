<?php
//including the database connection file
include("config.php");

//getting id of the data from url
$dept = $_GET['id'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM department WHERE id='$dept'");

//redirecting to the display page (index.php in our case)
header("Location:deptlist.php");
?>

