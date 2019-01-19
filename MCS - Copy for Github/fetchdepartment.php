<?php
$connect = mysqli_connect("localhost", "root", "", "mcs");
$output = '';
if(isset($_POST["query"]))
{
	$company = $_POST['query'];
	$query = "SELECT * FROM department WHERE companyname='$company' ORDER BY id ASC"; 
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive ">
					<table class="table table-hover table-bordered table-light">
						<tr class="bg-info text-white" align="center">
                            <th>No.</th>
							<th>Department</th>
                            <th>Actions</th>
						</tr>';
    $counter = 1;
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr >
                <td align="center">'.$counter.'</td>
				<td>'.$row["dept"].'</td>
                <td align="center"><a href="deptedit.php?id='.$row["id"].'">View</a> | <a href="deptdelete.php?id='.$row["id"].'" onclick="return confirm("Are you sure you want to delete?")\">Delete</a></td>	
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
