<!DOCTYPE html>
<?php
session_start();
?>
<?php 
if (isset($_POST["logout"])) {
  session_destroy();
  header('Location: login.php');
}
?>
 <?php 
$connection=mysqli_connect('localhost','root','','trekking');
if($connection){
  //echo "connected";
}
else{
  mysqli_connect_error();
}
unset($_SESSION["exists"]);

if(isset($_POST["submit"])){
$email='NULL';
$password='NULL';
$city='NULL';
$state='NULL';
$zip='NULL';
$gender='NULL';
$phno='NULL';
$aphno='NULL';
$height=0;
$age=0;
$weight=0;
$name='NULL';
$email=$_POST["email"];
$password=$_POST["password"];
$city=$_POST["city"];
$state=$_POST["state"];
$zip=$_POST["zip"];
$gender=$_POST["gender"];
$phno=$_POST["phno"];
$aphno=$_POST["aphno"];
$height=$_POST["height"];
$age=$_POST["age"];
$height=number_format($height);
$weight=$_POST["weight"];
$weight=number_format($weight);
$name=$_POST["uname"];
$hashpass = md5($password);
$does_exist="select * from tbl_users where email like '$email'";
$does_exist_test=mysqli_query($connection,$does_exist);
if(mysqli_num_rows($does_exist_test) > 0){
  $_SESSION["exists"]="User already exists";
}
else{
$query="insert into tbl_users(name,email,password,city,state,zip,age,weight,height,phno,aphno,gender)values('$name','$email','$hashpass','$city','$state','$zip',$age,$weight,$height,'$phno','$aphno','$gender')";
$result=mysqli_query($connection,$query);
if(!$result){
  die('No'.mysqli_error($connection));
}
else{
  header('Location: login.php');
}
}
}
?>
<html>
<head>
	<title>SIGNUP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="loginmain.css">
   <script type="text/javascript" src="loginmain.js"></script>
   <script type="text/javascript">
     function checkpass(){
    var pass1=document.getElementById("pass").value;
    console.log(pass1);
    if (pass1.length<7||pass1.length>20) {
    document.getElementById("alert6").innerHTML="Password should be greater than 7 and less than 20 characters";
  }
  else{
    document.getElementById("alert6").innerHTML="";
  }

  }
  function checkequal(){
    var pass1=document.getElementById("pass").value;
    var pass2=document.getElementById("verpass").value;
    console.log(pass1,pass2);
    if (pass1!==pass2) {
    document.getElementById("alert1").innerHTML="Both passwords do-not match";
  }
  else{
    document.getElementById("alert1").innerHTML="";
  }

  }
  function checkheight(){
    var height=document.getElementById("height").value;
    console.log(height);
    if(isNaN(height)){
    document.getElementById("alert2").innerHTML="Height should be a number";
  }
  else{
    document.getElementById("alert2").innerHTML="";
  }
  }
  function checkweight(){
    var weight=document.getElementById("weight").value;
    console.log(weight);
    if(isNaN(weight)){
    document.getElementById("alert2").innerHTML="weight should be a number";
  }
  else{
    document.getElementById("alert2").innerHTML="";
  }
  }
  function checkphoneno(){
    var phno=document.getElementById("phno").value;
    console.log(phno);
    if(isNaN(phno)||phno.length<10){
    document.getElementById("alert3").innerHTML="Check contact no.";
  }
  else{
    document.getElementById("alert3").innerHTML="";
  }
  }
  function checkaphno(){
    var aphno=document.getElementById("aphno").value;
    console.log(aphno);
    if(isNaN(aphno)||aphno.length<10){
    document.getElementById("alert3").innerHTML="Check contact no.";
  }
  else{
    document.getElementById("alert3").innerHTML="";
  }
  }
   </script>
</head>
<body>
	 <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black">
  <a class="navbar-brand" href="homepage.php" id="company">TrekKing</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="homepage.php">About Us <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="featured_treks.php">Featured Treks</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search_page.php">Search</a>
      </li>
    </ul>
    <button type="button" class="btn btn-outline-primary but" style="margin-right: 10px" onclick="window.location.href='login.php'">LOGIN</button>
    <button type="button" class="btn btn-outline-primary but" style="margin-right: 10px" onclick="window.location.href='loginmain.php'">SIGNUP</button>
    <form class="form-inline my-2 my-lg-0" method="GET" action="trek_info.php">
      <input class="form-control mr-sm-2" name="trekname" type="search" placeholder="Search Treks" aria-label="Search" list="states" required>
      <datalist id="states">
        <?php 
          $treks_find="select distinct name from tbl_treks";
          $treks_find_result=mysqli_query($connection,$treks_find);
          while($row = mysqli_fetch_assoc($treks_find_result)){
        echo"<option value='".$row["name"]."'></option>";
      }
        ?>
      </datalist>
      <input name="searchtreks" class="btn btn-outline-primary my-2 my-sm-0" type="submit" value="SEARCH">
    </form>
  </div>
