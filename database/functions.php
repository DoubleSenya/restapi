<?php

    require_once 'connect.php';

    function getUsers()
    {
        $connect = $GLOBALS['connect'];

        $query = "SELECT * FROM users";
        $result = mysqli_query($connect, $query);

        $users = [];
        while ($user = mysqli_fetch_assoc($result))
            $users[] = $user;

        return $users;
    }

    function getLoggedUsers()
    {
        $connect = $GLOBALS['connect'];

        $deadTime = date('Y-m-d H:i:s', strtotime('-12000 seconds'));

        $query = "SELECT * FROM users WHERE `last_seen` >= '$deadTime'";
        $result = mysqli_query($connect, $query);

        $users = [];

        if ($result) 
        {
            while ($user = mysqli_fetch_assoc($result))
                $users[] = $user;
        }

        return $users;
    }

    function getNoTrophyUsers()
    {
        $connect = $GLOBALS['connect'];

        $query = "SELECT u.* FROM users u LEFT JOIN trophies t ON u.ID = t.user_id WHERE t.ID IS NULL";

        $result = mysqli_query($connect, $query);

        $users = [];
        while ($user = mysqli_fetch_assoc($result))
            $users[] = $user;

        return $users;
    }

    function getTrophies()
    {
        $connect = $GLOBALS['connect'];

        $query = "SELECT * FROM trophies";
        $result = mysqli_query($connect, $query);

        $trophies = [];
        while ($trophy = mysqli_fetch_assoc($result))
            $trophies[] = $trophy;

        return $trophies;
    }

    function addTrophyByUserId($userId)
    {
        $connect = $GLOBALS['connect'];

        $userId = mysqli_real_escape_string($connect, $userId);

        $query = "INSERT INTO trophies (`user_id`, `count`) VALUES ($userId, 1)";

        return mysqli_query($connect, $query);
    }

    function delTrophyById($id)
    {
        $connect = $GLOBALS['connect'];

        $id = mysqli_real_escape_string($connect, $id);

        $query = "DELETE FROM trophies WHERE `ID` = $id";

        return mysqli_query($connect, $query);
    }

    function existUser($userId)
    {
        $connect = $GLOBALS['connect'];
        $query = "SELECT * FROM users WHERE ID = $userId";

        return mysqli_query($connect, $query);
    }

    function checkAuth($login, $password)
    {
        $users = getUsers();

        foreach($users as $user)
        {
            if ($user['login'] == $login && $user['password'] = $password)
                return true;
        }

        return false;
    }

    function setLastSeenByLogin($login)
    {
        $connect = $GLOBALS['connect'];

        $query = "UPDATE users SET `last_seen` = NOW() WHERE `login` = '$login'";

        return mysqli_query($connect, $query);
    }