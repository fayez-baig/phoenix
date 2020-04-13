<?php 

include_once('config.php');

	$about = '';
	
	$submit        = '';

	$validation_error = '';
	$output = '';

	

if(isset($_POST['submit']))
{
	$about = $_POST['about'];
	
	

	//validation
	if(empty($about))
	{
		$validation_error .= "About information cannot be blank.<br>";
	}

	
	//end of validation

	try 
	{
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // Make a sql query
	    $sql = "INSERT INTO about_us(about, update_date)
	    		VALUES (:about, Now())";

	    //Prepare sql query
	    $stmt = $conn->prepare($sql);


	    $stmt->bindParam(':about', $about);
	    


	    if (empty($validation_error)) {
	    	
		    //execute prepared query
		    if($stmt->execute())
		    {
		    	$output = "New Package <b>$package_title</b> added Successfully!";
		    }
		    else
		    {
		    	$output = "Failed to Add : <b>Please Contact Service Provider!</b>";
		    }
		}
		else
		{
			print_r($validation_error);
		}

		echo $output;
    }
	catch(PDOException $e)
    {
	    echo "Connection failed: " . $e->getMessage();
    }
	
}


 ?>