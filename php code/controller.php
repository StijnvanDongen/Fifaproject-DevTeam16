<?php
require 'config2.php';

if ($_POST['type'] == 'create') {

    $teamName = trim($_POST['teamName']);
    $madeBy = trim($_SESSION['id']);

    if ($teamName != "" || $madeBy != "") {
        $sql = "INSERT INTO teams (teamName, madeBy)
        VALUES  (:teamName, :madeBy)";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':teamName' => $teamName,
            ':madeBy' => $madeBy
        ]);

        $msg = "Team Is Succesvol Toegevoegd!";
        header("location: list.php?msg=$msg");
        exit;
    }
    $msg = "er is iets fout gegaan!";
    header("location: addTeam.php?msg=$msg");
    exit;

}

if ($_POST['type'] == 'register') {

    $email = trim($_POST['email']);
    $userName = trim($_POST['username']);
    $password1 = trim($_POST['password']);
    $password2 = trim($_POST['password_confirm']);

    $uppercase = preg_match('@[A-Z]@', $password1);
    $lowercase = preg_match('@[a-z]@', $password1);
    $number = preg_match('@[0-9]@', $password1);

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

    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            echo("$email is not a valid email address");

        } else {
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

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_login_email_check_query = $db->prepare("SELECT * FROM users WHERE userName=?");
    $user_login_email_check_query->execute([$username]);
    $account = $user_login_email_check_query->fetch();
    if ($account) {
        $sql = "SELECT * FROM users WHERE userName = :userName";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':userName' => $username
        ]);
        $account = $prepare->fetch(PDO::FETCH_ASSOC);
        $storedPassword = $account['password'];
        if ($account) {
            $hashedPassword = $account['password'];
            if (password_verify($password, $storedPassword)) {
                $id = $account['id'];
                $_SESSION['id'] = $username;
                header('location: Dashboard.php');
            } else {
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

if ($_POST['type'] == 'editpwd') {
    $password = $_POST{'password'};
    $username = $_GET{'username'};

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users 
            SET
            userName = :username,
            password = :password
            WHERE userName = :username";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':password' => $passwordHash,
        ':username' => $username,
    ]);

    header('location: index.php');
    exit;
}

if ($_POST['type'] == 'edit') {

    $teamName = trim($_POST['teamName']);
    $madeBy = trim($_SESSION['id']);
    $id = $_GET['id'];

    $sql = "UPDATE teams 
            SET
            teamName = :teamName,
            madeBy = :madeBy
            WHERE id = $id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':teamName' => $teamName,
        ':madeBy' => $madeBy,
    ]);

    $msg = "Het Item Is Succesvol Aangepast!";
    header("location: index.php?msg=$msg");
}

if ($_POST['type'] == 'delete') {

    $sql = "DELETE from teams WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $_GET['id']
    ]);

    $msg = "Item is succesvol verwijderd!";
    header("location: index.php?msg=$msg");
    exit;
}

if ($_POST['type'] == 'logout') {
    unset($_SESSION['id']);
    header("Location: index.php");
}

if ($_POST['type'] == 'makeWedstrijdschema') {
    $tijd = $_POST['tijd'];
    $rusttijdens = $_POST['rusttijdens'];
    $rustna = $_POST['rustna'];
    $startH = $_POST['startH'];
    $startM = $_POST['startM'];
    $veldamount = $_POST['veld'];
    $group_Count = $_POST['poules'];

    $sql = "SELECT * FROM teams";
    $query = $db->query($sql);
    $teams = $query->fetchAll(PDO::FETCH_ASSOC);
    $teamsAmount = count($teams);

    if ($teamsAmount % $group_Count != 0) {
        $message = "Het resultaat van het aantal teams / aantal groepen moet integer zijn";
        header("Location: list.php?msg=$message");
    } else {
        $NTeamsPerGroup = $teamsAmount / $group_Count;
        $array = array();
        $groupName = 1;
        $loopCounter = 0;
        $sql = "DELETE FROM teams_groups";
        $query = $db->query($sql);

        foreach ($teams as $t) {
            $array[$t["id"]] = $groupName;
            $sql = "INSERT INTO teams_groups (team_id, group_id) VALUES (:team_id, :group_id)";
            $prepare = $db->prepare($sql);
            $prepare->execute([
                ':team_id' => $t["id"],
                ':group_id' => $groupName
            ]);

            $loopCounter++;
            if ($loopCounter == $NTeamsPerGroup) {
                $loopCounter = 0;
                $groupName++;
            }
        }


        $start = ($startH * 60) + $startM;

        $sql = "DELETE FROM wedstrijden";
        $query = $db->query($sql);


        $wedstrijdAmount = (($teamsAmount * $teamsAmount) - $teamsAmount) / 2;

        $Group_wedstrijdAmount = (($NTeamsPerGroup * $NTeamsPerGroup) - $NTeamsPerGroup) / 2;
        $veld = 1;


        for ($GG = 1; $GG <= $group_Count; $GG++) {
            $sql = "SELECT * FROM teams_groups WHERE group_id =$GG";
            $query = $db->query($sql);
            $teams_perGroup = $query->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < $Group_wedstrijdAmount; $i++) {
                $team1 = $teams_perGroup[$i]['team_id'];
                for ($x = $i + 1; $x < $NTeamsPerGroup; $x++) {
                    $team2 = $teams_perGroup[$x]['team_id'];

                    $sql = "INSERT INTO wedstrijden (team1, team2, start, tijd, rust, veld,group_id) VALUES (:team1, :team2, :start, :tijd, :rust, :veld, :group_id)";
                    $prepare = $db->prepare($sql);
                    $prepare->execute([
                        ':team1' => $team1,
                        ':team2' => $team2,
                        ':start' => $start,
                        ':tijd' => $tijd,
                        ':rust' => $rusttijdens,
                        ':veld' => $veld,
                        ':group_id' => $GG
                    ]);
                    if ($veld == $veldamount) {
                        $veld = 1;
                        $start = $start + $tijd + $rustna + $rusttijdens;
                    } else {
                        $veld++;
                    }

                }
            }

        }
        header("Location: bracket.php?velden=$veldamount");
    }
}

if ($_POST['type'] == 'addUserToTeam') {
    $id = $_GET['id'];
    $user = $_POST['spelers'];

    $sql = "UPDATE users SET teamId = :teamId WHERE userName = :user";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':teamId' => $id,
        ':user' => $user
    ]);

    header("Location: detail.php?id=$id");
}

if ($_POST['type'] == 'keygen') {
    $key_new_gen = md5(uniqid(rand(), true));
    var_dump($key_new_gen);

    $sql = "INSERT INTO apikeys (apikey) VALUES (:key)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':key' => $key_new_gen
    ]);

    $msg = $key_new_gen;
    header("location: apiKeyGen.php?msg=$msg");
}
