<?php
// Проверяем, отправлены ли поля формы
if (isset($_POST['username'], $_POST['userpass'])) {
    // Защита от XSS с помощью htmlentities
    $username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
    echo "<p>Добро пожаловать, $username!</p>";
} else {
    echo "<p>Ошибка: данные не получены.</p>";
}
?>
<a href="login_form.php">← Назад к форме</a> | <a href="index.php">← На главную</a>