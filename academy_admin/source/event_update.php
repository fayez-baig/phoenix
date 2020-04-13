<?php 

include_once('config.php');

	$id                 = '';
	$event_title        = '';
	$event_location     = '';
	$event_date         = '';
	$event_description  = '';
	$event_image        = '';
	$event_update       = '';

	$validation_error = '';
	$output = '';

	

if(isset($_POST['submit']))
{
	$event_title = $_POST['event_title'];
	$event_location = $_POST['event_location'];
	$event_date = $_POST['event_date'];
	$event_description = $_POST['event_description'];
	// $event_image = $_POST['event_image'];
	$event_update = $_POST['event_update'];

	// $update_date     = $_POST['update_date'];
	

	// $update_date = now();

	//validation
	if(empty($event_title))
	{
		$validation_error = "Event title cannot be blank.<br>";
	}

	if(empty($event_location))
	{
		$validation_error = "Event title cannot be blank.<br>";
	}

	if(empty($event_date))
	{
		$validation_error = "Event title cannot be blank.<br>";
	}

	if(empty($event_description))
	{
		$validation_error = "Event title cannot be blank.<br>";
	}


	//end of validation

	try 
	{
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // Make a sql query
	    $sql = "UPDATE event SET event_title = :event_title,
	    						 event_date = :event_date,
	    						 event_description = :event_description,
	    						 event_location = :event_location,
	    						 event_title = :event_title,
	    							 -- update_date = :now() 
								WHERE about_id = :about_id ";

	    //Prepare sql query
	    $stmt = $conn->prepare($sql);


	    $stmt->bindParam(':about', $about);
	    // $stmt->bindParam(':update_date', now());
	    

	    // if (empty($validation_error)) {
	    	
		    //execute prepared query
		    if($stmt->execute())
		    {
		    	$output = "<b>Event</b> Updated Successfully!";
		    }
		    else
		    {
		    	$output = "Failed to Update : <b>Please Contact Service Provider!</b>";
		    }
		// }
		// else
		// {
		// 	print_r($validation_error);
		// }

		echo $output;
    }
	catch(PDOException $e)
    {
	    echo "Connection failed: " . $e->getMessage();
    }
	
}


 ?>