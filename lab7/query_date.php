<?php
require_once('data_base.php');
$dbh = db();
$stmt = "SELECT * FROM projects p inner join work w on p.ID_projects=w.FID_projects WHERE p.name = ? and w.date <= ?";
$arg = array($_POST["project_name"], $_POST['current_date']);
?>
        <?php
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

            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                echo '<tr>';
                foreach ($row as $myarr) {
                    echo '<td>' . $myarr . "</td>";
                }
                echo '<tr>';
            }
        ?>