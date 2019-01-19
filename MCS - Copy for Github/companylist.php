<?php   //including the database connection file
    session_start();
    include_once("config.php");
?>
<?php
    $rescompany = mysqli_query($conn, "SELECT * FROM company ORDER BY id ASC")
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

            <title>List of Company</title>

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
            <div class="row">
                <div class="col">
                    <h3 style="font-family:Trebuchet MS; color:black;">List of Company</h3>
                </div>
                <div class="col">
                    <a href="companyadd.php" class="btn btn-success btn-md float-right" role="button">Add Company</a>                   
                </div>
            </div>
            <table align="center" class="table table-hover table-bordered table-light">
                <tr class="bg-info text-white" align="center">
                    <th>No.</th>
                    <th>Company Name</th>
                    <th>Action</th>
                </tr>
                <?php
                    $counter = 1;
                    while($res = mysqli_fetch_array($rescompany))
                    {
                        echo "<tr>";
                        echo "<td align='center'>".$counter."</td>";
                        echo "<td>".$res['cname']."</td>";
                        echo "<td align='center'><a href=\"companyedit.php?id=$res[id]\">Edit</a> | <a href=\"companydelete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                        $counter++;
                    }
                ?>
            </table>
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