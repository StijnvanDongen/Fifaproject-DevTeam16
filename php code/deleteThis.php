<?php
require "header.php";
?>

    <form action="controller.php?id=<?=$id;?>" method="post">
        <input type="hidden" name="type" value="delete">
        <input type="submit" value="Delete this item!">
    </form>

<?php require "footer.php";