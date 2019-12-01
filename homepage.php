<?php session_start();
$connection=mysqli_connect('localhost','root','','trekking');
?>
<?php 
if (isset($_POST["logout"])) {
  session_destroy();
  header('Location: homepage.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>HomePage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

	<link rel="stylesheet" type="text/css" href="homepage.css">
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
  <a class="navbar-brand" href="#" id="company">TrekKing</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">About Us <span class="sr-only">(current)</span></a>
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

<div class="jumbotron">
  <?php 
function curl($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}


  if (isset($_SESSION["name"])) {
     $query="select distinct * from tbl_trektaken tk,tbl_treks t WHERE t.trekid=tk.trek_id and tk.email='".$_SESSION["email"]."' and t.start_date=(select MIN(t.start_date) from tbl_trektaken tk,tbl_treks t WHERE t.trekid=tk.trek_id and tk.email='".$_SESSION["email"]."')";
     $result=mysqli_query($connection,$query);
     if(!$result){
      echo mysqli_error($connection);
     }
     else{
      if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $url="https://api.openweathermap.org/data/2.5/weather?q=".$row['start_point']."&appid=4672f314fa6226637966f9da4802277a&units=metric";
        $weather_content=json_decode(curl($url),true);
        $available=$weather_content["cod"];
        if($available==200){
        $description=$weather_content["weather"][0]["description"];
        $temphigh=$weather_content["main"]["temp_min"];
        $templow=$weather_content["main"]["temp_max"];
}
    echo "<h1 class='display-4'>Trek Reminders:</h1>
  <div class='content'>
    <h3>".$row["name"]."</h3>
    <p>Height:".$row["height"]."</p>
    <p>State:".$row["state"]."</p>
    <p>Difficulty:".$row["difficulty"]."</p>
    <p>Start Date:".$row["start_date"]."</p>";
    if($available==200){
    echo "<p>Weather:".$description." <img
                src='http://openweathermap.org/img/w/".$weather_content["weather"][0]["icon"].".png'/>"."<br> Temp High:".$temphigh."<br> Temp Low:".$templow;
              }
    else{
      echo "<p>Weather:No information available";
    }
  echo"</div>";
  }
}
else{
  echo "<h1 class='display-4'>Trek Reminders:</h1>
  <div class='content'>
    <h3>You have no upcoming treks</h3>"; 
}
}
}
else{
  echo "<h1 class='display-4'>Trek Reminders:</h1>
  <div class='content'>
    <h3>PLEASE LOGIN TO SEE TREK REMINDERS</h3>"; 
}
?>
  <hr class="my-4">
  <h1 class="display-4">What is Trekking</h1>
  <div class="cont">
  <div class="content">
  <p class="lead" id="p1">Being a soft-adventure sport, almost anyone in reasonable physical condition can go trekking. To get initiated into trekking begin with day hikes, returning to your starting point in the evening. Move on to a multi-day trek which is relatively easy, in order to get to know your ability and aptitude. You can venture into the mountains with an experienced trekker, join an adventure club, or go with a reputed adventure travel company. It is not a good idea to venture out into the mountains alone – unless you happen to be a distant relative of the mythical Himalayan yeti (or an aspiring Reinhold Messner, the first person in the world to have climbed all fourteen 8000m peaks, including the first oxygen-less ascent and later the first solo ascent of Everest).
 <!-- <img src="home.jpg" id="image">-->
A basic knowledge of camp craft, map reading and first aid is essential before you go trekking. It’s a good idea to do an adventure course from one of the mountaineering/ adventure institutes in India. A basic course in mountaineering and a first-aid course are recommended if you decide to take it up more seriously and trek to remote/high-altitude areas. Get as much information about the trekking area as possible – the people, their culture, the geography, terrain, medical/rescue facilities and weather conditions – before you go. Trekking in India started when the land was inhabited in prehistoric times. There are perhaps as many trekking routes in India as there are Indians. It was in the 1970’s and 1980’s that trekking started gaining in popularity as a recreational/adventure sport. A number of religious sites and shrines across the country, especially in Jammu and Kashmir, and in the Garhwal region of Uttarakhand – such as Badrinath, Amarnath, Gangotri, Hemkund, Joshimath, Kedarnath, Vaishno Devi and Yamunotri – entail trekking for a couple of days in the mountains. Trekking in India has grown in leaps and bounds and the current trekking scenario is very promising, with thousands of Indians and foreigners hitting trekking trails each year.
What India can boast of is some of the most stunning trekking routes in the world – many of the mountain passes in the Ladakh and Zanskar Himalayas are above 5000m. But there are plenty of gentler and smaller trails, at different altitudes, both in the mountains and in the forests. If you’re looking for less arduous hikes, you’ll find plenty in in the Western Ghats and the Nilgiri Hills of south India (Munnar and Wayanad in Kerala, Coorg in Karnataka, and around Ooty in Tamil Nadu).<br><br></p>
</div>
</div>
  <hr class="my-4">
  <h1 class="display-4">WHY US</h1>
  <div class="cont">
  <div class="content">
  <p class="lead" id="p2">
    We at Trekking, try to make your experience of choosing a trek the best experience you would have. Right from helping you choose where you must go to what you must be careful about on the trek is guided by trekking experts. We group you with people whom you would enjoy your time with using a complex  algorithm with sucessful results over time. We also provide forecast of the weather for a particular trek and date to help you choose the dates you should take the trek on.<br>
    <br>
    Treks are differentiated based on difficulty. Trekkers can choose the treks depend on how comfortable they are witha particular difficulty. Each user also has points for completing treks that help you level up and get amazing discounts on next treks.
    <br>
    <br>
    Our site is also the best place to write trekking blogs and read present blogs. These blogs help you to select the best trek. Some special treks also generate a referral code that allows you to avail exciting discounts on trekking equipments from our partners.<br><br><br><br><br><br><br><br>
  </p>
</div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>