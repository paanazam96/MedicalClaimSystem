<?php
$connect = mysqli_connect("localhost", "root", "", "mcs");
$output = '';
if(isset($_POST["query"]))
{
	$company = $_POST['query'];
	$query = "SELECT staffs.name,
                   staffs.email,
                   staffs.company, 
                   staffs.entitlement, 
                   SUM(claim.amount) as amount, 
                   (staffs.entitlement - SUM(claim.amount)) as balance,
                   claim.staffno 
              FROM staffs, 
                   claim 
              WHERE staffs.staffno=claim.staffno AND company='$company' AND YEAR(date)=YEAR(CURDATE())
              GROUP BY staffno
              ORDER BY balance ASC"; 
}
else
{ 
	$query = "SELECT staffs.name,
                   staffs.email,
                   staffs.company, 
                   staffs.entitlement, 
                   SUM(claim.amount) as amount, 
                   (staffs.entitlement - SUM(claim.amount)) as balance,
                   claim.staffno 
              FROM staffs, 
                   claim 
              WHERE staffs.staffno=claim.staffno AND YEAR(date)=YEAR(CURDATE())
              GROUP BY staffno
              ORDER BY balance ASC";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive ">
					<table class="table table-hover table-bordered table-light">
						<tr class="bg-info text-white" align="center">
              <th>No.</th>
							<th>Staff ID</th>
							<th>Name</th>
							<th>Company</th>
							<th>Entitlement<br>(RM)</th>
              <th>Usage<br>(RM)</th>
              <th>Balance<br>(RM)</th>
              <th>Status</th>
						</tr>';
    $counter = 1;
	while($row = mysqli_fetch_array($result))
	{
        $entitlement = number_format($row['entitlement'], 2, '.', ''); 
        $totalamount = number_format($row['amount'], 2, '.', ''); 
        $balance = $entitlement - $totalamount;
                                 
        if($balance <= 100)
        {
            $status = "<form action='z.php' method='post'>
                           <button>
                               <a href=\"email.php?email=$row[email]&id=$balance&name=$row[name]&no=$row[staffno]\">
                                Send Email
                               </a>
                           </button>
                       </form>";
            $bal = "<b style='color:red;'>".number_format($balance, 2, '.', '')."</b>";
        }
        else
        {
            $status = "";
            $bal = number_format($balance, 2, '.', '');
        }
    $output .= '
      <tr >
                <td align="center">'.$counter.'</td>
        <td>'.$row["staffno"].'</td>
        <td><a href="staffprofile.php?id='.$row["staffno"].'">'.$row["name"].'</a></td>
        <td>'.$row["company"].'</td>
                <td align="center">'.$row["entitlement"].'</td>
                <td align="center">'.number_format($row['amount'], 2, '.', '').'</td>
                <td align="center">'.$bal.'</td>
                <td align="center">'.$status.'</td>
    ';
        $counter++;
  }
	echo $output;
}
else
{
	echo 'Details not Found!';
}
?>