</nav>
<div class="back">
  <br>
  <h1 class="fs-title content" style="margin-left: 42%">SIGN-UP</h1>
  <div class="form1 content">
<div class="container">
<form class="box" onsubmit="return validate(this)" id="msform" method="POST">
  <div class="form-group">
    <label for="uname">Name</label>
    <input type="text" class="form-control" id="uname" placeholder="Enter Name" style="width: 900px;" name="uname" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" style="width: 900px;" name="email" required>
    
  </div>
  <div class="form-group">
    <label for="pass">Password</label>
    <input type="password" class="form-control" id="pass" placeholder="Password" style="width: 900px;" name="password" onfocusout="checkpass()" required>
    <span id="alert6"></span>
  </div>
  <div class="form-group">
    <label for="verpass">Verify Password</label>
    <input type="password" class="form-control" id="verpass" placeholder="Re-Enter Password" style="width: 900px;" name="verpass" onfocusout="checkequal()" required>
    <span id="alert1"></span>
    </div>
    <div class="form-row">
    <div class="form-group col-md-4">
      <label for="City">City</label>
      <input name="city" type="text" class="form-control" id="City" required>
    </div>
    <div class="form-group col-md-4">
      <label for="State">State</label>
      <select name="state" id="State" class="form-control" required>
        <option selected disabled>Choose...</option>
        <option  value="Andhra Pradesh">Andhra Pradesh</option>
 <option value="Arunachal Pradesh">Arunachal Pradesh</option>
 <option value="Assam">Assam</option>
 <option value="Bihar">Bihar</option>
 <option value="Chhattisgarh">Chhattisgarh</option>
 <option value="Goa">Goa</option>
 <option value="Gujarat">Gujarat</option>
 <option value="Haryana">Haryana</option>
 <option value="Himachal Pradesh">Himachal Pradesh</option>
 <option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="West Bengal">West Bengal</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="Zip">Zip</label>
      <input type="text" name="zip" class="form-control" id="Zip" style="width: 150px;" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
    <label for="age">Age</label>
    <input type="number" class="form-control" name="age" id="age" style="width: 200px;" required>
    </div>
    <div class="form-group col-md-4">
    <label for="gender">Gender</label><br><input type="radio" name="gender" id="Male" value="male" required>Male &nbsp&nbsp&nbsp<input type="radio" name="gender" id="Female" value="female" required>Female
    </div>
</div>
<br><span id="alert4"></span>
    <br>
    <div class="form-row">
      <div class="form-group col-md-3">
      <label for="height">Height</label>
      <input type="text" class="form-control" id="height" style="width: 200px;" name="height" placeholder="in cms" onfocusout="checkheight()" required></div>
      <div class="form-group col-md-3">
      <label for="weight">Weight</label>
      <input type="text" class="form-control" id="weight" style="width: 200px;" name="weight" placeholder="in kgs" onfocusout="checkweight()" required></div>
    </div>
     <span id="alert2"></span><br>
    <div class="form-row">
      <div class="form-group col-md-3">
      <label for="phno">Contact No.</label>
      <input type="text" class="form-control" id="phno" style="width: 220px;" name="phno" onfocusout="checkphoneno()" required></div>
      <div class="form-group col-md-3">
      <label for="weight">Alternate Contact No.</label>
      <input type="text" class="form-control" id="aphno" style="width: 220px;" name="aphno" onfocusout="checkaphno()" required></div>
    </div>
    <span id="alert3"></span><br>
    <input type="submit" class="btn btn-primary" style="margin-left: 40%;padding-left:10px;padding-right:10px;" name="submit" value="SIGN-UP">
  </div>
  <br><span><?php if(isset($_SESSION["exists"])){
    echo $_SESSION["exists"].'<a href="login.php">  Click Here to Log-In</a>';
    unset($_SESSION["exists"]);
  }  ?></span>
  <br>
</form>
</div>
</div>
</div>
</body>
</html>