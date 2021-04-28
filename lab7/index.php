<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laba 5</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once('data_base.php');
$dbh = db();
$sql = "SELECT DISTINCT p.name FROM projects p inner join work w on p.ID_projects=w.FID_projects";

?>

<h2>Запрос 1</h2>
<p>Информация о выполненных задачах по выбранному проекту на указанную дату.</p>
<label>Введите название проекта: </label>
<div class="dropdown">
    <select name="project_name" id="project_name" class="dropdown-select">
        <?php
        foreach ($dbh->query($sql) as $row) {
            echo "<option>" . $row['name'] . "</option>";
        }
        ?>
    </select>
</div>
<br>
<label>Введите дату: </label>

<input type="date" name="current_date" id="current_date" value="2021-04-27">
<br>
<input type="button" name="send" onclick="get1post()" value="Узнать"/>

<table class="fl-table">
    <thead>
    <tr>
        <th>ID_projects</th>
        <th>name</th>
        <th>manager</th>
        <th>FID_projects</th>
        <th>FID_worker</th>
        <th>date</th>
        <th>time_start</th>
        <th>time_end</th>
        <th>description</th>
    </tr>
    </thead>
    <tbody id="result1"></tbody>
</table>


<h2>Запрос 2</h2>
<p>Общее время работы над выбранным проектом.</p>
<label>Введите название проекта: </label>
<div class="dropdown">
    <select name="project_name" id="project_name2" class="dropdown-select"">
    <?php
    foreach ($dbh->query($sql) as $row) {
        echo "<option>" . $row['name'] . "</option>";
    }
    ?>
    </select>
</div>
<br>
<input type="button" name="send" value="Узнать" onclick="get2post()"/>

<table class="fl-table">
    <thead>
    <tr>
        <th>project</th>
        <th>start task</th>
        <th>end of task</th>
        <th>time, days.</th>
    </tr>
    </thead>
    <tbody id="result2"></tbody>
</table>

<h2>Запрос 3</h2>
<p>Число сотрудников отдела выбранного руководителя.</p>
<label>Введите название проекта: </label>
<div class="dropdown">
    <select name="chief_name" id="chief_name" class="dropdown-select"">
    <?php
    $sql = "SELECT chief from department";
    foreach ($dbh->query($sql) as $row) {
        echo "<option>" . $row['chief'] . "</option>";
    }
    ?>
    </select>
</div>
<br>
<input type="button" name="send" value="Узнать" onclick="get3post()"/>

<table class="fl-table">
    <thead>
    <tr>
        <th>manager</th>
        <th>employee id</th>
    </tr>
    </thead>
    <tbody id="result3"></tbody>
</table>

<script src="scripts.js"></script>
</body>
</html>