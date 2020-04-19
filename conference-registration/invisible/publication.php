<?php
    session_start();
    require_once 'connect.php';
    $login=$_SESSION['user']['login'];
    $theme=$_POST['select_theme'];
    $report_name=$_POST['report_name'];
    $report_description=$_POST['report_description'];
    $presentation_path = 'uploads/' . time() . $_FILES['file']['name'];
    $presentation_r= end(explode(".", $_FILES['file']['name']));

    if($presentation_r=='ppt' || $presentation_r=='pptx' || $presentation_r =='pdf') {
        if (!move_uploaded_file($_FILES['file']['tmp_name'], '../' . $presentation_path)) {
            $_SESSION['message'] = 'Ошибка при загрузки файла!';
            header('Location:../publication_form.php');
            exit();
        }
    }
    else {
        $_SESSION['message'] = 'Выбранный файл неправильного расширения!';
        header('Location:../publication_form.php');
        exit();
    }

    $qwe = $connection->prepare('select * from reports as R where R.login=? and R.report_name=?');
    $qwe->execute([$login, $report_name]);
    $res = $qwe->fetchAll(PDO::FETCH_ASSOC);
    $count = $qwe->rowCount();

    if($count>0) {
        $_SESSION['message'] = 'У вас уже сущетсвует доклад с таким же названием!';
        header('Location:../publication_form.php');
        exit();
    }

    $stmt = $connection->prepare('insert into reports(report_name, report_theme, report_description, report_file_link, login) values (?,?,?,?,?)');
    $stmt->execute([$report_name, $theme, $report_description, $presentation_path, $login]);

    $tmp = $connection->prepare('select R.report_id from reports as R where R.login=? and R.report_name=?');
    $tmp->execute([$login,$report_name]);
    $res = $tmp->fetch(PDO::FETCH_ASSOC);
    $id_report = $res['report_id'];

    $tmp = $connection->prepare('insert into request(report_id, login) values (?,?)');
    $tmp->execute([$id_report, $login]);
    header('Location: ../profile.php');