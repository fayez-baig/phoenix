<?php 

require_once 'config.php';
// $level ='';
if (isset($_POST['submit'])) {

	$id                 = $_POST['id'];
	$name 				= $_POST['name'];
    $department 		= $_POST['department'];
    $feedback 			= $_POST['feedback'];  
    // $student_photo		= $_POST['']
	$image_types        = ['image/jpeg', 'image/png'];
	$feedback_dir      	= '../images/stud-feedback/';
	$has_upload         = false;

	$image_size_limit = 2000000; // 5e+6 Bytes

	//validation
	$validation = "";

	if(isset($_FILES['uploads']))
	{
		if(empty($name))
		{
			$validation .= "Student name can not be blank.<br>";
		}


		if(empty($department) )
		{
			$validation .= "please enter department / class<br>";
		}

		if(empty($feedback) )
		{
			$validation .= "please enter feedback<br>";
		}

		//image size validation
		if($_FILES['uploads']['size'] > $image_size_limit)
		{
			$validation .= "File size should be less than or equal to 2MB!<br>";
			echo $validation;
			exit();
		}

		// image type validation
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
			$sql = "UPDATE student_feedback 
					SET name = :name,
						department = :department,
						feedback = :feedback,
						student_photo = :student_photo,
						update_date = Now()
 				    WHERE id = :id" ;


			//Prepare query
			$stmt = $conn->prepare($sql);

			$level=0;
			$student_photo  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $feedback_dir . $student_photo;
			
			if(move_uploaded_file($_FILES['uploads']['tmp_name'], $destination))
			{
				//binding parameters
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':department', $department);
				$stmt->bindParam(':feedback', $feedback);
				$stmt->bindParam(':student_photo', $student_photo);

				$stmt->bindParam(':id', $id);


				//Query execution
				if ($stmt->execute()) {
					echo "feedback has been updated Successfully!";
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
			$sql = "UPDATE student_feedback 
					SET name = :name,
						-- post_image = :post_image,
						department = :department,
						feedback = :feedback,
						update_date = Now()
					WHERE id = :id" ;

			//Prepare query
			$stmt = $conn->prepare($sql);

			//binding parameters
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':department', $department);
			$stmt->bindParam(':feedback', $feedback);
			$stmt->bindParam(':id', $id);

			//Query execution
			if ($stmt->execute()) {
				echo "feedback has been updated Successfully!";
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