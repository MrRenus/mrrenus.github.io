<?php

$var = 'ПРИВЕТ';
$i = 0; 
$length = mb_strlen($var);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Цикл while</title>
</head>
<body>
	<h1>Цикл while</h1>
	<?php


    echo "<pre>";

	while ($i < $length) {

        $char = mb_substr($var, $i, 1);
        echo $char . "\n";
        $i++;
	}

    echo "</pre>";

	?>
</body>
</html>