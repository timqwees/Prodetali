<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Убедимся, что в сессии есть уникальный идентификатор для кода
if (!isset($_SESSION["code_id"])) {
    $code = mt_rand(1000, 9999); // Генерируем уникальный идентификатор
    $_SESSION["code_id"] = "$code";
} else {
    // Проверяем, изменилось ли состояние сессии `tom`
    if ($_SESSION["tom"] == false) {
        // Сессия `tom` стала ложной, генерируем новый код
        unset($_SESSION["code_id"]);
        $code = mt_rand(1000, 9999); // Генерируем уникальный идентификатор
        $_SESSION["code_id"] = "$code";
    }

    // Получаем значение кода от клиента
    $incoming_code = isset($_GET["code"]) ? strtoupper($_GET["code"]) : "";

    // Получаем уникальный идентификатор из сессии
    $code_id = $_SESSION['code_id'];

    // Проверяем совпадение кода с уникальным идентификатором
    if ($incoming_code === "$code_id") {
        // Код совпадает, выполняем необходимые действия
        echo json_encode(['isValid' => true]);

        // Удаляем уникальный идентификатор из сессии после использования
        unset($_SESSION["code_id"]);
    } else {
        // Код не совпадает
        echo json_encode(['isValid' => false]);
    }
}
?>