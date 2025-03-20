<?php
ob_start(); // Start output buffering

// Устанавливаем таймер на 5 секунд
$time_start = time();

include_once __DIR__ . '/../php/src/helpers.php';
include_once __DIR__ . '/../php/element.php';

// Запуск сеанса
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$user = currentUser();

$current_session_id = session_id();
session_regenerate_id();
// Проверьте, изменился ли идентификатор сеанса
if ($current_session_id != session_id()) {
  unset($_SESSION["code_id"]);
  $_SESSION["tom"] = false;
}

ob_end_flush(); // Flush the output buffer

// Получение датчика из URL-адреса
$sensor = $_GET['sensor'] ?? null;
// Получение идентификатора сессии из куки или HTTP-заголовка
$sessionId = $_COOKIE['sensor'] ?? null;
$_SESSION["tom"] = true;
$_SESSION["block"] = "";
if (!isset($sensor) || $sensor === null || !($sensor == $sessionId)) {
  header("Location: traker.php");
  exit;
}
// if ($sessionId != null) {
//   $_SESSION["block"] = "true";
// } elseif ($sensor != $sessionId) {
//   unset($_COOKIE['sensor']);
//   unset($_SESSION['sensor']);
//   $_SESSION["tom"] = false;
//   // Если датчики не совпадают, перенаправление на страницу тракера
//   header("Location: traker.php");
//   exit;
// } elseif (
//   isset($_SESSION["nickname"]) ||
//   isset($_SESSION["email"]) ||
//   isset($_SESSION["password"]) ||
//   isset($_SESSION["icon"])
// ) {
//   unset($_SESSION["nickname"]);
//   unset($_SESSION["email"]);
//   unset($_SESSION["password"]);
//   unset($_SESSION["icon"]);
//   unset($_COOKIE['sensor']);
//   unset($_SESSION['sensor']);
//   $_SESSION["tom"] = false;
//   header("Location: traker.php");
//   exit;
// } else {
//   $_SESSION["tom"] = true;
// }

