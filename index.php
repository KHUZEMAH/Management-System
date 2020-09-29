<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script> 
<meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<script>
  $(document).ready(function() {
    $('#employee').DataTable( {
    } );
} );
</script>

<style>
    h1, h3{
    text-align: center;
    }
</style>
</head>
<body>

<div class="container" style="background-color: black;" id="form-text">
    <h1 style="color:white;">Welcome to User Database</h1>
</div>
<div class="container">

<h3 style="background-color: lightblue;">Employees Database</h3>
<div class="container" style="padding: 3%; text-align: center; color: green;font-size: medium;">
<?php
  if(isset($_GET["message"]) && $_GET["message"]=='success'){
    echo "Form submitted successfully! <br>";
    echo "User is Added!!";
      unset($_GET['message']);  
  };
  if(isset($_GET["message"]) && $_GET["message"]=='successfully-deleted'){
    echo  "User deleted successfully!";
      unset($_GET['message']);  
  };
  if(isset($_GET["message"]) && $_GET["message"]=='successfully-updated'){
    echo "User data updated successfully!";
      unset($_GET['message']);  
  };
   if(isset($_GET["message"]) && $_GET["message"]=='Multiple'){
    echo "Multiple User data Deleted!";
      unset($_GET['message']);  
  };
?>

</div>
<div class="container" style="text-align: center;color:red;font-size: large;">
<?php 
  include('config.php');

$sql="SELECT * FROM members ORDER BY id desc";

$result = mysqli_query($conn, $sql);
$x= mysqli_num_rows($result);
  if ($x < 1){
    echo "No Records Found!<br>";
    echo "Please Add Users First!";
  }

  else{
?>
</div>
<table class="table table-striped table-bordered" id="employee" style="width:100%">
    <thead>
    <tr>
      <td><input type="checkbox" name="select-all" id="select-all" >
    </td>
      <td>ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Email</td>
        <td>Address</td>
        <td>Country</td>
        <td>Gender</td>
        <td>Photo</td>
        <td>Options</td>
  </tr>
</thead>

<script >
$('#select-all').click(function(event) {   
    if(this.checked) {

        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});

</script>

<?php
  if ($x > 0) {
    while($row = mysqli_fetch_assoc($result)) {
  ?>
<tbody>
    <tr>
      <td><input type="checkbox" class="employee" name="users" value="<?php echo $row["id"];?>">
      </td>
      <td><?php echo $row["id"]; ?></td>
      <td><?php echo $row["firstname"]; ?></td>
      <td><?php echo $row["lastname"]; ?></td>
      <td><?php echo $row["email"]; ?></td>
      <td><?php echo $row["address"]; ?></td>
      <td><?php echo $row["country"]; ?></td>
      <td><?php echo $row["gender"]; ?></td>
      <td><img src="uploads/<?php echo $row["photoname"]; ?>" width="50" height="50"/></td>
      <td><a href="edit-user.php?id=<?php echo $row["id"];?>" ><button class="btn btn-info">EDIT</button></a>
        <button onclick="mydelete(<?php echo $row['id'];?>)" class="btn btn-danger">Delete</button>
        
    </tr>
</tbody>

<?php
    }
  }
?>
<script>
  function mydelete(id){
 var r = confirm("Are You Sure You Want to Delete the Users");
       if(r==true){
        window.location.href = "delete-user.php?id="+id;
      }
      else{
        return false;
      }
    }
</script>
</table>
<div class="container">
  
<script>
   function updateTextArea() {
        var allVals = $('input.employee:checked').map( 
        function() {return this.value;}).get().join();
        $('#txtValue').val(allVals)
        }
        $(function () {
        var x =$('#employee input').click(updateTextArea);
        updateTextArea();
    });
  function mydelFunction(){
       var r = confirm("Are You Sure You Want to Delete Multiple Users");
       if(r==true){
        document.getElementById("delmany1").submit();
      }
      else{
        return false;
      }
}
  </script>


<form method="POST" action="delmany.php" id="delmany1">
    <input type="text" name="txtValue" id="txtValue"  name="users" hidden="" /><br>
   <a><input type="button" name="delmany" id="delmany" value="Delete Multiple Users" class="btn btn-danger" onclick="mydelFunction()" /></a>

</form>
</div>
<?php
}
?>
<div class="container">
<br><a href="add-user.php" ><button class="btn btn-success">Add User</button></a>
</div>


<?php
  mysqli_close($conn);
?>

</div>
</body>
</html>