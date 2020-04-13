<?php 

require_once 'config.php';
// $level ='';
if (isset($_POST['submit'])) {

	$id                 = $_POST['id'];
	$name 				= $_POST['name'];
    $designation 		= $_POST['designation'];
    $facebook 			= $_POST['facebook'];  
    $twitter 			= $_POST['twitter'];  
    $instagram 			= $_POST['instagram'];  
    $whatsapp 			= $_POST['whatsapp'];  
    //$image				= $_POST[''];
	$image_types        = ['image/jpeg', 'image/png'];
	$tech_dir      	= '../images/teachers/';
	$has_upload         = false;

	$image_size_limit = 2000000; // 5e+6 Bytes

	//validation
	$validation = "";

	if(isset($_FILES['uploads']))
	{
		if(empty($name))
		{
			$validation .= "Techare name can not be blank.<br>";
		}


		if(empty($designation) )
		{
			$validation .= "please enter Designation <br>";
		}

		if(empty($facebook) )
		{
			$validation .= "please enter facebookid<br>";
		}

		if(empty($twitter) )
		{
			$validation .= "please enter twitter id<br>";
		}

		if(empty($instagram) )
		{
			$validation .= "please enter instagram id<br>";
		}

		if(empty($whatsapp) )
		{
			$validation .= "please enter whatsapp no.<br>";
		}

		//image size validation
		

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
			$sql = "UPDATE teachers 
					SET name = :name,
						designation = :designation,
						facebook = :facebook,
						twitter = :twitter,
						instagram = :instagram,
						whatsapp = :whatsapp,
						image = :image,
						created_at = Now()
 				    WHERE id = :id" ;


			//Prepare query
			$stmt = $conn->prepare($sql);

			$level=0;
			$image  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $tech_dir . $image;
			
			if(move_uploaded_file($_FILES['uploads']['tmp_name'], $destination))
			{
				//binding parameters
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':designation', $designation);
				$stmt->bindParam(':facebook', $facebook);
				$stmt->bindParam(':instagram', $instagram);
				$stmt->bindParam(':twitter', $twitter);
				$stmt->bindParam(':whatsapp', $whatsapp);
				$stmt->bindParam(':image', $image);

				$stmt->bindParam(':id', $id);


				//Query execution
				if ($stmt->execute()) {
					echo "Techare has been updated Successfully!";
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
			$sql = "UPDATE teachers 
					SET name = :name,
						designation = :designation,
						facebook = :facebook,
						twitter = :twitter,
						instagram = :instagram,
						whatsapp = :whatsapp,
						image = :image,
						created_at = Now()
 				    WHERE id = :id" ;

			//Prepare query
			$stmt = $conn->prepare($sql);

			//binding parameters
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':designation', $designation);
				$stmt->bindParam(':facebook', $facebook);
				$stmt->bindParam(':instagram', $instagram);
				$stmt->bindParam(':twitter', $twitter);
				$stmt->bindParam(':whatsapp', $whatsapp);
				$stmt->bindParam(':image', $image);

				$stmt->bindParam(':id', $id);


				//Query execution
				if ($stmt->execute()) {
					echo "Techare has been updated Successfully!";
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