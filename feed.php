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
			
				<div id="browsePic">
					<div id="displayPic">
						<!-- assign avatar -->
						<img id="avatar"  alt="avatar">
					</div>
					<form action="js/uploadPic.php" method="post" id="formId" enctype="multipart/form-data">
						<input type="file" id="fileField" name="fileToUpload" value="fileToUpload" placeholder="" class="hidden">
					</form>
				</div>
				Hello <?php echo "<span id='nameUser'>".$username."</span>" ?>, Welcome back!
			</div>
  			<div class="item2"> <a href="js/logout.php"> Logout</a> </div>
  			<div class="item3">
  				<div id="posting">
  					<textarea name="msg" id="textmsg" value="" placeholder="" rows="4" cols="50"></textarea>
					<br/>
  					<button id="postbutton">Post</button>
  				</div>
  				<hr>
  				<div id="feed-container">
  					
  				</div>	
  			</div>  
		</div>
	</body>
	<script>
		let myUser = [
			"keroro",
			"giroro",
			"tamama",
			"kururu",
			"dororo",
		];
		var result = [];
		let idx = 0 , numberUser;
		let getUser = document.getElementById('nameUser').textContent;
			 for(let index = 0; index<myUser.length; index++){
				if(myUser[index] === getUser){
					idx = index;
			}
		 }
		var xhr = new XMLHttpRequest();	
		xhr.open("GET", "js/userDB.json");
		xhr.onload = function () {
			 
				jsonParse = JSON.parse(xhr.responseText);
				 result = Object.keys(jsonParse).map(function(key) {
					 return [jsonParse[key]];

					});
					console.log(result[idx][0].img.name);
					document.getElementById("avatar").src ="./img/"+result[idx][0].img.name;
			}	
			xhr.onerror = function () { 
			}
			xhr.send();

	</script>

</html>

