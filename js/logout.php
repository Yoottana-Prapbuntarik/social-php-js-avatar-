<?php
	session_start();
	//add code here
	session_destroy();
	header('Location:../index.html');
	exit;
	// ทำลาย session และ redirect ไปที่ index.html
?>