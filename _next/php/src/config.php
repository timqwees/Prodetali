<?php

// PDO
const DB_HOST = 's125.craft-hosting.ru'; //имя хостинга 
const DB_PORT = '3306'; //порт хостинга 
const DB_NAME = 'bdp472_s1'; // имя папки базы данных 
const DB_USERNAME = 'bdp472_s1'; // логин от БД 
const DB_PASSWORD = '123456'; // Пароль от БД 

// Без PDO 
$servername = "s125.craft-hosting.ru";
$dbname = "bdp472_s1";
$username = "bdp472_s1";
$password = "123456";

$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
?>