<?php
session_start();

if(isset($_POST['login'])) 
{
    include_once('config.php');
    $usernamee = $_POST['username'];
    $passwordd = $_POST['password'];
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Make a sql query
        $sql = "SELECT * FROM register_online WHERE email = :email and phone = :phone and status='Active' ";

        //Prepare sql query
        $stmt = $conn->prepare($sql);

        //bind value to parameter
        $stmt->bindParam(':email', $usernamee);
        $stmt->bindParam(':phone', $passwordd);

        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count) {
            $_SESSION['student'] = true;
            $_SESSION['user'] = $usernamee;
            $_SESSION['phone'] = $passwordd;
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