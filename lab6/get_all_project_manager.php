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
require 'vendor/autoload.php';
require 'paint_table.php';
# получаем имя руководителя от пользователя
$user_manager = $_POST['manager_name'];
# получаем объект с уникальными проектами выбранного руководителя
$collection = (new MongoDB\Client)->lab6;
$cursor = $collection->command([
    "distinct" => "tasks",
    "key" => "project",
    "query" => [
        "manager" => [ '$eq' => $user_manager ]]
]);
# формируем к-во уникальных проектов в переменную $count_project
$result = iterator_to_array($cursor);
$count_project = count((array)$result[0]['values']);
?>

<div class="table-wrapper">
    <table class="fl-table">
        <?php
        echo "<h2>Количество проектов ${user_manager} = ${count_project}</h2>";
        # формируем запрос всех задач, связанных с данным руководителем и рисуем таблицу
        $collection = (new MongoDB\Client)->lab6->tasks;
        $stmt = ['manager' => ['$eq' => $user_manager]];
        $cursor = $collection->find($stmt);
        paint_table($cursor);
        ?>
    </table>
</div>

</body>
</html>