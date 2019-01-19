<?php   //including the database connection file 
    session_start();
    include_once("config.php");
    
    if(isset($_POST['add'])) //update staff details based on id
    { 
        //$id = mysqli_real_escape_string($conn, $_POST['id']);
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
        //add staff to table staffs
        $check_staffs = "SELECT * FROM staffs WHERE staffno='$staffno'";
        $res = mysqli_query($conn, $check_staffs);
        $count = mysqli_num_rows($res);
        
        if($count == 1)
        { 
            echo "<script>alert('Staff Already Existed!'); window.location.href='welcomepage.php';</script>";
        }
        else
        {
            $result = mysqli_query($conn, "INSERT staffs (staffno,datejoin,email,name,ic,dob,tel,mobile,address,status,designation,grade,dept,company,entitlement,checkup) VALUES ('$staffno','$datejoin','$email','$name','$ic','$dob','$tel','$mobile','$address','$status','$designation','$grade','$dept','$company','$entitlement','$checkup')");
            
            echo "<script>alert('Staff Added Successful!'); window.location.href='welcomepage.php';</script>";
        } 
    }
?>
<?php
    include_once("config.php");
 
    if(isset($_POST['add'])) //update staff details based on id
    { 
        //$id = mysqli_real_escape_string($conn, $_POST['id']);
        $dept = mysqli_real_escape_string($conn, strtoupper($_POST['dept']));
        $company = mysqli_real_escape_string($conn, strtoupper($_POST['company']));
        $grade = mysqli_real_escape_string($conn, strtoupper($_POST['grade']));
        
        $check_dept = "SELECT * FROM department WHERE dept='$dept' ";   //check and insert to table department
        $res = mysqli_query($conn, $check_dept);
        $count1 = mysqli_num_rows($res);
        
        if($count1 == 1)
        { 
            echo "<script>alert('Company Already Existed!'); window.location.href='welcomepage.php';</script>";
        }
        else
        {
            $result = mysqli_query($conn, "INSERT department (dept) VALUES ('$dept')");
            echo "<script>alert('Department Added Successful!'); window.location.href=welcomepage.php';</script>";
        } 
        
        $check_company = "SELECT * FROM company WHERE cname='$company' ";   //check and insert to table company
        $res = mysqli_query($conn, $check_company);
        $count2 = mysqli_num_rows($res);
        
        if($count2 == 1)
        { 
            echo "<script>alert('Company Already Existed!'); window.location.href='welcomepage.php';</script>";
        }
        else
        {
            $result = mysqli_query($conn, "INSERT company (cname) VALUES ('$company')");
            echo "<script>alert('Company Added Successful!'); window.location.href=welcomepage.php';</script>";
        }    
        
        $check_grade = "SELECT * FROM grade WHERE grade='$grade' ";     //check and insert to table grade
        $res = mysqli_query($conn, $check_grade);
        $count3 = mysqli_num_rows($res);
        
        if($count3 == 1)
        {
            echo "<script>alert('Grade Already Existed!'); window.location.href='welcomepage.php';</script>";
        }
        else
        {
            $result = mysqli_query($conn, "INSERT grade (grade) VALUES ('$grade')");
            echo "<script>alert('Grade Added Successful!'); window.location.href=welcomepage.php';</script>";
        }
    }
