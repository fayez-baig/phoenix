<?php 

require_once 'config.php';

if (isset($_POST['submit'])) {

	$id                = $_POST['id'];
	$pop_title         = $_POST['pop_title'];
	$image_types       = ['image/jpeg', 'image/png','image/jpg'];
	$pop_dir      	   = '../../images/popup/';
	$has_upload        = false;

	$image_size_limit = 5000000; // 5e+6 Bytes

	//validation
	$validation = "";

	if(isset($_FILES['uploads']))
	{
		

		if(strlen($pop_title) > 50)
		{
			$validation .= "Image title lenght should be less than or equal to 50.<br>";
		}


		//image size validation
		if($_FILES['uploads']['size'] > $image_size_limit)
		{
			$validation .= "File size should be less than or equal to 5MB!<br>";
			echo $validation;
			exit();
		}

		//image type validation
		if(!in_array($_FILES['uploads']['type'], $image_types))
		{
			$validation .= "Only \"jpeg\" and \"png\" images are allowd!<br>";
			echo $validation;
			exit();
		}

		//Weather image has any error
		if($_FILES['uploads']['error'])
		{
			$validation .= "Sorry 1 or more files has an error!<br>";
			echo $validation;
			exit();
		}

		$has_upload = true;
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

		

		$updated = time();

		if($has_upload)
		{

		    //SQL query
			$sql = "UPDATE popup 
					SET pop_title = :pop_title,
						pop_image = :pop_image,
						updated = :updated
 				    WHERE id = :id" ;


			//Prepare query
			$stmt = $conn->prepare($sql);

			$pop_image  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $pop_dir . $pop_image;
			
			if(move_uploaded_file($_FILES['uploads']['tmp_name'], $destination))
			{
				//binding parameters
				$stmt->bindParam(':pop_title', $pop_title);
				$stmt->bindParam(':pop_image', $pop_image);
				$stmt->bindParam(':updated', $updated);
				$stmt->bindParam(':id', $id);


				//Query execution
				if ($stmt->execute()) {
					echo "Pop Up Image has been updated Successfully!";
				}
				else
				{
					echo "Oops! somthing went wrong, please try again.";
				}
			}
		}
		else
		{
			//SQL query
			$sql = "UPDATE popup 
					SET pop_title = :pop_title,
						-- pop_image = :pop_image,
						updated = :updated
					WHERE id = :id" ;

			//Prepare query
			$stmt = $conn->prepare($sql);

			//binding parameters
			$stmt->bindParam(':pop_title', $pop_title);
			// $stmt->bindParam(':pop_image', $pop_image);
			$stmt->bindParam(':updated', $updated);
			$stmt->bindParam(':id', $id);

			//Query execution
			if ($stmt->execute()) {
				echo " Pop up Image has been updated Successfully!";
			}
			else
			{
				echo "Oops! somthing went wrong, please try again.";
			}
		}
	}
	catch(PDOEXCEPTION $ex)
	{
		echo "Connection failed : " . $ex->getMessage();
	}

}


 ?>