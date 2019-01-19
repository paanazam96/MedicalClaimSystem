<?php   //including the database connection file
    session_start();
    include_once("config.php");
?>
<?php
    if(isset($_POST['update']))
    {	

        $id = mysqli_real_escape_string($conn, $_POST['id']);

        $clinicname = mysqli_real_escape_string($conn, strtoupper($_POST['clinicname']));
        $doctor = mysqli_real_escape_string($conn, strtoupper($_POST['doctor']));
        $location = mysqli_real_escape_string($conn, strtoupper($_POST['location']));
        $address = mysqli_real_escape_string($conn, strtoupper($_POST['address']));
        $tel = mysqli_real_escape_string($conn, strtoupper($_POST['tel']));
	
        //updating the table
        $result = mysqli_query($conn, "UPDATE clinic_name SET clinicname='$clinicname', doctor='$doctor', location='$location', address='$address', tel='$tel' WHERE id=$id");

        //redirectig to the display page. In our case, it is index.php
        header("Location: cliniclist.php");
    }
?>
<?php
    //getting id from url
    $id = $_GET['id'];

    //selecting data associated with this particular id
    $result = mysqli_query($conn, "SELECT * FROM clinic_name WHERE id=$id");

    while($res = mysqli_fetch_array($result))
    {
        $clinicname = $res['clinicname'];
        $doctor = $res['doctor'];
        $location = $res['location'];
        $address = $res['address'];
        $tel = $res['tel'];
    }
?>
<html>
    <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

            <title>Edit Clinic</title>

            <style>
                body {
                    overflow-x: hidden;
                    background-image: url("imgs/12.jpg"); 
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-size: 1400px 720px;
                }
                ::-webkit-scrollbar {
                    display: none;
                }
                #footer {
                    bottom:0;
                    width:100%;
                    height:30px;   /* Height of the footer */
                    background: white;
                    opacity: 0.7;
                    position: relative;
                } 
            </style>
            <script>
                history.pushState(null, null, location.href);
                window.onpopstate = function () {
                    history.go(1);
                };
            </script>
    </head>
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        <!-- Content -->
        <div class="container col-5" style="background-color: #EAEAEA; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px; margin-top: 120px;">
            <br>
            <div class="container">
                <center><h3 style="font-family:Trebuchet MS;">Edit Clinic</h3></center>
            </div>
            <form action="clinicedit.php" method="post">
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Clinic Name:</label>
                    <input name="clinicname" type="text" class="form-control" value="<?php echo $clinicname;?>" style="text-transform:uppercase;" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Doctor Name:</label>
                    <input name="doctor" type="text" class="form-control" value="<?php echo $doctor;?>" style="text-transform:uppercase;" >
                </div>
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Location:</label>
                    <input name="location" type="text" class="form-control" value="<?php echo $location;?>" style="text-transform:uppercase;" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Address:</label>
                    <textarea name="address" type="text" rows="2" class="form-control" style="text-transform:uppercase; resize: none;" ><?php echo $address;?></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Telephone:</label>
                    <input name="tel" type="text" class="form-control" value="<?php echo $tel;?>" style="text-transform:uppercase;" >
                </div>
                <div class="form-group col-md-12">
                    <div class="form-group">
                        <a href="cliniclist.php" class="btn btn-danger btn-sm float-left" role="button">Back</a>     
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                        <input type="submit" name="update" value="Update" class="btn btn-success btn-sm float-right">
                    </div>
                </div>
            </form>
            <br>
        </div>
        <!-- /Content -->
        <br>
        <br>
        <!-- Footer -->
        <div id="footer">
            <div class="container" align="center">
                <div class="row">
                    <div class="col">
                        Copyright &copy; 2018-<?php echo date("Y");?> Selia Selenggara Engineering. All Rights Reserved. Made by <a href="https://www.instagram.com/paan_azam13/">Farhan Azam</a> (IT Intern)
                    </div>
                </div>  
            </div>
        </div>
        <!-- /Footer -->
    </body>
</html>