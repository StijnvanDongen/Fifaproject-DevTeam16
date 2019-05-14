<?php
require "config2.php";
require "header.php";

echo "<h2>Wedstrijdschema:</h2>";

$sql = "SELECT * FROM wedstrijden";
$query = $db->query($sql);
$wedstrijden = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($wedstrijden as $wedstrijd){
    $sql = "SELECT * FROM teams WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $wedstrijd['team1']
    ]);
    $team1 = $prepare->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM teams WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $wedstrijd['team2']
    ]);
    $team2 = $prepare->fetch(PDO::FETCH_ASSOC);

    echo "<li>{$team1['teamName']} vs {$team2['teamName']}</li>";

}

require "footer.php";