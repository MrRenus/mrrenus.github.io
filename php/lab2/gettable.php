<?php

function getTable(int $cols = 10, int $rows = 10, string $color = 'yellow'): int {

    static $count = 0;
    $count++;


    echo "<h2>Таблица умножения {$cols}x{$rows} (Вызов #{$count})</h2>";
    echo "<table>";


    for ($r = 1; $r <= $rows; $r++) {
        echo "<tr>";
        for ($c = 1; $c <= $cols; $c++) {
            $isHeader = ($r == 1 || $c == 1);

            if ($isHeader) {

                if ($r == 1) {
                    $tag = 'th';
                    $style = " style='background-color: {$color}; font-weight: bold; text-align: center;'";
                    $content = $c; // Номер столбца
                } else {

                    $tag = 'td';
                    $style = " style='background-color: {$color}; font-weight: bold; text-align: center;'";
                    $content = $r; // Номер строки
                }
            } else {
                // Обычная ячейка с данными (TD)
                $tag = 'td';
                $style = '';
                $content = $r * $c; // Произведение
            }

            echo "<$tag$style>$content</$tag>";
        }

        echo "</tr>";
    }

    echo "</table>";

    // ЗАДАНИЕ 3: Функция должна возвращать значение $count
    return $count;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Функция getTable</title>
    </head>
<body>
	<h1>Таблица умножения (Функция getTable)</h1>

	<h3>Вызовы:</h3>

	<?php
	// ЗАДАНИЕ 3: Вызов с различными параметрами
	getTable(3, 5, 'lightgreen');

	// ЗАДАНИЕ 5: Вызов без параметров (должен использовать значения по умолчанию 10x10, yellow)
	$total_calls = getTable();

	// ЗАДАНИЕ 5: Вызов с одним параметром (cols=5, rows=10, yellow)
	$total_calls = getTable(5);

	// ЗАДАНИЕ 5: Вызов с двумя параметрами (cols=4, rows=7, yellow)
	$total_calls = getTable(4, 7);

	// ЗАДАНИЕ 5: Вывод общего числа вызовов
	echo "<hr><h3>Общее число вызовов функции getTable(): <strong>$total_calls</strong></h3>";
	?>
</body>
</html>