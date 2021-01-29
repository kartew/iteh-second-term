<?php
require_once('data_base.php');
$dbh = db();

function paint_table($dbh, $stmt, $arg) {
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

    # рисуем заголовки и тело таблицы
    echo '<tbody>';
    echo '<tr>';
    foreach ($column as $myarr) {
        echo '<th>' . $myarr . "</th>";
    }
    echo '</tr>';
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo '<tr>';
        foreach ($row as $myarr) {
            echo '<td>' . $myarr . "</td>";
        }
        echo '/<tr>';
    }
    echo '</tbody>';
}