<?php
require 'header.php';
?>
<div class="container">
<form action="controller.php?id=<?=$id;?>" method="post">
    <input type="hidden" name="type" value="delete">
    <input type="submit" value="Delete this item!">
</form>
</div>