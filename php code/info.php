<?php
require "config2.php";
require "header.php";

$id = $_GET['id'];
$sql = "SELECT * FROM wedstrijden WHERE id = $id";
$query = $db->query($sql);
$infowedstrijd = $query->fetch(PDO::FETCH_ASSOC);

echo "<h2>info:</h2>";

echo "<li class='wedstrijd'>
    <h4>Team 1:</h4>
    <h4>vs</h4>
    <h4>Team 2:</h4>
    <h4>Starttijd:</h4>
    <h4>Veld:</h4>
</li>";


$sql = "SELECT * FROM teams WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $infowedstrijd['team1']
]);
$team1 = $prepare->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM teams WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $infowedstrijd['team2']
]);
$team2 = $prepare->fetch(PDO::FETCH_ASSOC);

$name = $infowedstrijd['id'];

echo "<li class='wedstrijd'>
    <p>{$team1['teamName']}</p>
    <p> vs </p>
    <p>{$team2['teamName']}</p>
    <p>{$infowedstrijd['tijd']} min</p>
    <p>Veld {$infowedstrijd['veld']}</p>
</li>";


$id = $_GET['id'];
$sql = "SELECT * FROM wedstrijden WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$wedstrijd = $prepare->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM users WHERE teamId = :teamId";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':teamId' => $wedstrijd['team1']
]);
$spelers1 = $prepare->fetchall(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM users WHERE teamId = :teamId";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':teamId' => $wedstrijd['team2']
]);
$spelers2 = $prepare->fetchall(PDO::FETCH_ASSOC);

foreach ($spelers1 as $speler1) {
    echo "<table class='scoor' >
  <tr>
    <th>spelers Team 1</th>
    <th>Gescored</th> 
  </tr>
  <tr>
    <td>{$speler1['userName']}</td>
    <td>ja</td>
  </tr>  
</table>";
}

foreach ($spelers2 as $speler2) {
    echo "<table class='scoor' >
  <tr>
    <th>spelers Team 2</th>
    <th>Gescored</th> 
  </tr>
  <tr>
    <td>{$speler2['userName']}</td>
    <td>ja</td>
  </tr>  
</table>";
}

require "footer.php";