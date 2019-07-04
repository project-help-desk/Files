<?php session_start(); ?>   
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Tickets</title>
        <link rel="stylesheet" href="vendor/Slick/slick.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fonts/fonts.css">
        <link rel="stylesheet" href="css/usertickets.css">
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");
        if (!$conn) {
            echo "Unable to connect to server";
        }
        if (isset($_POST['update'])) {
            $query = "UPDATE incident SET Description =? WHERE incident_id=?";
            $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, "si", $description, $_GET["id"]);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Update Successful";
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
        $query_select = "SELECT Description FROM incident WHERE incident_id =?";
        if ($stmt = mysqli_prepare($conn, $query_select)) {
            mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
            if (mysqli_stmt_execute($stmt)) {
                echo "" . "<br>";
            } else {
                echo "Query Execution Failed " . mysqli_error($conn);
            }
            mysqli_stmt_bind_result($stmt, $description);
            while (mysqli_stmt_fetch($stmt)) {
                
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Unable to prepare query " . mysqli_error($conn);
        }
        mysqli_close($conn);
        ?>
        <form action="" method="POST">
            <h2>Edit ticket Description</h2>	
            <textarea name="description" rows="4" cols="30"><?php echo $description ?></textarea>
            <p><input type="submit" name="update" value="Update"></p>
        </form>
    </body>
</html>
