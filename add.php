<?php
include ('config.php');
$uploadOk = 1;
if (isset($_POST['adduser']) && $_POST['adduser'] == 'Add User')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {   
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
 
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg','bmp');
    if (in_array($fileExtension, $allowedfileExtensions))
    {
       $uploadFileDir = './uploads/';
      $dest_path = $uploadFileDir . $newFileName;
      move_uploaded_file($fileTmpPath, $dest_path);
    }
      else{
        echo "File Type Not Allowed";
        $uploadOk = 0;
    }    
if($uploadOk==0){
header("Location: http://localhost/users/add-user.php?message1=unsuccessfull");  
}
   
else{
  
$sql = "INSERT INTO members (firstname,lastname,email,address,country,gender,photoname) VALUES 
('$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[address1]', '$_POST[country]','$_POST[gender]','$newFileName')";


if (mysqli_query($conn, $sql)) {
 echo "New record created successfully";
} 
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
header("Location: http://localhost/users/index.php?message=success");
}
}


}
mysqli_close($conn);

?>