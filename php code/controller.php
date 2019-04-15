<?php
require 'config2.php';

if ($_POST['type'] == 'create') {

    $teamName = trim($_POST['teamName']);
    $player1 = trim($_POST['player1']);
    $player2 = trim($_POST['player2']);
    $player3 = trim($_POST['player3']);
    $player4 = trim($_POST['player4']);
    $player5 = trim($_POST['player5']);
    $player6 = trim($_POST['player6']);
    $player7 = trim($_POST['player7']);
    $player8 = trim($_POST['player8']);
    $player9 = trim($_POST['player9']);
    $player10 = trim($_POST['player10']);
    $player11 = trim($_POST['player11']);
    $madeBy = "";

    if($teamName != "" || $player1 != "" || $player2 != "" || $player3 != "" || $player4 != "" || $player5 != "" || $player6 != "" || $player7 != "" || $player8 != "" || $player9 != "" || $player10 != "" || $player11 != "" || $madeBy != "")
    {
        $sql = "INSERT INTO teams (teamName, player1, player2, player3, player4, player5, player6, player7, player8, player9, player10, player11, madeBy)
        VALUES  (:teamName, :player1, :player2, :player3, :player4, :player5, :player6, :player7, :player8, :player9, :player10, :player11, :madeBy)";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':teamName' => $teamName,
            ':player1' => $player1,
            ':player2' => $player2,
            ':player3' => $player3,
            ':player4' => $player4,
            ':player5' => $player5,
            ':player6' => $player6,
            ':player7' => $player7,
            ':player8' => $player8,
            ':player9' => $player9,
            ':player10' => $player10,
            ':player11' => $player11,
            ':madeBy' => $madeBy,
        ]);

        $msg = "Team Is Succesvol Toegevoegd!";
        header("location: apihandler.php?msg=$msg");
        exit;
    }
    $msg = "er is iets fout gegaan!";
    header("location: apihandler.php?msg=$msg");
    exit;

}

if ($_POST['type'] == 'register') {

    $email = trim($_POST['email']);
    $userName = trim($_POST['username']);
    $password1 = trim($_POST['password']);
    $password2 = trim($_POST['password_confirm']);

    $uppercase = preg_match('@[A-Z]@', $password1);
    $lowercase = preg_match('@[a-z]@', $password1);
    $number    = preg_match('@[0-9]@', $password1);

    $user_check_query = $db->prepare("SELECT * FROM users WHERE email=?");
    $user_check_query->execute([$email]);
    $account = $user_check_query->fetch();

    if ($account) {

        ?>
        <script type="text/javascript">
            alert("this email is already in use");
            window.location.href = "register.php";
        </script>
        <?php

    }
    else
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            echo("$email is not a valid email address");

        }
        else
        {
            if ($password1 === $password2) {

                if (!$uppercase || !$lowercase || !$number || strlen($password1) < 8) {
                    ?>

                    <script type="text/javascript">
                        alert("uw wachtwoord moet aan de voorwaarden voldoen");
                        window.location.href = "register.php";
                    </script>

                    <?php
                    exit;
                }
                $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (userName, email, password)
                        VALUES (:userName, :email, :passwordHash)";
                $prepare = $db->prepare($sql);
                $prepare->execute([
                    ':userName' => $userName,
                    ':email' => $email,
                    ':passwordHash' => $passwordHash
                ]);

                ?>
                <script type="text/javascript">
                    alert("You have succesfully been registered");
                    window.location.href = "login.php";
                </script>
                <?php
            } else {
                ?>
                <script type="text/javascript">
                    alert("The passwords do not match");
                    window.location.href = "register.php";
                </script>
                <?php
            }
        }
    }
}

if ($_POST['type'] == 'login') {

    require 'config2.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_login_email_check_query = $db->prepare("SELECT * FROM users WHERE email=?");
    $user_login_email_check_query->execute([$email]);
    $account = $user_login_email_check_query->fetch();
    if ($account) {
        // email has been found

        $sql = "SELECT * FROM users WHERE email = :email";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':email' => $email
        ]);
        $account = $prepare->fetch(PDO::FETCH_ASSOC);

        $storedPassword = $account['password'];

        if ($account) {

            $hashedPassword = $account['password'];

            if (password_verify($password, $storedPassword)){
                // everything is oke

                $id = $account['id'];
                $_SESSION['id'] = $id;
                header( 'location: apihandler.php');
            }
            else {
                ?>
                <script type="text/javascript">
                    alert("Wrong password!");
                    window.location.href = "login.php";
                </script>
                <?php
            }

        } else {
            ?>
            <script type="text/javascript">
                alert("Password not found!");
                window.location.href = "login.php";
            </script>
            <?php
        }

    } else {
        ?>
        <script type="text/javascript">
            alert("Email not found!");
            window.location.href = "login.php";
        </script>
        <?php
    }

    exit;
}
