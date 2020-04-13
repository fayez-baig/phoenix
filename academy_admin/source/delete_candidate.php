<?php


if(isset($_GET['reg_id'])) 
{
    include_once('config.php');
    $output = 0;
    $id = $_GET['reg_id'];
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Make a sql query
        $sql = "DELETE FROM register_online WHERE reg_id = :reg_id ";

        //Prepare sql query
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':reg_id', $id);
            
        if($stmt->execute())
        {
            $output = 1;
        }
        
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}


if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}


 ?>