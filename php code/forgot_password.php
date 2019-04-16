<?php
require 'header.php';
require 'config2.php';
$sql = "SELECT * FROM teams";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);




?>
<form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Forgot Password</h2>
        <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">@</span>
	  <input type="text" name="username" class="form-control" placeholder="Username" required>
	</div>
	<br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Forgot Password</button>
        <script type="text/javascript">
        alert(<?php foreach($teams as $team){
                $password1 = htmlentities($team['password']);

                echo "{$team['password']}";

                } ?>);
        window.location.href = "index.php";
        </script>
        <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>
      </form>
