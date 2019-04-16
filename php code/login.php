<?php
require 'header.php';

?>
<div class="container">
    <h2>Login</h2>

    <form action="controller.php" method="post">
        <input type="hidden" name="type" value="login">
        <div class="form-group">
            <p>Email.</p>
            <input type="email" name="email" id="email" class="inputField">
        </div>

        <div class="form-group">
            <p>Username.</p>
            <input type="text" name="username" id="username" class="inputField">
        </div>

        <div class="form-group">
            <p>Password.</p>
            <input type="password" name="password" id="password" class="inputField">
        </div>

        <input type="submit" value="login">
    </form>
</div>