<?php
    session_start();
    if ($_SESSION['user']['login']=='admin'){
        header('Location: ../admin.php');
    }
    else{
        header('Location: ../profile.php');
    }