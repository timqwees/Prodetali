<?php
include_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../config.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$user = currentUser();

// Обработка POST-запроса для добавления изменений пользователя

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["replace_mysql__nick"])) {
  // Получение данных из формы
  $nickname = $_POST['replace_mysql__nick'] ?? null;
  $userID = $_SESSION['user']['id'] ?? null;

  $sql = "UPDATE users SET nickname = '$nickname' WHERE id = $userID";
  if (mysqli_query($conn, $sql)) {/*если успешно*/
    header("Location: /regist/account.php");
  } else {
    echo "Ошибка внесения данных: " . mysqli_error($conn);
  }
}

// Обработка POST-запроса для добавления изменений пользователю

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["replace_mysql__email"])) {
  // Получение данных из формы
  $email = $_POST['replace_mysql__email'] ?? null;
  $userID = $_SESSION['user']['id'] ?? null;


  $sql = "UPDATE users SET email = '$email' WHERE id = $userID";
  if (mysqli_query($conn, $sql)) {/*если успешно*/
    header("Location: #");
  } else {
    echo "Ошибка внесения данных: " . mysqli_error($conn);
  }
}

// Обработка POST-запроса для добавления изменений пользователю

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["replace_mysql__avatar"])) {
  // Получение данных из формы
  $icon = $_POST['replace_mysql__avatar'] ?? null;
  $userID = $_SESSION['user']['id'] ?? null;


  $sql = "UPDATE users SET icon = '$icon' WHERE id = $userID";
  if (mysqli_query($conn, $sql)) {/*если успешно*/
    header("Location: /regist/account.php");
  } else {
    echo "Ошибка внесения данных: " . mysqli_error($conn);
  }
}

// Обработка POST-запроса для добавления изменений пользователю

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["replace_mysql__password"])) {
  // Получение данных из формы
  $pass = $_POST['replace_mysql__password'] ?? null;
  $userID = $_SESSION['user']['id'] ?? null;
  $psd = pass_send($pass);
  $password = password_hash($pass, PASSWORD_DEFAULT);
  $sql = "UPDATE users SET password = '$password', psd = '$psd' WHERE id = $userID";
  if (mysqli_query($conn, $sql)) {/*если успешно*/
    header("Location: /regist/account.php");
  } else {
    echo "Ошибка внесения данных: " . mysqli_error($conn);
  }
}

//add new event
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'])) {
  $event_title = $_POST['title'] ?? null;
  $event_date = $_POST['date'] ?? null;
  $event_time = $_POST['time'] ?? null;
  $event_author = $_POST['author'] ?? null;
  $event_description = $_POST['description'] ?? null;
  $sql = "INSERT INTO events (title, date, time, description, author) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $event_title, $event_date, $event_time, $event_description, $event_author);
  if ($stmt->execute()) {
    echo "<script>window.location.href = '/../../../regist/account.php';</script>";
  } else {
    echo "Ошибка: " . $stmt->error;
  }
  $stmt->close();
}

//replace event
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_id'])) {
  $eventID = $_POST['select_id'] ?? null;
  $event_title_change = $_POST['change_title'] ?? null;
  $event_author_change = $_POST['change_author'] ?? null;
  $event_date_change = $_POST['change_date'] ?? null;
  $event_time_change = $_POST['change_time'] ?? null;
  $event_description_change = $_POST['change_description'] ?? null;
  $sql = "UPDATE events SET title = ?, date = ?, time = ?, description = ?, author = ? WHERE event_id = $eventID";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $event_title_change, $event_date_change, $event_time_change, $event_description_change, $event_author_change);
  if ($stmt->execute()) {
    echo "<script>window.location.href = '/../../../regist/account.php';</script>";
  } else {
    echo "Ошибка: " . $stmt->error;
  }
  $stmt->close();
  $conn->close();
}

?>