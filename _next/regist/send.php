<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once __DIR__ . '/server.php';
// Проверка наличия кода в сессии
if (isset($_SESSION["code_id"])) {
    $import = $_SESSION["code_id"];
} else {
    $import = $_SESSION["code_id"];
}
?>