<?php

    function route($method, $urlData, $data)
    {
        if ($method == 'GET' && empty($urlData))
        {
            $trophies = getTrophies();

            echo json_encode(array(
                'method' => 'GET',
                'users' => $trophies
            ));

            return;
        }

        if ($method == 'POST' && $urlData[0] == 'add')
        {
            $userId = $data['user_id'];

            $status = 'ok';

            if (existUser($userId))
            {

                if(!addTrophyByUserId($userId))
                    $status = 'error';

                echo json_encode(array(
                    'method' => 'POST',
                    'status' => $status,
                    'user_id' => $userId
                ));

                return;
            }

            $status = 'error';

            echo json_encode(array(
                'method' => 'POST',
                'status' => $status,
                'message' => 'User do not exist',
                'user_id' => $userId
            ));

            return;
        }

        if ($method == 'DELETE' && $urlData[0] == 'del')
        {
            $userId = $urlData[1];

            print_r($urlData);

            $status = 'ok';

            if (existUser($userId))
            {

                if(!delTrophyByUserId($userId))
                    $status = 'error';

                echo json_encode(array(
                    'method' => 'DELETE',
                    'status' => $status,
                    'user_id' => $userId
                ));

                return;
            }

            $status = 'error';

            echo json_encode(array(
                'method' => 'DELETE',
                'status' => $status,
                'message' => 'User do not exist',
                'user_id' => $userId
            ));

            return;
        }

        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }