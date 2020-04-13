<?php 

require_once 'config.php';

if (isset($_POST['submit'])) {


    $category         = $_POST['category'];
    $batch           = $_POST['batch'];
    $start_date      = $_POST['start_date'];
    $end_date        = $_POST['end_date'];
    $duration        = $_POST['duration'];
    // $location        = $_POST['location'];
    $day_time        = $_POST['day_time'];
    // $days             = $_POST['days'];
    // $id              = $_POST['id'];


    //validation
    $validation = "";

    if(empty($category))
    {
        $validation .= "Please select a Category.<br>";
    }

    if(empty($batch))
    {
        $validation .= "Please select batch.<br>";
    }

    if(empty($start_date))
    {
        $validation .= "Please enter start course date(format).<br>";
    }

    if(empty($end_date))
    {
        $validation .= "Please enter end date of course.<br>";
    }

    if(empty($duration))
    {
        $validation .= "Please enter duration of course.<br>";
    }

    if(empty($day_time))
    {
        $validation .= "Please enter a day_time of batch.<br>";
    }

    // if(empty($days))
    // {
    //     $validation .= "Please enter day of week.<br>";
    // }

    // if(empty($location))
    // {
    //     $validation .= "Please enter a clasroom address.<br>";
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
        $sql = "INSERT INTO upcoming_batches (category, batch, start_date, end_date, duration, day_time, update_date) 
                      				  VALUES (:category, :batch, :start_date, :end_date, :duration, :day_time, Now())";

        //Prepare query
        $stmt = $conn->prepare($sql);

        
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':batch', $batch);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':day_time', $day_time);
        // $stmt->bindParam(':id', $id);

        //Query execution
        $stmt->execute();

		echo "Batch added Successfully!";

	}
    catch(PDOEXCEPTION $ex)
    {
        echo "Connection failed : " . $ex->getMessage();
    }

}
else
{
    echo "All Fields are required.<br>";
}

 ?>