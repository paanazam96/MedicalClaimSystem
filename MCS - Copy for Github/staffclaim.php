<?php   //including the database connection file
    session_start();
    include_once("config.php");

    $staffno = $_GET['id'];
    if(isset($_POST['submit'])) //update staff details based on id
    { 
        $staffno = mysqli_real_escape_string($conn, $_POST['id']);
        
        $famname = mysqli_real_escape_string($conn, strtoupper($_POST['famname']));
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $clinic = mysqli_real_escape_string($conn, strtoupper($_POST['clinic']));
        $invoice = mysqli_real_escape_string($conn, strtoupper($_POST['invoice']));
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        //$balance = mysqli_real_escape_string($conn, $_POST['balance']);
        //$newbal = mysqli_real_escape_string($conn, $_POST['newbal']);
        
        $result = mysqli_query($conn, "INSERT claim (staffno, famname, type, date, clinic, invoice, amount) VALUES ('$staffno','$famname','$type','$date','$clinic','$invoice','$amount')");
            
        echo "<script>alert('Claim Added Successfully!'); window.location.href='staffprofile.php?id=$staffno';</script>";
    }
?>
<?php   //query all family name for dropdown
    $hostname="localhost";
    $username="root";
    $password="";
    $databaseName="mcs";
 
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    $query1 = "SELECT * FROM family WHERE staffno='$staffno' ";
    $result1 = mysqli_query($connect, $query1);

    $query2 = "SELECT name FROM staffs WHERE staffno='$staffno' ";
    $result2 = mysqli_query($connect, $query2);
    
    $query3 = "SELECT * FROM clinic_name";
    $result3 = mysqli_query($connect, $query3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        
        <title>Insert Claim</title>
        
        <style>
            body {
                overflow-x: hidden;
                background-image: url("imgs/9.jpg");
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
    <!-- Content -->
    <div class="container col-8" style="background-color: #f4f4f4; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px; margin-top: 120px;">
        <!-- Claim Page -->
        <div class="container">
            <div class="card-body col-md-12">
                <div class="form-row">
                    <div class="col">
                        <h1 style="font-family:Trebuchet MS; color:black;">Insert Claim</h1>
                    </div>
                </div>
                <form action="staffclaim.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <select name="famname" class="form-control" required>
                                <option value="">Choose..</option>
                                <?php while($row1=mysqli_fetch_array($result2)):;?>                                    
                                    <option>
                                        <?php echo $row1['name']; ?>    <!-- staff name -->
                                    </option>
                                <?php endwhile; ?>
                                <?php while($row1=mysqli_fetch_array($result1)):;?>                                    
                                    <option>
                                        <?php echo $row1['name']; ?>    <!-- Looping of staff family -->
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Type of Claim</label>
                            <select name="type" class="form-control" required>
                                <option value="">Choose..</option>
                                <option value="STAFF CLAIM">STAFF CLAIM</option>
                                <option value="CLINIC INVOICE">CLINIC INVOICE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Date</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Clinic Name</label>
                            <input type="text" list="clinic" name="clinic" class="form-control" style="text-transform:uppercase;">
                            <datalist id="clinic">
                                <?php while($row1=mysqli_fetch_array($result3)):;?>
                                <option><?php echo $row1[1]; ?></option>
                                <?php endwhile; ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Invoice No.</label>
                            <input type="text" name="invoice" class="form-control" style="text-transform:uppercase;">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Amount (RM)</label>
                            <input type="text" name="amount" class="form-control" onchange="updateDue()">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <a href="staffprofile.php?id=<?php echo $staffno; ?>" class="btn btn-danger btn-sm float-left" role="button">Back</a>   
                        </div>
                        <div class="form-group col">
                            <input type="hidden" name="id" value=<?php echo $staffno;?>>
                            <input type="submit" name="submit" value="Update" class="btn btn-success btn-sm float-right">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Claim Page -->
    </div>
    <!-- /Content -->
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