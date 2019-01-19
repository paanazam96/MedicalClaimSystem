<?php   //including the database connection file
    session_start();
    include_once("config.php");
?>
<?php
    $resdept = mysqli_query($conn, "SELECT * FROM department ORDER BY id ASC")
?>
<?php   
    $hostname="localhost";
    $username="root";
    $password="";
    $databaseName="mcs";
 
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    $query = "SELECT * FROM `company` ";    //query all company name for dropdown
    $result1 = mysqli_query($connect, $query);
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

            <title>List of Department</title>

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
                    <h3 style="font-family:Trebuchet MS; color:black;">List of Departments</h3>
                </div>
                <div class="col">
                    <a href="deptadd.php" class="btn btn-success btn-md float-right" role="button">Add Department</a>                   
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="" >
                        <select id="company" name="company" class="bg-white text-dark form-control form-control-lg form-control-borderless" style="width: 100%;">
                            <option value="">Select Company..</option>
                            <?php   //search company from staffs table
                                $sql = "SELECT * FROM company";
                                $result=mysqli_query($conn, $sql);
                                                                            
                                $row=mysqli_fetch_array($result);
                                $company_user = $row['company']; 
                            ?>
                            <?php while($row1=mysqli_fetch_array($result1)):;?>
                                <option value="<?php echo $row1['cname']; ?>" >
                                    <?php echo $row1['cname']; ?> <!-- Looping of company table -->
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div id="table">
                
            </div>
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
<script>
    $(document).ready(function(){
        load_data();
        function load_data(query)
        {
            $.ajax({
                url:"fetchdepartment.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#table').html(data);
                }
            });
        }

        $('#company').change(function(){
            var search = $(this).val();
            if(search != '')
            { 
                load_data(search); //when user type, it fill find data
            }
            else 
            {
                load_data(); //when user type, it fill find data			
            }
        });
    });
    
    // hide table when no value in search input and show table when there is value in search input
    $('#company').change(function() {

      // If value is not empty
      if ($(this).val().length == 0) {
        // Hide the element
        $('#table').hide();
      } else {
        // Otherwise show it
        $('#table').show();
      }
    }).change(); // Trigger the keyup event, thus running the handler on page load
</script>