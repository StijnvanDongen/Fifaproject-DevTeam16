<?php
require "config2.php";
require "header.php";

if (!isset($_SESSION['id'])) {
    echo 'you are not logged in to see content.';
} else {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE userName = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $id
    ]);
    $account = $prepare->fetch(PDO::FETCH_ASSOC);

    echo "<h4>Welcome {$account['userName']}</h4>";
}

$sql = "SELECT DISTINCT(group_id) FROM teams_groups";
$query = $db->query($sql);
$groups = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($groups as $group) {
    $group_id = $group["group_id"];

    $sql = "SELECT teams_groups.team_id,teams.teamName,teams.teamScore FROM teams_groups, teams 
                    where teams_groups.team_id=teams.id and group_id =$group_id";
    $query = $db->query($sql);
    $teams_perGroup = $query->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class='poule'>";
    echo "<ol>";
    echo "<h3>Poule: $group_id</h3>";
    foreach ($teams_perGroup as $team) {
        echo "<li> " . $team["teamName"] . "</li>";
    }
    echo "</ol>";

    echo "<ol>";
    echo "<h3>  Punten </h3>";

    foreach ($teams_perGroup as $team) {
        echo "<div> " . $team["teamScore"] . "</div>";
    }

    echo "</ol>";
    echo "</div>";


}
$sql = "SELECT * FROM wedstrijden";
$query = $db->query($sql);
$wedstrijden = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<li class='wedstrijden'>
    <h4>Team 1:</h4>
    <h4>vs</h4>
    <h4>Team 2:</h4>
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

    echo "<li class='wedstrijden'>
        <p>{$team1['teamName']}</p>
        <p> vs </p>
        <p>{$team2['teamName']}</p>
    </li>";
}
require "footer.php";