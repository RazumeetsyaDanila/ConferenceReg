<?php
    session_start();
    require_once 'invisible/connect.php';

    $array = array();

    $stmt = $connection->prepare('select Rq.report_id, U.name, U.email, Rp.report_name, Rp.report_description, Rq.request_id, Rp.report_theme 
        from request as Rq 
        left join reports as Rp on Rp.report_id=Rq.report_id
        left join users as U on U.login=Rq.login');

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <title>Админ</title>
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

    <div class="dropdown">
        <button class="dropbtn"><?=$_SESSION['user']['name']?>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="invisible/logout.php">Выход</a>
        </div>
    </div>
</div>
<div class="table_name">
    <p>Все презентации</p>
</div>
<!--------------------------------  Вывод информации о заявках  ----------------------------------------------->

<?php
foreach ($result as $bow){
    array_push($array,$bow);
}
if (count($array)>0)
{
    echo '
            <div class="padding_table">
            <table class="table">
              <thead>
                <tr>
                  <th >Логин</th>
                  <th >Название доклада</th>
                  <th >Тематика</th>
                  <th class="description_display">Краткое описание доклада</th>
                </tr>
              </thead>
              </div>';
    foreach ($array as $bow)
    {
        echo '<tr>
                        <td> <p> '.$bow['name'].'</p></td>
                        <td  style="width: 15vw"><a href="selected_publication.php?name='.$bow['report_name'].'&id='.$bow['report_id'].'"> '.$bow['report_name'].'</a></td>
            
                        <td> <p> '.$bow['report_theme'].'</p></td>
                        <td class="description_display" style="max-width: 30vw"> <p> '.$bow['report_description'].'</p></td>
                        <td> <a href="invisible/delete_publication.php?request_id='.$bow['request_id'].'"><img src="img/delete.png" width="20px;"></a></td>
                        </tr>';
    }
}
else{
    $_SESSION['message'] = 'Заявок на выступление пока нет.';
}
?>

<!------------------------------------------------------------------------------->




<?php
if($_SESSION['message']){
    echo '<p class="msg">' . $_SESSION['message'] . '</p>';
}
unset($_SESSION['message']);
?>

</body>
</html>