<?php 

require_once 'config.php';
// $level ='';
if (isset($_POST['submit'])) {

	$id                 = $_POST['id'];
	$post_title 		= $_POST['post_title'];
    $post_date 			= $_POST['post_date'];
    $post_tag 			= $_POST['post_tag'];  
    $post_description   = $_POST['post_description']; 
	$image_types        = ['image/jpeg', 'image/png'];
	$post_dir      	 	= '../academy_admin/../images/blogs/';
	$has_upload         = false;

	$image_size_limit = 2000000; // 5e+6 Bytes

	//validation
	$validation = "";

	if(isset($_FILES['uploads']))
	{
		if(empty($post_title))
		{
			$validation .= "Post title can not be blank.<br>";
		}


		if(empty($post_description) )
		{
			$validation .= "please enter description of post<br>";
		}

		if(empty($post_tag) )
		{
			$validation .= "please enter description of tag<br>";
		}

		//image size validation
		if($_FILES['uploads']['size'] > $image_size_limit)
		{
			$validation .= "File size should be less than or equal to 2MB!<br>";
			echo $validation;
			exit();
		}

		//image type validation
		if(!in_array($_FILES['uploads']['type'], $image_types))
		{
			$validation .= "Only \"jpeg\" and \"png\" images are allowd!<br>";
			echo $validation;
			exit();
		}

		//Weather image has any error
		if($_FILES['uploads']['error'])
		{
			$validation .= "Sorry 1 or more files has an error!<br>";
			echo $validation;
			exit();
		}

		$has_upload = true;
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

		

		$updated = time();

		if($has_upload)
		{

		    //SQL query
			$sql = "UPDATE post 
					SET post_title = :post_title,
						post_image = :post_image,
						post_description = :post_description,
						post_tag = :post_tag,
						post_date = :post_date,
						update_date = Now()
 				    WHERE id = :id" ;


			//Prepare query
			$stmt = $conn->prepare($sql);

			$level=0;
			$post_image  = time() . "$level." . str_replace('image/', '', $_FILES['uploads']['type'][$level]);
			$destination = $post_dir . $post_image;
			
			if(move_uploaded_file($_FILES['uploads']['tmp_name'], $destination))
			{
				//binding parameters
				$stmt->bindParam(':post_title', $post_title);
				$stmt->bindParam(':post_image', $post_image);
				$stmt->bindParam(':post_description', $post_description);
				$stmt->bindParam(':post_tag', $post_tag);
				$stmt->bindParam(':post_date', $post_date);
				$stmt->bindParam(':id', $id);


				//Query execution
				if ($stmt->execute()) {
					echo "Post has been updated Successfully!";
				}
				else
				{
					echo "Oops! somthing went wrong, please try again.";
				}
			}
			$level++;
		}
		else
		{
			//SQL query
			$sql = "UPDATE post 
					SET post_title = :post_title,
						-- post_image = :post_image,
						post_description = :post_description,
						post_tag = :post_tag,
						post_date = :post_date,
						update_date = Now()
					WHERE id = :id" ;

			//Prepare query
			$stmt = $conn->prepare($sql);

			//binding parameters
			$stmt->bindParam(':post_title', $post_title);
			// $stmt->bindParam(':post_image', $post_image);
			$stmt->bindParam(':post_description', $post_description);
			$stmt->bindParam(':post_tag', $post_tag);
			$stmt->bindParam(':post_date', $post_date);	
			$stmt->bindParam(':id', $id);

			//Query execution
			if ($stmt->execute()) {
				echo "post has been updated Successfully!";
			}
			else
			{
				echo "Oops! somthing went wrong, please try again.";
			}
		}
	}
	catch(PDOEXCEPTION $ex)
	{
		echo "Connection failed : " . $ex->getMessage();
	}

}


 ?>