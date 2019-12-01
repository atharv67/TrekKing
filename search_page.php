<?php session_start();
$connection=mysqli_connect('localhost','root','','trekking');
?>
<?php 
if (isset($_POST["logout"])) {
  session_destroy();
  header('Location: search_page.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>SEARCH</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

	<link rel="stylesheet" type="text/css" href="search_page.css">
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
      <li class="nav-item active">
        <a class="nav-link" href="#">Search</a>
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
<div>
  <form class="box" method="GET" id="search_form" style="margin-top: 80px;" action="treks.php">
  <h1>FILTER TO THE TREKS YOU LOVE</h1>
   <select form="search_form" name="month">
    <option value="ok" disabled selected>Select Month</option>
  <option value="1">January</option>
  <option value="2">Februrary</option>
  <option value="3">March</option>
  <option value="4">April</option>
  <option value="5">May</option>
  <option value="6">June</option>
  <option value="7">July</option>
  <option value="8">August</option>
  <option value="9">Spetember</option>
  <option value="10">October</option>
  <option value="11">November</option>
  <option value="12">December</option>
  </select>
  <select form="search_form" name="difficulty">
    <option value="ok" disabled selected>Select Difficulty</option>
  <option value="Easy">Easy</option>
  <option value="Moderate">Moderate</option>
  <option value="Difficult">Difficult</option>
  </select>
   <select form="search_form" name="state">
    <option value="ok" disabled selected>Select State</option>
    <?php 
          $treks_search="select distinct state from tbl_treks";
          $treks_search_result=mysqli_query($connection,$treks_search);
          while($row = mysqli_fetch_assoc($treks_search_result)){
    echo "<option value='".$row['state']."' style='text-color: white'>".$row['state']."</option>";
     } ?>
  </select>
  <input type="submit" name="search" value="SEARCH">
  <br>
</form>
</div>
</body>
</html>