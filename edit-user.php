<!DOCTYPE html>
<html>
<head>
	<title>Edit User Page</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      margin: 15px 0;
      font-weight: 400;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 3px;
      }
      form {
      width: 100%;
      padding: 20px;
      background: #fff;
      box-shadow: 0 2px 5px #ccc; 
      }
      input, select, textarea {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      }
      select {
      width: 100%;
      padding: 7px 0;
      background: transparent;
      }
      textarea {
      width: calc(100% - 6px);
      }
      .item {
      position: relative;
      margin: 10px 0;
      }
      .item:hover p, .item:hover i {
      color: #095484;
      }
      input:hover, select:hover, textarea:hover, .preferred-metod label:hover input {
      box-shadow: 0 0 5px 0 #095484;
      }
      .preferred-metod label {
      display: block;
      margin: 5px 0;
      }
      .preferred-metod:hover input {
      box-shadow: none;
      }
      .preferred-metod-item input, .preferred-metod-item span {
      width: auto;
      vertical-align: middle;
      }
      .preferred-metod-item input {
      margin: 0 5px 0 0;
      }
      input[type="date"]::-webkit-inner-spin-button {
      display: none;
      }
      .item i, input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      font-size: 20px;
      color: #a9a9a9;
      }
      .item i {
      right: 1%;
      top: 30px;
      z-index: 1;
      }
      [type="date"]::-webkit-calendar-picker-indicator {
      right: 0;
      z-index: 2;
      opacity: 0;
      cursor: pointer;
      }
      .btn-block {
      margin-top: 20px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;      
      -webkit-border-radius: 5px; 
      -moz-border-radius: 5px; 
      border-radius: 5px; 
      background-color: #095484;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background-color: #0666a3;
      }
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .city-item input {
      width: calc(50% - 20px);
      }
      .city-item select {
      width: calc(50% - 8px);
      }
      }
    </style>
<script>
function validateForm() {
  var x = document.forms["editform"]["fname"].value;
  if (x == "") {
    alert("Please Fill in your First Name Properly!");
    return false;
  }
  var y = document.forms["editform"]["lname"].value;
  if (y == "") {
    alert("Please Fill in your Last Name Properly!");
    return false;
  }
  var z = document.forms["editform"]["email"].value;
  if(z==""){
    alert("Please Enter your email");
    return false;
  }
var xx = document.forms["editform"]["address1"].value;
  if (xx == "") {
    alert("Please Fill in your Address Properly!");
    return false;
  }

}
</script>
</head>
<body>
<div class="container" style="padding-top: 1%;">
  <a href="index.php" ><button class="btn btn-success">Go Back</button></a>
</div>

<div class="testbox">

<div class="testbox">
<?php
  include('config.php');
  $id = $_GET['id'];
  $sql="SELECT * FROM members Where id= $id ";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
?>
<form  method="POST" onsubmit="return validateForm()" action="edit.php?id=<?php echo $row["id"];?>" enctype="multipart/form-data" name="editform" 
   style="color:black;background-color: lightyellow;">

     <h1 style="text-align: center;">Edit User Page</h1>

<h5 style="color: red;">
<?php
  if(isset($_GET["message"]) && $_GET["message"]=='FileNotAllowed'){
    echo "File Not Uploaded! <br>";
    echo "Please Use .JPG, .JPEG, .PNG, .BMP, .GIF Format!!";
      unset($_GET['message']);  
  };
  ?>
</h5>
        <h5>Personal Information</h5>
	<div class="item">
		<p>Your Full Legal Name:</p>
		<input class="name-item" type="text" name="fname" value="<?php echo $row["firstname"]?>"  >
	</div>

<div class="item">
	<label for="lname">Last Name:</label><br>
	<input class="name-item" type="text" name="lname" value="<?php echo $row["lastname"]?>"  >
</div>

<div class="item">
	<label for="email">Email:</label><br>
	<input class="form-group" type="email" name="email" value="<?php echo $row["email"]?>"  >
</div>

<div class="item">
	<label for="address1">Address:</label><br>
	<textarea class="form-group" rows="5" cols="50" name="address1"  ><?php echo $row["address"]?></textarea>
</div>

<div class="item">
<label for="country">Country:</label>
<?php
$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
$count1= count($countries);
?>
<select id="country" name="country" class="form-control">
<?php 
 for($i=0;$i<$count1;$i++){
  ?>
<option value="<?php echo $countries[$i];?>" <?php if($row['country']=="$countries[$i]"){echo 'selected';}?>>
  <?php echo $countries[$i];?></option>
<?php
};?>
</select><br><br>
</div>

<div class="item preferred-metod">
  <p>Gender:</p>
  <div class="preferred-metod-item">
  <label><input type="radio" id="Male" name="gender" value="Male" <?php if($row['gender']=="Male"){echo 'checked';}?> ><span>Male</span></label>
  <label><input type="radio" id="Female" name="gender" value="Female" <?php if($row['gender']=="Female"){echo 'checked';}?> ><span>Female</span></label>
  </div>
</div>

<div class="item">
<br><label>Photo:</label>
<h5 style="color: red;">Please upload image of size < 2MB.<h5>
<h5 style="color: red;"> Allowed extionsions are jpg, jpeg, png, gif, bmp.</h5>
      <br><img src="uploads/<?php echo $row["photoname"]; ?>" width="150" height="150"/><br><br>
</div>

<div class="item">
  <input type="file" name="uploadedFile" /><br>
</div>

<div>
    <input type="submit" name="uploadBtn" value="Update" class="btn btn-warning"/>

</div>

</form>
</div>
<?php
	}
} 
mysqli_close($conn);
?>

</table>

</body>

</html>