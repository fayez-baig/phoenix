<?php 

require_once 'config.php';

if (isset($_POST['submit']) && isset($_FILES['uploads'])) {


	$name        		= $_POST['name'];
	$designation        = $_POST['designation'];
	$facebook			= $_POST['facebook'];
	$twitter			= $_POST['twitter'];
	$instagram			= $_POST['instagram'];
	$whatsapp			= $_POST['whatsapp'];
	$image_types        = ['image/jpeg', 'image/png'];
	$teacher_dir       	= '../images/teachers/';

	$image_size_limit = 2000000; // 5e+6 Bytes

	//validation
	$validation = "";
	$multiple = true;

	// if(count($_FILES['uploads']['size']) > 20)
	// {
	// 	$validation .= "Only 20 or less no. of files are allowd.<br>";
	// }


	if (count($_FILES['uploads']['size']) > 1) {
		$multiple = false;
	}


	if(empty($name))
	{
		$validation .= "Please enter Teachers name.<br>";
	}

	if(empty($designation))
	{
		$validation .= "Please enter Teachers Designation.<br>";
	}

	if(empty($facebook) )
	{
		$validation .= "Please enter Facebook Id.<br>";
	}
	if(empty($twitter) )
	{
		$validation .= "Please enter twitter Id.<br>";
	}
	if(empty($instagram) )
	{
		$validation .= "Please enter instagram Id.<br>";
	}
	if(empty($whatsapp) )
	{
		$validation .= "Please enter whatsapp No.<br>";
	}



	//image size validation
	foreach ($_FILES['uploads']['size'] as $size) {
		if($size > $image_size_limit)
		{
			$validation .= "File size should be less than or equal to 2MB!<br>";
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
		$sql = "INSERT INTO teachers(name, designation, facebook, twitter, instagram, whatsapp, image, created_at) 
						VALUES (:name,:designation, :facebook, :twitter, :instagram, :whatsapp, :image,  Now())";

		//Prepare query
		$stmt = $conn->prepare($sql);

		$level = 0;
		foreach ($_FILES['uploads']['tmp_name'] as $image_tmp) {

			$teachers_photo  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $teacher_dir . $teachers_photo;
			// $created     = time();
			// $updated     = $created;

			if(move_uploaded_file($image_tmp, $destination))
			{
				//binding parameters
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':designation', $designation);
				$stmt->bindParam(':facebook', $facebook);
			 	$stmt->bindParam(':twitter', $twitter);
			 	$stmt->bindParam(':instagram', $instagram);
			 	$stmt->bindParam(':whatsapp', $whatsapp);
				$stmt->bindParam(':image', $teachers_photo);
				// $stmt->bindParam(':star', $star);
				//$stmt->bindParam(':created_at', Now());
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

		echo "Teacher <b>$name</b> Added  Successfully!";

	}
	catch(PDOEXCEPTION $ex)
	{
		echo "Connection failed : " . $ex->getMessage();
	}

}
else
{
	echo "All Filed Required.<br>";
}


 ?>