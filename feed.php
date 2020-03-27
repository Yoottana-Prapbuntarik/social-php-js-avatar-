<?php
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
	$username = $_SESSION["username"];
}else{
	header('Location:./index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link type="text/css" rel="stylesheet" href="css/stylefeed.css">
		<script type="text/javascript" src="js/feed.js"></script>
	</head>
	<body>
		<div class="grid-container">
			<div class="item1">
				Hello <?php echo "<span id='nameUser'>".$username."</span>" ?>, Welcome back!
			</div>
  			<div class="item2"> <a href="js/logout.php"> Logout</a> </div>
  			<div class="item3">
  				<div id="posting">
  					<textarea name="msg" id="textmsg" value="" placeholder="" rows="4" cols="50"></textarea>
					<br>
  					<button id="postbutton">Post</button>
  				</div>
  				<hr>
  				<div id="feed-container">
  					
  				</div>	
  			</div>  
		</div>
	
	</body>
</html>

