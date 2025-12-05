<?php

$cols = 7;
$rows = 8;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Таблица умножения</title>
	<style>
		table {
			border: 2px solid black;
			border-collapse: collapse;
			margin: 20px 0;
			font-family: Arial, sans-serif;
		}

		th,
		td {
			padding: 10px;
			border: 1px solid black;
			text-align: center; /* Центрирование всего контента */
			font-weight: normal;
		}


		th {
			background-color: yellow; /* Фоновый цвет: yellow (из задания) */
			font-weight: bold; 		 /* Полужирный шрифт */
		}


		.first-col {
			background-color: #ADD8E6; /* Фоновый цвет: светло-голубой (отличный от таблицы и заголовка) */
			font-weight: bold; 		 /* Полужирный шрифт */
		}
	</style>
</head>
<body>
	<h1>Таблица умножения <?php echo $cols; ?>x<?php echo $rows; ?></h1>
	<?php

	echo "<table>";

	
    for ($r = 1; $r <= $rows; $r++) {
       echo "<tr>";


       for ($c = 1; $c <= $cols; $c++) {


          $class = '';


          $isHeader = ($r == 1 || $c == 1);

          if ($isHeader) {

             if ($r == 1) {

                $tag = 'th';
                $content = $c;

             } else {

                $tag = 'td';
                $class = ' class="first-col"';
                $content = $r;
             }
          } else {

             $tag = 'td';

             $content = $r * $c;
          }


          echo "<$tag$class>$content</$tag>";
       }

       echo "</tr>";
    }

	echo "</table>";
	?>
</body>
</html>