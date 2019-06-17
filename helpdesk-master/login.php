<?php session_start(); ?>   
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
        <div class="form-div">
            <div class="form-style">
                <form action="" method="POST">
                    <p><input type="text" name="username" placeholder="Username" size="30"></p>
                    <p><input type="text" name="password" placeholder="Password" size="30"></p>
                    <input type="submit"name="submit" Value="Login">
                    <p>Not registered? <span><a href="signup.php" class="no-decor-a">Create an account</a></span></p>
                </form>
            </div>
        </div>
        <?php include_once 'includes/footer.php'; ?>
    </body>

</html>