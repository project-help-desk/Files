<?php session_start();?>
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
    <header>
    <div class="container clearfix">
        <div class="logo">
            <a href="index.php">
                <img src="img/logo1.png" class="logo-pic" alt="Stenden SupportDesk logo">
            </a>
        </div>
        <div class="menu-btn not-active"><span></span>
        </div>
        <ul class="menu">
            <li><a href="#">Faq</a>
            </li>
            <li><a href="#">buy a license</a>
            </li>
            <li>
                <?php
                if(isset($_SESSION["valid_id"]) && isset($_SESSION["valid_name"])){
                    echo'<a href="dashboard.php">Dashboard</a>';
                } else {
                    echo'<a href="login.php">Login</a>';
                }
                ?>
            </li>
            <li>
                <?php
                if(isset($_SESSION["valid_id"]) && isset($_SESSION["valid_name"])){
                    echo'<a href="logout.php">Logout</a>';
                } else {
                    echo'<a href="signup.php">Sign up</a>';
                }
                ?>
            </li>
        </ul>
    </div>
</header>
    <?php include"includes/edit_account.php";?> 

    <div class="form-div">
        <div class="form-style">
            <form action="" method="POST">
              	<p><input type="text" name="username" placeholder="Name" size="30" required value="<?php echo $name?>"></p>
                <p><input type="email" name="email" placeholder="Email" size="30"required value="<?php echo $email?>"></p>
                <p><input type="text" name="company" placeholder="Company Name" size="30" required value="<?php echo $company?>"></p>
                <input type="submit"name="update" Value="Save">
            </form>
        </div>
    </div>
        <?php include_once 'includes/footer.php'; ?>
</body>
</html>