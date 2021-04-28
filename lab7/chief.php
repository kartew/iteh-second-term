<?php
$my_name = $_POST["chief_name"];
require_once('data_base.php');
$dbh = db();
$stmt = "SELECT d.chief 'Manager', w.ID_worker 'Employee ID' FROM department d inner join worker w on d.ID_department=w.FID_department where d.chief= ? ";
$arg = array($my_name);

$sql = $stmt;
# готовим sql-скрипт для выполнения
$stmt = $dbh->prepare($stmt);
$stmt->execute($arg);

$timetable = $stmt->fetchAll(PDO::FETCH_OBJ);
# FETCH_OBJ - определяет получение результата в виде анонимного объекта со свойствами,
# соответствующими именам столбцов результирующего набора.
echo json_encode($timetable);
