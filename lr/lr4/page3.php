<?php
session_start();
unset($_SESSION['username']); // разрегистрировали переменную
echo 'Привет, ' . $_SESSION['username'];
/* теперь имя пользователя уже не выводится */
session_destroy(); // разрушаем сессию
?>