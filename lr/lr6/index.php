<?php
// Объединенный файл index.php, включающий все функции из contact.php, lb6.php, lb6_attach.php, lb6_multiple.php

require __DIR__ . '/код/PHPMailer-master/src/Exception.php';
require __DIR__ . '/код/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/код/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Общие настройки SMTP
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'feratyler04@gmail.com';
        $mail->Password   = 'uyaalwozbhgtgakn'; // Пароль приложения
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';
        $mail->setFrom('feratyler04@gmail.com', 'Сервис сайта');

        // Определение типа формы
        $type = $_POST['type'] ?? '';

        switch ($type) {
            case 'subscribe':
                // Подписка
                $mail->addAddress('feratyler04@gmail.com');
                $mail->Subject = 'Новая подписка';
                $mail->Body    = "Email для подписки: " . htmlspecialchars($_POST['email']);
                $mail->send();
                $status = "Подписка оформлена!";
                break;

            case 'feedback':
                // Обратная связь (из contact.php)
                $mail->addAddress('feratyler04@gmail.com');
                $mail->Subject = 'Обратная связь';
                $mail->Body    = "Имя: " . htmlspecialchars($_POST['name']) . "\nСообщение: " . htmlspecialchars($_POST['message']);
                $mail->send();
                $status = "Сообщение отправлено!";
                break;

            case 'anketa':
                // Анкета (из contact.php)
                $mail->addAddress('feratyler04@gmail.com');
                $mail->Subject = 'Заполненная анкета';
                $mail->Body    = "ФИО: " . htmlspecialchars($_POST['fio']) . "\nВозраст: " . htmlspecialchars($_POST['age']) . "\nОтзыв: " . htmlspecialchars($_POST['review']);
                $mail->send();
                $status = "Анкета успешно отправлена!";
                break;

            case 'simple':
                // Простая форма (из lb6.php)
                $mail->addAddress('feratyler04@gmail.com');
                $mail->Subject = 'Новое сообщение с сайта';
                $mail->Body    = "Имя: " . htmlspecialchars($_POST['name']) . "\nСообщение: " . htmlspecialchars($_POST['message']);
                $mail->send();
                $status = "Сообщение успешно отправлено!";
                break;

            case 'attach':
                // Форма с вложением (из lb6_attach.php)
                $mail->addAddress('feratyler04@gmail.com');
                // Обработка вложения
                if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
                    $mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
                }
                $mail->Subject = 'Сообщение с вложением';
                $mail->Body    = "Имя: " . htmlspecialchars($_POST['name']) . "\nСообщение: " . htmlspecialchars($_POST['message']);
                $mail->send();
                $status = "Сообщение с файлом успешно отправлено!";
                break;

            case 'multiple':
                // Массовая рассылка (из lb6_multiple.php)
                $emailString = $_POST['recipients'];
                $emails = array_map('trim', explode(',', $emailString));
                foreach ($emails as $email) {
                    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $mail->addAddress($email);
                    }
                }
                $mail->Subject = 'Тестовая массовая рассылка';
                $mail->Body    = "Привет! Это сообщение отправлено пользователям с сайта.";
                $mail->send();
                $status = "Письмо успешно отправлено всем указанным адресатам!";
                break;

            default:
                $status = "Неизвестный тип формы.";
        }
    } catch (Exception $e) {
        $status = "Ошибка: " . $mail->ErrorInfo;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все формы обратной связи</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-block { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; max-width: 500px; }
        .form-block h3 { margin-top: 0; }
        input, textarea, button { display: block; margin: 5px 0; width: 100%; box-sizing: border-box; }
        textarea { height: 60px; }
        .status { background: #e7f3fe; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Все формы обратной связи</h1>

    <?php if ($status): ?>
        <div class="status"><strong><?php echo htmlspecialchars($status); ?></strong></div>
    <?php endif; ?>

    <!-- 1. Подписка (из contact.php) -->
    <div class="form-block">
        <h3>Подписка</h3>
        <form method="POST">
            <input type="hidden" name="type" value="subscribe">
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Подписаться</button>
        </form>
    </div>

    <!-- 2. Обратная связь (из contact.php) -->
    <div class="form-block">
        <h3>Обратная связь</h3>
        <form method="POST">
            <input type="hidden" name="type" value="feedback">
            <input type="text" name="name" placeholder="Ваше имя" required>
            <textarea name="message" placeholder="Сообщение" required></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>

    <!-- 3. Анкета (из contact.php) -->
    <div class="form-block">
        <h3>Анкета</h3>
        <form method="POST">
            <input type="hidden" name="type" value="anketa">
            <input type="text" name="fio" placeholder="ФИО" required>
            <input type="number" name="age" placeholder="Возраст">
            <textarea name="review" placeholder="Ваш отзыв"></textarea>
            <button type="submit">Отправить анкету</button>
        </form>
    </div>

    <!-- 4. Простая форма (из lb6.php) -->
    <div class="form-block">
        <h3>Простая обратная связь</h3>
        <form method="POST">
            <input type="hidden" name="type" value="simple">
            <input type="text" name="name" placeholder="Ваше имя" required>
            <textarea name="message" placeholder="Ваш вопрос" required></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>

    <!-- 5. Форма с вложением (из lb6_attach.php) -->
    <div class="form-block">
        <h3>Обратная связь с вложением</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="attach">
            <input type="text" name="name" placeholder="Ваше имя" required>
            <textarea name="message" placeholder="Ваш вопрос" required></textarea>
            <label>Выберите файл:</label>
            <input type="file" name="attachment">
            <button type="submit">Отправить</button>
        </form>
    </div>

    <!-- 6. Массовая рассылка (из lb6_multiple.php) -->
    <div class="form-block">
        <h3>Массовая рассылка</h3>
        <form method="POST">
            <input type="hidden" name="type" value="multiple">
            <label>Email адреса через запятую:</label>
            <input type="text" name="recipients" placeholder="mail1@ex.com, mail2@ex.com" required>
            <button type="submit">Отправить письмо всем</button>
        </form>
    </div>
</body>
</html>