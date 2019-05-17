<?php require "config2.php";
require "header.php";

if (!isset($_SESSION['id'])){
    header('location: login.php');
    exit;
}

$sql = "SELECT * FROM users WHERE username = :username";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':username' => $_SESSION['id'],
]);
$user = $prepare->fetch(PDO::FETCH_ASSOC);

if ($user['admin'] != 1){
    header('location: index.php');
}

?>

    <h1>admin page</h1>
    <p>jij bent geregistreerd als een admin dus hier kan jij alle teams zien en jij kan de ook verwijderen</p>
    <h2>DEZE ACTIE KAN NIET TERUG GEDRAAID WORDEN!!!</h2>

<?php

$sql = "SELECT * FROM teams";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<ul class=\"list\">";

foreach ($teams as $team){
    $id = $team['id'];
    $name = $team['teamName'];
    ?>

    <li class="del-item">
        <p><?=$name?></p>
        <form action="controller.php?id=<?=$id;?>" method="post">
            <input type="hidden" name="type" value="delete">
            <input type="submit" value="Delete <?=$name?>!">
        </form>
    </li>

    <?php
}

echo "</ul>";
require "footer.php";