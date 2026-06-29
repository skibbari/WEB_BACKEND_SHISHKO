<?php
$currentMonth = date('n');
$currentYear = date('Y');
$daysInCurrentMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

echo "<h3>Задание 2. Количество дней в текущем месяце</h3>";
echo "<p>Текущий месяц: " . date('F') . "<br>";
echo "Количество дней: $daysInCurrentMonth</p><hr>";
?>