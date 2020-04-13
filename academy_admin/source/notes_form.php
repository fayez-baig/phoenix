<?php 

require_once ('config.php');

if (isset($_POST['submit']) && isset($_FILES['uploads'])) {


	$category          = $_POST['category'];
	$topic_title       = $_POST['topic_title'];
	$topic_description = $_POST['topic_description'];
	$image_types       = ['image/jpeg', 'image/png'];
	$course_dir        = '../../resources/courses/';

	$application_types       = ['application/pdf'];
	$application_dir        = '../../resources/notes/';

	$image_size_limit = 5000000; // 5e+6 Bytes
	$file_size_limit  = 5000000;

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

	if(count($_FILES['uploads1']['size']) > 20)
	{
		$validation .= "Only 20 or less no. of files are allowd.<br>";
	}


	if (count($_FILES['uploads1']['size']) > 1) {
		$multiple = true;
	}

	if(empty($category))
	{
		$validation .= "Please select a Category.<br>";
	}

	if(strlen($topic_title) > 50)
	{
		$validation .= "Topic title lenght should be less than or equal to 50.<br>";
	}

	if(strlen($topic_description) > 255 )
	{
		$validation .= "Topic Description lenght should be less than or equal to 255.<br>";
	}

	//image size validation
	foreach ($_FILES['uploads']['size'] as $size) {
		if($size > $image_size_limit)
		{
			$validation .= "image size should be less than or equal to 5MB!<br>";
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



	//file size validation
	foreach ($_FILES['uploads1']['size'] as $size1) {
		if($size > $file_size_limit)
		{
			$validation .= "File size should be less than or equal to 5MB!<br>";
			echo $validation;
			exit();
		}
	}

	//file type validation
	foreach ($_FILES['uploads1']['type'] as $type1) {
		if(!in_array($type1, $application_types))
		{
			$validation .= "Only \"PDF\"  Files are allowd!<br>";
			echo $validation;
			exit();
		}
	}

	//Weather file has any error
	foreach ($_FILES['uploads1']['error'] as $erro1) {
		if($erro1)
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
		$sql = "INSERT INTO notes(category, topic, image_file, pdf_file, description, upload_date ) 
						VALUES (:category, :topic, :image_file, :pdf_file, :description, now())";

		//Prepare query
		$stmt = $conn->prepare($sql);

		$level = 0;
		foreach ($_FILES['uploads']['tmp_name'] as $image_tmp  ) {
			$image_file  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $course_dir . $image_file;

			$level1 = 0;
			foreach ($_FILES['uploads1']['tmp_name'] as $file_tmp ) {
				$pdf_file  = time() . "$level1." . str_replace('application/', '', $_FILES['uploads1']['type'][$level1]);
				$destination1 = $application_dir . $pdf_file;
			
			if(move_uploaded_file($image_tmp, $destination)){
				if(move_uploaded_file( $file_tmp, $destination1))
			
			{
				//binding parameters
				$stmt->bindParam(':category', $category);
				$stmt->bindParam(':topic', $topic_title);
				$stmt->bindParam(':image_file', $image_file);
				$stmt->bindParam(':pdf_file', $pdf_file);
				$stmt->bindParam(':description', $topic_description);
				

				//Query execution
				$stmt->execute();
			}
		
			else
			{
				break;
			}
		}
		
			
			$level++;
			$level1++;

		
}
		echo "Notes(s) added Successfully!";

	}

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