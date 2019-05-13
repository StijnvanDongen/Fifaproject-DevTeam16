<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/header.css">
    <link href="https://fonts.googleapis.com/css?family=Asap|Open+Sans" rel="stylesheet">
    <title>Fifa Dev-Team 16</title>
</head>
<body>
<header>
        <img src="./images/logo.png" alt="" height="75px" width="75px">
        <nav class="flex">
            <a class="button" href="index.php">Home</a> <br>
            <?php
                if ( !isset($_SESSION['id']) ) {
                    echo "
                        <a class=\"button\" href=\"register.php\">Registreren</a> <br>
                        <a class=\"button\" href=\"login.php\">Inloggen</a> <br>        
                    ";
                }
            ?>
            <a class="button" href="download.php">Download C#</a> <br>
            <a class="button" href="list.php">List (public)</a> <br>
            <?php
                //knoppen zijn alleen zichtbaar in het menu waneer er is ingelogd
                if (isset($_SESSION['id'])) {
                    echo "
                        <a class=\"button\" href=\"delete.php\">Delete team (admin only)</a> <br>
                        <a class=\"button\" href=\"addTeam.php\">Team aanmaken (logged-in users only)</a> <br>
                        <a class=\"button\" href=\"edit.php\">Edit existing team (logged-in users only)</a> <br>
                        <form action=\"controller.php\" method=\"post\">
                            <input type=\"hidden\" name=\"type\" value=\"logout\">
                            <input class=\"nav-item\" type=\"submit\" value=\"Log Out\">
                        </form>
                    ";
                }
            ?>
        </nav>
</header>
<main>
    <div class="container">
