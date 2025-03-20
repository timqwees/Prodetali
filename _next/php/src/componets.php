<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . "/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send_mysqli_info"])) {


  // Получение значения id пользователя из поля ввода
  $user_id = $_POST['userId'];

  $check_id = findID($user_id);

  // Осуществляем проверки  
  if (empty($user_id)) { // пустая строка
    setMessage('error', "Пожалуйста, заполните пустую строку USER_ID!");
    $send = "main-panel.php";
    redirect($send);
  } elseif ($check_id == false) { // Проверка ID пользователей с базы данных
    setMessage('error', "Введённый вами USER_ID: <font color='#cc0033'>$user_id не найден</font> в базе данных!");
    $send = "main-panel.php";
    redirect($send);
  } elseif ($check_id == true) {

    // SQL-запрос для получения почты пользователя по его id
    $sql = "SELECT email, adress, firstname, lastname, phone FROM users WHERE id = $user_id";

    $result = $conn->query($sql);

    // Проверка, найдены ли данные пользователя
    if ($result->num_rows > 0) {
      // Вывод информации о пользователе
      $row = $result->fetch_assoc();
      $email = $row["email"];
      $adress = $row["adress"];
      $phone = $row["phone"];
      $id = $user_id;
      $firstname = $row["firstname"];
      $lastname = $row["lastname"];
    } else {
      die("Подключение не удалось!" . mysqli_error($result));
    }
  }
}

/* Обработка POST-запроса для регистрации нового пользователя */

// Проверка наличия POST-запроса для регистрации нового пользователя
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sqli_reg_new_user"])) {
  $firstname = $_POST["firstname_reg"] ?? null;
  $lastname = $_POST["lastname_reg"] ?? null;
  $password = $_POST["password_reg"] ?? null;
  $avatar = $_FILES["avatar"] ?? null;
  $email = $_POST["email_reg"] ?? null;
  $avatarPath = null;

  // Проверка обязательных полей
  if (!$lastname) {
    setMessage("error-message", "Пожалуйста, заполните поле 'Имя пользователя'!");
    $send = "main-panel.php";
    redirect($send);
    exit();
  } elseif (!$firstname) {
    setMessage("error-message", "Пожалуйста, заполните поле 'Фамилия пользователя'!");
    $send = "main-panel.php";
    redirect($send);
    exit();
  } elseif (!$email) {
    setMessage("error-message", "Пожалуйста, заполните поле 'Почта пользователя'!");
    $send = "main-panel.php";
    redirect($send);
    exit();
  } elseif (!$password) {
    setMessage("error-message", "Пожалуйста, заполните поле 'Пароль пользователя'!");
    $send = "main-panel.php";
    redirect($send);
    exit();
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setMessage("error-message", 'Указанная почта не соответствует стандарту! Проверьте, чтобы в ней был символ @');
    $send = "main-panel.php";
    redirect($send);
    exit();
  }

  // Проверка изображения профиля
  if (!empty($avatar["name"])) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    if (!in_array($avatar['type'], $allowedTypes)) {
      setMessage("error-message", 'Изображение профиля имеет неверный тип! Допустимые форматы: png, jpg, gif, jpeg');
      $send = "main-panel.php";
      redirect($send);
      exit();
    } elseif (($avatar['size'] / 1024 / 1024) >= 15) {
      setMessage("error-message", 'Изображение должно быть размером не более 15 МБ');
      $send = "main-panel.php";
      redirect($send);
      exit();
    }
  }

  // Хеширование пароля
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);

  // Подготовка запроса для проверки существующего пользователя с такой же почтой
  $checkQuery = "SELECT * FROM users WHERE email='$email'";
  $checkResult = mysqli_query($conn, $checkQuery);

  // Проверка, если пользователь с такой же почтой уже существует
  if (mysqli_num_rows($checkResult) > 0) {
    setMessage("error-message", "Пользователь с указанной почтой уже зарегистрирован!");
    $send = "main-panel.php";
    redirect($send);
    exit();
  }

  //  Загружаем аватарку, если она была отправлена в форме

  if (!empty($avatar)) {
    $avatarPath = uploadFile($avatar, 'avatar');
  }

  // Подготовка запроса для вставки данных

  $pdo = getPDO();

  $query = "INSERT INTO users (lastname, firstname, email, avatar, password) VALUES (:firstname, :lastname, :email, :avatar, :password)";

  $params = [
    'firstname' => $lastname,
    'lastname' => $firstname,
    'email' => $email,
    'avatar' => $avatarPath,
    'password' => password_hash($password, PASSWORD_DEFAULT)
  ];

  $stmt = $pdo->prepare($query);

  try {
    $stmt->execute($params);
  } catch (\Exception $e) {
    die($e->getMessage());
  }
  setMessage('nice-reg-message', "Пользователь $firstname $lastname успешно зарегистрирован!");
  $send = "main-panel.php";
  redirect($send);
}

