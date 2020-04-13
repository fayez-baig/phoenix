<?php 

require_once 'config.php';

if (isset($_POST['submit']) && isset($_FILES['uploads'])) {


	$event_title        = $_POST['event_title'];
	$event_date       = $_POST['event_date'];
	$event_location		=$_POST['event_location'];
	$event_description  =$_POST['event_description'];
	// $event_image	    = $_POST['event_image'];
	$image_types       = ['image/jpeg', 'image/png'];
	$event_dir       = '../images/events/';

	$image_size_limit = 5000000; // 5e+6 Bytes

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


	if(empty($event_title))
	{
		$validation .= "Please enter event title.<br>";
	}

	if(empty($event_location))
	{
		$validation .= "Please enter event location.<br>";
	}

	if(empty($event_date) )
	{
		$validation .= "Please enter event Description.<br>";
	}

	if(empty($event_description) )
	{
		$validation .= "Please enter event Description.<br>";
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
		$sql = "INSERT INTO event(event_title, event_date, event_location, event_description, event_image, event_update) 
						VALUES (:event_title, :event_date, :event_location, :event_description, :event_image, Now())";

		//Prepare query
		$stmt = $conn->prepare($sql);

		$level = 0;
		foreach ($_FILES['uploads']['tmp_name'] as $image_tmp) {

			$event_image  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $event_dir . $event_image;
			// $created     = time();
			// $updated     = $created;

			if(move_uploaded_file($image_tmp, $destination))
			{
				//binding parameters
				$stmt->bindParam(':event_title', $event_title);
				$stmt->bindParam(':event_date', $event_date);
				$stmt->bindParam(':event_location', $event_location);
				$stmt->bindParam(':event_description', $event_description);
				$stmt->bindParam(':event_image', $event_image);
				// $stmt->bindParam(':event_update', Now());
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

		echo "Event added Successfully!";

	}
	catch(PDOEXCEPTION $ex)
	{
		echo "Connection failed : " . $ex->getMessage();
	}

}
else
{
	 echo "All Fields are required.<br>";
}


 ?>