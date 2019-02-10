<!DOCTYPE html>
<html>
<head>
    <title>Gitar Keren</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="guitar shop"/>
    <meta name="keywords" content="guitar, shop, music"/>
    <meta name="author" content=""/>
    <link rel="stylesheet" type="text/css" href="../../app/resources/css/style.css">
    <link rel="stylesheet" href="../../app/resources/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="/app/resources/js/jquery.js"></script>
    <script type="text/javascript" src="/app/resources/js/banner.js"></script>
    <script type="text/javascript" src="/app/resources/js/slider.js"></script>
    <script type="text/javascript" src="../app/resources/js/burger.js"></script>
</head>
<body>
<div class="body">
<header id="header">
    <div id="headerTopLine">
        <h3>Viola! Welcome to <i>GITAR KEREN</i>, Find your dream guitar here! Happy shopping ^^</h3>
        <div id="headerTopLineButtons">
            <ul>
                <li><a href="/registration">REGISTER</a></li>
                <li><a href="/signin">
                        <?php  session_start();
                        echo !isset($_SESSION['user']) ? "SIGN IN" : "CABINET";
                        //$_SESSION['user1'] = $_SESSION['user'];
                        session_abort(); ?></a></li>
                <li><a href="/cart"><nobr class="fas fa-shopping-cart"></nobr>
                        CART <?php
                        require "app/models/CartModel.php";
                        echo (CartModel::countItems() == 0) ? "" : CartModel::countItems();?></a></li>
            </ul>
        </div>
    </div>
    <div id="navigation">
        <div id="logo">
            <a href="/main"><img src="/app/resources/images/gitarKerenLogo.png"></a>
        </div>
        <div id="navigationButtons">
            <ul>
                <li class="nameCategory"><a href="/main">HOME</a></li>
                <li class="nameCategory"><a href="/goods">GUITARS</a></li>
                <li class="nameCategory"><a href="/accessories">ACCESSORIES</a></li>
                <li class="nameCategory"><a href="/bestbuy">BEST BUY</a></li>
                <li class="nameCategory"><a href="/about_us">ABOUT US</a></li>
                <li class="nameCategory"><a href="/contact">CONTACT</a></li>
            </ul>
            <div class="buttonMenu"><span class="fas fa-bars" id=""></span></div>
        </div>

    </div>
    <div class="burger">
        <div id="menuBurger">
            <ul>
                <li class="nameCategory"><a href="/main">HOME</a></li>
                <li class="nameCategory"><a href="/goods">GUITARS</a></li>
                <li class="nameCategory"><a href="/accessories">ACCESSORIES</a></li>
                <li class="nameCategory"><a href="/bestbuy">BEST BUY</a></li>
                <li class="nameCategory"><a href="/about_us">ABOUT US</a></li>
                <li class="nameCategory"><a href="/contact">CONTACT</a></li>
            </ul>
        </div>
    </div>
</header>
    <div id="back">