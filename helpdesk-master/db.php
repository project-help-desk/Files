<?php

$conn = mysqli_connect("localhost", "root", "");
if (!$conn) {
    echo "Connection to the server  not established";
} else {
    "";
}

$db_create = "CREATE DATABASE customer_db";

if ($stmt = mysqli_prepare($conn, $db_create)) {
    if (mysqli_stmt_execute($stmt)) {
        echo "Database created succesfully";
    } else//{echo "Unable to create database".mysqli_error($conn);}

    mysqli_stmt_close($stmt);
}else {
    "Unable to prepare statement" . mysqli_error($conn);
}

mysqli_select_db($conn, "customer_db");

$db_table = "CREATE TABLE customer
				(
				  customer_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  username VARCHAR(40),
				  email VARCHAR(40),
				  company_name VARCHAR(50),
				  password VARCHAR(120)
				)";

if ($stmt = mysqli_prepare($conn, $db_table)) {
    if (mysqli_stmt_execute($stmt)) {
        echo "Table Created Succesfully";
    } else //echo {"Unable to create table ".mysqli_error($conn)};	

    mysqli_stmt_close($stmt);
}else {
    echo "Unable to prepare statement " . mysqli_error($conn);
}

if (isset($_POST["submit"])) 
{
        $user = htmlentities($_POST["username"]);
        $username = filter_var($user,FILTER_SANITIZE_STRING);

       

        $company = filter_var($_POST["username"],FILTER_SANITIZE_STRING);

        $password =htmlentities($_POST["password"]);

        $password_new =  password_hash($password,PASSWORD_BCRYPT);

         // Remove all illegal characters from email
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);


        $db_insert = "INSERT INTO customer VALUES(NULL,?,?,?,?)";
    if ($stmt = mysqli_prepare($conn, $db_insert)) 
    {
            //check for both invalid email and username with numbers
         if (!filter_var($email,FILTER_VALIDATE_EMAIL) && (preg_match('#[0-9]#', $username))) 
         {
            $emailError = "Please enter an appropriate mail and ";
            $emailError .= "a valid name,userid should not contain number.";
         } 

        else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) //to check if it is not in an email format
        {

            $emailError = "Please enter an appropriate mail.";

        } 

        else if (preg_match('#[0-9]#', $username))
        {

            $nameError = "Invalid name, userid should not contain number.";
        } 
        else
        {
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $company, $password_new);

            if (mysqli_stmt_execute($stmt)) 
            {
                echo "<span>Accound successfully created!</span><br>
                   <span>Redirecting you back to the Login page...</span>";

                header("Location: login.php");
            } 
            else 
            {
                echo "Unable to create account " . mysqli_error($conn);
            }

        }

        mysqli_stmt_close($stmt);

    } else {echo "Unable to prepare statement " . mysqli_error($conn); }       
   
  }


mysqli_close($conn);
?>