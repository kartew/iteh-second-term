<?php
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");

$my_name = $_POST["project_name"];
require_once('data_base.php');
$dbh = db();
$stmt = "SELECT p.name as 'Project', w.time_start as 'Start task', w.time_end as 'End of task', TIMESTAMPDIFF(DAY, w.time_start,  w.time_end) as 'Time, days.' FROM projects p inner join work w on p.ID_projects=w.FID_projects where p.name= ?";
$arg = array($my_name);

$sql = $stmt;
# готовим sql-скрипт для выполнения
$stmt = $dbh->prepare($stmt);
$stmt->execute($arg);

# sql-скрипт для получение навзания столбцов
$sql = strtolower($sql);
$sql = substr($sql, 0, -(strlen($sql) - strpos($sql, 'where') + 1));
$select = $dbh->query($sql);
$total_column = $select->columnCount();
for ($counter = 0; $counter < $total_column; $counter++) {
    $meta = $select->getColumnMeta($counter);
    $column[] = $meta['name'];
}

echo '<?xml version="1.0" encoding="utf8" ?>';
echo '<root>';
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {

    echo '<row>';
    echo '<project>' . $row[0] . "</project>";
    echo '<start_task>' . $row[1] . "</start_task>";
    echo '<end_of_task>' . $row[2] . "</end_of_task>";
    echo '<days>' . $row[3] . "</days>";
    echo '</row>';

}
echo '</root>';
