<?php
    session_start();
    require_once 'invisible/connect.php';
//-----------------------------------------
    $report_name = $_GET['name'];
    $report_id = $_GET['id'];

    $tmp = $connection->prepare('select R.login from reports as R  where R.report_name=? and R.report_id = ?');
    $tmp->execute([$report_name,$report_id]);
    $res = $tmp->fetch(PDO::FETCH_ASSOC);
    $login = $res['login'];

    $tmp = $connection->prepare('select U.email from users as U  where U.login=?');
    $tmp->execute([$login]);
    $res = $tmp->fetch(PDO::FETCH_ASSOC);
    $email = $res['email'];

    $tmp = $connection->prepare('select * from reports as Rp left join request as Rq on Rp.login = Rq.login where Rp.report_name=? and Rp.login=? and Rq.report_id = ?');
    $tmp->execute([$report_name, $login,$report_id]);
    $res = $tmp->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Описание заявки</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="topnav">
    <div class="site_label">
        <p>Danilas Conferences</p>
    </div>

    <form action="invisible/backbtn.php" >
        <button class="backbtn">Назад</button>
    </form>
</div>


<table class="info_table">
    <tbody >
    <tr>
        <td>Email докладчика:</td>
        <td><?= $email ?></td>
    </tr>
    <tr>
        <td>Название доклада:</td>
        <td><?= $report_name ?></td>
    </tr>
    <tr>
        <td>Тематика доклада:</td>
        <td><?= $res['report_theme'] ?></td>
    </tr>
    <tr>
        <td>Краткое описание доклада:</td>
        <td  style="max-width: 30vw" ><?=  $res['report_description']?></td>
    </tr>
    <tr>
        <td>Скачать презентацию</td>
        <td ><a href="<?= $res['report_file_link'] ?>" download><img src="img/download.png" width="25px"></a></td>
    </tr>
    </tbody>
</table>


</body>
</html>
