<?php
require "header.php";
?>

    <h2>Register.</h2>

    <form action="controller.php" method="post">
        <input type="hidden" name="type" value="register">

        <div class="form-group">
            <p>Email.</p>
            <input type="email" name="email" id="email" class="inputField" required>
        </div>

        <div class="form-group">
            <p>Username.</p>
            <input type="text" name="username" id="username" class="inputField" required>
        </div>

        <div class="form-group">
            <p><b>Password. </b>Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</p>
            <input type="password" name="password" id="password" class="inputField" minlength="8"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
        </div>

        <div class="form-group">
            <p>Please confirm your password.</p>
            <input type="password" name="password_confirm" id="password_confirm" class="inputField" required>
        </div>

        <!--    <label class="container">-->
        <!--        <input type="checkbox" required>-->
        <!--        <span>I agree with the <a href="tac.html">Terms And Conditions.</a></span>-->
        <!--    </label>-->

        <div class="form-group-buttons">
            <input class="button" type="submit" value="Register" class="submit">
        </div>

    </form>

<?php require "footer.php";