<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Query 2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
$my_name = $_POST["project_name"];
require_once('data_base.php');
require_once('paint_table.php');
$dbh = db();
$stmt = "SELECT p.name as 'Project', w.time_start as 'Start task', w.time_end as 'End of task', TIMESTAMPDIFF(DAY, w.time_start,  w.time_end) as 'Time, days.' FROM projects p inner join work w on p.ID_projects=w.FID_projects where p.name= ?";
$arg = array($my_name);
?>

<div class="table-wrapper">
    <table class="fl-table">
        <?php
        paint_table($dbh, $stmt, $arg);
        ?>
    </table>
    <h2>Общее количество времени:
        <?php
        $data = array($my_name);
        $sth = $dbh->prepare("SELECT round(sum(TIMESTAMPDIFF(second, w.time_start,  w.time_end))/60/60/24) as 'time' FROM projects p inner join work w on p.ID_projects=w.FID_projects where p.name= ?");
        $sth->execute($data);
        $res = $sth->fetchAll();
        echo $res[0]['time']
        ?>
        (день/дней)</h2>
</div>o
</body>
</html>
