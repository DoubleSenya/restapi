<?php 

    $connect = mysqli_connect('localhost', 'root', 'root', 'restapi');

    if (!$connect)
        die(print_r('Проблема с подключением к БД'));