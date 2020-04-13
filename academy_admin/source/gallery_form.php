<?php 

require_once 'config.php';

if (isset($_POST['submit']) && isset($_FILES['uploads'])) {


	$category          = $_POST['category'];
	$image_title       = $_POST['image_title'];
	$image_description = $_POST['image_description'];
	$image_types       = ['image/jpeg', 'image/png'];
	$gallary_dir       = '../images/gallery/';

	$image_size_limit = 5000000; // 5e+6 Bytes

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


	if(empty($category))
	{
		$validation .= "Please select a Category.<br>";
	}

	if(strlen($image_title) > 50)
	{
		$validation .= "Image title lenght should be less than or equal to 50.<br>";
	}

	if(strlen($image_description) > 255 )
	{
		$validation .= "Image Description lenght should be less than or equal to 255.<br>";
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
		$sql = "INSERT INTO gallery(category, image_title, image_description, image_file, created, updated) 
									 VALUES (:category, :image_title, :image_description, :image_file, :created, :updated)";

		//Prepare query
		$stmt = $conn->prepare($sql);

		$level = 0;
		foreach ($_FILES['uploads']['tmp_name'] as $image_tmp) {

			$image_file  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $gallary_dir . $image_file;
			$created     = time();
			$updated     = $created;

			if(move_uploaded_file($image_tmp, $destination))
			{
				//binding parameters
				$stmt->bindParam(':category', $category);
				$stmt->bindParam(':image_title', $image_title);
				$stmt->bindParam(':image_description', $image_description);
				$stmt->bindParam(':image_file', $image_file);
				$stmt->bindParam(':created', $created);
				$stmt->bindParam(':updated', $updated);

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