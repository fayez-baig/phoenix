<?php 

require_once 'config.php';

if (isset($_POST['submit'])) {


    $course         = $_POST['category'];
    $s_name         = $_POST['s_name'];
    $status         = $_POST['status'];
    $today          = date('yy/mm/dd');


    //validation
    $validation = "";

    if(empty($course))
    {
        $validation .= "Please select a Course.<br>";
    }

    if(empty($s_name))
    {
        $validation .= "Please select Name.<br>";
    }

    if(empty($status))
    {
        $validation .= "Please Select Status .<br>";
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
        $sql = "INSERT INTO attendance(s_id, class, status, created_at)  
                                VALUES (:s_id, :class, :status, :today)";

        //Prepare query
        $stmt = $conn->prepare($sql);

        
        $stmt->bindParam(':s_id', $s_name);
        $stmt->bindParam(':class', $course);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':today', $today);

        //Query execution
        $stmt->execute();

    echo "Attendance added Successfully!";

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