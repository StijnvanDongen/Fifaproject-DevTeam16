<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fifa Dev-Team 16</title>
    <style>
        .container {
            max-width: 960px;
            margin: 0 auto;


        }

        footer {
            max-width: 960px;
            margin: 0 auto;
        }

        .logo {
            align-items: center;
        }

        ul {
            text-align: center;
            list-style: none;
            display: flex;
            justify-content: space-between;

        }

        li > a {
            text-decoration: none;
            color: black;
        }

        .other a {
            align-items: center;
            display: flex;
            justify-content: space-between;
            text-decoration: none;
            color: blue;
            background: white;
        }

        .other {
            background: white;
        }

        * {
            background-color: #0078d7;
        }

    </style>
</head>
<header>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="index.php"><img src="./images/logo.png" alt="" height="10%" width="10%"></a>

            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="register.php">Registreren</a></li>
                <li><a href="login.php">Inloggen</a></li>
                <li><a href="addTeam.php">Team aanmaken (logged-in users only)</a></li>
            </ul>

        </div>


    </div>

</header>

<div class="container">

    <ul class="other">
        <li><a href="download.php">Download C#</a></li>
        <li><a href="list.php">list (public)</a></li>
        <li><a href="delete.php">delete team (admin only)</a></li>
        <li><a href="edit.php">edit existing team (logged-in users only)</a></li>
    </ul>

</div>
<body>




