<?php
    session_start();
    $target_dir = "../img/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if(file_exists($target_file)){
		echo "Soory, file already exitsts. ";
		$uploadOk = 0;
	}

	// Check file size
	if($_FILES["fileToUpload"]["size"] > 500000){
		echo "Soory, Your file is too large.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	} else {
		if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
            $jsonString = file_get_contents('./userDB.json');
            $data = json_decode($jsonString, true);
            foreach ($data as $key => $entry) {
                if ($entry['username'] == $_SESSION['username']) {
                    $data[$key]['img']= $_FILES["fileToUpload"];
                    file_put_contents('./userDB.json', json_encode($data));
                    header('Location:http://localhost/assignment11/social-php-js/feed.php');
                    exit;
                }
            }
            
        }else{
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>