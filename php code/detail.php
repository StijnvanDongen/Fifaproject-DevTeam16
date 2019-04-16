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

<h1><?php echo $team['teamName'] ?></h1>