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
require 'vendor/autoload.php';
# получаем имя руководителя от пользователя
$user_manager = $_POST['manager_name'];
# получаем объект с уникальными проектами выбранного руководителя
$collection = (new MongoDB\Client)->lab6;
$cursor = $collection->command([
    "distinct" => "tasks",
    "key" => "worker",
    "query" => [
        "manager" => [ '$eq' => $user_manager ]]
]);
# формируем к-во уникальных проектов в переменную $count_project
$result = iterator_to_array($cursor);
$workers = (array)$result[0]['values'];
?>

<div class="table-wrapper">
    <table class="fl-table">
        <?php
        echo "<h2>Сотрудники, работающие под руководством ${user_manager}: </h2>";
        # отображаем всех сотрудников, связанных с данным руководителем
        echo '<tbody>';
        echo '<tr>';
        echo '<th>' . 'Имя сотрудника' .'</th>';
        echo '</tr>';

        foreach ($workers as $myarr) {
            echo '<tr>';
            echo '<td>' . $myarr . "</td>";
            echo '</tr>';
        }
        echo '</tbody>';
        ?>
    </table>
</div>

</body>
</html>