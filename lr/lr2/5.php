<?php
$S1 = "ШИШКО";
$S2 = "ВИКТОРИЯ";

echo "<h3>Задание 5. Операции со строками</h3>";
echo "<p>Исходные строки:<br>S1 = $S1<br>S2 = $S2</p>";

$lengthS2 = strlen($S2);
echo "<p>1. Длина строки S2: $lengthS2 символов</p>";

$concatenated = $S1 . $S2;
echo "<p>2. Сцепление S1 и S2: $concatenated</p>";

$S2lower = strtolower($S2);
echo "<p>3. S2 в нижнем регистре: $S2lower</p><hr>";
?>