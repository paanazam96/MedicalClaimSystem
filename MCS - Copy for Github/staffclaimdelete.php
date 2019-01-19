<?php
//including the database connection file
include("config.php");

//getting id of the data from url
$id = $_GET['id'];
$staffno = $_GET['staffno'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM claim WHERE id='$id'");

//redirecting to the display page (index.php in our case)
echo "<script>window.location.href='staffprofile.php?id=$staffno';</script>";
?>

