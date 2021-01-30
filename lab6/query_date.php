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
require 'vendor/autoload.php';
require 'paint_table.php';

$user_timestamp = strtotime($_POST['current_date']) + 3 * 60 * 60;
$collection = (new MongoDB\Client)->lab6->tasks;
$user_date = new MongoDB\BSON\Timestamp(1, $user_timestamp);
$user_project = $_POST['project_name'];
$stmt = ['$and' =>
    [['project' => ['$eq' => $user_project],],
        ['end_time' => ['$lte' => $user_date],],]];
$cursor = $collection->find($stmt);

?>

<div class="table-wrapper">
    <table class="fl-table">
        <?php
        paint_table($cursor);
        ?>
    </table>
</div>
</body>
</html>