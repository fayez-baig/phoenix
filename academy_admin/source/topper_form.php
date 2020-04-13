<?php 

require_once 'config.php';

if (isset($_POST['submit']) && isset($_FILES['uploads'])) {


	$name        = $_POST['t_name'];
	$class       = $_POST['t_Class'];
	$rank		 =$_POST['t_rank'];
	$year		 =$_POST['t_year'];
	$descripatin =$_POST['t_description'];
	$image_types       = ['image/jpeg', 'image/png'];
	$top_dir       = '../images/topper/';

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


	if(empty($name))
	{
		$validation .= "Please enter Student name.<br>";
	}

	if(empty($class))
	{
		$validation .= "Please enter Class.<br>";
	}

	if(empty($rank) )
	{
		$validation .= "Please enter Rank number.<br>";
	}
	
	if(empty($year) )
	{
		$validation .= "Please Select Passing Year.<br>";
	}

	if(empty($descripatin) )
	{
		$validation .= "Please enter Description.<br>";
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
		$sql = "INSERT INTO toper(name, class, year, rank, descripatin, image, created) 
						VALUES (:name, :class, :year, :rank, :descripatin, :image, now())";

		//Prepare query
		$stmt = $conn->prepare($sql);

		$level = 0;
		foreach ($_FILES['uploads']['tmp_name'] as $image_tmp) {

			$top_image  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $top_dir . $top_image;
			// $created     = time();
			 //$updated     = date('d-m-yy');

			if(move_uploaded_file($image_tmp, $destination))
			{
				//binding parameters
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':class', $class);
				$stmt->bindParam(':year', $year);
				$stmt->bindParam(':rank', $rank);
				$stmt->bindParam(':descripatin', $descripatin);
				$stmt->bindParam(':image', $top_image);
				//$stmt->bindParam(':created', $created);
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

		echo "Topper added Successfully!";

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