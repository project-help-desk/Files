<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index Page</title>
        <link rel="stylesheet" href="vendor/Slick/slick.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fonts/fonts.css">
        <link rel="stylesheet" href="css/loginsystem.css">
    </head>

    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php
        include"CreateAcc.php";
        ?>

        <div class="form-div">
            <div class="form-style">
                
                <form action="" method="POST">
                    <span class="login-error">
                        <?php
                        if (isset($nameError)) {
                            echo $nameError . " ";
                        }
                        if (isset($emailError)) {
                            echo $emailError;
                        }
                        ?>
                    </span>
                    <?php
                    if(isset($_POST['newAccount']) || isset($_POST['newComp'])){
                        echo ' 
                            <p><input type="text" name="username" placeholder="Username" size="35" required></p>
                            <p><input type="password" name="password" placeholder="Password" size="35" required></p>
                            <p><input type="email" name="email" placeholder="Email" size="35"required></p>
                            <p><input type="text" name="firstname" placeholder="First Name" size="35" required></p>
                            <p><input type="text" name="lastname" placeholder="Last Name" size="35" required></p>
                            <p><input type="text" name="phone" placeholder="Phonenumber" size="35" required></p>
                        ';
                        if(isset($_POST['newAccount'])){
                            echo '<p><input type="text" name="licence" placeholder="Licence Code" size="35" required></p>';
                            echo '<p><input type="submit"name="submitAcc" Value="Register"></p>';
                        } else {
                            echo '<p><input type="text" name="company" placeholder="Company Name" size="35" required></p>';
                            echo '<p><input type="text" name="licence" placeholder="Licence Code (if available)" size="35"></p>';
                            echo '<p><input type="submit"name="submitComp" Value="Register"></p>';
                        }
                        
                    } else {
                        
                        echo '<div class=form-box><p>Is your company already registered with us?</p>
                    <p><input type="submit"name="newAccount" Value="Yes, our company is already registered."></p>
                    <p><input type="submit"name="newComp" Value="No, we haven&apos;t registered yet."></p></div>';
                    }
                    ?>
                </form>
            </div>
        </div>
<?php include_once 'includes/footer.php'; ?>
    </body>
</html>