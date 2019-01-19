<?php   //including the database connection file
    session_start();
    include_once("config.php");
?>
<?php
    if(isset($_POST['add']))
    {   
        $company = mysqli_real_escape_string($conn, $_POST['company']);
        header("Location: staffsummary.php?id=$company");
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
?>
<!DOCTYPE html> 
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        
        <!-- For datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> <!-- button css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >

        <title>Staff Medical Claim Summary (<?php echo date('Y') ?>) <br> <?php echo $_GET['id'] ?></title>
        
        <style>
            body {
                overflow-x: hidden;
                background-image: url("imgs/7.jpg");
                background-size: cover;
            }
            #footer { 
                bottom:0;
                width:100%;
                height:30px;   /* Height of the footer */
                background: white;
                opacity: 0.7;
                position: fixed;
            }
            #footer {
                -moz-user-select: none;  
                -webkit-user-select: none;  
                -ms-user-select: none;  
                -o-user-select: none;  
                user-select: none;
            }
            div.dataTables_length {
              margin-right: 3em;
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
        <div class="container col-11" style="background-color: #EAEAEA; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px; margin-top: 120px;">
            <br>
            <div class="container">
                <div class="row">
                    <h3 style="font-family:Trebuchet MS;">Staff Medical Summary (<?php echo date('Y') ?>)</h3>
                </div>
            </div>
            <div class="container">
                <form action="staffsummary.php" method="post">
                    <div class="row">
                        <div class="">
                            <select id="company" name="company" class="bg-white text-dark form-control form-control-lg form-control-borderless" style="width: 950px;">
                                <option value="">Choose Company..</option>
                                <?php   //search company from staffs table
                                    $sql = "SELECT * FROM company";
                                    $result=mysqli_query($conn, $sql);
                                                                            
                                    $row=mysqli_fetch_array($result);
                                    $company_user = $row['company']; 
                                ?>
                                <?php while($row1=mysqli_fetch_array($result1)):;?>
                                    <option  >
                                        <?php echo $row1['cname']; ?> <!-- Looping of company table -->
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="">
                            <input type="submit" name="add" value="Search" class="btn btn-warning btn-lg float-right">
                        </div>
                        <div class="">
                            <input type="button" value="Reset" class="btn btn-success btn-lg" onclick="location.href='staffsummary.php?id=';">
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <?php 
                echo "<h2 align='center'>" . $_GET['id'] . "</h2>";  
            ?>
            <br>
            <table id="summary" class="table table-hover table-bordered table-light">
                <thead class="bg-info text-white" align="center">
                    <th>No.</th>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Entitlement</th>
                    <th>Usage</th>
                    <th>Balance</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <!-- fetch from db -->
                    <?php
                        $conn = mysqli_connect("localhost","root","","mcs") or die ("Error in Connection");
                        $company = $_GET['id'];
                        $query = mysqli_query($conn, "SELECT staffs.name,
                                                           staffs.email,
                                                           staffs.dept, 
                                                           staffs.company,
                                                           staffs.entitlement, 
                                                           SUM(claim.amount) as amount, 
                                                           (staffs.entitlement - SUM(claim.amount)) as balance,
                                                           claim.staffno 
                                                      FROM staffs, 
                                                           claim 
                                                      WHERE staffs.staffno=claim.staffno AND company='$company' AND YEAR(date)=YEAR(CURDATE())
                                                      GROUP BY staffno
                                                      ORDER BY balance ASC");
                        $query2 = mysqli_query($conn, "SELECT *
                                                      FROM staffs
                                                      WHERE company='$company' AND staffno NOT IN(SELECT staffno FROM claim)");
                        $counter = 1;
                        while($result = mysqli_fetch_array($query))
                        {
                            $entitlement = number_format($result['entitlement'], 2, '.', ''); 
                            $totalamount = number_format($result['amount'], 2, '.', ''); 
                            $balance = $entitlement - $totalamount;
                            
                            if($balance <= 100)
                            {
                                $status = "<form action='email.php' method='post'>
                                                <a href=\"email.php?email=$result[email]&id=$balance&name=$result[name]&no=$result[staffno]\">
                                                    Send Email
                                                </a>
                                           </form>";
                                $bal = "<b style='color:red;'>".number_format($balance, 2, '.', '')."</b>";
                            }
                            else
                            {
                                $status = "";
                                $bal = number_format($balance, 2, '.', '');
                            }
                            echo "<tr>
                                    <td align='center'>".$counter."</td> 
                                    <td >".$result['staffno']."</td> 
                                    <td><a href='staffprofile.php?id=".$result['staffno']."'>".$result['name']."</a></td>        
                                    <td>".$result['dept']."</td>
                                    <td align='center'>".$result['entitlement']."</td>
                                    <td align='center'>".number_format($result['amount'], 2, '.', '')."</td>                               
                                    <td align='center'>".$bal."</td>
                                    <td align='center'>".$status."</td>
                            </tr>";
                            $counter++;
                        }
                    
                        //untuk staff yang tak claim lagi
                        while($result = mysqli_fetch_array($query2))
                        {
                            $amount = 0;
                            echo "<tr>
                                    <td align='center'>".$counter."</td> 
                                    <td >".$result['staffno']."</td> 
                                    <td><a href='staffprofile.php?id=".$result['staffno']."'>".$result['name']."</a></td>        
                                    <td>".$result['dept']."</td>
                                    <td align='center'>".$result['entitlement']."</td>
                                    <td align='center'>".$amount."</td>                               
                                    <td align='center'>".$amount."</td>
                                    <td align='center'> </td>
                            </tr>";
                            $counter++;
                        }
                    ?>
                </tbody>
            </table>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> <!-- jquery for button -->
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> <!-- jquery datatable -->
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> <!-- buttons datatable -->
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script> <!-- buttons flash -->

            <!-- copy csv excel pdf print button -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

            <script type="text/javascript">
                $(document).ready( function () {
                    $('#summary').DataTable({
                        dom: 'l B f r t i p', //l = length, f = filter, t = table, i = info summary, p = pagination, r = processing display
                        buttons: [
                            {
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6 ] // display all columns except status column
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                                }
                            },
                        ],
                        aLengthMenu: [
                            [10, 30, 50, 70, 100, -1],
                            [10, 30, 50, 70, 100, "All"]
                        ],
                        iDisplayLength: 30,
                        
                    });
                    //exact search word in search bar
                    var table = $('#summary').DataTable();  

                    $('.dataTables_filter input').unbind().bind('keyup', function() {
                       var searchTerm = this.value.toLowerCase()
                       if (!searchTerm) {
                           table.draw();   
                         return;
                       }
                       $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                          for (var i=0;i<data.length;i++) {
                             if (data[i].toLowerCase() == searchTerm) return true
                          }
                          return false
                       })
                       table.draw();   
                       $.fn.dataTable.ext.search.pop()
                    });
                } );
            </script>
            <br>
        </div>
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
                url:"fetchsummary.php",
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