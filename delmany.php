<?php 
include('config.php');

	$id=$_POST['txtValue'];
	$sql2="SELECT * FROM members where id IN ($id)";
	$result = mysqli_query($conn,$sql2);
	while($row = mysqli_fetch_assoc($result)){
		$filename=$row['photoname'];
		unlink("uploads/$filename");
	}

	 $sql="DELETE FROM members where id IN ($id)";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
header("Location: index.php?message=Multiple");
?>