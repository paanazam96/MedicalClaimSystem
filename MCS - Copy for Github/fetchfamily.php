<?php
$connect = mysqli_connect("localhost", "root", "", "mcs");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM family 
	WHERE staffno LIKE '%".$search."%'
	OR name LIKE '%".$search."%' 
	OR ic LIKE '%".$search."%' 
	";
}
else
{  
	$query = "
	SELECT * FROM family ORDER BY staffno";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive ">
					<table class="table table-hover table-bordered table-light">
						<tr class="bg-info text-white" align="center">
                            <th>ID</th>
							<th>Name</th>
                            <th>I/C</th>
                            <th>Action</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr >
                <td align="center">'.$row["id"].'</td>
				<td>'.$row["name"].'</td>
				<td align="center">'.$row["ic"].'</td>
                <td align="center"><a href="staffprofile.php?id='.$row["staffno"].'">View</a></td>			
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