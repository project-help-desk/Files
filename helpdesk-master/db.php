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
				  password VARCHAR(20)
				)";

if ($stmt = mysqli_prepare($conn, $db_table)) {
    if (mysqli_stmt_execute($stmt)) {
        echo "Table Created Succesfully";
    } else //echo {"Unable to create table ".mysqli_error($conn)};	

    mysqli_stmt_close($stmt);
}else {
    echo "Unable to prepare statement " . mysqli_error($conn);
}

if (isset($_POST["submit"])) {
    $username = htmlentities($_POST["username"]);
    $email = htmlentities($_POST["email"]);
    $company = htmlentities($_POST["company"]);
    $password = htmlentities($_POST["password"]);

    $db_insert = "INSERT INTO customer VALUES(NULL,?,?,?,?)";

    if ($stmt = mysqli_prepare($conn, $db_insert)) {
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $company, $password);

        if (mysqli_stmt_execute($stmt)) {
            echo "<span>Accound successfully created!</span><br>
               <span>Redirecting you back to the Login page...</span>";

            header("Location: login.php");
        } else {
            echo "Unable to create account " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Unable to prepare statement " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>