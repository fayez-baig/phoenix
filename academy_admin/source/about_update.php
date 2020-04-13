<?php 

require_once 'config.php';
// $level ='';
if (isset($_POST['submit'])) {

	$id         = $_POST['id'];
	$about 		= $_POST['about'];

	//validation
	$validation = "";

		if(empty($about))
		{
			$validation .= "About information can not be blank.<br>";
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

		

		// $updated = time();

		    //SQL query
			$sql = "UPDATE about_us 
					SET about = :about,
						update_date = Now()
 				    WHERE id = :id";


			//Prepare query
			$stmt = $conn->prepare($sql);

				$stmt->bindParam(':about', $about);
			$stmt->bindParam(':id', $id);
				//Query execution
				if ($stmt->execute()) {
					echo "About has been updated Successfully!";
				}
				else
				{
					echo "Oops! somthing went wrong, please try again.";
				}
	}

	catch(PDOEXCEPTION $ex)
	{
		echo "Connection failed : " . $ex->getMessage();
	}

}


 ?>