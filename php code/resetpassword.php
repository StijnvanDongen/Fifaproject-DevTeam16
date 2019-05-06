<?php
require "header.php";
?>


    <form action="forgot_password.php" method="post">

        <div class="form-group">
            <p>Username.</p>
            <input type="text" name="username" id="username" class="inputField" required="required">
        </div>
        <input type="submit" value="reset my password">

    </form>

<?php require "footer.php";