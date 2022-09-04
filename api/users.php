<?php
    
    require_once('C:/OpenServer/domains/restapi/database/functions.php');

    function route($method, $urlData, $data)
    {
        if ($method == 'GET' && empty($urlData))
        {
            $users = getUsers();

            echo json_encode(array(
                'method' => 'GET',
                'users' => $users
            ));

            return;
        }

        if ($method == 'GET' && $urlData[0] == 'logged')
        {
            $users = getLoggedUsers();

            echo json_encode(array(
                'method' => 'GET',
                'log_users' => $users
            ));

            return;
        }

        if ($method == 'GET' && $urlData[0] == 'notrophy')
        {
            $users = getNoTrophyUsers();

            echo json_encode(array(
                'method' => 'GET',
                'users' => $users
            ));

            return;
        }

        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }