<?php
    session_start();
    include("config.php");  //including the database connection file
    
    if(isset($_POST['update'])) //update staff details based on id
    { 
        $staffno = $_POST['staffno'];
        $id = $_POST['id'];
        $famname = mysqli_real_escape_string($conn, strtoupper($_POST['famname']));
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $clinic = mysqli_real_escape_string($conn, strtoupper($_POST['clinic']));
        $invoice = mysqli_real_escape_string($conn, strtoupper($_POST['invoice']));
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        
        $result = mysqli_query($conn, "UPDATE claim 
                                       SET date='$date',
                                       famname='$famname',                                        
                                       clinic='$clinic',
                                       invoice='$invoice',
                                       amount='$amount',
                                       type='$type' WHERE id=$id");
            
        //header("Location: staffprofile.php?id=$id");
        echo "<script>alert('Update Successful!'); window.location.href='staffprofile.php?id=$staffno';</script>";    
    }
?>
<?php
    $id = $_GET['id'];
    $staffno = $_GET['staffno'];

    //echo $id ." ".$staffno;
    $result = mysqli_query($conn, "SELECT * FROM claim WHERE id=$id AND staffno='$staffno' ");
    while($res = mysqli_fetch_array($result))
    {
        $staffno = $res['staffno'];
        $date = $res['date'];
        $famname = $res['famname'];
        $clinic = $res['clinic'];
        $invoice = $res['invoice'];
        $amount = $res['amount'];
        $type = $res['type'];
    }
?>
<?php   //query all family name for dropdown
    $hostname="localhost";
    $username="root";
    $password="";
    $databaseName="mcs";
 
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    $query = "SELECT * FROM family WHERE staffno='$staffno' ";
    $result1 = mysqli_query($connect, $query);

    $query2 = "SELECT name FROM staffs WHERE staffno='$staffno' ";
    $result2 = mysqli_query($connect, $query2);

    $query3 = "SELECT * FROM clinic_name";
    $result3 = mysqli_query($connect, $query3);
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

        <title>Edit Claim</title>
        
        <style>
            body {
                overflow-x: hidden;
                background-image: url("imgs/11.jpg");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 1920px 1080px;
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
        <div class="container col-8" style="background-color: #f4f4f4; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px; margin-top: 120px;">
            <!-- Claim Page -->
        <div class="container">
            <div class="card-body col-md-12">
                <div class="form-row">
                    <div class="col">
                        <h1 style="font-family:Trebuchet MS; color:black;">Edit Claim</h1>
                    </div>
                </div>
                <form action="staffclaimedit.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <select name="famname" class="form-control" required>
                                <option value="">Choose..</option>
                                <?php while($row1=mysqli_fetch_array($result2)):;?>
                                    <?php   //search dept from staffs table
                                        $sql = "SELECT * FROM staffs WHERE name='$famname'";
                                        $result=mysqli_query($conn, $sql);

                                        $row=mysqli_fetch_array($result);
                                        $user = $row['name']; 
                                    ?>
                                    <option <?php if($row1['name'] == $user) echo "selected"; ?>>
                                        <?php echo $row1['name']; ?>    <!-- staff name -->
                                    </option>
                                <?php endwhile; ?>
                                
                                <?php while($row1=mysqli_fetch_array($result1)):;?> 
                                    <?php   //search dept from staffs table
                                        $sql = "SELECT * FROM family WHERE name='$famname'";
                                        $result=mysqli_query($conn, $sql);

                                        $row=mysqli_fetch_array($result);
                                        $user = $row['name']; 
                                    ?>
                                    <option <?php if($row1['name'] == $user) echo "selected"; ?>>
                                        <?php echo $row1['name']; ?>    <!-- Looping of staff family -->
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Type of Claim</label>
                            <select name="type" class="form-control" required>
                                <option value="">Choose..</option>
                                <option value="STAFF CLAIM" <?php if($type=="STAFF CLAIM") echo 'selected="selected"';?>>STAFF CLAIM</option>
                                <option value="CLINIC INVOICE" <?php if($type=="CLINIC INVOICE") echo 'selected="selected"';?>>CLINIC INVOICE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo $date ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Clinic Name</label>
                            <input type="text" list="clinic" name="clinic" class="form-control" style="text-transform:uppercase;" value="<?php echo $clinic ?>">
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
                            <input type="text" name="invoice" class="form-control" style="text-transform:uppercase;" value="<?php echo $invoice ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Amount (RM)</label>
                            <input type="text" name="amount" class="form-control" value="<?php echo $amount ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <a href="staffprofile.php?id=<?php echo $staffno; ?>" class="btn btn-danger btn-sm float-left" role="button">Back</a>   
                        </div>
                        <div class="form-group col">
                            <input type="hidden" name="id" value=<?php echo $id;?> >
                            <input type="hidden" name="staffno" value=<?php echo $staffno;?>>
                            <input type="submit" name="update" value="Update" class="btn btn-success btn-sm float-right">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Claim Page -->
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