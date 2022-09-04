<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>REST API</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
            crossorigin="anonymous">
        <style>
            body{
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            form{
                width: 500px;
            }

            p{
                font-size: 50px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                opacity: 0.2;
                user-select: none;
                color: blue;
            }
        </style>
    </head>
    <body>
        <?php
            require $page . '.php';
        ?>
    </body>
</html>