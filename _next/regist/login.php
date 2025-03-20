<?php
include_once __DIR__ . '/../php/src/helpers.php';
include_once __DIR__ . '/../php/element.php';
include_once __DIR__ . '/../php/src/config.php';

$action = $_GET['action'] ?? null; // Добавлено значение по умолчанию для $action
switch ($action) {
    case 'check_email':
        $email = $_GET['email'];
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        echo json_encode(array("exists" => $exists));
        exit;
        break;
    case 'check_password':
        // Получение данных из запроса
        $email = $_GET['email'] ?? null;

        // Поиск пользователя
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (isset($_SESSION['user']['id'])) {
            unset($_SESSION['user']['id']);
        }

        // Проверка наличия пользователя
        if ($result->num_rows === 0) { // Пользователь не найден
            echo json_encode(array("find" => false));
            exit;
        }
        // Проверка наличия пользователя
        if ($result->num_rows === 1) {
            // Извлечение данных пользователя из базы данных
            $pass = pass_back($row["psd"]);
            $password = "$pass";
            // Формирование ответа
            echo json_encode(array("find" => true, "password" => $password));
            exit;
        }
}

?>