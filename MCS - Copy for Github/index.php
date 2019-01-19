<?php
    session_start();
    require_once('config.php');
?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <title>MCS</title>
        
        <style>
            body {
                overflow-x: hidden;
                background-image: url("imgs/1.jpg");
                background-size: cover;
            }
            #footer {
                position:absolute;
                bottom:0;
                width:100%;
                height:30px;   /* Height of the footer */
                background: white;
                opacity: 0.6;
            }
            #footer {
                -moz-user-select: none;  
                -webkit-user-select: none;  
                -ms-user-select: none;  
                -o-user-select: none;  
                user-select: none;
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
        <!-- Topbar -->
        <div align="center" style="background-color: white; opacity: 0.8;">
            <div class="row">
                <div class="col-sm">
                  
                </div>
                <div class="col-sm">
                    <img src="imgs/Untitled-1.png" style="width: 200px; height: 70px;">
                </div>
                <div class="col-sm">
                    
                </div>
            </div>
        </div>
        <!-- Topbar -->
        <div class="container py-5 rounded-1">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center text-black mb-4" style="font-family:Trebuchet MS; font-size:50px; color:white;">MEDICAL CLAIM SYSTEM</h2>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <!-- form card login -->
                            <div class="card rounded-1">
                                <div class="card-header" style="background-color: #abe16b">
                                    <h3 class="mb-0">Login</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Form -->
                                    <form action="index.php" method="post">
                                        <div class="form-group">
                                            <label for="uname1">Username</label>
                                            <input class="form-control form-control-lg rounded-0" type="email" name="email" required >
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control form-control-lg rounded-0" type="password" name="password" required >
                                        </div>
                                        <button class="btn btn-success btn-lg float-right" id="btnLogin" name="login">Login</button>
                                    </form>
                                    <!-- Form -->
                                    <?php
                                    
                                        if(isset($_POST['login']))
                                        {
                                            $email = $_POST['email'];
                                            $password = $_POST['password'];
                                            
                                            $query = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
                                            
                                            $query_run = mysqli_query($conn, $query);
                                            
                                            if($query_run)
                                            {
                                                if(mysqli_num_rows($query_run)>0)
                                                {
                                                    $row = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
                                                    
                                                    $count = mysqli_num_rows($query_run); 
                                                    // If result matched $username and $password, table row must be 1 row
                                                    
                                                    if($count == 1) 
                                                    {
                                                        $_SESSION['email'] = $email;
                                                        header("Location:welcomepage.php");
                                                    }
                                                    else
                                                    {
                                                    
                                                    }
                                                }
                                                else 
                                                {
                                                    echo '<script type="text/javascript">alert("Wrong Username or Password!")</script>';
                                                }
                                            }
                                            else
                                            {
                                                echo '<script type="text/javascript">alert("Database Error")</script>';    
                                            }
                                        }
                                    
                                    ?>
                                </div>
                                <!--/card-block-->
                            </div>
                            <!-- /form card login -->
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <!--/col-->
            </div>
            <!--/row-->
        </div>
        <!--/container-->
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
 