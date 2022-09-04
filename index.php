<?php

    function getFormData($method)
    {
        if ($method == 'POST') return $_POST;

        return [];
    }

    require_once './database/functions.php';

    $url = (isset($_GET['q'])) ? $_GET['q'] : '';
    $url = rtrim($url, '/');
    $urls = explode('/', $url);
    
    if ($url == '')
    {
        session_start();

        if (empty($_SESSION['auth']))
        {
            $page = 'auth';
        }
        else
        {
            $page = 'home';
            setLastSeenByLogin($_SESSION['login']);
        }

        require './template/main.php';
    }
    else
    {

        if ($urls[0] == 'check')
        {
            if(checkAuth($_POST['login'], $_POST['password']))
            {
                $_SESSION['auth'] = true;
                $_SESSION['login'] = $_POST['login'];

                if(setLastSeenByLogin($_POST['login'])) echo 'logged';
                else echo 'dont work';
                
                $page = 'home';

               require './template/main.php';
            }
        }
        else if($urls[0] == 'users' || $urls[0] == 'trophy')
        {
            $method = $_SERVER['REQUEST_METHOD'];
            $formData = getFormData($method);

            $router = $urls[0];
            $urlData = array_slice($urls, 1);

            include_once 'api/' . $router . '.php';
            route($method, $urlData, $formData);
        }
        else
        {
            $page = '404';
            require './template/main.php';
        }
    }

    mysqli_close($connect);