<?php
include_once __DIR__ . '/../php/src/helpers.php';
include_once __DIR__ . '/../php/element.php';
include_once __DIR__ . '/../php/src/config.php';

if (isset($_SESSION['user']['id'])) {
    unset($_SESSION['user']['id']);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    // Получение данных из запроса
    $email = $_POST['email'] ?? null;
    $password = pass_send($_POST['password'] ?? "NULL");
    $rememberMe = $_POST["rememberMe"] ?? null;
    $remember = false;
    if ($rememberMe === 'on') {
        $remember = true;
    } else if ($rememberMe == 'off' || $rememberMe == null) {
        $remember = false;
    }
    $sql = "SELECT * FROM users WHERE email = ? and psd = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    if ($exists) {
        $_SESSION["user"]["id"] = $result->fetch_assoc()["id"];
        if ($remember) {
            setOldValue('email', $email);
            setOldValue('password', $password);
        } else {
            setOldValue('email', null);
            setOldValue('password', null);
        }
        redirect(dirname(__FILE__) . "/account.php");
    } else {
        echo "<script>alert('Ошибка системы! Мы уже решаем данную проблему!');</script>";
        echo "<script>window.location.href = 'log-in.php';</script>";
    }
}