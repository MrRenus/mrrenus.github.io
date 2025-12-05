<?php
/*
ЗАДАНИЕ 1
- Создайте переменную $day и присвойте ей произвольное целочисленное значение.
*/
$day = 3; // Пример: 3 - среда (рабочий день). Можете изменить это значение.
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Конструкция switch</title>
</head>
<body>
	<h1>Конструкция switch</h1>
	<?php

    echo "<p>Текущий день (число): <strong>$day</strong></p>";

    // Конструкция switch
	switch ($day) {
        // Рабочие дни: 1, 2, 3, 4, 5
        case 1:
        case 2:
        case 3:
        case 4:
        case 5:
            echo "<h2>Это рабочий день</h2>";
            break;

        // Выходные дни: 6, 7
        case 6:
        case 7:
            echo "<h2>Это выходной день</h2>";
            break;

        // Если значение не попадает в 1-7
        default:
            echo "<h2>Неизвестный день</h2>";
            break;
	}
	?>
</body>
</html>