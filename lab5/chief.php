<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Query 3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$my_name = $_POST["chief_name"];
require_once('data_base.php');
require_once('paint_table.php');
$dbh = db();
$stmt = "SELECT d.chief 'Manager', w.ID_worker 'Employee ID' FROM department d inner join worker w on d.ID_department=w.FID_department where d.chief= ? ";
$arg = array($my_name);

?>
<div class="table-wrapper">
    <table class="fl-table">
        <?php
        paint_table($dbh, $stmt, $arg);
        ?>
    </table>
    <h2>Общее количество подчиненных:
        <?php
        $data = array($my_name);
        $sth = $dbh->prepare("SELECT COUNT(w.ID_worker) chief FROM department d inner join worker w on d.ID_department=w.FID_department where d.chief = ?");
        $sth->execute($data);
        $res = $sth->fetchAll();
        echo $res[0]['chief']
        ?>
        (сотрудник/ов)</h2>
</div>
</body>
</html>