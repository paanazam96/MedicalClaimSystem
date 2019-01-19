<?php   //including the database connection file
    session_start();
    include_once("config.php");
    
    if(isset($_POST['update'])) //update staff details based on id
    { 
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        
        $staffno = mysqli_real_escape_string($conn, strtoupper($_POST['staffno']));
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $name = mysqli_real_escape_string($conn, strtoupper($_POST['name']));
        $ic = mysqli_real_escape_string($conn, $_POST['ic']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $address = mysqli_real_escape_string($conn, strtoupper($_POST['address']));
        $status = mysqli_real_escape_string($conn, strtoupper($_POST['status']));
        $designation = mysqli_real_escape_string($conn, strtoupper($_POST['designation']));
        $grade = mysqli_real_escape_string($conn, strtoupper($_POST['grade']));
        $dept = mysqli_real_escape_string($conn, strtoupper($_POST['dept']));        
        $company = mysqli_real_escape_string($conn, strtoupper($_POST['company']));
        $entitlement = mysqli_real_escape_string($conn, $_POST['entitlement']);
        $checkup = mysqli_real_escape_string($conn, $_POST['checkup']);
        $datejoin = mysqli_real_escape_string($conn, $_POST['datejoin']);
        
        $result = mysqli_query($conn, "UPDATE staffs SET staffno='$staffno', 
        email='$email', 
        name='$name', 
        grade='$grade',
        dept='$dept',
        designation='$designation',
        status='$status',
        company='$company',
        ic='$ic',
        dob='$dob',
        address='$address',
        mobile='$mobile',
        tel='$tel',
        entitlement='$entitlement',
        checkup='$checkup',
        datejoin='$datejoin' WHERE staffno='$staffno'");
            
        //header("Location: staffprofile.php?id=$id");
        echo "<script>alert('Update Successful!'); window.location.href='staffprofile.php?id=$staffno';</script>";    
    }
?> 
<?php

    $staffno = $_GET['id'];  //read staff details based on id

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
        $datejoin = $res['datejoin'];
    }

?>
<?php   
    $hostname="localhost";
    $username="root";
    $password="";
    $databaseName="mcs";
 
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    $query = "SELECT * FROM `company` ";    //query all company name for dropdown
    $result1 = mysqli_query($connect, $query);

    $query = "SELECT * FROM `department` "; //query all department name for dropdown
    $result2 = mysqli_query($connect, $query);

    $query = "SELECT * FROM `status` ";     //query all status name for dropdown
    $result3 = mysqli_query($connect, $query);

    $query = "SElECT * FROM `grade` ";      //query all grade name for dropdown
    $result4 = mysqli_query($connect, $query)
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
        
        <!-- Jacascript for Datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

        <title>Edit Staff Profile</title>
        
        <style>
            body {
                overflow-x: hidden;
                background-image: url("imgs/3.jpg");
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
                display: inline-block;
            }
            .checkup {
                display: inline;
            }
        </style>
        <!-- Convrt ic to dob -->
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
        <div class="container" style="background-color: #f4f4f4; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px; margin-top: 120px;">
            <div class="row">
                <!-- My Profile -->
                    <div class="container">
                        <div class="card-body col-md-12">
                            <div class="row">
                                <div class="col">
                                    <h1 style="font-family:Trebuchet MS; color:black;">Edit Staff Profile</h1>
                                </div>
                                <div class="col">
                                    
                                </div>
                            </div>
                            <form action="staffprofileedit.php" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Staff ID</label>
                                        <input name="staffno" type="text" class="form-control" style="text-transform:uppercase;" value="<?php echo $staffno;?>" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPassword4">Email</label>
                                        <input name="email" type="email" class="form-control" value="<?php echo $email;?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Name</label>
                                        <input name="name" type="text" class="form-control" style="text-transform:uppercase;" value="<?php echo $name;?>" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">I/C</label>
                                        <input name="ic" id="ic" onchange="cal()" type="text" class="form-control" value="<?php echo $ic;?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPassword4">Date of Birth</label>
                                        <input name="dob" id="numdays2" type="text" class="form-control" value="<?php echo $dob;?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Telephone</label>
                                        <input name="tel" type="text" class="form-control" value="<?php echo $tel;?>" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPassword4">Mobile Phone</label>
                                        <input name="mobile" type="text" class="form-control" value="<?php echo $mobile;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Address</label>
                                    <textarea name="address" class="form-control" rows="3" id="comment" style="text-transform:uppercase; resize: none;"><?php echo $address;?></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">Date Join</label>
                                        <input type="text" name="datejoin" class="form-control" id="datepicker" value="<?php echo $datejoin ;?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Status</label>
                                        <select name="status" class="form-control" required>
                                            <?php   //search dept from staffs table
                                                $sql = "SELECT status FROM staffs WHERE staffno='$staffno'";
                                                $result=mysqli_query($conn, $sql);

                                                $row=mysqli_fetch_array($result);
                                                $status_user = $row['status']; 
                                            ?>
                                            <?php while($row1=mysqli_fetch_array($result3)):;?>
                                            <option <?php if($row1['type'] == $status_user) echo "selected"; ?> >
                                                <?php echo $row1['type']; ?>    <!-- Looping of department table -->
                                            </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="inputPassword4">Designation</label>
                                        <input name="designation" type="text" class="form-control" style="text-transform:uppercase;" value="<?php echo $designation;?>" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputPassword4">Grade</label>
                                        <select name="grade" class="form-control" required>
                                            <?php   //search dept from staffs table
                                                $sql = "SELECT grade FROM staffs WHERE staffno='$staffno'";
                                                $result=mysqli_query($conn, $sql);

                                                $row=mysqli_fetch_array($result);
                                                $grade_user = $row['grade']; 
                                            ?>
                                            <?php while($row1=mysqli_fetch_array($result4)):;?>
                                            <option <?php if($row1['grade'] == $grade_user) echo "selected"; ?> >
                                                <?php echo $row1['grade']; ?>    <!-- Looping of department table -->
                                            </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>Entitlement (RM)</label>
                                        <input type="text" name="entitlement" class="form-control" value="<?php echo $entitlement;?>" style="text-transform:uppercase;">
                                    </div>
                                    <div class="form-group col-md-2" <?php if ($grade == "E6" || $grade == "E7" || $grade == "E8" || $grade == "E9" || $grade == "E10" || $grade == "E11" || $grade == "E12" || $grade == "N1" || $grade == "N2" || $grade == "N3" || $grade == "N4" || $grade == "N5") echo " style='display: none';"; ?>>
                                        <label>Checkup (RM)</label>
                                        <input type="text" id="checkup" name="checkup" class="form-control" value="<?php echo $checkup;?>" style="text-transform:uppercase;">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Department</label>
                                        <select name="dept" class="form-control" required>
                                            <option value="">Choose..</option>
                                            <?php   //search dept from staffs table
                                                $sql = "SELECT dept FROM staffs WHERE staffno='$staffno'";
                                                $result=mysqli_query($conn, $sql);

                                                $row=mysqli_fetch_array($result);
                                                $dept_user = $row['dept']; 
                                            ?>
                                            <?php while($row1=mysqli_fetch_array($result2)):;?>
                                            <option <?php if($row1['dept'] == $dept_user) echo "selected"; ?> >
                                                <?php echo $row1['dept']; ?>    <!-- Looping of department table -->
                                            </option>
                                            <?php endwhile; ?>
                                        </select>                                        
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">Company</label><br>
                                        <select name="company" class="form-control" required>
                                            <option value="">Choose..</option>
                                            <?php   //search company from staffs table
                                                $sql = "SELECT company FROM staffs WHERE staffno='$staffno'";
                                                $result=mysqli_query($conn, $sql);
                                                                            
                                                $row=mysqli_fetch_array($result);
                                                $company_user = $row['company']; 
                                            ?>
                                            <?php while($row1=mysqli_fetch_array($result1)):;?>
                                            <option <?php if($row1['cname'] == $company_user) echo "selected"; ?> >
                                                <?php echo $row1['cname']; ?> <!-- Looping of company table -->
                                            </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <a href="staffprofile.php?id=<?php echo $staffno; ?>" class="btn btn-danger btn-sm float-left" role="button">Back</a>     
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="hidden" name="id" value="<?php echo $staffno;?>">
                                        <input type="submit" name="update" value="Update" class="btn btn-success btn-sm float-right">
                                    </div>
                                </div>
                            </form>    
                        </div>
                    </div>
                </div>
            <!-- /My Profile -->
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
<script>
    $(function() {
    $('#grade').on('change', function(){
        $('#checkup').prop('disabled', (this.value == 'E6' || this.value == 'E7' || this.value == 'E8' || this.value == 'E9' || this.value == 'E10' || this.value == 'E11' || this.value == 'E12' || this.value == 'N1' || this.value == 'N2' || this.value == 'N3' || this.value == 'N4' || this.value == 'N5'));
    });
});
</script>
<script>
    $(document).ready(function () {
    $("#ic").keyup(function () {
        if ($(this).val().length == 6) {
            $(this).val($(this).val() + "-");
        }
        else if ($(this).val().length == 9) {
            $(this).val($(this).val() + "-");
        }
        else if ($(this).val().length == 11) {
            $(this).val($(this).val() + "-");
        }
    });
});
</script>
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd', // iso format
            yearRange: '1960:+10'
        });
    });
</script>