<!DOCTYPE html>
<?php session_start(); 
$connection=mysqli_connect('localhost','root','','trekking');
?>
<?php 
if (isset($_POST["logout"])) {
  session_destroy();
  header('Location: login.php');
}
?>
<?php if (!isset($_SESSION["name"])) {
  header('location:login.php');
} ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="featured_treks.css">
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  
</head>
</head>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
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
      <li class="nav-item active">
        <a class="nav-link" href="#"><?php echo $_SESSION["name"]; ?></a>
      </li>
    </ul>
    <form method="POST">
    <input type="submit" name="logout" value="LOGOUT" class="btn btn-outline-primary but" style="margin-right: 10px;color: white;border-color: white;">
    </form><!--
    <button type="button" class="btn btn-outline-primary but" style="margin-right: 10px;color: white;border-color: white;" onclick="window.location.href='loginmain.php'">SIGNUP</button>-->
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
<br>
	<div class="border" style=" box-shadow: 5px 10px 18px #888888;width: 90%">
    <br>
    <h1 align="Center"><?php echo $_SESSION["name"]; ?></h1>
	<div class="container">
	<br>
	<h4 align="Center"><?php echo $_SESSION["email"]; ?></h4><br>
    <h4 align="Center"><?php echo $_SESSION["phno"]; ?></h4><br>
  <div style="text-align: center;">CITY : <?php echo $_SESSION["city"]; ?> &nbsp &nbspSTATE: <?php echo $_SESSION["state"]; ?> &nbsp &nbsp ZIP: <?php echo $_SESSION["zip"]; ?>
  </div>
	<br>
  <div style="text-align: center;">HEIGHT : <?php echo $_SESSION["height"]; ?> &nbsp &nbspWeight: <?php echo $_SESSION["weight"]; ?> 
  </div>
  <br>
 <?php
$my_treks="select distinct t.name,t.state,t.difficulty,t.height,t.max_intake,t.no_of_days,t.description,t.price,t.pic1,t.start_date from tbl_treks t ,tbl_trektaken tk where t.trekid=tk.trek_id and email='".$_SESSION["email"]."'";
$result=mysqli_query($connection,$my_treks);
 ?>
</div>
</div>
<br>
<h3 align="Center">Your Treks:</h3>
 <div style="margin-top: 30px;">
</div>
<?php 
if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_assoc($result)){
  $name=$row["name"];
  $state=$row["state"];
  $difficulty=$row["difficulty"];
  $height=$row["height"];
  $max_intake=$row["max_intake"];
  $no_of_days=$row["no_of_days"];
  $description=$row["description"];
  $date=$row["start_date"];
  $description=substr($description,0,500);
  $price=$row["price"];
  $pic1=$row["pic1"];
?>
<div class="container-fluid">
  <div class="row item itemcontainer">
    <div class="col-lg-3">
      <img style="height: 200px;width: 350px;margin-top: 12px;" src="<?php echo $pic1; ?>"><br>
      <h3 style="margin-top: 20px;text-align: center;"><?php echo $name; ?></h3>
      
    </div>
    <div class="col-lg-9">
      <!-- <h5 style="text-align: center;">Trek Name</h5> -->
       <div style="margin-top: 15px;">
        <strong>
          Max Altitude</strong>: <?php echo $height; ?></strong><br>
          <strong>Difficulty: </strong><?php echo $difficulty; ?><br>
          <strong>State:</strong><?php echo $state; ?><br>
          <strong>Number of Days: </strong><?php echo $no_of_days; ?><br>
          <strong>Price: </strong><?php echo $price; ?><br>
          <strong>Date: </strong><?php echo $date; ?><br>
        </div> 
      <p style="margin-top: 15px;"><?php echo $description; ?></p>
    </div>
  </div>
  </a>
</div>
<br>
<?php }}
else{
echo "<h2 align='center'>You haven't taken any treks yet</h2>";
}
 ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript" src="ft.js">
</script>
</div>
</body>
</html>