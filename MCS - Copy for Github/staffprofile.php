<?php   //including the database connection file
    session_start();
    include_once("config.php");
?>
<?php   //find staff details based on id

    $staffno = $_GET['id'];
    $result5 = mysqli_query($conn, "SELECT entitlement FROM staffs WHERE staffno='$staffno' ");
    $result4 = mysqli_query($conn, "SELECT SUM(amount) AS totalamount FROM claim WHERE staffno='$staffno' AND YEAR(date)=YEAR(CURDATE())");
    $result3 = mysqli_query($conn, "SELECT * FROM claim WHERE staffno='$staffno' AND YEAR(date)=YEAR(CURDATE()) ORDER BY date"); 
    $result2 = mysqli_query($conn, "SELECT * FROM family WHERE staffno='$staffno'"); // using mysqli_query instead
    $result = mysqli_query($conn, "SELECT * FROM staffs WHERE staffno='$staffno'");

    while($res = mysqli_fetch_array($result))
    {
        $staffno = $res['staffno'];
        $email = $res['email'];
        $name = $res['name'];
        $grade = $res['grade'];
        $dept = $res['dept'];
        $designation = $res['designation'];
        $status = $res['status'];
        $company = $res['company'];
        $ic = $res['ic'];
        $dob = $res['dob'];
        $address = $res['address'];
        $mobile = $res['mobile'];
        $tel = $res['tel'];
        $entitlement = $res['entitlement'];
        $checkup = $res['checkup'];
        $datejoin = date("d-M-Y", strtotime($res['datejoin']));
    }

?>
<?php
    if(isset($_POST['add']))
    {	
        $staffno = mysqli_real_escape_string($conn, $_POST['id']);
        $i = mysqli_real_escape_string($conn, $_POST['year']);
        header("Location: pdfclaimyear.php?id=$staffno&year=$i");
    }
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
        
        <title>Staff Profile</title>
        
        <style>
            body {
                overflow-x: hidden;
                background-image: url("imgs/4.jpg");
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
            }
        </style>
        