?>
<?php   //query all company name for dropdown
    $hostname="localhost";
    $username="root";
    $password="";
    $databaseName="mcs";
 
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    $query1 = "SELECT * FROM `company` ";
    $result1 = mysqli_query($connect, $query1);

    $query2 = "SELECT * FROM `department` ";
    $result2 = mysqli_query($connect, $query2);

    $query3 = "SELECT * FROM `status` ";
    $result3 = mysqli_query($connect, $query3);

    $query4 = "SELECT * FROM `grade` ";
    $result4 = mysqli_query($connect, $query4);
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
        
        <title>Add Staff</title>
        
        <style>
            body {
                overflow-x: hidden;
                background-image: url("imgs/10.jpg");
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
            }
            textarea{
                text-transform: uppercase;
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
                                    <h1 style="font-family:Trebuchet MS; color:black;">Add Staff</h1>
                                </div>
                                <div class="col">
                                    
                                </div>
                            </div>
                            <form action="staffadd.php" method="post" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Staff ID</label>
                                        <input type="text" class="form-control" name="staffno" style="text-transform:uppercase;" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPassword4">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Name</label>
                                        <input type="text" class="form-control" name="name" style="text-transform:uppercase;" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label >I/C</label>
                                        <input id="ic" size="14" maxlength="14" onchange="cal()" class="form-control" name="ic" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPassword4">Date of Birth</label>
                                        <input id="numdays2" type="text" size="12" maxlength="12" class="form-control" name="dob" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Telephone</label>
                                        <input type="text" class="form-control" name="tel" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPassword4">Mobile Phone</label>
                                        <input type="text" class="form-control" name="mobile" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">Address</label>
                                        <textarea class="form-control" style="resize: none;" name="address" style="text-transform:uppercase;"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4">Date Join</label>
                                        <input type="text" name="datejoin" class="form-control" id="datepicker" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Status</label>
                                        <input name="status" list="status" class="form-control" placeholder="Choose.." style="text-transform:uppercase;"/>
                                        <datalist id="status">
                                            <?php while($row1=mysqli_fetch_array($result3)):;?>
                                            <option><?php echo $row1[1]; ?></option>
                                            <?php endwhile; ?>
                                        </datalist>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="inputPassword4">Designation</label>
                                        <input type="text" name="designation" class="form-control" style="text-transform:uppercase;">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Grade</label>
                                        <select id="grade" name="grade" class="form-control">
                                            <option value="">Choose..</option>
                                            <option value="E1">E1</option>
                                            <option value="E2">E2</option>
                                            <option value="E3">E3</option>
                                            <option value="E4">E4</option>
                                            <option value="E5">E5</option>
                                            <option value="E6">E6</option>
                                            <option value="E7">E7</option>
                                            <option value="E8">E8</option>
                                            <option value="E9">E9</option>
                                            <option value="E10">E10</option>
                                            <option value="E11">E11</option>
                                            <option value="E12">E12</option>
                                            <option value="N1">N1</option>
                                            <option value="N2">N2</option>
                                            <option value="N3">N3</option>
                                            <option value="N4">N4</option>
                                            <option value="N5">N5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>Entitlement (RM)</label>
                                        <input type="text" name="entitlement" id="test" class="form-control" style="text-transform:uppercase;">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Checkup (RM)</label>
                                        <input type="text" id="checkup" name="checkup" class="form-control" style="text-transform:uppercase;">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Department</label>
                                        <select name="dept" class="form-control">
                                            <option value="">Choose..</option>
                                            <?php while($row1=mysqli_fetch_array($result2)):?>
                                            <option>
                                                <?php echo $row1['dept']; ?>    <!-- Looping of department table -->
                                            </option>
                                            <?php endwhile; ?>
                                        </select>                                         
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">Company</label><br>
                                        <select name="company" class="form-control">
                                            <option value="">Choose..</option>
                                            <?php while($row1=mysqli_fetch_array($result1)):;?>
                                            <option>
                                                <?php echo $row1['cname']; ?> <!-- Looping of company table -->
                                            </option>
                                            <?php endwhile; ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <a href="welcomepage.php" class="btn btn-danger btn-md float-left" role="button">Back</a>     
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button name="add" type="submit" class="btn btn-success btn-md float-right">Submit</button> 
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
    $(document).ready(function () {
    $("#ic").keyup(function () {
        if ($(this).val().length == 6) {
            $(this).val($(this).val() + "-");
        }
        else if ($(this).val().length == 9) {
            $(this).val($(this).val() + "-");
        }
    });
});
</script>
<script>
    $(function() {
    $('#grade').on('change', function(){
        $('#checkup').prop('disabled', (this.value == 'E6' || this.value == 'E7' || this.value == 'E8' || this.value == 'E9' || this.value == 'E10' || this.value == 'E11' || this.value == 'E12' || this.value == 'N1' || this.value == 'N2' || this.value == 'N3' || this.value == 'N4' || this.value == 'N5'));
    });
});
</script>
<script>
    $(document).change(function(){
        var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
        var firstDate = new Date(2019,0,1);
        var secondDate = new Date(document.getElementById('datepicker').value);

        var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay))+1);
        var daysLeft = (365 - diffDays)+1;    

        var date = document.getElementById("datepicker").value;
        
        var grade = document.getElementById("grade").value;
        switch (grade) {
        case "E1":
            grade = "2500";
            break;
        case "E2":
            grade = "2500";
            break;
        case "E3":
            grade = "2500";
            break;
        case "E4":
            grade = "2500";
            break;
        case "E5":
            grade = "2500";
            break;
        case "E6":
            grade = "1200";
            break;
        case "E7":
            grade = "1200";
            break;
        case "E8":
            grade = "1200";
            break;
        case "E9":
            grade = "1200";
            break;
        case "E10":
            grade = "1200";
            break;
        case "E11":
            grade = "1200";
            break;
        case "E12":
            grade = "1200";
            break;
        case "N1":
            grade = "1000";
            break;
        case "N2":
            grade = "1000";
        case "N3":
            grade = "1000";
            break;
        case "N4":
            grade = "1000";
            break;
        case "N5":
            grade = "1000";
        }
        
        var entitlement = (daysLeft*grade)/365;
        document.getElementById("test").value = Math.round(entitlement);
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