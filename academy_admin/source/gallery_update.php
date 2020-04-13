<?php 

require_once 'config.php';

if (isset($_POST['submit'])) {

	$id                = $_POST['id'];
	$category          = $_POST['category'];
	$image_title       = $_POST['image_title'];
	$image_description = $_POST['image_description'];
	$image_types       = ['image/jpeg', 'image/png'];
	$gallary_dir       = '../images/gallery/';
	$has_upload        = false;

	$image_size_limit = 5000000; // 5e+6 Bytes

	//validation
	$validation = "";

	if(isset($_FILES['uploads']))
	{
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
			$sql = "UPDATE gallery 
					SET category = :category,
						image_title = :image_title,
						image_description = :image_description,
						image_file = :image_file,
						updated = :updated
 				    WHERE id = :id" ;


			//Prepare query
			$stmt = $conn->prepare($sql);
            $level=0;
			$image_file  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $gallary_dir . $image_file;
			
			if(move_uploaded_file($_FILES['uploads']['tmp_name'], $destination))
			{
				//binding parameters
				$stmt->bindParam(':category', $category);
				$stmt->bindParam(':image_title', $image_title);
				$stmt->bindParam(':image_description', $image_description);
				$stmt->bindParam(':image_file', $image_file);
				$stmt->bindParam(':updated', $updated);
				$stmt->bindParam(':id', $id);


				//Query execution
				if ($stmt->execute()) {
					echo "Image has been updated Successfully!";
				}
				else
				{
					echo "Oops! somthing went wrong, please try again.";
				}
			}
			$level++;
		}
		else
		{
			//SQL query
			$sql = "UPDATE gallery 
					SET category = :category,
						image_title = :image_title,
						image_description = :image_description,
						
image_file = :image_file,						updated = :updated
					WHERE id = :id" ;

			//Prepare query
			$stmt = $conn->prepare($sql);

			//binding parameters
			$stmt->bindParam(':category', $category);
			$stmt->bindParam(':image_title', $image_title);
			$stmt->bindParam(':image_description', $image_description);
			$stmt->bindParam(':image_file', $image_file);
			$stmt->bindParam(':updated', $updated);
			$stmt->bindParam(':id', $id);

			//Query execution
			if ($stmt->execute()) {
				echo "Image has been updated Successfully!!";
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