</head>
<body>
    <!-- nav bar -->
    <?php include 'navbar.php'; ?>
    <!-- /nav bar -->
    <!-- Content -->
    <div class="container" style="background-color: #f4f4f4; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px; margin-top: 120px;">
        <!-- Profile Page -->
        <div class="container" >
            <div class="card-body col-md-12">
                <div class="row">
                    <div class="col">
                        <h1 style="font-family:Trebuchet MS; color:black;">Staff Profile</h1>
                    </div>
                    <div class="col-md-3">
                        <div class="float-right"><a href="staffprofileedit.php?id=<?php echo $staffno; ?>" class="btn btn-success btn-lg" role="button">Edit Profile</a></div> <!-- This button take the id (by echo) to editprofile page -->
                    </div>
                </div>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Staff ID</label>
                            <input type="text" class="form-control" value="<?php echo $staffno;?>" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Email</label>
                            <input type="email" class="form-control" value="<?php echo $email;?>" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="text" class="form-control" value="<?php echo $name;?>" disabled>
                        </div>                                  
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">I/C</label>
                            <input type="text" class="form-control" value="<?php echo $ic;?>" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Date of Birth</label>
                            <input type="text" class="form-control" value="<?php echo $dob;?>" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Telephone</label>
                            <input type="text" class="form-control" value="<?php echo $tel;?>" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Mobile Phone</label>
                            <input type="text" class="form-control" value="<?php echo $mobile;?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <textarea class="form-control" rows="3" style="resize: none;" disabled><?php echo $address;?></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputEmail4">Date Join</label>
                            <input type="text" name="datejoin" class="form-control" id="datepicker" value="<?php echo $datejoin;?>" disabled/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Status</label>
                            <input type="text" class="form-control" value="<?php echo $status;?>" disabled>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputPassword4">Designation</label>
                            <input type="text" class="form-control" value="<?php echo $designation;?>" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">Grade</label>
                            <input type="text" class="form-control" value="<?php echo $grade;?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Entitlement (RM)</label>
                            <input type="text" name="entitlement" class="form-control" value="<?php echo $entitlement;?>" style="text-transform:uppercase;" disabled>
                        </div>
                        <div class="form-group col-md-2" <?php if ($grade == "E6" || $grade == "E7" || $grade == "E8" || $grade == "E9" || $grade == "E10" || $grade == "E11" || $grade == "E12" || $grade == "N1" || $grade == "N2" || $grade == "N3" || $grade == "N4" || $grade == "N5") echo " style='display: disabled';"; ?>>
                            <label>Checkup (RM)</label>
                            <input type="text" id="checkup" name="checkup" class="form-control" value="<?php echo $checkup;?>" style="text-transform:uppercase;" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Department</label>
                            <input type="text" class="form-control" value="<?php echo $dept;?>" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Company</label>
                            <input type="text" class="form-control" value="<?php echo $company;?>" disabled>
                        </div>
                    </div>
                </form>    
            </div>
        </div>   
        <!-- /Profile Page -->
        <!-- Family Page -->
        <div class="container">
            <div class="card-body col-md-12">
                <div class="form-row">
                    <div class="col">
                        <h1 style="font-family:Trebuchet MS; color:black;">Staff Family</h1>
                    </div>
                    <div class="col-md-3">
                        <div class="float-right"><a href="stafffamilyadd.php?id=<?php echo $staffno; ?>" class="btn btn-success btn-lg" role="button">Add Family</a></div>
                    </div>
                </div>
                <table class="table table-hover table-bordered">
                    <tr class="bg-info text-white" align="center" style="font-weight:bold" >
                        <td align="center">Relationship</td>
                        <td align="center">Name</td>
                        <td align="center">I/C</td>
                        <td align="center">Date of Birth</td>
                        <td align="center">Action</td>
                    </tr>
                    <tbody>
                        <?php
                            while($res = mysqli_fetch_array($result2))
                            {
                                echo "<tr>";
                                echo "<td >".$res['relationship']."</td>";
                                echo "<td >".$res['name']."</td>";
                                echo "<td align='center'>".$res['ic']."</td>";
                                echo "<td align='center'>".$res['dob']."</td>";
                                echo "<td align='center'><a href=\"stafffamilyedit.php?id=$res[id]&staffno=$staffno\">Edit</a> | <a href=\"stafffamilydelete.php?id=$res[id]&staffno=$staffno\" onClick=\"return confirm('Are you sure you want to delete $res[name] ?')\">Delete</a></td>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>    
        <!-- /Family Page -->
        <!-- Claim Page -->
        <div class="container">
            <div class="card-body col-md-12">
                <div class="form-row">
                    <div class="col-md-5">
                        <h1 style="font-family:Trebuchet MS; color:black;">Claim Balance</h1>
                    </div>
                    <form action="staffprofile.php" method="post">
                        <div class="row">
                            <div class="">
                                <select id="year" name="year" class="bg-white text-dark form-control form-control-lg form-control-borderless" style="width: 216px;">
                                    <?php
                                        //$prev_year = 2016;
                                        for($i=date('Y'); $i>date('Y')-3; $i--) {
                                            //echo "$i<br>";
                                            print '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="">
                                <input type="hidden" name="id" value="<?php echo $staffno;?>">
                                <input type="submit" name="add" value="Print" class="btn btn-warning btn-lg float-right">
                            </div>
                        </div>
                    </form>
                    <div class="col-md-4">                        
                        <div class="float-right"><a href="staffclaim.php?id=<?php echo $staffno; ?>" class="btn btn-success btn-lg" role="button">Add Claim</a></div>
                    </div>
                </div>
                <table id="claim" class="table table-hover table-bordered" class="display nowrap dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                    <tr class="bg-info text-white" align="center" style="font-weight:bold" >
                        <td align="center">No.</td>
                        <td align="center">Date</td>
                        <td align="center">Name</td>
                        <td align="center">Clinic</td>
                        <td align="center">Invoice No</td>
                        <td align="center">Amount (RM)</td>
                        <td align="center">Actions</td>
                    </tr>
                    <tbody id="table">
                        <?php
                            $counter = 1;
                            while($res = mysqli_fetch_array($result3))
                            {
                                $tarikh=$res['date'];
                                $date=date('j/M/y', strtotime($tarikh));
                                
                                echo "<tr>";
                                echo "<td align='center'>".$counter."</td>";
                                echo "<td >".$date."</td>";
                                echo "<td >".$res['famname']."</td>";
                                echo "<td >".$res['clinic']."</td>";
                                echo "<td align='center'>".$res['invoice']."</td>";
                                echo "<td align='center'>".$res['amount']."</td>";
                                echo "<td align='center'><a href=\"staffclaimedit.php?id=$res[id]&staffno=$res[staffno]\">Edit</a> | <a href=\"staffclaimdelete.php?id=$res[id]&staffno=$staffno\" onClick=\"return confirm('Are you sure you want to delete $res[famname] ?')\">Delete</a></td>";
                                $counter++;
                            }
                            while($res = mysqli_fetch_array($result4))
                            {
                                $smallest = number_format($res['totalamount'], 2, '.', ''); 
                                echo "<tr>";
                                echo "<td colspan='5' align='right'><b>Total Amount (RM)</b></td>";
                                echo "<td align='center'>".$smallest."</td>";
                            }
                            while($res = mysqli_fetch_array($result5))
                            {
                                $entitlement = number_format($res['entitlement'], 2, '.', ''); 
                                $smallest;
                                $balance = $entitlement - $smallest;
                                
                                if($balance <= 100)
                                {
                                    $bal = "<b style='color:red;'>".number_format($balance, 2, '.', '')."</b>";
                                }
                                else
                                {
                                    $bal = number_format($balance, 2, '.', '');
                                }
                                
                                echo "<tr>";
                                echo "<td colspan='5' align='right'><b>Balance (RM)</b></td>";
                                echo "<td align='center'>".$bal."</td>";
                            }                            
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /Claim Page -->
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
<script>
    $(document).ready(function(){
        $('#year').change(function(){
            var search = $(this).val();
            var staffno = '<?php echo $_GET["id"]; ?>';
            if(search != '')
            {
                load_data(search, staffno); //when user choose dropdown, it fill find data
            }
            else 
            {
                load_data(); //idle		
            }
        });
        //load_data();
        function load_data(query, id)
        {
            $.ajax({
                url:"fetchclaimyear.php",
                method:"post",
                data:{query:query, id:id},
                success:function(data)
                {
                    $('#table').html(data);
                }
            });
        }
    });
</script>