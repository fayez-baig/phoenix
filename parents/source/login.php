<?php
session_start();

if(isset($_POST['login'])) 
{
    include_once('../../academy_admin/source/config.php');
    $courseame = $_POST['username'];
    $passwordd = $_POST['password'];
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Make a sql query
        $sql = "SELECT * FROM register_online WHERE course = :course and phone = :password";

        //Prepare sql query
        $stmt = $conn->prepare($sql);

        //bind value to parameter
        $stmt->bindParam(':course', $courseame);
        $stmt->bindParam(':password', $passwordd);

        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count) {
            $_SESSION['parent'] = true;
            $_SESSION['userP'] = $passwordd;
            echo "Successfully logged in! Please wait...";
        }
        else
        {
            echo "Username or password is incorrect.";
        }

    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}

?>