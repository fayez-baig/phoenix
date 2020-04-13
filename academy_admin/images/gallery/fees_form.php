<?php 

require_once 'config.php';

if (isset($_POST['submit']) ) {


  $s_id        	= $_POST['s_id'];
  $amount       = $_POST['amount'];
  $type         = $_POST['payment'];
  $status       = $_POST['status'];

  //validation
  $validation = "";

  
  if(empty($s_id))
  {
    $validation .= "Please Select Student.<br>";
  }

  if(empty($amount) )
  {
    $validation .= "Please enter amount.<br>";
  }

  if(empty($type) )
  {
    $validation .= "Please Select Any one Payment Type.<br>";
  }

 if(empty($status))
  {
    $validation .= "Please Select Status.<br>";
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
    $sql = "INSERT INTO fees(s_id, amount, type, status, created_at) 
                     VALUES (:s_id, :amount, :type, :status,  Now())";

    //Prepare query
    $stmt = $conn->prepare($sql);

        //binding parameters
        $stmt->bindParam(':s_id', $s_id);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':status', $status);
    

        //Query execution
        //execute prepared query
		    if($stmt->execute())
		    {
		    	echo "Fees added Successfully!";
		    }
		    else
		    {
		    	echo "Failed to Add : <b>Please Contact Service Provider!</b>";
		    }
    }

  catch(PDOEXCEPTION $ex)
  {
    echo "Connection failed : " . $ex->getMessage();
  }
}
 ?>