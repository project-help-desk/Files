<?php

$conn = mysqli_connect("localhost", "root", "","customer_db");

if (!$conn) 
{
    echo "Connection to the server  not established";
}
if(isset($_POST['update']))
{
		
	$query = "UPDATE customer SET username =?,email=?,company_name=? WHERE customer_id=?";

	$user_name = filter_var($_POST["username"],FILTER_SANITIZE_STRING);
	$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$company = $_POST["company"];

	if($stmt=mysqli_prepare($conn,$query))
	{
			
		mysqli_stmt_bind_param($stmt,"sssi",$user_name,$email,$company,$_GET["id"]);
		if(mysqli_stmt_execute($stmt))
		{
			echo "";
			echo "<br>";
			
		}else{echo "Unable to Update ".mysqli_error($conn);}

			mysqli_stmt_close($stmt);

		}else{echo "Unable to Prepare ".mysqli_error($conn);}	
}

$query_select = "SELECT username,email,company_name FROM customer WHERE customer_id=?";

	if($stmt = mysqli_prepare($conn,$query_select))
	{
		mysqli_stmt_bind_param($stmt,"i",$_GET["id"]);
		
		if(mysqli_stmt_execute($stmt))
		{
			echo ""."<br>";
		
		}else{echo "Query Execution Failed ".mysqli_error($conn);}	

		mysqli_stmt_bind_result($stmt,$name,$email,$company);
		
		while(mysqli_stmt_fetch($stmt))
		{}

	mysqli_stmt_close($stmt);

	}else{echo "Unable to prepare query ".mysqli_error($conn);}	


	mysqli_close($conn);

	?>