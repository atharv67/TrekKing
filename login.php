<!DOCTYPE html>
<?php session_start(); ?>
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
$_SESSION["loginerror"]="";
if(isset($_POST["submit"])){
$email=$_POST["email"];
$password=$_POST["password"];
$hashpassword=md5($password);
$validatequery="select * from tbl_users where email='$email'";
$is_present=mysqli_query($connection,$validatequery);
if(mysqli_num_rows($is_present) > 0){
  //echo "user found";
  while($row = mysqli_fetch_assoc($is_present)){
    if ($hashpassword==$row["password"]) {
      echo "password is right";
      $_SESSION["name"]=$row["name"];
      $_SESSION["email"]=$row["email"];
      $_SESSION["age"]=$row["age"];
      $_SESSION["height"]=$row["height"];
      $_SESSION["weight"]=$row["weight"];
      $_SESSION["city"]=$row["city"];
      $_SESSION["state"]=$row["state"];
      $_SESSION["zip"]=$row["zip"];
      $_SESSION["phno"]=$row["phno"];
      header('Location: myprofile.php');
    }
    else{
      $_SESSION["loginerror"]="Check Credentials again";
      echo $_SESSION["loginerror"];
    }
  }
}
else{
  $_SESSION["loginerror"]="User does not exist kindly SIGN-UP";
  echo $_SESSION["loginerror"];
}



}

?>

<html>
<head>
	<title>LOGIN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
    <style type="text/css">
      html { 
  background: url('loginimg.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
    </style>
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!-- <script type="text/javascript" src="login.js"></script> -->
  <!-- <script type="text/javascript">
    function time(){
      var timer=document.getElementById("otp_timer");
      var timesubmit= new Date();
      var t = setTimeout(timeremaining(timesubmit), 500);
    }
    function timeremaining(timesubmit){
      var timenow=new Date();
      var time

    }

  </script> -->
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
<!--
<div id="box" style="border:2px solid grey;padding-left: 10px;padding-top: 10px;">
	<h1 id="title">TrekKing</h1>
	<h2 style="color: green;text-align: center;font-size: 3em">LOG-IN</h2>
	<form action="homepage.html">
		 <div class="form-group">
		 <br>
		 
		<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" style="width:400px;">
		<br>
		
		 <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" style="width: 400px;">
		<br>
			<input type="submit" class="btn btn-primary">
		<br>
		
		</div>
	</form>
-->
<form class="box" style="box-shadow: 5px 10px 18px #888888;" method="POST">
          <h1>Log In to Start Exploring</h1>
  <input type="text" name="email" placeholder="E-mail">
  <input type="password" name="password" placeholder="Password">
  <input type="submit" name="submit" value="Login">
  <br>
  <span style="color: red"><?php echo $_SESSION["loginerror"] ?></span>
</form>
</body>
</html>