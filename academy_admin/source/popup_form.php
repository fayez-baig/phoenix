<?php 

require_once 'config.php';

if (isset($_POST['submit']) && isset($_FILES['uploads'])) {


	$pop_title       = $_POST['pop_title'];
	$image_types       = ['image/jpg', 'image/png','image/jpeg'];
	$pop_dir       = '../../images/popup/';

	$image_size_limit = 500000; // 5e+6 Bytes

	//validation
	$validation = "";
	$multiple = false;

	if(count($_FILES['uploads']['size']) > 20)
	{
		$validation .= "Only 20 or less no. of files are allowd.<br>";
	}


	if (count($_FILES['uploads']['size']) > 1) {
		$multiple = true;
	}


	

	if(strlen($pop_title) > 50)
	{
		$validation .= "Image title lenght should be less than or equal to 50.<br>";
	}

	

	//image size validation
	foreach ($_FILES['uploads']['size'] as $size) {
		if($size > $image_size_limit)
		{
			$validation .= "File size should be less than or equal to 5MB!<br>";
			echo $validation;
			exit();
		}
	}

	//image type validation
	foreach ($_FILES['uploads']['type'] as $type) {
		if(!in_array($type, $image_types))
		{
			$validation .= "Only \"jpeg\" and \"png\" images are allowd!<br>";
			echo $validation;
			exit();
		}
	}

	//Weather image has any error
	foreach ($_FILES['uploads']['error'] as $err) {
		if($err)
		{
			$validation .= "Sorry 1 or more files has an error!<br>";
			echo $validation;
			exit();
		}
	}

	if(!empty($validation))
	{
		echo $validation;
		exit();
	}
	//end of validation

	try
	{
		//PDO connection
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

		//set PDO error mode exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//SQL query
		$sql = "INSERT INTO popup( pop_title, pop_image, created, updated) 
									 VALUES ( :pop_title, :pop_image, now(), now())";

		//Prepare query
		$stmt = $conn->prepare($sql);

		$level = 0;
		foreach ($_FILES['uploads']['tmp_name'] as $image_tmp) {

			$image_file  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $pop_dir . $image_file;
			$created     = time();
			$updated     = $created;

			if(move_uploaded_file($image_tmp, $destination))
			{
				//binding parameters
				$stmt->bindParam(':pop_title', $pop_title);
				$stmt->bindParam(':pop_image', $image_file);
				// $stmt->bindParam(':created', $created);
				// $stmt->bindParam(':updated', $updated);

				//Query execution
				$stmt->execute();
			}
			else
			{
				break;
			}

			$level++;
		}

		echo "Image(s) added Successfully!";

	}
	catch(PDOEXCEPTION $ex)
	{
		echo "Connection failed : " . $ex->getMessage();
	}

}
else
{
	echo "Please select an image file.<br>";
}


 ?>