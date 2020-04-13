<?php

if(isset($_GET['id'])) 
{
    include_once('config.php');
    $output = 0;
    $id = $_GET['id'];
    $inQuery = implode(',', array_fill(0, count(explode(',', $id)), '?'));

    // echo $inQuery;
    // exit();
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Make a sql query
        $sql = "SELECT image_file FROM gallery WHERE id IN(".$inQuery.")";

        //Prepare sql query
        $stmt = $conn->prepare($sql);

        $cou = 1;
        foreach (explode(',', $id) as $value) {       
            $stmt->bindValue($cou, $value);
            $cou++;
        }


        if($stmt->execute())
        {
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $val)
            {

                if(isset($val['image_file']))
                {
                   unlink("../images/gallery/".$val['image_file']);
                }
            }
        }

        // Make a sql query
        $sql = "DELETE FROM gallery WHERE id IN(".$inQuery.")";

        //Prepare sql query
        $stmtt = $conn->prepare($sql);

        $cou = 1;
        foreach (explode(',', $id) as $value) {       
            $stmtt->bindValue($cou, $value);
            $cou++;
        }

        $stmtt->execute();
        
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