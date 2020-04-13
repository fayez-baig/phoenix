<?php 

require_once 'config.php';
// $level ='';
if (isset($_POST['submit'])) {

	$reg_id      = $_POST['reg_id'];
	$name        = $_POST['name'];
	$course      = $_POST['course'];
	$email      = $_POST['email'];
	$image_types        = ['image/jpeg', 'image/png'];
	$stud_dir          = '../images/student/';
	$has_upload         = false;

	$image_size_limit = 5000000; // 5e+6 Bytes

	//validation
	$validation = "";

	if(isset($_FILES['uploads']))
	{
		if(empty($name))
		{
			$validation .= "Please Enter Name.<br>";
		}

		if(empty($email))
		{
			$validation .= "Enter Valid Email Id.<br>";
		}

		if(empty($course) )
		{
			$validation .= "Please Select Course.<br>";
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
			$sql = "UPDATE register_online 
					SET name = :name,
						email = :email,
						course = :course,
						image = :image
 				    WHERE reg_id = :reg_id" ;


			//Prepare query
			$stmt = $conn->prepare($sql);

			 $level=0;
			$stud_image  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $stud_dir . $stud_image;
			
			if(move_uploaded_file($_FILES['uploads']['tmp_name'], $destination))
			{
				//binding parameters
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':course', $course);
				$stmt->bindParam(':image', $stud_image);
				$stmt->bindParam(':reg_id', $reg_id);


				//Query execution
				if ($stmt->execute()) {
					echo "Student Profile Updated Successfully!!!";
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
			$sql = "UPDATE register_online 
					SET name = :name,
						email = :email,
						course = :course,
						-- image = :image
 				    WHERE reg_id = :reg_id" ;

			//Prepare query
			$stmt = $conn->prepare($sql);

			//binding parameters
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':course', $course);
			$stmt->bindParam(':reg_id', $reg_id);

			//Query execution
			if ($stmt->execute()) {
					echo "Student Profile Updated Successfully!";
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