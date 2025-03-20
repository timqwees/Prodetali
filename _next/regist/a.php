<?php
include_once __DIR__ . '/../php/src/helpers.php';
include_once __DIR__ . '/../php/element.php';
include_once __DIR__ . '/../php/src/config.php';

$user = currentUser();

// Подключение к базе данных и другие необходимые действия

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];

    // Подготовка запроса для проверки существующего пользователя с такой же почтой
    $checkQuery = "SELECT * FROM users WHERE email='$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    $response = [
        'exists' => mysqli_num_rows($checkResult) > 0,
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>