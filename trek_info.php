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
$trekname=$_GET["trekname"];
?>
<?php 
$connection=mysqli_connect('localhost','root','','trekking');
if($connection){
 // echo "connected";
}
$find_treks="select distinct state,difficulty,height,no_of_days,description,price,pic1,pic2,pic3,pic4,pic5,start_point,contact_no from tbl_treks where name='$trekname'";
$result=mysqli_query($connection,$find_treks);
?>
<html lang="en">
<head>
  <title>Trek Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="trek_info.css">
  <script type="text/javascript">
    function openlogin(){
      window.location.href='login.php';
    }
    function opensignup(){
      window.location.href='loginmain.php';
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
      <!--
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Find Treks
        </a>
        
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">BEGINNER</a>
          <a class="dropdown-item" href="#">AMATEUR</a>
          <a class="dropdown-item" href="#">EXPERT</a>
        </div>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="search_page.php">Search</a>
      </li>
      <li class="nav-item">
        <?php 
        if (isset($_SESSION["name"])) {
          echo "<a class='nav-link' href='myprofile.php'>".$_SESSION["name"]."</a>";
        }
        else{
          echo "<a class='nav-link' href='login.php'>MY PROFILE</a>";
        }
         ?>
      </li>
    </ul>
    <?php
    if(isset($_SESSION["name"])){
      echo"
       <form method='POST'>
    <input type='submit' name='logout' value='LOGOUT' class='btn btn-outline-primary but' style='margin-right: 10px;color: white;border-color: white;'>
    </form>";
    
}else{
  echo"
  <button type='button' class='btn btn-outline-primary but' style='margin-right: 10px;border-color: white;color: white;' onclick='openlogin()'>LOGIN</button>
    <button type='button' class='btn btn-outline-primary but' style='margin-right: 10px;border-color: white;color: white;' onclick='opensignup()'>SIGNUP</button>";
}

    ?>
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
<br>
<?php
  $row = mysqli_fetch_assoc($result);
  if($row<1){
    echo "<h3 style='color:grey;'>No results found for ".$_GET["trekname"]."</h3>";
  }
  else{
  ?>
<div class="container" style="border: 2px solid black;padding: 10px;">
  <div style="margin-top: 10px; margin-bottom: 10px;">
  <h1 style="text-align: center;"><?php echo $_GET["trekname"]; ?></h3>
  </div>
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
     <li data-target="#demo" data-slide-to="4"></li>
  </ul>
  <div class="container info">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo $row['pic1']; ?>" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="<?php echo $row['pic2']; ?>" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="<?php echo $row['pic3']; ?>" width="1100" height="500">
    </div>
     <div class="carousel-item">
      <img src="<?php echo $row['pic4']; ?>" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="<?php echo $row['pic5']; ?>" width="1100" height="500">
    </div>
  </div>
  
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
</div>
<br><br>
<?php 
  $description=$row["description"];
  $description=nl2br($description);
 ?>
<p><?php
echo $description;
 ?></p>
 <strong>Maximum Altitude Reached: </strong><?php
echo $row["height"];
 ?><br>
 <strong>State: </strong><?php
echo $row["state"];
 ?><br>
 <strong>Difficulty: </strong><?php
echo $row["difficulty"];
 ?><br>
 <!-- <strong>Max Slots: </strong><?php
echo $row["max_intake"];
 ?><br> -->
 <strong>Number of Days: </strong><?php
echo $row["no_of_days"];
 ?><br>
 <strong>Price: </strong><?php
echo $row["price"];
 ?><br>
 <?php
$start_dates_query="select start_date from tbl_treks where name='$trekname'";
$dates=mysqli_query($connection,$start_dates_query);
 ?>
 <strong>Start Dates:<br> </strong><?php
while ($date = mysqli_fetch_assoc($dates)) {
  echo $date["start_date"]."<br>";
}
 ?>
 <strong>Starting Point: </strong><?php
echo $row["start_point"];
 ?><br>
 <strong>For queries contact: </strong><?php
echo $row["contact_no"];
 ?><br>
 <br>
 <form method="GET" action="checkout.php">
  <input type="hidden" name="trekpricebooking" value="<?php echo $row["price"]; ?>">
   <input type="hidden" name="treknamebooking" value="<?php echo $_GET["trekname"]; ?>">
 <input type="submit" name="gotocheckout" value="BOOK" class="btn btn-primary my-2 my-sm-0" style="margin: 45%">
</form>
</div>
<?php } ?>
</body>
</html>
