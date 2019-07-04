<?php

$conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");

if (!$conn) {
    echo "Connection to the server  not established";
}
if (isset($_POST['update']) && isset($_SESSION["valid_id"])) {

    $query = "UPDATE contact SET first_name = ?, last_name = ?, phone = ?, email = ?, username =? WHERE contact_id=?";

    $user_name = htmlentities($_POST["username"]);
    $email = htmlentities($_POST["email"]);
    $phone = htmlentities($_POST["phone"]);
    $first_name = htmlentities($_POST["firstname"]);
    $last_name = htmlentities($_POST["lastname"]);
//    $license_id = htmlentities($_POST["licence"]);
    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param($stmt, "ssissi",$first_name, $last_name, $phone,$email, $user_name,$_SESSION["valid_id"]);
        if (mysqli_stmt_execute($stmt)) {
            echo "Information succesfully updated, you will be redirected to the ticket overview.";
            echo "<br>";
            header("Refresh: 5; URL=UserTickets.php");
        } else {
            echo "Unable to Update " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Unable to Prepare " . mysqli_error($conn);
    }
}

$query_select = "SELECT contact.username, contact.email, contact.phone, contact.first_name, contact.last_name, licence.licence_code FROM contact LEFT JOIN licence ON contact.company_id = licence.company_id WHERE contact.contact_id= ?";
if ($stmt = mysqli_prepare($conn, $query_select)) {

    mysqli_stmt_bind_param($stmt, "i", $_SESSION["valid_id"]);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $username, $email, $phone, $firstname, $lastname, $licence);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_fetch($stmt); 
        
    } else {
        echo "Query Execution Failed " . mysqli_error($conn);
    }



    mysqli_stmt_close($stmt);
} else {
    echo "Unable to prepare query " . mysqli_error($conn);
}


mysqli_close($conn);
?>
