<?php

	$conn = mysqli_connect("localhost", "root", "","customer_db");

if (!$conn) 
{
    echo "Connection to the server  not established";
}
else 
{
    "";
}

	if(isset($_POST["submit"]))
	{
	 	$user = $_POST["username"];
	 	$user_name = filter_var($user,FILTER_SANITIZE_STRING);
		$password = $_POST["password"];

		if(empty($user_name) || empty($password))
		{
			  echo "<p style=color:white;font-size:20px;>Please Enter your details</p>";
		}

		$query = "SELECT customer_id,username,password FROM customer WHERE username=?";
			
	 
		if($stmt=mysqli_prepare($conn,$query))
		{
				mysqli_stmt_bind_param($stmt,"s",$user_name);

			if(mysqli_stmt_execute($stmt))
			{
					echo ""."<br>";
				
			}else{echo "Error could not execute ".mysqli_error($stmt);}	

			mysqli_stmt_bind_result($stmt,$user_id,$user_name,$hash_pass);
			mysqli_stmt_store_result($stmt);

			if(mysqli_stmt_num_rows($stmt)!=0)
			{

				while(mysqli_stmt_fetch($stmt))
				{	
					if($verify=password_verify($password,$hash_pass))
					{
					 	echo "Login successfull"."<br>";
					 				 
					 		if($user_name == true && $verify == true)
					 		{

						 		$_SESSION["valid_id"] = $user_id;
						 		$_SESSION["valid_name"] = $user_name;
						 			
						 		if(isset($_SESSION["valid_id"]) && isset($_SESSION["valid_name"]))
						 		{
						 			header("location:index.php");
						 		}			

					 		}else{echo $messageError = "Not Register Yet! Click Register Link";}
					 		
			       }
			       else
				   {
				   		$messageError = "Incorrect user ID or password. Type the correct User Id and password. 
				   		and try again";
				 		// echo "<h1>Login failed</h1>";
				 		// echo "<h1>Try Again</h1>";
				   }	
				 			
				}

			}
			else
			{
				 		$messageError = "Not Register Yet! Click Register Link";
			}

			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
			

		}else{echo "error ".mysqli_error($conn);}	



		// $query = "SELECT username,password FROM customer WHERE username = 'stenden' AND password ='stenden'";

		// if($stmt=mysqli_prepare($conn,$query))
 	// {
 	// 	mysqli_stmt_bind_param($stmt,"ss",$user,$password);
 	// 	if(mysqli_stmt_execute($stmt))
 	// 	{

 	// 		$_SESSION["employee"] = $user;
		// 	$_SESSION["employee_pass"] = $password;
						 			
		// 	if(isset($_SESSION["employee"]) && isset($_SESSION["employee_pass"]))
		// 	{
		// 		header("location:index.php");
		// 	}		

 	// 	}
 	// 	else
 	// 		{
 	// 			// echo "error".mysqli_error($conn);
 	// 		}
 		
 	// }
 	// else
 	// {
 	// 	// echo "error".mysqli_error($conn);
 	// }
		mysqli_close($conn);

   }
?>