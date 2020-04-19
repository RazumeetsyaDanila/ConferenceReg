<?php
session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$query = 'select u.login,u.name,u.email from users as u
where u.login = ? and u.password = ?';
$stmt = $connection->prepare($query);
$stmt->bindValue(1,$login);
$stmt->bindValue(2,$password);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
if($count > 0){
    foreach ($result as $user){
        $array = ['login' => $user['login'], 'name' =>$user['name'], 'email' => $user['email']];
        $_SESSION['user'] = [
            'login' => $user['login'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
    }
    if ($login=='admin'){
        header('Location: ../admin.php');
    }
    else{
        header('Location: ../profile.php');
    }
} else{
    $_SESSION['message'] = 'Неправильный логин или пароль!';
    header('Location: ../index.php');
}