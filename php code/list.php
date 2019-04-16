<?php
require "config2.php";
require 'header.php';


    $sql = "SELECT * FROM teams";
    $query = $db->query($sql);
    $teams = $query->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class='container'><h1>hier onder zie je een lijst met alle teams</h1></div>";
    echo "<div class='container'>
                 <ul>
                </div>";

    foreach ($teams as $team){

        $name = $team['teamName'];

        echo "<li>$name</li>";

    }
    echo "</ul>";


