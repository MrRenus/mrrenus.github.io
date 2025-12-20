<?php
// Устанавливаем значения по умолчанию
$default_cols = 5;
$default_rows = 7;
$default_color = '#90ee90';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cols = abs((int) $_POST['cols']);
    $rows = abs((int) $_POST['rows']);
    $color = trim(strip_tags($_POST['color']));
}

$cols = ($cols) ? $cols : $default_cols;
$rows = ($rows) ? $rows : $default_rows;
$color = ($color) ? $color : $default_color;
?>
<!-- Область основного контента -->
<h3>Таблица умножения</h3>
<form action='<?=$_SERVER['REQUEST_URI']?>' method='POST'>
    <label>Количество колонок: </label>
    <br>
    <input name='cols' type='text' value='<?=isset($_POST['cols']) ? htmlspecialchars($_POST['cols']) : $default_cols?>'>
    <br>
    <label>Количество строк: </label>
    <br>
    <input name='rows' type='text' value='<?=isset($_POST['rows']) ? htmlspecialchars($_POST['rows']) : $default_rows?>'>
    <br>
    <label>Цвет: </label>
    <br>
    <input name='color' type='color' value='<?=isset($_POST['color']) ? htmlspecialchars($_POST['color']) : $default_color?>'>
    <br>
    <small>Или выберите из списка: </small>
    <select onchange="document.querySelector('input[name=color]').value = this.value">
        <option value="#90ee90">Светло-зеленый</option>
        <option value="#ff0000">Красный</option>
        <option value="#00ff00">Зеленый</option>
        <option value="#0000ff">Синий</option>
        <option value="#ffff00">Желтый</option>
        <option value="#ff00ff">Пурпурный</option>
        <option value="#00ffff">Бирюзовый</option>
    </select>
    <br>
    <br>
    <input type='submit' value='Создать'>
</form>
<br>



<!-- Таблица -->
<?php 
// Изменяем вызов функции getTable() чтобы она использовала CSS классы
// Предполагаем, что функция getTable() генерирует таблицу
// Если не можете изменить функцию, добавьте обертку
?>

<!-- Вариант 1: Если можно изменить функцию getTable() -->
<?php
// Внутри функции getTable() нужно будет использовать CSS классы вместо атрибутов
// Например, вместо <table border='1' width='200'> использовать <table class="mult-table">
// И вместо <th bgcolor='lightgreen'> использовать <th>
?>

<!-- Вариант 2: Если не можете изменить функцию getTable(), оберните таблицу -->
<div style="border: 1px solid #000; width: 200px; display: inline-block; overflow: auto;">
    <?php getTable($rows, $cols, $color); ?>
</div>

<!-- Вариант 3: Исправить саму функцию getTable() в файле lib.inc.php -->
<?php
/*
// Пример исправленной функции getTable():
function getTable($rows, $cols, $color) {
    echo '<table class="mult-table">';
    for ($i = 1; $i <= $rows; $i++) {
        echo '<tr>';
        for ($j = 1; $j <= $cols; $j++) {
            $result = $i * $j;
            echo "<td>$result</td>";
        }
        echo '</tr>';
    }
    echo '</table>';
}
*/
?>
<!-- Область основного контента -->
