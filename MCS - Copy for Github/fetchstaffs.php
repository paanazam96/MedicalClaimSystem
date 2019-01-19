<?php
$connect = mysqli_connect("localhost", "root", "", "mcs");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM staffs 
	WHERE staffno LIKE '%".$search."%'
	OR name LIKE '%".$search."%' 
	OR dept LIKE '%".$search."%' 
	OR company LIKE '%".$search."%' 
	OR email LIKE '%".$search."%'
    OR grade LIKE '%".$search."%'
    OR datejoin LIKE '%".$search."%'
	";
}
else
{  
	$query = "
	SELECT * FROM staffs ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive ">
					<table class="table table-hover table-bordered table-light">
						<tr class="bg-info text-white" align="center">
							<th>Staff ID</th>
							<th>Email</th>
							<th>Name</th>
							<th>Department</th>
							<th>Company</th>
                            <th>Action</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr >
				<td>'.$row["staffno"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["name"].'</td>
				<td>'.$row["dept"].'</td>
				<td>'.$row["company"].'</td>
                <td align="center"><a href="staffprofile.php?id='.$row["staffno"].'">View</a> | <a href="staffdelete.php?id='.$row["staffno"].'" onclick="return checkDelete()">Delete</a></td>			
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