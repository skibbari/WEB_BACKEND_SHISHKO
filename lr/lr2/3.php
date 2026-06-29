<?php
$n = 6;
$repeatCount = $n + 5;
$fullName = "Шишко Виктория";

echo "<h3>Задание 3. Вывод фамилии и имени $repeatCount раз </h3>";
for ($i = 1; $i <= $repeatCount; $i++) {
    echo "$i. $fullName<br>";
}
echo "<hr>";
?>