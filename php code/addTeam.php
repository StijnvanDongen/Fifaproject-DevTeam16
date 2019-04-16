<?php
require "config2.php";
require 'header.php';


if (!isset($_SESSION['id'])){
    header('location: login.php');
    exit;
}

?>

<div class="container">
        <form action="controller.php" method="post">

            <input type="hidden" name="type" value="create">

            <div>
                <label for="teamName">Name of team</label>
                <input type="text" name="teamName" id="teamName" required>
            </div>

            <div>
                <label for="player1">Name Player1</label>
                <input type="text" name="player1" id="player1" required>
            </div>

            <div>
                <label for="player2">Name Player2</label>
                <input type="text" name="player2" id="player2" required>
            </div>

            <div>
                <label for="player3">Name Player3</label>
                <input type="text" name="player3" id="player3" required>
            </div>

            <div>
                <label for="player4">Name Player4</label>
                <input type="text" name="player4" id="player4" required>
            </div>

            <div>
                <label for="player5">Name Player5</label>
                <input type="text" name="player5" id="player5" required>
            </div>

            <div>
                <label for="player6">Name Player6</label>
                <input type="text" name="player6" id="player6" required>
            </div>

            <div>
                <label for="player7">Name Player7</label>
                <input type="text" name="player7" id="player7" required>
            </div>

            <div>
                <label for="player8">Name Player8</label>
                <input type="text" name="player8" id="player8" required>
            </div>

            <div>
                <label for="player9">Name Player9</label>
                <input type="text" name="player9" id="player9" required>
            </div>

            <div>
                <label for="player10">Name Player10</label>
                <input type="text" name="player10" id="player10" required>
            </div>

            <div>
                <label for="player11">Name Player11</label>
                <input type="text" name="player11" id="player11" required>
            </div>

            <input type="submit" value="Add this team!">
            </div>

        </form>
</div>
