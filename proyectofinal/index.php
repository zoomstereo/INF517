<?php

$URI = explode('?', $_SERVER["REQUEST_URI"], 2)[0];
// Diferent vars for the switch cases, depending on the URI
$case_admin = '/';
$case_usuarios = '/usuarios.php';
$case_usuario_details = '/edit.php';
$case_nuevo_usuario = '/new.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Admin</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="static/normalize.css" media="screen" title="no title">
        <link rel="stylesheet" href="static/font-awesome.min.css" media="screen" title="no title">
        <link rel="stylesheet" href="static/style.css" media="screen" title="no title">
        <?php
        switch ($URI) {
            case $case_admin: ?>
                <link rel="stylesheet" href="static/details.css" media="screen" title="no title">
                <?php
                break;
            case $case_nuevo_usuario:
            case $case_usuario_details:
            case $case_usuarios: ?>
                <link rel="stylesheet" href="static/usuarios.css" media="screen" title="no title">
                <?php
                break;
        }
        ?>
    </head>
    <body>

        <header>
            <div class="logo">
                <a id="menu-btn" href="#"><i class="menu-btn fa fa-bars" aria-hidden="true"></i></a>
                <a href="/admin/">Proyecto final INF-517</a>
            </div>
        </header>

        <div class="container">

            <div id="side-nav" class="side-nav">
                <ul>
                    <?php
                    switch ($URI) {
                        case $case_usuario_details:
                            ?>
                            <a href="/">
                                <li><i class="fa fa-home" aria-hidden="true"></i> Home</li>
                            </a>
                            <a href="/new.php">
                                <li><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</li>
                            </a>
                            <script src="static/main.js">

                            </script>
                            <?php
                            break;
                        case $case_admin:
                            ?>
                            <a href="/">
                                <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Home</li>
                            </a>
                            <a href="/new.php">
                                <li><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</li>
                            </a>
                            <script src="static/main.js">

                            </script>
                            <?php
                            break;

                        case $case_nuevo_usuario:
                        case $case_usuarios:
                            ?>
                            <a href="/">
                                <li><i class="fa fa-home" aria-hidden="true"></i> Home</li>
                            </a>
                            <a href="/new.php">
                                <li class="active"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</li>
                            </a>
                            <?php
                            break;
                    }
                    ?>

                </ul>
            </div>

            <div class="content">
                <!-- Here ends the template, here begins the content side  -->
                <?php
                    if($URI == $case_admin) {
                        include 'details.php';
                    }
                ?>
