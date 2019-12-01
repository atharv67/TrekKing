<!DOCTYPE html>
<?php
session_start();
set_time_limit(0);
$connection=mysqli_connect('localhost','root','','trekking');
?>
<?php
if(!isset($_SESSION["name"])){
  header('Location: login.php');
}
$_SESSION["treknamebooking"]=$_GET["treknamebooking"];
$_SESSION["trekpricebooking"]=$_GET["trekpricebooking"];
$enabledays=array();
$getdates="select start_date from tbl_treks where name='".$_SESSION['treknamebooking']."' and max_intake>0";
//echo $getdates;
$result=mysqli_query($connection,$getdates);
if (!$result) {
  echo mysqli_error($connection);
}
if(mysqli_num_rows($result) > 0){
  //echo "user found";
  while($row = mysqli_fetch_assoc($result)){
    array_push($enabledays,$row["start_date"]);
   }
  // print_r($enabledays);
 }
    else{
      $nodates="Trek is not available for booking";
      echo $nodates;
    }

?>
<?php
if (isset($_POST["checkout"])) {
  if(in_array($_POST["trekdate"],$enabledays)){
  $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$promo = "";
for ($i = 0; $i < 10; $i++) {
    $promo .= $chars[mt_rand(0, strlen($chars)-1)];
}
  // echo $_POST["trekdate"];]
  $find_trek_id="select trekid,contact_no from tbl_treks where name='".$_SESSION['treknamebooking']."' and start_date='".$_POST["trekdate"]."'";
  $result=mysqli_query($connection,$find_trek_id);
if (!$result) {
  echo mysqli_error($connection);
}
 while($row = mysqli_fetch_assoc($result)){
  $emailbook=$_SESSION["email"];
  $trek_id=$row["trekid"];
  $contact_no=$row["contact_no"];
    $insert_to_trekstaken="insert into tbl_trektaken(email,trek_id)values('$emailbook',$trek_id)";
    //echo $insert_to_trekstaken;
    $inserted=mysqli_query($connection,$insert_to_trekstaken);
    if (!$inserted) {
  echo mysqli_error($connection);
}
$update_maxintake="update tbl_treks set max_intake=max_intake-1 where trekid=$trek_id";
//echo $update_maxintake;
$update=mysqli_query($connection,$update_maxintake);
if (!$update) {
  echo mysqli_error($connection);
}
$msg = "Hi, ".$_SESSION["name"]." \nYour ".$_SESSION['treknamebooking']." trek has been successfully booked. Thank you for choosing us. Use promo code ".$promo." to gain 20% discount on your next Amazon purchase. Visit www.amazon.com for further details.Kindly contact on:".$contact_no." for further details and collaborating your travel if necessary.\n Start Date of trek:".$_POST["trekdate"]."\n Keep trekking. Cheers.";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($emailbook,"Trek successfully booked",$msg);
$confirmed="Your booking is confirmed, detailed trek details will be sent to your registered email";
   }
 }
 else{
  $confirmed="You have entered a date that is not available, kindly recheck";
 }

}
?>
<html>
<head>
	<title>Checkout</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="checkout.css">
  <style type="text/css">
      html { 
  background: url('loginimg.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
    </style>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

      <!-- Javascript -->
      <script>
        jQuery(function(){

    var enableDays = <?php echo json_encode($enabledays); ?>;

    function enableAllTheseDays(date) {
        var sdate = $.datepicker.formatDate( 'yy-mm-dd', date)
        if($.inArray(sdate, enableDays) != -1) {
            return [true];
        }
        return [false];
    }

    $('#datepicker').datepicker({dateFormat: 'yy-mm-dd', beforeShowDay: enableAllTheseDays});
})
        // var enabledays=<?php echo json_encode($enabledays); ?>;
         // $(function() 
         // });

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
      <li class="nav-item active">
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
<form class="box" style="box-shadow: 5px 10px 18px #888888;margin-top: 5%" method="POST">
          <h1><span style="font-family: Arial; color: white">ONE STEP AWAY FROM YOUR ADVENTURE</span></h1>
  <div class="form-group">
    TREK NAME:
    <input type="text" class="form-control" id="trekname" style="width: 300px;" name="trekname" value="<?php echo $_SESSION["treknamebooking"] ?>" disabled>
  </div>
   <div class="form-group">
    <!-- <label for="trekprice">Price</label> -->
   PRICE: <input type="text" class="form-control" id="trekprice" style="width: 300px;" name="trekprice" value="<?php echo $_SESSION["trekpricebooking"] ?>" disabled>
  </div>
   <div class="form-group">
    <label for="trekdate">Choose Dates</label>
    <input type="text" class="form-control" id="datepicker" style="width: 300px;" name="trekdate" style="text-align: center;" required>
  </div>
  

<input type="submit" class="btn btn-primary" style="margin-left: 37%;padding-left:10px;padding-right:10px;" name="checkout" value="CHECKOUT"><br>
<span style="color: white;"><?php if(isset($confirmed)){echo $confirmed;} ?></span>
 </form>
   <!-- <form> <input type="text" name="otp" id="enterotp" placeholder="Enter OTP" style="display: none;"></form> -->
 
  <!-- <br> -->
</form>
</body>
</html>