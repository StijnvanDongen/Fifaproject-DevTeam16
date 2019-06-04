<?php
require "config2.php";
require "header.php";

$sql = "SELECT * FROM users WHERE scheids = :scheids";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':scheids' => 1
]);
$scheids = $prepare->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM users";
$query = $db->query($sql);
$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>
    <h2>Schiedsrechters</h2>
<?php
if (isset($_SESSION['id'])) {
    echo "<form action='controller.php' method='post'>
        <input type='hidden' name='type' value='addScheids'>
        <label for='spelers'>Speler:</label>
        <select name='spelers'>";
    foreach ($users as $user) {
        $user = $user['userName'];
        echo "<option name='$user' value='$user'>$user</option>";
    }
    echo "</select>
        <input class='button' type='submit' value='Add Scheidsrechter'>
    </form>";
}
?>

    <ul>
        <?php
        foreach ($scheids as $scheid) {
            $scheid = $scheid['userName'];
            echo "<li>$scheid</li>";
        }
        ?>
    </ul>

<?php require "footer.php";