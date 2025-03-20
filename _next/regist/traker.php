<?php
// Запуск сеанса
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Генерация криптографически безопасного датчика
if (!isset($_SESSION['sensor'])) {
    unset($_SESSION['sensor']);
    $grsw = "timqwees=";
    $checker = "::@timqwees";
    $_SESSION['sensor'] = $grsw . bin2hex(random_bytes(16)) . $checker;
}

// Создание ссылки на страницу регистрации с датчиком в качестве параметра
$registrationUrl = "sign-up.php?sensor=" . $_SESSION['sensor'];

// Отправка куки с уникальным идентификатором сессии
setcookie('sensor', $_SESSION['sensor'], time() + 302, '/'); // Кука истекает через 5 минут 2 секунды

header("Location: $registrationUrl");
exit;
?>