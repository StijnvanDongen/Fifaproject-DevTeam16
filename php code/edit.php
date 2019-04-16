<?php require "config2.php";

?>

<h1>hier kunt u een team kiezen dat u wilt aanpassen</h1>
<p>hier ziet u al uw aangemaakte teams</p>

<?php

$madeBy = $_SESSION['id'];

$sql = $db->prepare("SELECT * FROM teams WHERE madeBy=?");
$sql->execute([$madeBy]);
$teams = $sql->fetchAll(PDO::FETCH_ASSOC);

echo "<ul>";

foreach ($teams as $team){
    $id = $team['id'];
    $name = $team['teamName'];
    ?>

    <li><a href="editThis.php?id=<?=$id?>"><?=$name?></a></li>

<?php
}

echo "</ul>";



