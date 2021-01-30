<?php
function paint_table($cursor)
{
    # заголовки таблицы
    $fields = ['Проект', 'Задача', 'Описание', 'Работник', 'Руководитель', 'Начало выполнения задачи', 'Конец выполнения задачи'];
    echo '<tbody>';
    echo '<tr>';
    # формируем "шапку таблицы"
    foreach ($fields as $myarr) {
        echo '<th>' . $myarr . "</th>";
    }
    echo '</tr>';
    # поочередно выводим каждую строку таблицы
    foreach ($cursor as $document) {
        echo '<tr>';
        echo '<td>' . $document['project'] . '</td>';
        echo '<td>' . $document['name'] . '</td>';
        echo '<td>' . $document['description'] . '</td>';

        # распаковываем массив с именами работников
        $workers = '';
        for ($i = 0; $i < count($document['worker']); $i++) {
            $workers .= $document['worker'][$i];
            if ($i != count($document['worker']) - 1) {
                $workers .= ", ";
            }
        }
        echo '<td>' . $workers . '</td>';
        echo '<td>' . $document['manager'] . '</td>';

        # преобразовываем timestamp в человекочетаем вид
        $temp_array_start_time = (array)$document['start_time'];
        echo '<td>' . date('m/d/Y', $temp_array_start_time['timestamp']) . '</td>';
        $temp_array_end_time = (array)$document['end_time'];
        echo '<td>' . date('m/d/Y', $temp_array_end_time['timestamp']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
}