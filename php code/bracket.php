<?php
require "config2.php";
require "header.php";


echo "<h2>Poules</h2>";

$sql = "SELECT DISTINCT(group_id) FROM teams_groups";
$query = $db->query($sql);
$groups = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($groups as $group) {
    $group_id = $group["group_id"];
    echo "<h3>Poule: $group_id</h3>";

    $sql = "SELECT teams_groups.team_id,teams.teamName FROM teams_groups, teams 
                    where teams_groups.team_id=teams.id and group_id =$group_id";
    $query = $db->query($sql);
    $teams_perGroup = $query->fetchAll(PDO::FETCH_ASSOC);
    echo "<ol>";
    foreach ($teams_perGroup as $team) {
        echo "<li> " . $team["teamName"] . "</li>";
    }
    echo "</ol>";
}

print "<hr>";
echo "<h2>Wedstrijdschema:</h2>";

$sql = "SELECT * FROM wedstrijden";
$query = $db->query($sql);
$wedstrijden = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<li class='wedstrijd'>
    <h4>Team 1:</h4>
    <h4>vs</h4>
    <h4>Team 2:</h4>
    <h4>Starttijd:</h4>
    <h4>Speeltijd:</h4>
    <h4>Rusttijd:</h4>
    <h4>Veld:</h4>
    <h4>Poule:</h4>
</li>";

foreach ($wedstrijden as $wedstrijd) {
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

    $min = $wedstrijd['start'] % 60;
    $hour = ($wedstrijd['start'] - $min) / 60;
    if ($hour >= 24) {
        $hour = $hour - 24;
    }
    if ($hour < 10) {
        $hour = "0" . $hour;
    }
    if ($min < 10) {
        $min = "0" . $min;
    }

    $name = $wedstrijd['id'];

    $sql = "SELECT * FROM teams_groups WHERE team_id = :team1";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':team1' => $team1['id']
    ]);
    $group = $prepare->fetch(PDO::FETCH_ASSOC);

    echo "<li class='wedstrijd'>
        <p>{$team1['teamName']}</p>
        <p> vs </p>
        <p>{$team2['teamName']}</p>
        <p>{$hour}:{$min}</p>
        <p>{$wedstrijd['tijd']} min</p>
        <p>{$wedstrijd['rust']} min</p>
        <p>Veld {$wedstrijd['veld']}</p>
        <p>Poule {$group['group_id']}</p>
        <h4><a href='info.php?id={$wedstrijd['id']}'>Informatie</a></h4>
    </li>";
}

require "footer.php";