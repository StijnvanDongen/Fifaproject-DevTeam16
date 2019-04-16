<?php
require "config2.php";

    $sql = "SELECT * FROM teams";
    $query = $db->query($sql);
    $teams = $query->fetchAll(PDO::FETCH_ASSOC);

    echo "<h1>hier onder zie je een lijst met alle teams</h1>";
    echo "<ul>";

    foreach ($teams as $team){

        $name = $team['teamName'];
        $id = $team['id'];

        echo "<li><a href='detail.php?id=$id'>$name</a></li>";

    }
    echo "</ul>";


