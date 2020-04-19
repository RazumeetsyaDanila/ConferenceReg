<?php
    session_start();
    require_once 'connect.php';
    $req_id = $_GET['request_id'];
    //------- попытка получить ссылку на файл ---------------------------------
    $stmt = $connection->prepare('select report_id from request as Rq where Rq.request_id = ?');
    $stmt->execute([$req_id]);
    $rep_id = $stmt->fetchAll(PDO::FETCH_ASSOC); // $rep_id[0]['report_id']

    $stmt = $connection->prepare('select report_file_link from reports as R where R.report_id = ?');
    $stmt->execute([$rep_id[0]['report_id']]);
    $link_of_file = $stmt->fetchAll(PDO::FETCH_ASSOC); // $link_of_file[0]['report_file_link']
    //-------------------------------------------------------------------------
    $query = 'delete from request where request_id = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$req_id]);

    $query = 'delete from reports where report_id = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$rep_id[0]['report_id']]);

    unlink('../'.$link_of_file[0]['report_file_link']);

    if ($_SESSION['user']['login']=='admin'){
        header('Location: ../admin.php');
    }
    else{

        header('Location: ../profile.php');
    }