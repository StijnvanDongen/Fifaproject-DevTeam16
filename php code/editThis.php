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

        <input type="submit" value="Submit">
            </div>
                <input type="text" name="teamName" id="teamName" value="<?= $team['teamName']?>">
                <label for="teamName">Team Name</label>
            <div>

    </form>

        </form>
    </div>
<?php

require "footer.php";
