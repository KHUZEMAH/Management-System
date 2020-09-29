<?php
include('config.php');

	$id=$_GET['id'];
	$sql1="SELECT * FROM members where id=$id";
	$result = mysqli_query($conn,$sql1);
	$row=mysqli_fetch_assoc($result);
	$filename=$row['photoname'];
	unlink("uploads/$filename");
	
	$sql="DELETE FROM members where id=$id";
	mysqli_query($conn, $sql);
	
	mysqli_close($conn);

header("Location: index.php?message=successfully-deleted");
?>