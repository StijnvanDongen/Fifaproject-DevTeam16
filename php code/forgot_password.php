<?php
require "config2.php";
require "header.php";

$username = $_POST['username'];
?>
    <form action="controller.php?username=<?=$username?>" method="post">
        <input type="hidden" name="type" value="editpwd">
        <div class="form-group">
            <label for="ingredients">wachtwoord: </label>
            <input  type="password" name="password" id="password" required="required">
        </div>
        <input type="submit" value="edit password">
    </form>


<?php require "footer.php";



