<?php 

require_once 'config.php';
// $level ='';
if (isset($_POST['submit'])) {

	$id               = $_POST['id'];
	$category         = $_POST['category'];
    $batch            = $_POST['batch'];
    $start_date       = $_POST['start_date'];
    $end_date         = $_POST['end_date'];
    $duration         = $_POST['duration'];
    // $location         = $_POST['location'];
    $day_time         = $_POST['day_time'];
    // $days             = $_POST['days'];
    // $id              = $_POST['id'];

	//validation
	$validation = "";


    if(empty($category))
    {
        $validation .= "Category can not be blank.<br>";
    }

    if(empty($batch))
    {
        $validation .= "batch can not be blank.<br>";
    }

    if(empty($start_date))
    {
        $validation .= "start course date can not be blank.<br>";
    }

    if(empty($end_date))
    {
        $validation .= "end date of course can not be blank.<br>";
    }

    if(empty($duration))
    {
        $validation .= "duration of course can not be blank.<br>";
    }

    if(empty($day_time))
    {
        $validation .= "Batch time of batch can not be blank.<br>";
    }

    // if(empty($days))
    // {
    //     $validation .= "day of week can not be blank.<br>";
    // }

    // if(empty($location))
    // {
    //     $validation .= "clasroom address can not be blank.<br>";
    // }

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
			$sql = " UPDATE upcoming_batches 
					SET category = :category,
						batch = :batch,
						start_date = :start_date,
						end_date = :end_date,
						duration = :duration,
						day_time = :day_time,
						update_date = Now()
 				    WHERE id = :id ";


			//Prepare query
			$stmt = $conn->prepare($sql);

			$stmt->bindParam(':category', $category);
	        $stmt->bindParam(':batch', $batch);
	        $stmt->bindParam(':start_date', $start_date);
	        $stmt->bindParam(':end_date', $end_date);
	        $stmt->bindParam(':duration', $duration);
	        $stmt->bindParam(':day_time', $day_time);
	        // $stmt->bindParam(':days', $days);
	        // $stmt->bindParam(':location', $location);
			$stmt->bindParam(':id', $id);


			if ($stmt->execute()) {
				echo "Batch has been updated Successfully!";
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