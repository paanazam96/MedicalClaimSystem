<?php
$connect = mysqli_connect("localhost", "root", "", "mcs");
//$staffno = 'SSSB9999';
$staffno = $_POST['id'];
$output = '';
if(isset($_POST["query"]))
{
	$year = $_POST['query'];
	$query5 = "SELECT entitlement FROM staffs WHERE staffno='$staffno' ";
    $query4 = "SELECT SUM(amount) AS totalamount FROM claim WHERE staffno='$staffno' AND YEAR(date)=$year";
    $query3 = "SELECT * FROM claim WHERE staffno='$staffno' AND YEAR(date)=$year ORDER BY date"; 
}
else
{ 
    $query5 = "SELECT entitlement FROM staffs WHERE staffno='$staffno' ";
    $query4 = "SELECT SUM(amount) AS totalamount FROM claim WHERE staffno='$staffno' AND YEAR(date)=YEAR(CURDATE())";
    $query3 = "SELECT * FROM claim WHERE staffno='$staffno' AND YEAR(date)=YEAR(CURDATE()) ORDER BY date"; 
}
$result5 = mysqli_query($connect, $query5);
$result4 = mysqli_query($connect, $query4);
$result3 = mysqli_query($connect, $query3);
if(mysqli_num_rows($result3) > 0)
{
    $counter = 1;
	while($row = mysqli_fetch_array($result3))
	{
        $tarikh=$row['date'];
        $date=date('j/M/y', strtotime($tarikh));
        
		$output .= '
			<tr >
                <td align="center">'.$counter.'</td>
				<td>'.$date.'</td>
				<td>'.$row["famname"].'</td>
                <td >'.$row["clinic"].'</td>
                <td align="center">'.$row["invoice"].'</td>
                <td align="center">'.$row["amount"].'</td>
                <td align="center"><a href="staffclaimedit.php?id='.$row["id"].'&staffno='.$row["staffno"].'">Edit</a> | <a href="staffclaimdelete.php?id='.$row["id"].'&staffno='.$row["staffno"].'" onclick="return checkDelete()">Delete</a></td>
		'; 
        $counter++;
	} 
    while($row = mysqli_fetch_array($result4))
    {
        $smallest = number_format($row['totalamount'], 2, '.', ''); 
        
        $output .= '
			<tr >
				<td colspan="5" align="right"><b>Total Amount (RM)</b></td>
                <td align="center">'.number_format($row['totalamount'], 2, '.', '').'</td>
		';
    }
    while($row = mysqli_fetch_array($result5))
    {
        $entitlement = number_format($row['entitlement'], 2, '.', ''); 
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

        $output .= '
			<tr >
				<td colspan="5" align="right"><b>Balance (RM)</b></td>
                <td align="center">'.$bal.'</td>
		';
    }
	echo $output;
}
else
{
	echo 'Details not Found!';
}
?>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure you want to delete this staff?\nThis action CANNOT be undone.');
}
</script>