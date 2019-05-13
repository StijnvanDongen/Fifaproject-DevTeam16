<?php require "config2.php";
require "header.php";

if (!isset($_SESSION['id'])){
    header('location: login.php');
    exit;
}

?>


    <form action="controller.php" method="post">

        <input type="hidden" name="type" value="create">

        <div>
            <label for="teamName">Name of team</label>
            <input type="text" name="teamName" id="teamName" required>
        </div>

        <input class="button" type="submit" value="Add this team!">

    </form>


<?php require "footer.php";