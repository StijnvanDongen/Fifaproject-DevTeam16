<?php
require "config2.php";
require "header.php";

$id = $_GET['id'];

$sql = "SELECT * FROM teams WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $id,
]);
$team = $prepare->fetch(PDO::FETCH_ASSOC);



?>

    <div class="container">
        <h2>Edit This Team!</h2>

        <form action="controller.php?id=<?=$id?>" method="post">

            <input type="hidden" name="type" value="edit">

            <div>
                <label for="teamName">Team Name</label>
                <input type="text" name="teamName" id="teamName" value="<?= $team['teamName']?>">
            </div>

            <div>
                <label for="player1">Name Player1</label>
                <input type="text" name="player1" id="player1" value="<?= $team['player1']?>">
            </div>

            <div>
                <label for="player2">Name Player2</label>
                <input type="text" name="player2" id="player2" value="<?= $team['player2']?>">
            </div>

            <div>
                <label for="player3">Name Player3</label>
                <input type="text" name="player3" id="player3" value="<?= $team['player3']?>">
            </div>

            <div>
                <label for="player4">Name Player4</label>
                <input type="text" name="player4" id="player4" value="<?= $team['player4']?>">
            </div>

            <div>
                <label for="player5">Name Player5</label>
                <input type="text" name="player5" id="player5" value="<?= $team['player5']?>">
            </div>

            <div>
                <label for="player6">Name Player6</label>
                <input type="text" name="player6" id="player6" value="<?= $team['player6']?>">
            </div>

            <div>
                <label for="player7">Name Player7</label>
                <input type="text" name="player7" id="player7" value="<?= $team['player7']?>">
            </div>

            <div>
                <label for="player8">Name Player8</label>
                <input type="text" name="player8" id="player8" value="<?= $team['player8']?>">
            </div>

            <div>
                <label for="player9">Name Player9</label>
                <input type="text" name="player9" id="player9" value="<?= $team['player9']?>">
            </div>

            <div>
                <label for="player10">Name Player10</label>
                <input type="text" name="player10" id="player10" value="<?= $team['player10']?>">
            </div>

            <div>
                <label for="player11">Name Player11</label>
                <input type="text" name="player11" id="player11" value="<?= $team['player11']?>">
            </div>

            <input type="submit" value="Verzend">

        </form>
    </div>
<?php

require "footer.php";
