<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css"/>
    <script src="https://kit.fontawesome.com/06f7e1b310.js" crossorigin="anonymous"></script>
    <title>Master Space Shooter</title>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo"><a href="/">MASTER SPACE SHOOTER</a> -> <a href="<?php echo isset($_SESSION['user']) ? '/download' : '/access' ?>">DESCARGAR</a></div>
            <ul class="nav-links">
                <input type="checkbox" id="checkbox_toggle" />
                <label for="checkbox_toggle" class="hamburger">&#9776;</label>
                <div class="header-menu">
                    <li><a class="hover-underline-animation" href="/#history">Historia</a></li>
                    <li><a class="hover-underline-animation" href="/#game">Juego</a></li>
                    <li><a class="hover-underline-animation" href="/#help">Apoya la causa</a></li>
                    <li><a class="hover-underline-animation" href="/#leaderboard">Leaderboard</a></li>
                    <div class="social">
                        <a href=""><i class="fa-brands fa-twitter"></i></a>
                        <a href=""><i class="fa-brands fa-instagram"></i></a>
                        <a href=""><i class="fa-brands fa-facebook"></i></a>
                    </div>
                    <div class="user">
                        <a href="<?php echo isset($_SESSION['user']) ? '/user' : '/access' ?>"><i class="fa-solid fa-user"></i></a>
                        <?php if( isset($_SESSION['user']) ){ ?>
                            <a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </ul>
        </nav>
    </header>