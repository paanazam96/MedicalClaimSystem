<?php   //including the database connection file
    session_start();
    include_once("config.php");

    $staffno = $_GET['id'];
    if(isset($_POST['update'])) //update staff details based on id
    { 
        $staffno = mysqli_real_escape_string($conn, $_POST['id']);
        
        $relationship = mysqli_real_escape_string($conn, $_POST['relationship']);
        $name = mysqli_real_escape_string($conn, strtoupper($_POST['name']));
        $ic = mysqli_real_escape_string($conn, $_POST['ic']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        
        $result = mysqli_query($conn, "INSERT family (staffno, relationship, name, ic, dob) VALUES ('$staffno','$relationship','$name','$ic','$dob')"); 
            
        //header("Location: staffprofile.php?id=$id");
        echo "<script>alert('Family Added Successfully!'); window.location.href='staffprofile.php?id=$staffno';</script>";    
    }
?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <title>Add Family</title>
        
        <style>
            body {
                overflow-x: hidden;
                background-image: url("imgs/8.jpg");
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
                opacity: 0.6;
                position: fixed; 
            }
        </style>
        
        <script>
            function GetDays() {
                var str = document.getElementById("ic").value;
                var year = str.substring(0, 2);
                var month = str.substring(2, 4);
                var day = str.substring(4, 6);
                return day + '/' + month + '/' + year;
            }
            function cal(){
                document.getElementById("numdays2").value=GetDays();
            }
        </script>
        
        <script>
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
        </script>
        
    </head>
    <body>        
        <!-- nav bar -->
        <?php include 'navbar.php'; ?>
        <!-- /nav bar -->
        <!-- card -->
        <div class="container col-6" style="background-color: #f4f4f4; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px; margin-top: 120px;">
            <!-- My Family -->
                <form action="stafffamilyadd.php" method="post">
                        <div class="card-body col-md-12" style="background-color: #f4f4f4">
                            <h2 style="font-family:Trebuchet MS; color:black;">Add Family</h2>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputZip">Relationship</label>
                                    <select class="custom-select" name="relationship">
                                        <option selected>Choose...</option>
                                        <option value="HUSBAND">HUSBAND</option>
                                        <option value="WIFE">WIFE</option>
                                        <option value="SON">SON</option>
                                        <option value="DAUGHTER">DAUGHTER</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Name</label>
                                    <input type="text" name="name" class="form-control" style="text-transform:uppercase;" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">I/C</label>
                                    <input id="ic" name="ic" type="text" size="12" maxlength="12" onchange="cal()" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Date of Birth</label>
                                    <input id="numdays2" name="dob" type="text" size="12" maxlength="12" class="form-control">
                                </div>
                            </div>   
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <a href="staffprofile.php?id=<?php echo $staffno; ?>" class="btn btn-danger btn-sm float-left" role="button">Back</a>    
                                </div>
                                <div class="form-group col-md-9">
                                    <input type="hidden" name="id" value=<?php echo $staffno;?>>
                                    <input type="submit" name="update" value="Add" class="btn btn-success btn-sm float-right">
                                </div>
                            </div> 
                        </div>
                </form>
            <!-- /My Family -->
        </div>  
        <!-- /card -->
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