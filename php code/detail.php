<?php
require "config2.php";
require "header.php";

$id = $_GET['id'];
$sql = "SELECT * FROM teams WHERE id = $id";
$query = $db->query($sql);
$team = $query->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM users WHERE teamId = :teamId";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':teamId' => $id
]);
$spelers = $prepare->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM users";
$query = $db->query($sql);
$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<h2><?=$team['teamName']?></h2>

<?php
if ( isset($_SESSION['id']) ) {
    echo "<form action='controller.php?id=$id' method='post'>
        <input type='hidden' name='type' value='addUserToTeam'>

        <label for='spelers'>Speler:</label>
        <select name='spelers'>";
            foreach ($users as $user){
                $user = $user['userName'];
                echo "<option name='$user' value='$user'>$user</option>";
            }
        echo "</select>
        <input class='button' type='submit' value='Add Player to Team'>
    </form>";
}
?>

<ul>
    <?php
    foreach ($spelers as $speler){
        $speler = $speler['userName'];
        echo "<li>$speler</li>";
    }
    ?>
</ul>

<?php require "footer.php";