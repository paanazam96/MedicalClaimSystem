<?php
//including the database connection file
include("config.php");

//getting id of the data from url
$staffno = $_GET['id'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM staffs WHERE staffno='$staffno'");
$result = mysqli_query($conn, "DELETE FROM family WHERE staffno='$staffno'");

//redirecting to the display page (index.php in our case)
header("Location:welcomepage.php");
?>

