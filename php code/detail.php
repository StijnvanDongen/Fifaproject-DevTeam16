<?php
/**
 * Created by PhpStorm.
 * User: Floris
 * Date: 16-4-2019
 * Time: 10:25
 */

require "config2.php";

$id = $_GET['id'];
$sql = "SELECT * FROM teams WHERE id = $id";
$query = $db->query($sql);
$team = $query->fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h1><?php echo $team['teamName'] ?></h1>
    <ul>
        <li><?php echo $team['player1']?></li>
        <li><?php echo $team['player2']?></li>
        <li><?php echo $team['player3']?></li>
        <li><?php echo $team['player4']?></li>
        <li><?php echo $team['player5']?></li>
        <li><?php echo $team['player6']?></li>
        <li><?php echo $team['player7']?></li>
        <li><?php echo $team['player8']?></li>
        <li><?php echo $team['player9']?></li>
        <li><?php echo $team['player10']?></li>
        <li><?php echo $team['player11']?></li>
    </ul>
</div>