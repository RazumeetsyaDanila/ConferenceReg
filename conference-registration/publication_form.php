<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Публикация</title>
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


<div class="form" style="padding-top: 16vh">
    <form action="invisible/publication.php" method="post" enctype="multipart/form-data">
        <input type="text" id="report_name" name="report_name" placeholder="Название доклада">
        <div>
            <select  id="select_theme" name="select_theme">
                <option value="Гуманитарные науки">Гуманитарные науки</option>
                <option value="Технические науки">Технические науки</option>
                <option value="Естественные науки">Естественные науки</option>
                <option value="Другое">Другое</option>
            </select>
        </div>
        <textarea id="report_description" name="report_description" placeholder="Описание доклада..." style="height:150px"></textarea>
        <input type="file" name="file" id="file" class="inputfile" />
        <label for="file">Загрузить файл презентации</label>
        <button type = "submitbtn" class="submitbtn" id="submitbtn" style="margin-top: 18px"> <span> Отправить </span></button>
    </form>
</div>



    <?php
    if($_SESSION['message']){
        echo '<p class="msg">' . $_SESSION['message'] . '</p>';
    }
    unset($_SESSION['message']);
    ?>

</body>
</html>