/* POINTS БАЛЛЫ  */
// Обработка POST-запроса для добавления баллов пользователю
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_points"])) {
  // переменные с input
  $id = $_POST["user_id"];
  $points = $_POST["points"];
  $check_id_points = findID($id);

  // Осуществляем проверки  
  if (empty($id)) { // пустая строка
    setMessage('error_points', "<i class='fa fa-check text-danger'></i> Пожалуйста, заполните пустую строку USER_ID!");
    $send = "main-panel.php";
    redirect($send);
  } elseif ($check_id_points == false) { // Проверка ID пользователей с базы данных
    setMessage('error_points', "<i class='fa fa-close text-danger'></i> Введённый вами USERS_ID: <font color='#cc0033'>$id не найден </font>в базе данных!");
    $send = "main-panel.php";
    redirect($send);
  } elseif (empty($points) or $points <= 0) {
    setMessage('error_points', "<i class='fa fa-close text-danger'></i> Строка зачисления баллов не может быть <font color='#cc0033'>пустым</font>, равняться <font color='#cc0033'>нулю</font> или быть <font color='#cc0033'>меньше нуля!</font>");
    $send = "main-panel.php";
    redirect($send);
  } elseif ($check_id_points == true) { // else

    // подготовка sql обновления
    $sql = "UPDATE users SET points = points + $points WHERE id = $id";

    // Запрос на получения данных с базы
    $sqlite = "SELECT firstname, lastname, phone, points FROM users WHERE id = $id";

    $result = $conn->query($sqlite);

    // Проверка, найдены ли данные пользователя
    if ($result->num_rows > 0) {
      // Вывод информации о пользователе
      $row = $result->fetch_assoc();
      $firstname = $row["firstname"];
      $lastname = $row["lastname"];
      $count_point = $row["points"];

      //вносим в базу данных
      if (mysqli_query($conn, $sql)) {
        setMessage('nice', "<i class='fa fa-check text-success'></i> Успешно добавлено <font color='#2dce88'>+$points балл(а/ов) </font> пользователю!");
      } else {
        setMessage('error_points', "Ошибка при добавлении баллов: " . mysqli_error($conn));
      }
    } else {
      die("Подключение не удалось!" . mysqli($result));
    }
  }
}


// Обработка POST-запроса для изьятия баллов пользователю
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_points"])) {
  // переменные с input
  $id_rem = $_POST["user_id_remove"];
  $points_rem = $_POST["points_remove"];
  $check_id_points_rem = findID($id_rem);

  // Осуществляем проверки  
  if (empty($id_rem)) { // пустая строка
    setMessage('error_points_remove', "<i class='fa fa-check text-danger'></i> Пожалуйста, заполните пустую строку USER_ID!");
    $send = "main-panel.php";
    redirect($send);
  } elseif ($check_id_points_rem == false) { // Проверка ID пользователей с базы данных
    setMessage('error_points_remove', "<i class='fa fa-close text-danger'></i> Введённый вами USERS_ID: <font color='#cc0033'>$id_rem не найден </font>в базе данных!");
    $send = "main-panel.php";
    redirect($send);
  } elseif (empty($points_rem) or $points_rem <= 0) {
    setMessage('error_points_remove', "<i class='fa fa-close text-danger'></i> Строка зачисления баллов не может быть <font color='#cc0033'>пустым</font>, равняться <font color='#cc0033'>нулю</font> или быть <font color='#cc0033'>меньше нуля!</font>");
    $send = "main-panel.php";
    redirect($send);
  } elseif ($check_id_points_rem == true) { // else

    // подготовка sql обновления
    $sql = "UPDATE users SET points = points - $points_rem WHERE id = $id_rem";

    // Запрос на получения данных с базы
    $sqlite = "SELECT firstname, lastname, phone, points FROM users WHERE id = $id_rem";

    $result = $conn->query($sqlite);

    // Проверка, найдены ли данные пользователя
    if ($result->num_rows > 0) {
      // Вывод информации о пользователе
      $row = $result->fetch_assoc();
      $firstname = $row["firstname"];
      $lastname = $row["lastname"];
      $count_point_rem = $row["points"];

      //вносим в базу данных
      if (mysqli_query($conn, $sql)) {
        setMessage('remove_accept', "<font color='#57d8a0'><i class='fa fa-check'></i></font> Успешно язъято <font color='#57d8a0'>-$points_rem балл(а/ов) </font> пользователю!");
      } else {
        setMessage('error_points_remove', "<i class='fas fa-exclamation text-danger'></i></button>&nbsp;&nbsp;Ошибка при добавлении баллов: " . mysqli_error($conn));
      }
    } else {
      die("Подключение не удалось!" . mysqli($result));
    }
  }
}
?>