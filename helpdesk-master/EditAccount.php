<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Account</title>
        <link rel="stylesheet" href="vendor/Slick/slick.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fonts/fonts.css">
        <link rel="stylesheet" href="css/loginsystem.css">
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php include"includes/edit_account.php"; ?> 

        <div class="form-div">
            <div class="form-style">
                <form action="" method="POST">
                    <p><input type="text" name="username" placeholder="Username" size="35" required value="<?php echo $username ?>"></p>
                    <p><input type="email" name="email" placeholder="Email" size="35"required value="<?php echo $email ?>"></p>
                    <p><input type="text" name="phone" placeholder="Phone number" size="35" required value="<?php echo $phone ?>"></p>
                    <p><input type="text" name="firstname" placeholder="First Name" size="35" required value="<?php echo $firstname ?>"></p>
                    <p><input type="text" name="lastname" placeholder="Last Name" size="35" required value="<?php echo $lastname ?>"></p>                   
                    <input type="submit" name="update" Value="Save">
                </form>
            </div>
        </div>
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>