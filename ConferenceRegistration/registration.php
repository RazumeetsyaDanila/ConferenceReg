<?php
    session_start();
    if($_SESSION['user']){
        header('Location: profile.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <title>Регистрация</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/functions.js"></script>
</head>
<body>
    <!--Форма регистрации-->
    <form action="invisible/signup.php" method="post" enctype="multipart/form-data" style="padding-top: 4vh">
        <div class="form">
            <h1>Регистрация</h1>
            <p>Пожалуйста, заполните все поля, чтобы зарегистрировать аккаунт.</p>
            <hr>
            <input type="text" placeholder="Введите имя" name="name" required pattern="(?=.*[А-Яа-яЁё]).{2,}"
                   title="Имя может содержать только русские буквы, минимальная длина – 2 символа"required>
            <input type="text" placeholder="Введите логин" name="login" required>
            <input type="email" placeholder="Введите Email" name="email" required>
            <input type="password" placeholder="Введите пароль" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                   title="Пароль должен содержать как минимум одну букву верхнего и нижнего регистра, минимальная длина – 6 символов"required>
            <input type="password" placeholder="Повторите пароль" name="password_confirm" required>
            <hr>
            <input type="checkbox" id="myCheck" onclick="check_of_consent()" style="transform:scale(1.3)">Принимаю пользовательское соглашение<br>
            <button type="submit" class="submitbtn" id="submitbtn" style="display:none"><span>Зарегистрироваться</span></button>
        </div>

        <div class="ihave">
            <p>У вас уже есть аккаунт? <a href="index.php">Войти</a>.</p>
        </div>

       <?php
        if($_SESSION['message']){
            echo '<p1 class="msg">' . $_SESSION['message'] . '</p1>';
        }
        unset($_SESSION['message']);
        ?>

    </form>
</body>
</html>