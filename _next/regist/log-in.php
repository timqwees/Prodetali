<?php
include_once __DIR__ . '/../php/src/helpers.php';
include_once __DIR__ . '/../php/element.php';

$user = currentUser();
// Запуск сеанса
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
// Устанавливаем таймер на 5 секунд
$time_start = time();

// Проверяем, загрузилась ли страница в течение 5 секунд
if (time() - $time_start > 5) {
  header("Location: log-in.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- CSS Files -->
  <link crossorigin id="pagestyle" href="assets/css/log.css" rel="preload stylesheet" as="style" />
  <link crossorigin rel="preload stylesheet" as="style" href="/../css/tap_browser.css">
  <!-- CSS FILES -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Font Awesome Icons -->
  <link crossorigin href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="preload stylesheet" as="style" />
  <link crossorigin rel="preload stylesheet" as="style" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link crossorigin rel="preload stylesheet" as="style" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link crossorigin rel="preload stylesheet" as="style" href="https://use.fontawesome.com/releases/v6.2.1/css/all.css">
  <link crossorigin rel="preload stylesheet" as="style" href="https://use.fontawesome.com/releases/v1.0.0/css/all.css">
  <link crossorigin rel="preload stylesheet" as="style" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
  <link crossorigin rel="preload stylesheet" as="style" href="https://use.fontawesome.com/releases/v4.7.0/css/all.css">
  <link crossorigin rel="preload stylesheet" as="style" href="https://use.fontawesome.com/releases/v3.0.0/css/all.css">
  <!-- finish icon -->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- SEO Meta Tags -->
  <meta name="description"
    content="Пройди авторизацию своего личного кабинета и управляй свои профилем прямо из сайта!">
  <meta name="author" content="TimQwees https://t.me/@timqwees">
  <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
  <meta property="og:site_name" content="Mostimqwees Auth" /> <!-- website name -->
  <meta property="og:site" content="https://envtimqwees.ru/" /> <!-- website link -->
  <meta property="og:title" content="TimQwees - авторизация профиля" />
  <!-- title shown in the actual shared post -->
  <meta property="og:description" content="TimQwees - Металлообработки" />
  <!-- description shown in the actual shared post -->
  <meta property="og:image" content="images/logo.svg" /> <!-- image link, make sure it's jpg -->
  <meta property="og:url" content="https://vk.com/MX999AM99/" /> <!-- where do you want your post to link to -->
  <meta property="og:type" content="article" />
  <!-- Website Title -->
  <title>Авторизация - TimQwees [Металлообработки]</title>

  <!-- Styles -->
  <link crossorigin id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="preload stylesheet" as="style">

  <link crossorigin href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
    rel="preload stylesheet" as="style">
  <link crossorigin href="../css/swiper.css" rel="preload stylesheet" as="style">
  <link crossorigin href="css/styles.css" rel="preload stylesheet" as="style">
  <link crossorigin href="../css/edits.css" rel="preload stylesheet" as="style">
  <link crossorigin href="../css/login.css" rel="preload stylesheet" as="style">
  <link crossorigin href="../css/register.css" rel="preload stylesheet" as="style">
  <link crossorigin href="../css/navbar.css" rel="preload stylesheet" as="style">

  <link crossorigin href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="preload stylesheet" as="style" />
  <!-- Favicon  -->
  <link crossorigin rel="icon" href="/../images/logo/project_logo_technologies_of_the_future.png" type="image/x-icon">
  <style>
    .sidebar.close .none-title::before {
      content: "";
      position: absolute;
      height: 0;
      width: 0;
    }
  </style>
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
      <img src="/../images/logo.png" alt="timqwees" /></i>
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

  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100">
        <style>
          .bo {
            margin-right: 0 !important;
            margin-left: 80px !important;
            transition: 1s ease all;
          }

          @media (max-width: 768px) {
            .bo {
              margin-right: 0 !important;
              margin-left: 0 !important;
              transition: all ease 1s;
            }
          }
        </style>
        <div class="container bo">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Авторизация профиля</h4>
                  <p class="mb-0 font-weight-default">Впишите почту и пароль от профиля.</p>
                </div>
                <div class="card-body">

                  <form role="form" action="login_result.php" method="post">
                    <style>
                      .error-message {
                        background-color: #fce4e4;
                        border: 1px solid #fcc2c3;
                        float: left;
                        padding: 8px 10px;
                        margin-bottom: 8.5px;
                        margin-top: -20px;
                        border-radius: 10px;
                      }

                      .error-text {
                        color: #cc0033;
                        font-family: Helvetica, Arial, sans-serif;
                        font-size: 12px;
                        font-weight: bolder;
                        line-height: 18px;
                        text-shadow: 1px 1px rgba(250, 250, 250, .3);
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
                        --white: #fff;
                        --input_text: #f8f8f8;
                        --greamsw: #56515d91;
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
                        --white: #000;
                        --navigator: #333;
                        --nb: gray;
                        --hh: #405AB4;
                        --hhg: #405AB4;
                        --mestext: #333;
                        --input_text: rgb(73, 80, 87);
                        --greamsw: #FBFBFB;
                      }

                      .email_message {
                        display: flex;
                        justify-content: start;
                        align-items: start;
                        text-align: start;
                        transition: 1s ease all;
                      }

                      .mess_check {
                        color: var(--white);
                        font-size: 12px;
                        margin-bottom: 10px;
                        font-family: "SB Sans Display";
                        margin-top: -15px;
                        text-decoration: none;
                        transition: 1s ease all;
                      }

                      @media (min-width: 768px) {}

                      @media (min-width: 1200px) {
                        .mess_check {
                          font-size: 18px !important;
                          transition: 1s ease all;
                        }

                        .notowod {
                          font-size: 15px !important;
                          transition: 1s ease all;
                        }

                        .godowod {
                          font-size: 15px !important;
                          transition: 1s ease all;
                        }

                        .numeric {
                          font-size: 100% !important;
                          padding: 4px 10px 4px 10px !important;
                          border-radius: 20% !important;
                        }

                        .god_icon {
                          font-size: 10.5px !important;
                          border: 1.99999999px solid #00B050 !important;
                          padding: 4px !important;
                          border-radius: 20% !important;
                        }

                        .bad_icon {
                          font-size: 10.5px !important;
                          border: 1.999999999px solid #FF6963 !important;
                          padding: 5px !important;
                          border-radius: 50% !important;
                        }
                      }

                      .notowod {
                        font-weight: 600;
                        animation: textfun ease-in-out 3.5s infinite;
                        font-size: 10px;
                        color: #FF6963;
                        transition: 1s ease all;
                        text-transform: uppercase;
                        font-family: "SB Sans Display";
                      }

                      .godowod {
                        font-size: 10px;
                        font-weight: 600;
                        text-transform: uppercase;
                        animation: textgod ease-in-out 3.5s infinite;
                        transition: 1s ease all;
                        color: #00B050;
                        font-family: "SB Sans Display";
                      }

                      @keyframes textgod {
                        0% {
                          opacity: 0.6;
                          background: transparent;
                          text-shadow: 0 0 0px #00B050;
                        }

                        10% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #00B050;
                        }

                        20% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #00B050;
                        }

                        30% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #00B050;
                        }

                        40% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #00B050;
                        }

                        50% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #00B050;
                        }

                        60% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #00B050;
                        }

                        70% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #00B050;
                        }

                        80% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #00B050;
                        }

                        90% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #00B050;
                        }

                        100% {
                          opacity: 0.6;
                          background: transparent;
                          text-shadow: 0 0 0px #00B050;
                        }
                      }

                      @keyframes textfun {
                        0% {
                          opacity: 0.6;
                          background: transparent;
                          text-shadow: 0 0 0px #FF6963;
                        }

                        10% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #FF6963;
                        }

                        20% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #FF6963;
                        }

                        30% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #FF6963;
                        }

                        40% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #FF6963;
                        }

                        50% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #FF6963;
                        }

                        60% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #FF6963;
                        }

                        70% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #FF6963;
                        }

                        80% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #FF6963;
                        }

                        90% {
                          opacity: 1;
                          background: transparent;
                          text-shadow: 0 0 15px #FF6963;
                        }

                        100% {
                          opacity: 0.6;
                          background: transparent;
                          text-shadow: 0 0 0px #FF6963;
                        }
                      }

                      .numeric {
                        font-size: 12px;
                        background: #1e3050;
                        padding: 2px 7px 2px 7px;
                        font-weight: 900;
                        color: white;
                        transition: 1s ease all;
                        font-stretch: expanded;
                        border-radius: 20%;
                        margin-right: 5px;
                      }

                      .god_icon {
                        font-size: 7.5px;
                        color: #00B050;
                        opacity: 0.75;
                        margin-left: 5px;
                        border: 1.7px solid #00B050;
                        border-radius: 20%;
                        transform: translateY(-1px);
                        padding: 4px;
                        transition: 1s ease all;
                        justify-content: center;
                        align-items: center;
                        text-align: center;
                      }

                      .bad_icon {
                        font-size: 7.5px;
                        color: #FF6963;
                        opacity: 0.75;
                        margin-left: 5px;
                        border: 1.7px solid #FF6963;
                        border-radius: 50%;
                        transform: translateY(-1px);
                        padding: 4px;
                        transition: 1s ease all;
                        justify-content: center;
                        align-items: center;
                        text-align: center;
                        margin-right: 5px;
                      }

                      .dater {
                        color: white !important;
                      }

                      .form-control {
                        background: var(--greamsw) !important;
                        color: var(--input_text) !important;
                      }

                      .form-control:hover {
                        background: var(--greamsw) !important;
                      }

                      .noentrance {
                        background-color: rgb(231, 75, 75);
                        width: 16px;
                        height: 16px;
                        position: absolute;
                        border-radius: 50%;
                        font-size: 10px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: #fff;
                        right: 25px;
                      }

                      .yeaentrance {
                        background-color: #3a6df0;
                        width: 16px;
                        height: 16px;
                        position: absolute;
                        border-radius: 50%;
                        font-size: 10px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: #fff;
                        right: 25px;
                      }
                    </style>

                    <h6 class="email_message" id="email_message"></h6>
                    <h6 class="email_message" id="password_message"></h6>
                    <!-- email -->
                    <div class="mb-3">
                      <input class="form-control form-control-lg replace_color" aria-label="email" type="email"
                        id="email" name="email" placeholder="email" oninput="checkEmail()"
                        value="<?php echo htmlspecialchars(old('email')); ?>" required>
                    </div>
                    <!-- password -->
                    <div class="mb-3">
                      <input class="form-control form-control-lg replace_color" aria-label="password" type="password"
                        id="password" name="password" placeholder="password" oninput="checkPassword()"
                        value="<?php echo htmlspecialchars(old('password')); ?>" required>
                    </div>

                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <input type="hidden" name="rememberMe">
                      <label class=" form-check-label font-weight-default" for="rememberMe">Запомнить меня</label>
                    </div>
                    <div class="text-center">
                      <input class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0 dater" type="submit" id="submit"
                        disabled="true" value="Войти в профиль" />
                    </div>
                  </form>

                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Еще нет аккаунта?
                    <a href="sign-up.php" class="text-primary text-gradient font-weight-bold">Зарегистрироваться</a>
                  </p>
                </div>
              </div>
            </div>
            <div
              class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div
                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">PRO детали - ваш сервис по
                  Металлообработки
                  [TimQwees Technology]</h4>
                <p class="text-white position-relative">
                  ©
                  <script async defer>
                    document.write(new Date().getFullYear())
                  </script> Проект при поддержке TimQwees Technology 'платформа по Металлообработки (сайт)'
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script async defer src="js/login/login.js"></script>
  <script async defer src="../js/auth.js"></script> <!-- auth/backgrond plugins -->
  <script async defer src="../js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
  <script async defer src="../js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
  <script async defer src="../js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
  <script async defer src="../js/jquery.easing.min.js"></script>
  <!-- jQuery Easing for smooth scrolling between anchors -->
  <script async defer src="../js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
  <script async defer src="../js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
  <script async defer src="../js/validator.min.js"></script>
  <!-- Validator.js - Bootstrap plugin that validates forms -->
  <script async defer src="../js/scripts.js"></script> <!-- Custom scripts -->
  <script async defer src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script async defer>
    document.querySelector('input[name="rememberMe"]').value = 'off';
    document.getElementById('rememberMe').addEventListener('click', function () {
      if (document.querySelector('input[name="rememberMe"]').value === 'off') {
        document.querySelector('input[name="rememberMe"]').value = 'on';
      } else if (document.querySelector('input[name="rememberMe"]').value === 'on') {
        document.querySelector('input[name="rememberMe"]').value = 'off';
      }
    });
  </script>
</body>

</html>