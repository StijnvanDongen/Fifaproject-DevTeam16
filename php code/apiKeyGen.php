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
    die;
}

if ( isset( $_GET['msg'] ) ){
    $msg = "latest generated key : " . $_GET['msg'];
    echo  $msg;
}

?>

<form action="controller.php" method="post">
    <input type="hidden" name="type" value="keygen">

    <div class="form-group-buttons">
        <input class="button" type="submit" value="Generate New API Key" class="generate">
    </div>

</form>

<?php require "footer.php";

