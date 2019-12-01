<!DOCTYPE html>
<?php session_start(); ?>
<?php 
if (isset($_POST["logout"])) {
  session_destroy();
  header('Location: featured_treks.php');
}
?>
<?php 
$connection=mysqli_connect('localhost','root','','trekking');
if($connection){
 // echo "connected";
}
$find_treks="select distinct name,state,difficulty,height,max_intake,no_of_days,description,price,pic1 from tbl_treks where featured_treks=1";
$result=mysqli_query($connection,$find_treks);
?>
<!DOCTYPE html>
<html>
<head>
	<title>FEATURED TREKS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

	<link rel="stylesheet" type="text/css" href="featured_treks.css">
	<script type="text/javascript">
		function openlogin(){
			window.location.href='login.php';
		}
		function opensignup(){
			window.location.href='loginmain.php';
		}
	</script>
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  
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
      <li class="nav-item  active">
        <a class="nav-link" href="#">Featured Treks</a>
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
<!-- <div style="padding-top: 40px;">
  
   <img style="padding-left: 10px; padding-top: 50px;" src="signupimg.jpg" min-height="100px" width="300px">
  
   <div style="padding-left: 340px;border:3px solid grey;padding-top: 40px;">
   <h5>YJHD Trek</h5>
   <strong>
   Height</strong>:123456km</strong><br>
   <strong>Difficulty:</strong>Expert<br>
   <strong>State:</strong>Manali<br>
   <strong>Date:</strong>22/07/1999<br>
   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
   tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
   quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
   consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
   cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
   proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
   tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
   quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
   consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
   cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
   proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
   </div>
 </div>
</div> -->
<div style="margin-top: 50px;">
</div>
<?php 
while($row = mysqli_fetch_assoc($result)){
	$name=$row["name"];
	$state=$row["state"];
	$difficulty=$row["difficulty"];
	$height=$row["height"];
	$max_intake=$row["max_intake"];
	$no_of_days=$row["no_of_days"];
	$description=$row["description"];
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
	   		</div> 
			<p style="margin-top: 15px;"><?php echo $description; ?></p>
			<form action="trek_info.php" method="GET"><input type="hidden" name="trekname" value="<?php echo $row["name"] ?>"><input type="submit" name="knowmore" value="KNOW MORE" class="btn btn-primary" id="knowmore" style="margin-left: 980px;margin-bottom: 5px;"></form>
		</div>
	</div>
	</a>
</div>
<br>
<?php } ?>
<!--
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript" src="ft.js">
  	
  </script>
</body>
</html>