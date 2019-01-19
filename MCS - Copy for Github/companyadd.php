<?php   //including the database connection file
    session_start();
    include_once("config.php");
?>
<?php
    if(isset($_POST['add']))
    {	
        $company = mysqli_real_escape_string($conn, strtoupper($_POST['company']));
	
        //updating the table
        $result = mysqli_query($conn, "INSERT INTO company(cname) VALUES ('$company')");

        //redirectig to the display page. In our case, it is index.php
        header("Location: companylist.php");
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

            <title>Add Company</title>

            <style>
                body {
                    overflow-x: hidden;
                    background-image: url("imgs/7.jpg"); 
                    height: 100%; 
                    background-repeat: repeat;
                    background-size: cover;
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
                    position: fixed;
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
                <center><h3 style="font-family:Trebuchet MS;">Add Company</h3></center>
            </div>
            <br>
            <form action="companyadd.php" method="post">
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Company Name</label>
                    <input name="company" type="text" class="form-control" style="text-transform:uppercase;" required>
                </div>
                <div class="form-group col-md-12">
                    <div class="form-group">
                        <a href="companylist.php" class="btn btn-danger btn-sm float-left" role="button">Back</a>     
                    </div>
                    <div class="form-group">
                        <input type="submit" name="add" value="Add" class="btn btn-success btn-sm float-right">
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