<?php
	session_start();
	$myfile = fopen("userDB.json","r");
	$jsonfile = fread($myfile,filesize("userDB.json"));  
	$associative = json_decode($jsonfile, true);
	$username = $_GET["username"];
	$password = $_GET["password"]; 
	
	if(isset($username) && isset($password)){
		foreach($associative as $index => $data){
			if($username == $data["username"] && $password == $data["password"]){
				$_SESSION["username"] = $username;
				$_SESSION["password"] = $password;
				header('Location:../feed.php');
				exit;
			}
			else{
				header('Location:../index.html?error=1');
			}
		}
	}

	//complete this file
	// ทำได้โดยเริ่มจากอ่านไฟล์ userDB.json วน  
	// foreach loop ถ้าตรงทั้ง password และ 
	// username ให้ redirect ไปที่ feed.php 
	// แต่ถ้าไม่ตรงให้ กลับไปที่ index.html?error=1
?>