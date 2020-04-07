<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <div class="container">
            <div class="login_input">
                <div class="form">
                <form action="" method="POST">    
                        <div class="reg-titles">
                        <div class="reg-logo">
                            Danil Markov
                        </div>
                        <div class="reg-name">
                            Регистрация
                        </div>
                        </div>      
                        <form action="" method="POST">
                            <div class="input_data">    
                                <input type="text" placeholder="Логин" size="50" name="login" class="reg-input">
                                <input type="password" placeholder="Пароль" size="50" name="password" class="reg-input">
                                <?php
                                    if (isset($_POST['login']) && isset($_POST['password'])) {  
                                        $login = $_POST['login'];
                                        $password = md5($_POST['password']);
                                        $mysql = new mysqli('127.0.0.1:3306','root','','users');
                                        $authQuery = "SELECT * FROM `users` WHERE `login` = '$login'";
                                    if (!$result = $mysql->query($authQuery)) {
                                        die('Ошибка запроса: '. $mysqli->error);
                                    }
                                    if (!$result->num_rows) {
                                        echo('<font color="red">Неверный логин или пароль!</font>');
                                    } else {
                                        $user = $result->fetch_assoc();
                                    if ($user['password'] !== $password) {
                                        echo('<font color="red">Неверный логин или пароль!</font>');
                                    } else {
                                        $_SESSION['user'] = $user;
                                    }
                                    }
                                    }
                                ?>
                            </div>
                            <input type="submit" class="login-btn" value="Войти">
                        </form>
                        <a href="registration.php" class="login_reg-btn">Регистрация</a>
                        <?php
                         if (isset($_SESSION['user'])) {
                            echo("<div class='login-greeting'><h1>Добро пожаловать, " . $_SESSION['user']['name'] . "</h1></div>");
                            echo("<div class='login_succes_btn'><a href='index.php'>На главную</a></div>");
                        }
                        ?>
                </div>
            </div>
            <div class="reg-links">
                        <a href="index.php">На главную</a>
            </div>
        </div>    
    </section>
</body>
</html>