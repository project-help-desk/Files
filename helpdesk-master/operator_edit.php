<?php session_start(); ?>   
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
        if (isset($_SESSION['valid_id'])) {
            if ($_SESSION['perm_level'] > 1) {
                $conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");
                if (!$conn) {
                    echo "Connection to the server  not established";
                }
                //add solution
                if (isset($_POST['solution'])) {
                    $solution = $_POST['solution'];
                } else {
                    $solution = NULL;
                }
                if (isset($_POST['update'])) {
                    $query = "UPDATE incident SET Status_id = ?, Operator_id = ?, Solution= ? WHERE Incident_id=?";
                    if (isset($_POST['solution'])) {
                        $status = 3;
                    } else {
                        $status = 1;
                    }
                    $operatorid = htmlentities($_SESSION["valid_id"]);
                    $ticketid = htmlentities($_GET["id"]);

                    if ($stmt = mysqli_prepare($conn, $query)) {
                        mysqli_stmt_bind_param($stmt, "iisi", $status, $operatorid, $solution, $ticketid);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "Update Successful" . "<br>";
                            echo "<a href=ticket_overview.php><button>Back to Ticket</button></a>";
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
                    mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
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
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="operatorid" value="$_SESSION['valid_id']">
                    <fieldset>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Description:</td>
                                    <td><?php echo $desc ?></td>
                                </tr>
                                <tr>
                                    <td>Solution:</td>
                                    <td><input type="text" name="solution"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="update" value="Save"></td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </form>
                <?php
            }
        }
        ?>
    </body>
</html>