// Проверяем, загрузилась ли страница в течение 5 секунд
// if (time() - $time_start > 5) {
//   header("Location: traker.php");
//   exit;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <style>
    .noentrance {
      background-color: rgb(231, 75, 75) !important;
      width: 16px !important;
      height: 16px !important;
      position: absolute !important;
      border-radius: 50% !important;
      font-size: 10px !important;
      display: flex !important;
      align-items: center !important ! justify-content: center !important;
      color: #fff !important;
      right: 25px;
    }

    .noentrance i {
      transform: translate(3px, 3px) !important;
    }

    .yeaentrance {
      background-color: #3a6df0 !important;
      width: 16px;
      height: 16px;
      position: absolute;
      border-radius: 50%;
      font-size: 10px !important;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff !important;
      right: 25px;
    }

    body {
      overflow-y: scroll;
    }

    body.dark {
      --dar: #333;
      --bord: 1px solid #fff;
      --whiter-color: #f9f9f9;
      --white-color: #fff;
      --blue-color: #4070f4;
      --grey-color: #707070;
      --grey-color-light: #aaa;
      --text-color: #a1a1a1;
      --content-color: #f2f2f2;
      --accent-color: none;
      --geist-foreground-rgb: 0, 0, 0;
      --buttom: #F9F9F9;
      --border-radius: 12px;
      --dark: #000;
      --navigator: #333;
      --input: #252525;
      --nb: #414145;
      --inptext: #b5b5b5;
      --hhg: #A4C6FF;
      --mestext: #f9f9f9;
      --hh: #7CFFA8;
    }

    :root {
      --inptext: gray;
      --input: #fff;
      --whiter-color: transparent;
      --white-color: #333;
      --blue-color: #fff;
      --grey-color: #f2f2f2;
      --content-color: #707070;
      --grey-color-light: #aaa;
      --bord: 1px solid #333;
      --geist-foreground-rgb: 255, 255, 255;
      --dar: #F9F9F9;
      --buttom: #333;
      --dark: #fff;
      --navigator: #333;
      --nb: gray;
      --hh: #405AB4;
      --hhg: #405AB4;
      --mestext: #333;
    }

    form input[type=text],
    form input[type=password],
    form input[type=email] {
      padding-left: 1rem;
    }

    .form-control-submit-button {
      background: var(--white-color) !important;
      border-radius: 0.5rem !important;
      display: inline-block;
      width: 100%;
      height: 3.125rem;
      cursor: pointer;
      z-index: 999 !important;
      transition: all 0.5s ease;
    }

    .form-control-submit-button h2 {
      font-size: calc(25px - 2px);
      color: var(--dark) !important;
      font-weight: 500;
      transition: all 1s ease;
      transform: translateY(1px);
      font-family: "SB Sans Display";
    }

    .form-control-submit-button i {
      transform: translateY(6.5px);
      transition: all 1s ease;
    }

    .disabled-button {
      opacity: 0.55;
    }

    .disabled-button-input {
      opacity: 0.55;
      pointer-events: none;
      cursor: none;
    }

    .information,
    .codeemail,
    .traker {
      max-height: 1000px;
      /* устанавливает максимальную высоту блока */
      overflow: hidden;
      opacity: 1;
      transition: all 0.5s ease;
      /* плавный переход */
    }

    .transition {
      max-height: 0;
      opacity: 0;
    }

    .full {
      opacity: 1;
      max-height: 1000px;
    }

    .ddd:hover {
      padding: 10px;
      border: var(--bord) !important;
      border-radius: 15px;
      transition: all 1s ease;
      -webkit-transition: all 1s ease;
      -moz-transition: all 1s ease;
      -ms-transition: all 1s ease;
      -o-transition: all 1s ease;
      -webkit-border-radius: 15px;
      -moz-border-radius: 15px;
      -ms-border-radius: 15px;
      -o-border-radius: 15px;
    }

    .ddd {
      border: 0px solid black !important;
      padding: none;
      border-radius: 0.5rem;
      transition: all 0.5s ease;
      -webkit-transition: all 1s ease;
      -moz-transition: all 1s ease;
      -ms-transition: all 1s ease;
      -o-transition: all 1s ease;
      -webkit-border-radius: 0.5rem;
      -moz-border-radius: 0.5rem;
      -ms-border-radius: 0.5rem;
      -o-border-radius: 0.5rem;
    }

    @media screen and (max-width: 768px) {

      .error_message_email {
        width: 55% !important;
      }

      .above-heading {
        font: 700 1rem / 1.5rem "Open Sans", sans-serif !important;
      }

      .bloctime p {
        font-size: 10px !important;
      }


      .label-control {
        top: 20px !important;
      }

      .form-control-submit-button h2 {
        font-size: calc(18px - 2px);
        color: var(--dark) !important;
        font-weight: 500;
        transition: all 1s ease;
        transform: translateY(-3px);
        font-family: "SB Sans Display";
      }

      .label-control {
        margin-top: -7.5px;
      }

      .form-control-input:focus+.label-control,

      .form-control-input.notEmpty+.label-control,
      .form-control-textarea:focus+.label-control,
      .form-control-textarea.notEmpty+.label-control {
        top: 0rem !important;
        opacity: 1;
        font-size: 0.6rem;
        left: 10px;
        color: #fff;
        background: var(--navigator);
        padding: 0px 10px 0px 10px;
        transition: padding top font-size 1s ease;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        -webkit-transition: padding top font-size 1s ease;
        -moz-transition: padding top font-size 1s ease;
        -ms-transition: padding top font-size 1s ease;
        -o-transition: padding top font-size 1s ease;
      }
    }

    @media screen and (min-width: 768px) {
      .text-lead {
        font-size: 15px;
        margin-top: -1rem !important;
        transition: 1s ease all;
      }
    }

    .navlink {
      font-weight: normal;
    }

    .nav_link {
      font-weight: normal;
      font-size: 14px !important;
    }

    .sidebar .nav_link {
      padding: 4px 1rem;
    }
  </style>


  <!-- CSS FILES -->
  <link crossorigin="anonymous" rel="stylesheet" href="/../css/tap_browser.css">
  <link crossorigin="anonymous" id="pagestyle" href="assets/css/reg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link crossorigin="anonymous" rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;1,400&display=swap">
  <link crossorigin="anonymous" href="../css/swiper.css" rel="stylesheet">
  <link crossorigin="anonymous" href="../css/register.css" rel="stylesheet">
  <link crossorigin="anonymous" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- SEO Meta Tags -->
  <meta name="description" content="TimQwees -  Регистрация [Металлообработки]">
  <meta name="author" content="TimQwees">

  <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
  <meta property="og:site_name" content="Металлообработки - REGISTRATION" /> <!-- website name -->
  <meta property="og:site" content="" /> <!-- website link -->
  <meta property="og:title" content="Регистрация - TimQwees [Металлообработки]" />
  <!-- title shown in the actual shared post -->
  <meta property="og:description" content="Металлообработки - регистрация" />
  <!-- description shown in the actual shared post -->
  <meta property="og:image" content="/../images/logo.png" />
  <!-- image link, make sure it's jpg -->
  <meta property="og:url" content="https://t.me/timqwees" /> <!-- where do you want your post to link to -->
  <meta property="og:type" content="article" />

  <!-- Website Title -->
  <title>TimQwees [Металлообработки] - Регистрация</title>

  <script defer async src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Styles -->
  <link crossorigin="anonymous" id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet">
  <!-- icon -->
  <!-- <link crossorigin="anonymous" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link crossorigin="anonymous" rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link crossorigin="anonymous" rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link crossorigin="anonymous" rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.1/css/all.css">
  <link crossorigin="anonymous" rel="stylesheet" href="https://use.fontawesome.com/releases/v1.0.0/css/all.css"> -->
  <link crossorigin="anonymous" rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
  <link crossorigin="anonymous" rel="stylesheet" href="https://use.fontawesome.com/releases/v4.7.0/css/all.css">
  <link crossorigin="anonymous" rel="stylesheet" href="https://use.fontawesome.com/releases/v3.0.0/css/all.css">
  <!-- finish icon -->

  <link crossorigin="anonymous"
    href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
    rel="stylesheet">
  <link crossorigin="anonymous" href="../css/swiper.css" rel="stylesheet">
  <link crossorigin="anonymous" href="css/styles.css" rel="stylesheet">
  <link crossorigin="anonymous" href="../css/edits.css" rel="stylesheet">
  <link crossorigin="anonymous" href="../css/login.css" rel="stylesheet">
  <link crossorigin="anonymous" href="../css/register.css" rel="stylesheet">
  <link crossorigin="anonymous" href="css/reg.css" rel="stylesheet">

  <!-- Favicon  -->
  <link crossorigin="anonymous" rel="icon" href="/../images/logo/project_logo_technologies_of_the_future.png"
    type="image/x-icon">

  <script defer async src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script defer async src="js/jquery.maskedinput.js"></script>
  <script defer async src="js/jquery.validate.min.js"></script>
  <script defer async src="js/script.js"></script>
