<?php

$conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");

if (!$conn) {
    echo "Connection to the server  not established";
} else {
    "";
}

if (isset($_POST["submit"])) {
    $user_name = htmlentities($_POST["username"]);
    $password = $_POST["password"];

    if (empty($user_name) || empty($password)) {
        echo "<p style=color:white;font-size:20px;>Please Enter your details</p>";
    }
    if (strpos($user_name, "$") !== 0) {
        $query = "SELECT contact.contact_id,contact.username,contact.password,customer.perm_level FROM contact JOIN customer ON contact.company_id = customer.company_id WHERE username=?";
    } else {
        $user_name = str_replace("$", "", $user_name);
        $query = "SELECT operator_id, username, password, Perm_level FROM operator WHERE username=?";
    }

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $user_name);

        if (mysqli_stmt_execute($stmt)) {
            echo "" . "<br>";
        } else {
            echo "Error could not execute " . mysqli_error($stmt);
        }

        mysqli_stmt_bind_result($stmt, $user_id, $user_name, $hash_pass, $perm_level);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) != 0) {

            while (mysqli_stmt_fetch($stmt)) {
                if ($verify = password_verify($password, $hash_pass)) {
                    echo "Login successfull" . "<br>";
                    $_SESSION["valid_id"] = $user_id;
                    $_SESSION["valid_name"] = $user_name;
                    $_SESSION["perm_level"] = $perm_level;

                    if (isset($_SESSION["valid_id"]) && isset($_SESSION["valid_name"]) && isset($_SESSION["perm_level"])) {
                        header("location:index.php");
                    }
                } else {
                    $messageError = "Incorrect user ID or password. Type the correct User Id and password. 
                    and try again";
                }
            }
        } else {
            $messageError = "Not Register Yet! Click Register Link";
        }

        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "error " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>