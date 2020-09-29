<?php
include ('config.php');
$uploadOk = 1;
$id = $_GET['id'];
$sql1="SELECT * FROM members where id=$id";
$result = mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($result);
$filename1=$row['photoname'];

if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Update')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameC = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameC));

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg', 'bmp');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      $uploadFileDir = './uploads/';
      $dest_path = $uploadFileDir . $newFileName;
      move_uploaded_file($fileTmpPath, $dest_path);
      unlink("uploads/$filename1");
      $sql = "UPDATE members SET firstname='$_POST[fname]',lastname='$_POST[lname]',
          email='$_POST[email]',address ='$_POST[address1]',country='$_POST[country]',gender='$_POST[gender]',photoname ='$newFileName' WHERE id=$id";
      mysqli_query($conn, $sql);
    }

    else{
        $uploadOk = 0;
        }
}
else{
  $sql = "UPDATE members SET firstname='$_POST[fname]',lastname='$_POST[lname]',
          email='$_POST[email]',address ='$_POST[address1]',country='$_POST[country]',gender='$_POST[gender]' WHERE id=$id";

  mysqli_query($conn, $sql);    
}
  if($uploadOk==0){
  header("Location: http://localhost/users/edit-user.php?id=$id&message=FileNotAllowed");
  }
  else{
  header("Location: http://localhost/users/index.php?message=successfully-updated");
  }
}
mysqli_close($conn);
?>