</head>

<body data-spy="scroll" data-target=".fixed-top">

  <!-- Preloader -->
  <div class="spinner-wrapper">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
  </div>

  <!-- end of preloader -->
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="/../images/logo.png" alt="gream's" /></i>
    </div>

    <?php echo $search; ?>

    <div class="navbar_content">
      <i class="bi bi-grid"></i>
      <i class='bx bx-sun' id="darkLight"></i>
      <i class='bx bx-bell'></i>
      <a href="/../<?php echo $send_profil ?>"><img src="/../<?php echo $account_icon ?>" alt="icon"
          class="profile" /></a>
    </div>
  </nav>

  <!-- sidebar -->
  <nav class="sidebar close hoverable">
    <div class="menu_content" style="margin-left: -16px">
      <ul class="menu_items">
        <div class="menu_title none-title menu_dahsboard"></div>
        <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
        <!-- start -->
        <li class="item">
          <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
              <i class="bx bx-home-alt"></i>
            </span>
            <span class="navlink">Главная</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>

          <ul class="menu_items submenu">
            <a href="/../<?php echo $title_self ?>" class="nav_link sublink"><?php echo $title ?>
              <?php echo $upmes ?></a>
            <a href="/../<?php echo $title1_self ?>" class="nav_link sublink"><?php echo $title1 ?>
              <?php echo $upmes1 ?></a>
          </ul>
        </li>
        <!-- end -->

        <!-- duplicate this li tag if you want to add or remove  navlink with submenu -->
        <!-- start -->
        <!-- <li class="item">
          <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
              <i class="bx bx-grid-alt"></i>
            </span>
            <span class="navlink">Важные</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>

          <ul class="menu_items submenu">
            <a href="https://vk.com/greamsrp" class="nav_link sublink"><? echo $title11 ?> <?php echo $upmes10 ?></a>
            <a href="https://t.me/timqwees" class="nav_link sublink"><? echo $title8 ?> <?php echo $upmes11 ?></a>
            <a href="/../<?php echo $fqa ?>" class="nav_link sublink"><? echo $title9 ?> <?php echo $upmes8 ?></a>
            <a href="/../<?php echo $bagus ?>" class="nav_link sublink"><? echo $title10 ?> <?php echo $upmes9 ?></a>
          </ul>
        </li> -->
        <!-- end -->
      </ul>

      <ul class="menu_items">
        <div class="menu_title menu_editor"></div>
        <!-- duplicate these li tag if you want to add or remove navlink only -->
        <!-- Start -->
        <li class="item">
          <a href="/../<?php echo $title2_self ?>" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bxs-magic-wand"></i>
            </span>
            <span class="navlink"><?php echo $title2 ?> <?php echo $upmes2 ?></span>
          </a>
        </li>
        <!-- End -->

        <li class="item">
          <a href="<?php echo $title3_self ?>" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bxs-book-content"></i>
            </span>
            <span class="navlink"><?php echo $title3 ?> <?php echo $upmes3 ?></span>
          </a>
        </li>
        <li class="item">
          <a href="/../<?php echo $title4_self ?>" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-loader-circle fa-spin"></i>
            </span>
            <span class="navlink"><?php echo $title4 ?> <?php echo $upmes4 ?></span>
          </a>
        </li>
        <!-- <li class="item">
          <a href="/../<?php echo $title5_self ?>" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-cloud-upload"></i>
            </span>
            <span class="navlink"><?php echo $title5 ?> <?php echo $upmes5 ?></span>
          </a>
        </li> -->
      </ul>
      <ul class="menu_items">
        <div class="menu_title menu_setting"></div>
        <!-- <li class="item">
          <a href="/../<?php echo $title6_self ?>" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-cog"></i>
            </span>
            <span class="navlink"><?php echo $title6 ?> <?php echo $upmes6 ?></span>
          </a>
        </li> -->
        <li class="item">
          <a href="/../<?php echo $title7_self ?>" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bxs-user-account"></i>
            </span>
            <span class="navlink"><?php echo $title7 ?> <?php echo $upmes7 ?></span>
          </a>
        </li>
      </ul>

      <!-- Sidebar Open / Close -->
      <div class="bottom_content">
        <div class="bottom expand_sidebar">
          <span> Удерживать окно</span>
          <i class='bx bx-log-in'></i>
        </div>
        <div class="bottom collapse_sidebar">
          <span> Закрывать</span>
          <i class='bx bx-log-out'></i>
        </div>
      </div>
    </div>
  </nav>

  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg marg"
      style="background-position: top;top: 4em">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Regisration!</h1>
            <p class="text-lead text-white" style="transform: translateY(-15px)">Зарегистрируйся на форуме, чтобы
              использовать платформу.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container" style="margin-top: 2em">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0 dark">
            <div class="card-header text-center pt-4">

              <!-- Blocktime -->
              <div class="bloctime" id="bloctime">
                <div class="container_reg">
                  <div class="inform" id="inform">
                    <h4 id="title_timer" class="above-heading">Сессия регистрации</h4>
                    <p id="message_timer" class="mestext">До конца регистрации: <i id="my-tooltip"
                        class="fas fa-question-circle"
                        style="font-size: 10px;cursor: pointer;transform: translate(5px, .5px);"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Во время таймера ваша сессия активна. После окончания времени ваша сессия завершиться и вам нужно будет перезагрзить страницу для повторной регистрации! Важно: 》При случайном обновлении страницы до окончания времени ваша сессия всё ровно будет активна"></i>
                    </p>
                  </div>

                  <div class="ti" id="ti">
                    <div class="time">
                      <div class="date_reg dater_1" id="minutes">0</div>
                      <p class="mestext" style="margin-right: 1.5px">Минут</p>
                    </div>
                    <b>:</b>
                    <div class="time">
                      <div class="date_reg dater" id="seconds">0</div>
                      <p class="mestext">Секунд</p>
                    </div>
                  </div>
                </div>
              </div><!-- end bloctime -->

              <h1 style="margin-top: 1.5rem;font-family: 'SB Sans Display';font-weight: 600;font-size: 20px">
                TimQwees 》<font style="font-weight: 500;">Регистрация профиля [Металлообработки]</font>
              </h1>
            </div>
            <div class="information">
              <div class="row px-xl-5 px-sm-4 px-3">
                <!-- <div class="col-3 ms-auto px-1">
                  <a class="btn btn-outline-light w-100" href="javascript:;">
                    <svg width="40px" height="32px" viewBox="15 -5 210 230" version="1.1" id="VK_Logo"
                      xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <style>
                          .st0 {
                            clip-path: url(#SVGID_2_);
                            fill: #5181b8
                          }

                          .st1 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: #fff
                          }
                        </style>
                        <g id="Base">
                          <defs>
                            <path id="SVGID_1_"
                              d="M71.6 5h58.9C184.3 5 197 17.8 197 71.6v58.9c0 53.8-12.8 66.5-66.6 66.5H71.5C17.7 197 5 184.2 5 130.4V71.5C5 17.8 17.8 5 71.6 5z">
                            </path>
                          </defs>
                          <use xlink:href="#SVGID_1_" overflow="visible" fill-rule="evenodd" clip-rule="evenodd"
                            fill="#5181b8"></use>
                          <clipPath id="SVGID_2_">
                            <use xlink:href="#SVGID_1_" overflow="visible"></use>
                          </clipPath>
                          <path class="st0" d="M0 0h202v202H0z"></path>
                        </g>
                        <path id="Logo" class="st1"
                          d="M162.2 71.1c.9-3 0-5.1-4.2-5.1h-14c-3.6 0-5.2 1.9-6.1 4 0 0-7.1 17.4-17.2 28.6-3.3 3.3-4.7 4.3-6.5 4.3-.9 0-2.2-1-2.2-4V71.1c0-3.6-1-5.1-4-5.1H86c-2.2 0-3.6 1.7-3.6 3.2 0 3.4 5 4.2 5.6 13.6v20.6c0 4.5-.8 5.3-2.6 5.3-4.7 0-16.3-17.4-23.1-37.4-1.4-3.7-2.7-5.3-6.3-5.3H42c-4 0-4.8 1.9-4.8 4 0 3.7 4.7 22.1 22.1 46.4C70.9 133 87.2 142 102 142c8.9 0 10-2 10-5.4V124c0-4 .8-4.8 3.7-4.8 2.1 0 5.6 1 13.9 9 9.5 9.5 11.1 13.8 16.4 13.8h14c4 0 6-2 4.8-5.9-1.3-3.9-5.8-9.6-11.8-16.4-3.3-3.9-8.2-8-9.6-10.1-2.1-2.7-1.5-3.9 0-6.2 0-.1 17.1-24.1 18.8-32.3z">
                        </path>
                      </g>
                    </svg>
                  </a>
                  <i id="my-tooltip" class="fa fa-user-times"
                    style="transform: translate(2.2rem, -.5rem);font-size: 10px;cursor: pointer;color: #FF7866"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Сервис временно недоступен!"></i>
                </div>
                <div class="col-3 px-1">
                  <a class="btn btn-outline-light w-100" href="javascript:;">
                    <svg width="24px" height="32px" viewBox="0 0 64 64" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(7.000000, 0.564551)" fill="#000000" fill-rule="nonzero">
                          <path class="apple"
                            d="M40.9233048,32.8428307 C41.0078713,42.0741676 48.9124247,45.146088 49,45.1851909 C48.9331634,45.4017274 47.7369821,49.5628653 44.835501,53.8610269 C42.3271952,57.5771105 39.7241148,61.2793611 35.6233362,61.356042 C31.5939073,61.431307 30.2982233,58.9340578 25.6914424,58.9340578 C21.0860585,58.9340578 19.6464932,61.27947 15.8321878,61.4314159 C11.8738936,61.5833617 8.85958554,57.4131833 6.33064852,53.7107148 C1.16284874,46.1373849 -2.78641926,32.3103122 2.51645059,22.9768066 C5.15080028,18.3417501 9.85858819,15.4066355 14.9684701,15.3313705 C18.8554146,15.2562145 22.5241194,17.9820905 24.9003639,17.9820905 C27.275104,17.9820905 31.733383,14.7039812 36.4203248,15.1854154 C38.3824403,15.2681959 43.8902255,15.9888223 47.4267616,21.2362369 C47.1417927,21.4153043 40.8549638,25.1251794 40.9233048,32.8428307 M33.3504628,10.1750144 C35.4519466,7.59650964 36.8663676,4.00699306 36.4804992,0.435448578 C33.4513624,0.558856931 29.7884601,2.48154382 27.6157341,5.05863265 C25.6685547,7.34076135 23.9632549,10.9934525 24.4233742,14.4943068 C27.7996959,14.7590956 31.2488715,12.7551531 33.3504628,10.1750144">
                          </path>
                        </g>
                      </g>
                    </svg>
                  </a>
                  <i id="my-tooltip" class="fa fa-user-times"
                    style="transform: translate(2.2rem, -.5rem);font-size: 10px;cursor: pointer;color: #FF7866"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Сервис временно недоступен!"></i>
                </div>
                <div class="col-3 me-auto px-1">
                  <a class="btn btn-outline-light w-100" href="javascript:;">
                    <svg width="24px" height="32px" viewBox="0 0 64 64" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(3.000000, 2.000000)" fill-rule="nonzero">
                          <path
                            d="M57.8123233,30.1515267 C57.8123233,27.7263183 57.6155321,25.9565533 57.1896408,24.1212666 L29.4960833,24.1212666 L29.4960833,35.0674653 L45.7515771,35.0674653 C45.4239683,37.7877475 43.6542033,41.8844383 39.7213169,44.6372555 L39.6661883,45.0037254 L48.4223791,51.7870338 L49.0290201,51.8475849 C54.6004021,46.7020943 57.8123233,39.1313952 57.8123233,30.1515267"
                            fill="#4285F4"></path>
                          <path
                            d="M29.4960833,58.9921667 C37.4599129,58.9921667 44.1456164,56.3701671 49.0290201,51.8475849 L39.7213169,44.6372555 C37.2305867,46.3742596 33.887622,47.5868638 29.4960833,47.5868638 C21.6960582,47.5868638 15.0758763,42.4415991 12.7159637,35.3297782 L12.3700541,35.3591501 L3.26524241,42.4054492 L3.14617358,42.736447 C7.9965904,52.3717589 17.959737,58.9921667 29.4960833,58.9921667"
                            fill="#34A853"></path>
                          <path
                            d="M12.7159637,35.3297782 C12.0932812,33.4944915 11.7329116,31.5279353 11.7329116,29.4960833 C11.7329116,27.4640054 12.0932812,25.4976752 12.6832029,23.6623884 L12.6667095,23.2715173 L3.44779955,16.1120237 L3.14617358,16.2554937 C1.14708246,20.2539019 0,24.7439491 0,29.4960833 C0,34.2482175 1.14708246,38.7380388 3.14617358,42.736447 L12.7159637,35.3297782"
                            fill="#FBBC05"></path>
                          <path
                            d="M29.4960833,11.4050769 C35.0347044,11.4050769 38.7707997,13.7975244 40.9011602,15.7968415 L49.2255853,7.66898166 C44.1130815,2.91684746 37.4599129,0 29.4960833,0 C17.959737,0 7.9965904,6.62018183 3.14617358,16.2554937 L12.6832029,23.6623884 C15.0758763,16.5505675 21.6960582,11.4050769 29.4960833,11.4050769"
                            fill="#EB4335"></path>
                        </g>
                      </g>
                    </svg>
                  </a>
                  <i id="my-tooltip" class="fa fa-user-times"
                    style="transform: translate(2.2rem, -.5rem);font-size: 10px;cursor: pointer;color: #FF7866"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Сервис временно недоступен!"></i>
                </div>
                <div class="mt-2 position-relative text-center">
                  <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 px-3">
                    или
                  </p>
                </div> -->

                <div class="card-body">
                  <form data-toggle="validator" data-focus="false" role="form" method="post"
                    enctype="multipart/form-data" id="signUpForm" action="sender.php">


                    <div class="form-group">
                      <div class="input-wrapper">
                        <input style="border:0.5px solid var(--nb);border-radius: 5px;font-family: 'SB Sans Display'"
                          type="text" class="mestext form-control-input" id="icon" name="icon" placeholder="Аватар"
                          readonly required>
                        <label class="label-control-avatar form-control-avatar" for="icon">Icon</label>

                        <button class="buttonsing" type="button" onclick="openAvatarModal()"><span>Выберите
                            аватар</span></button>

                        <div id="avatarModal" class="modal">
                          <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Выберите аватар</h2>
                            <div class="avatar-options">
                              <img src="../images/icon/1.jpg" onclick="selectAvatar('../images/icon/1.jpg')">
                              <img src="../images/icon/2.jpg" onclick="selectAvatar('images/icon/2.jpg')">
                              <img src="../images/icon/3.jpg" onclick="selectAvatar('images/icon/3.jpg')">
                              <img src="../images/icon/4.jpg" onclick="selectAvatar('images/icon/4.jpg')">
                              <img src="../images/icon/5.jpg" onclick="selectAvatar('images/icon/5.jpg')">
                              <img src="../images/icon/6.jpg" onclick="selectAvatar('images/icon/6.jpg')">
                              <img src="../images/icon/7.jpg" onclick="selectAvatar('images/icon/7.jpg')">
                              <img src="../images/icon/8.jpg" onclick="selectAvatar('images/icon/8.jpg')">
                              <img src="../images/icon/happy.jpg" onclick="selectAvatar('images/icon/happy.jpg')">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <input type="email" class="mestext form-control-input"
                        style="border:0.5px solid var(--nb);border-radius: 5px;padding-right: 5%;font-family: 'SB Sans Display'"
                        id="email" name="email" required placeholder="example@gmail.com">
                      <label class="label-control" for="email">Email</label>
                      <div style="display: flex;">
                        <div style="width: 85%" class="help-block with-errors"></div>

                        <div class="error_message_email" id="email-message">

                          <div id="ok"><!--START-->
                            <span id="email-message_ok">
                              <p style="color: #5DFF61;" class="ok">Свободен</p>
                              <div class="circle_inf"><i class="fa fa-check"></i></div>
                            </span>
                          </div><!--end-->

                          <div id="load"><!--START-->

                            <span id="email-message_load">
                              <p class="load" style="color: var(--email-block)">Поиск...</p>
                              <div class="circle_inf_load"><i class="fa fa-search"></i></div>
                            </span>
                          </div><!--end-->


                          <div id="validator"><!--START-->

                            <span id="email-message_validator">
                              <p class="validator" style="color: var(--email-block)">Добавьте @</p>
                              <div class="circle_inf_validator"><i class="fa fa-ban"></i></div>
                            </span>
                          </div><!--end-->


                          <div id="valid"><!--START-->

                            <span id="email-message_valid">
                              <p class="valid" style="color: #6478FF">Неккоретно!</p>
                              <div class="circle_inf_valid"><i style="transform: translateY(-1px)"
                                  class="fa fa-exclamation-triangle"></i></div>
                            </span>
                          </div><!--end-->

                          <div id="not">
                            <span id="email-message_not">
                              <p style="color: #EE3A3C" class="not">Уже занят</p>
                              <div class="circle_inf_not"><i class="fa fa-ban"></i></div>
                            </span>
                          </div><!--end-->

                          </p>
                        </div>

                      </div><!-- flex -->

                    </div>

                    <div class="form-group">
                      <input style="border:0.5px solid var(--nb);border-radius: 5px;font-family: 'SB Sans Display'"
                        type="text" class="mestext form-control-input" id="nickname" name="nickname" required
                        placeholder="Иванов Иван Иванович">
                      <label class="label-control" for="nickname">ФИО</label>
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <div class="input-wrapper">
                        <i style='cursor:pointer;font-size: 70%;' class="fa fa-eye" id='toggle-password'></i>
                        <input
                          style="border:0.5px solid var(--nb);border-radius: 5px;padding-right: 50px;font-family: 'SB Sans Display'"
                          type="password" class="form-control-input mestext" id="password" name="password" required>
                        <label class="label-control" for="password">Password</label>
                      </div>
                      <div class="error-message_password" id="password_length_message"></div>
                    </div>

                    <div style="display: flex;position: relative;margin-top: -15px">
                      <p class="mestext" style="display: flex;font-size: 10px;width: 100px">Проблемы? <i id="my-tooltip"
                          class="fa fa-exclamation-triangle mestext"
                          style="transform: translate(5.5px, 3px);font-size: 10px;cursor: pointer"
                          data-bs-toggle="tooltip" data-bs-placement="top"
                          title="Если кнопка подтверждения окажеться не активна - это значит валидация проходит повторную проверку, чтобы её решить внесите изменения в поле password"></i>
                      </p>
                    </div>


                    <div class="form-check form-check-info text-start">
                      <fieldset>
                        <input class="form-check-input" type="checkbox" id="terms" name="terms">
                        <label style="transition: all 1s ease;font-size: 12px;margin-top: 5px;color: var(--white-color)"
                          class="form-check-label" for="terms" style="opacity: 1">
                          Я согласен с <a style="transition: all 1s ease;color: var(--hh)" href="/../privacy-policy.php"
                            class="text-dark font-weight-bolder">Политикой конфиденциальности</a> и <a
                            style="transition: all 1s ease;color: var(--hh)" class="text-dark font-weight-bolder"
                            href="/../terms-conditions.php">Условиями использования сервиса</a>
                        </label>
                      </fieldset>
                    </div>
                    <span style='displa:none' class="main-header-link-reg"></span>
                    <div class="form-group">
                      <div class="ddd disabled-button" id="see" style="margin-top: 15px">
                        <button type="button" id="send_email"
                          class="send-form main-header-link-reg form-control-submit-button disabled-button-input"
                          style="text-align: center;display: flex;justify-content: center;align-items: center">
                          <h2 style="font-weight: 600;margin-top: 13px">Подтвердить почту <i
                              style="transform: translateY(8px);margin-left: 5px;font-size: 12px"
                              class='fas fa fa-fan fa-solid fa-spin'></i></h2>
                        </button>
                        <div class="status"></div>
                  </form>

                </div>
                <div id="smsgSubmit" class="h3 text-center"></div>
                <div style="margin-bottom: 0" id="lmsgSubmit" class="h3 text-center hidden"></div>
              </div>


              <p class="mestext text-sm mt-3 mb-0">Уже есть аккаунт ? <a
                  style="transition: all 1s ease;color: var(--hhg)" href="log-in.php"
                  class="font-weight-bolder">Войти</a></p>
            </div>

          </div>

        </div><!-- INFO -->

        <div id="traker_window" class="traker transition" style="transform: translateY(-10px)">
          <div class="row px-xl-5 px-sm-4 px-3"><!-- RESET -->

            <div style="margin-top: -13px" class="card-body"
              style="text-align: center;justify-content: center;align-center:center;display: flex;align-items: center;margin-top: 10px">

              <h3 style="margin-left: 4%;width: 100%;text-align: center">Ваша сессия завершена!</h3>
              <p style="font-size: 12px;text-align: center">Вся форма была приостановленна! Для возобновления работы
                регистрации нажмите на кнопку <font style="color:#9453FF">Возобновить</font> или дождитесь <font
                  style="color:#9453FF">Авто-Возобновления через 1 минуту</font>
              </p>

              <div class="form-group">
                <a href="traker.php">
                  <button type="button" class="form-control-submit-button"
                    style="background-color: #9453FF !important;border: none !important">
                    <h2 style="transform: translateY(3.5px)">Возобновить<i
                        style="margin-left: 5.5px;transform: translateY(1px);font-size: 15px"
                        class="fa fa-retweet mesicon" aria-hidden="true"></i></h2>
                  </button></a>
              </div>


              <p class="mestext text-sm mt-3 mb-0">Уже есть аккаунт ? <a
                  style="transition: all 1s ease;color: var(--hhg)" href="log-in.php"
                  class="font-weight-bolder">Войти</a></p>
            </div>
          </div>
        </div><!-- RESET -->

        <div class="codeemail transition">
          <div class="row px-xl-5 px-sm-4 px-3">

            <div style="margin-top: -13px" class="card-body">

              <div class="form-group">
                <div class="flexer">
                  <input style="text-transform: uppercase" type="number" class="form-control-check" id="CHECK_CODE"
                    name="CHECK_CODE" required placeholder="****" maxlength="4">
                  <label style="font-weight: 600;transform: translate(-5px, -2px)"
                    class="label-control-avatar form-control-avatar" for="CHECK_CODE">ВВЕДИТЕ КОД</label>

                  <div style="display: flex;">
                    <div class="help-block with-errors"></div>

                    <div class="message_code" id="message_code">
                      <p id="email_title" class="email_title_code">Проверка:

                      <div id="ok_code"><!--START-->
                        <span id="email-message_ok">
                          <p style="color: #5DFF61;" class="ok_code">Верно</p>
                          <div class="circle_inf_code"><i class="fa fa-check"></i></div>
                        </span>
                      </div><!--end-->

                      <div id="dont_code"><!--START-->

                        <span id="email-message_load">
                          <p class="load_code" style="color: var(--email-block)">Ожидание...</p>
                          <div class="circle_inf_load_code"><i class="fa fa-search"></i></div>
                        </span>
                      </div><!--end-->

                      <div id="not_code" style="display: none">
                        <span id="email-message_not">
                          <p style="color: #EE3A3C" class="not_code">Не верно</p>
                          <div class="circle_inf_not_code"><i class="fa fa-ban"></i></div>
                        </span>
                      </div><!--end-->

                      </p>
                    </div>

                  </div><!-- flex -->
                </div>
                <div style="display: flex;justify-content: space-between;">
                  <p class="mestext" style="margin-top: 10px;font-size: 10px;display: flex !important">Подробнее: <i
                      id="my-tooltip" class="mestext fas fa-info-circle"
                      style="font-size: 10px;cursor: pointer;transform: translate(4px, 3.5px);" data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="TimQwees::CODE активен до тех пор пока ваша сессия включена, после обновлении страницы, ваша сессия будет обновлена! КОД ОДНОРАЗОВЫЙ, нельзя вносить изменения после подтверждения кода, УКАЗЫВАЙТЕ КОД ТАК КАК УКАЗАН НА ПОЧТЕ!"></i>
                  </p>

                  <p class="mestext" style="margin-top: 10px;font-size: 10px;margin-left: 25%">Код неактивен? <a
                      style="margin-left: 1px;color: #9453FF" href="traker.php">Возобновить</a></p>
                </div>
              </div>

              <form data-toggle="validator" data-focus="false" role="form" method="post" enctype="multipart/form-data"
                id="signUpForm" action="sql.php">

                <div class="form-group">
                  <div class="ddd" id="see" style="margin-top: 15px">
                    <button type="button" id="sql_send_date"
                      class="send-form main-header-link-reg form-control-submit-button">
                      <h2 style="transform: translateY(3.5px)">Зарегестрироваться<i
                          style="margin-left: 5.5px;transform: translateY(1px);font-size: 13px"
                          class="fa fa-cog fa-spin mesicon" aria-hidden="true"></i></h2>
                    </button>
              </form>

            </div>
            <div id="smsgSubmit" class="h3 text-center"></div>
            <div style="margin-bottom: 0" id="lmsgSubmit" class="h3 text-center hidden"></div>
          </div>


          <p class="mestext text-sm mt-3 mb-0">Уже есть аккаунт ? <a style="transition: all 1s ease;color: var(--hhg)"
              href="log-in.php" class="font-weight-bolder">Войти</a></p>
        </div>

      </div>
      </form>

    </div><!-- EMAIL -->
    </div>
    </div>
    </div>
    </div>

    </div>
    </div>
    </div>
    </div>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p style="font-size: 13px" class="mb-0 text-secondary">
            <input class="turn" type="hidden" value="<?php echo $_SESSION["block"]; ?>">
            Проект по металургии при поддержке TimQwees Technology ©
            <script defer async>
              document.write(new Date().getFullYear())
            </script>
          </p>
        </div>
      </div>
    </div>
  </footer>

  <script defer async>
    document.getElementById("sql_send_date").addEventListener("click", function () {
      window.location.href = "log-in.php";
    });
  </script>

  <script defer async src="js/siup/stucture.js"></script>
  <script defer async src="../js/auth.js"></script> <!-- auth/backgrond plugins -->
  <script defer async src="../js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
  <script defer async src="../js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
  <script defer async src="../js/jquery.easing.min.js"></script>
  <!-- jQuery Easing for smooth scrolling between anchors -->
  <script defer async src="../js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
  <script defer async src="../js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
  <script defer async src="../js/validator.min.js"></script>
  <!-- Validator.js - Bootstrap plugin that validates forms -->
  <script defer async src="../js/scripts.js"></script> <!-- Custom scripts -->
  <script defer async src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!--icon-->
  <script defer async src="../js/icon.js"></script>
  <script defer async src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- end -->
</body>

</html>