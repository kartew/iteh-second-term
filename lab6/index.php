<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
require 'vendor/autoload.php';
$collection = (new MongoDB\Client)->lab6->tasks;
$cursor = $collection->distinct('project');
?>

<h2>Запрос 1</h2>
<p>Информация о выполненных задачах по выбранному проекту на указанную дату.</p>
<form action="query_date.php" method="post">
    <label>Введите название проекта: </label>
    <div class="dropdown">
        <select name="project_name" class="dropdown-select">
            <?php
            foreach ($cursor as $i) {
                echo "<option>" . $i . "</option>";
            }
            ?>
        </select>
    </div>
    <br>
    <label>Введите дату: </label>
    <input type="date" name="current_date">
    <br>
    <input type="submit" name="send" value="Узнать"/>
</form>

<h2>Запрос 2</h2>
<p>Информация о количестве проектов указанного руководителя.</p>
<form action="get_all_project_manager.php" method="post">
    <label>Выбирите руководителя: </label>
    <div class="dropdown">
        <select name="manager_name" class="dropdown-select">
        <?php
        $collection = (new MongoDB\Client)->lab6->tasks;
        $cursor = $collection->distinct('manager');
        foreach ($cursor as $i) {
            echo "<option>" . $i . "</option>";
        }
        ?>
        </select>
    </div>
    <br>
    <input type="submit" name="send" value="Узнать"/>
</form>

<h2>Запрос 3</h2>
<p>Информация о сотрудниках, работавших под началом выбранного руководителя.</p>
<form action="get_all_worker_manager.php" method="post">
    <label>Выбирите руководителя: </label>
    <div class="dropdown">
        <select name="manager_name" class="dropdown-select">
        <?php
        $collection = (new MongoDB\Client)->lab6->tasks;
        $cursor = $collection->distinct('manager');
        foreach ($cursor as $i) {
            echo "<option>" . $i . "</option>";
        }
        ?>
        </select>
    </div>
    <br>
    <input type="submit" name="send" value="Узнать"/>
</form>

</body>
</html>