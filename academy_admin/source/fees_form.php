<?php 

require_once 'config.php';

if (isset($_POST['submit'])) {


	$name       	= $_POST['s_id'];
	$amount     = $_POST['amount'];
	$payment		=$_POST['payment'];
	$status			=$_POST['status'];
	

	$image_size_limit = 2000000; // 5e+6 Bytes

	//validation
	$validation = "";
	$multiple = true;

	// if(count($_FILES['uploads']['size']) > 20)
	// {
	// 	$validation .= "Only 20 or less no. of files are allowd.<br>";
	// }


	if(empty($name))
	{
		$validation .= "Please enter student name.<br>";
	}

	if(empty($amount))
	{
		$validation .= "Please enter student department.<br>";
	}

	if(empty($payment) )
	{
		$validation .= "Please Select Payment Type.<br>";
	}

	if(empty($status) )
	{
		$validation .= "Please Select Payment status.<br>";
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
		$sql = "INSERT INTO fees( s_id,  amount, type, status, created_at) 
						VALUES (:name, :amount, :type, :status,  Now())";

		//Prepare query
		$stmt = $conn->prepare($sql);

		
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':amount', $amount);
				$stmt->bindParam(':type', $payment);
				$stmt->bindParam(':status', $status);

				//Query execution
				if ($stmt->execute())
				{
					echo "Student Fees added Successfully!";
				}
				else{
					echo "Error : please try again!";

				}
	}
	catch(PDOEXCEPTION $ex)
	{
		echo "Connection failed : " . $ex->getMessage();
	}

}
else
{
	echo "Connection Error : PLease Contact Service Provider.<br>";
}


 ?>