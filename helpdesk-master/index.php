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
    </head>

    <body>
        <?php include_once 'includes/header.php'; ?>
        <div class="banner-block clearfix">
            <div class="container">
                <div class="banner-txt">
                    <h2>We are <span>here to </span>help you!</h2><span class="line"> </span>
                    <p>Find the solution for your problem</p><a href="#">Get started</a>
                </div>
            </div>
        </div>
        <div class="lf-fl-block">
            <div class="container">
                <div class="fl-inner clearfix">
                    <div class="lf-fl-img-block">
                        <img src="img/lf-fl-img.png" alt="">
                    </div>
                    <div class="lf-fl-txt-block">
                        <h4>Find <span>the right solution </span>for your problem </h4>
                        <p>Stenden Helpdesk is a professional help desk with years of experience to help you with your technical problems.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="rh-fl-block">
            <div class="container">
                <div class="rh-fl-inner clearfix">
                    <div class="rh-fl-img-block">
                        <img src="img/rh-fl-img.png" alt="">
                    </div>
                    <div class="rh-fl-txt-block">
                        <h4>Buy a maintenace license and <span>become a part </span>of our community</h4>
                        <p>By buying a license you get immediate access to our helpdesk where you can get professional help with your problem!</p>
                    </div>
                </div>
            </div>
        </div>

        <script src="vendor/jquery/jquery-3.2.0.min.js"></script>
        <script src="js/core.js"></script>
        <?php include_once 'includes/footer.php'; ?>
    </body>

</html>