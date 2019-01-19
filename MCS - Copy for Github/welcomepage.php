<?php   //including the database connection file
    session_start();
    include_once("config.php");
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

            <title>Home Page</title>

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
        <div class="container col-11" style="background-color: #EAEAEA; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px; margin-top: 120px;">
            <br>
            <div class="container">
                <center><h3 style="font-family:Trebuchet MS;">Welcome, <?php echo $_SESSION['email']; ?>!</h3></center>
            </div>
            <!-- Tabs -->
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#staff" role="tab" aria-controls="home" aria-selected="true">Staff Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#family" role="tab" aria-controls="profile" aria-selected="false">Family Search</a>
                </li>
            </ul> 
            <!-- /Tabs -->
            <!-- Tabs Page -->
            <div class="tab-content" id="myTabContent">
                <!-- Search Staff Page -->
                <div class="tab-pane fade show active" id="staff" role="tabpanel" aria-labelledby="home-tab">
                    <div class="container">
                        <div class="row">
                            <div class="" >
                                <input type="text" id="search_text" class="bg-white text-dark form-control form-control-lg form-control-borderless" placeholder="Search Staff" style="width: 1050px;">
                            </div>
                            <div class="">
                                <a href="welcomepage.php" class="btn btn-success btn-lg " role="button">Reset</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Table -->
                    <div id="result">

                    </div>
                    <!-- /Table -->
                </div>
                <!-- /Search Staff Page -->
                <!-- Search Family Page -->
                <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="container">
                        <div class="row">
                            <div class="" >
                                <input type="text" id="search_family" class="bg-white text-dark form-control form-control-lg form-control-borderless" placeholder="Search Family" style="width: 1050px;">
                            </div>
                            <div class="">
                                <a href="welcomepage.php" class="btn btn-success btn-lg " role="button">Reset</a>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <!-- Table -->
                    <div id="result2">

                    </div>
                    <!-- /Table -->    
                </div>
                <!-- /Search Family Page -->
            </div>
            <!-- /Tabs Page -->
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
<!-- Staff Part -->
<script>
    $(document).ready(function(){
        load_data();
        function load_data(query)
        {
            $.ajax({
                url:"fetchstaffs.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }

        $('#search_text').keyup(function(){
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
    $('#search_text').keyup(function() {

      // If value is not empty
      if ($(this).val().length == 0) {
        // Hide the element
        $('#result').hide();
      } else {
        // Otherwise show it
        $('#result').show();
      }
    }).keyup(); // Trigger the keyup event, thus running the handler on page load
</script>
<!-- /Staff Part -->
<!-- Family Part -->
<script>
    $(document).ready(function(){
        load_data();
        function load_data(query)
        {
            $.ajax({
                url:"fetchfamily.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#result2').html(data);
                }
            });
        }

        $('#search_family').keyup(function(){
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
    $('#search_family').keyup(function() {

      // If value is not empty
      if ($(this).val().length == 0) {
        // Hide the element
        $('#result2').hide();
      } else {
        // Otherwise show it
        $('#result2').show();
      }
    }).keyup(); // Trigger the keyup event, thus running the handler on page load
</script>
<!-- Staff Part -->