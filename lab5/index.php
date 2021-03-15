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

<form action="query_date.php" method="post">
    <label>Введите название проекта: </label>
    <div class="dropdown">
        <select name="project_name" class="dropdown-select">
            <?php
            foreach ($dbh->query($sql) as $row) {
                echo "<option>" . $row['name'] . "</option>";
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
<p>Общее время работы над выбранным проектом.</p>
<form action="get_all_time.php" method="post">
    <label>Введите название проекта: </label>
    <div class="dropdown">
        <select name="project_name" class="dropdown-select"">
        <?php
        foreach ($dbh->query($sql) as $row) {
            echo "<option>" . $row['name'] . "</option>";
        }
        ?>
        </select>
    </div>
    <br>
    <input type="submit" name="send" value="Узнать"/>
</form>

<h2>Запрос 3</h2>
<p>Число сотрудников отдела выбранного руководителя.</p>
<form action="chief.php" method="post">
    <label>Введите название проекта: </label>
    <div class="dropdown">
        <select name="chief_name" class="dropdown-select"">
        <?php
        $sql = "SELECT chief from department";
        foreach ($dbh->query($sql) as $row) {
            echo "<option>" . $row['chief'] . "</option>";
        }
        ?>
        </select>
    </div>
    <br>
    <input type="submit" name="send" value="Узнать"/>
</form>

</body>
</html>