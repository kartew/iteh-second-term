<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Query 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once('data_base.php');
require_once('paint_table.php');
$dbh = db();
$stmt = "SELECT * FROM projects p inner join work w on p.ID_projects=w.FID_projects WHERE p.name = ? and w.date <= ?";
$arg = array($_POST["project_name"], $_POST['current_date']);
?>
<div class="table-wrapper">
    <table class="fl-table">
        <?php
        paint_table($dbh, $stmt, $arg);
        ?>
    </table>
</div>
</body>
</html>