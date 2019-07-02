<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update ticket</title>
        <link rel="stylesheet" href="vendor/Slick/slick.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fonts/fonts.css">
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");
        if (!$conn) {
            echo "Connection to the server  not established";
        }
        if (isset($_POST['update']) && isset($_SESSION["valid_id"])) {
            $query = "UPDATE incident SET Status_id = ?, Operator_id = ?, Description= ? WHERE Incident_id=?";
            $status = htmlentities($_POST["status"]);
            $operatorid = htmlentities($_POST["operatorid"]);
            $desc = htmlentities($_POST["desc"]);
            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, "iisi", $status, $operatorid, $desc, $_session["valid_id"]);
                if (mysqli_stmt_execute($stmt)) {
                    echo "";
                    echo "<br>";
                } else {
                    echo "Unable to Update " . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Unable to Prepare " . mysqli_error($conn);
            }
        }
        $query_select = "SELECT Status_id, Operator_id, Description FROM incident WHERE Incident_id=?";
        if ($stmt = mysqli_prepare($conn, $query_select)) {
            mysqli_stmt_bind_param($stmt, "i", $_SESSION["valid_id"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $status, $operatorid, $desc);
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

        <form action="" method="POST">
            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td>Status ID:</td>
                            <td><input type="text" name="status" value="<?php echo $status; ?>"></td>
                        </tr>
                        <tr>
                            <td>Operator ID:</td>
                            <td><input type="text" name="operatorid" value="<?php echo $operatorid; ?>"></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><input type="text" name="desc" value="<?php echo $desc; ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" value="Submit"></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
    </body>
</html>