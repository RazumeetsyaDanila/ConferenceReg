<?php
    session_start();
    if($_SESSION['user']){
        header('Location:profile.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <title>Авторизация</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/functions.js"></script>
</head>
<body>
    <form action="invisible/signin.php" method="post" style="padding-top: 18vh">
        <div  class="form">
            <h1>Вход</h1>
            <hr>
            <input type="text" id="login" name="login" placeholder="Введите логин">
            <input type="password" id="password" name="password" placeholder="Введите пароль">
            <button type = "submitbtn" class="submitbtn" id="submitbtn"> <span> Войти </span></button>
            <p>У вас еще нет аккаунта? <a href="registration.php">Зарегистрироваться</a></p>
        </div>
    </form>

    <?php
    if($_SESSION['message']){
        echo '<p class="msg">' . $_SESSION['message'] . '</p>';
    }
    unset($_SESSION['message']);
    ?>
</body>
</html>