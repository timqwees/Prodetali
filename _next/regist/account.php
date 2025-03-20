<?php
include_once __DIR__ . '/../php/src/actions/replace.php';
include_once __DIR__ . '/../php/src/helpers.php';
include_once __DIR__ . '/../php/element.php';
include_once __DIR__ . '/../php/src/config.php';

$user = currentUser();
// Запуск сеанса
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Устанавливаем таймер на 5 секунд
$time_start = time();

$sender_edit_full = '<svg style="transform: translateY(-3px)" viewBox="0 0 30 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM10.95 17.51C10.66 17.8 10.11 18.08 9.71 18.14L7.25 18.49C7.16 18.5 7.07 18.51 6.98 18.51C6.57 18.51 6.19 18.37 5.92 18.1C5.59 17.77 5.45 17.29 5.53 16.76L5.88 14.3C5.94 13.89 6.21 13.35 6.51 13.06L10.97 8.6C11.05 8.81 11.13 9.02 11.24 9.26C11.34 9.47 11.45 9.69 11.57 9.89C11.67 10.06 11.78 10.22 11.87 10.34C11.98 10.51 12.11 10.67 12.19 10.76C12.24 10.83 12.28 10.88 12.3 10.9C12.55 11.2 12.84 11.48 13.09 11.69C13.16 11.76 13.2 11.8 13.22 11.81C13.37 11.93 13.52 12.05 13.65 12.14C13.81 12.26 13.97 12.37 14.14 12.46C14.34 12.58 14.56 12.69 14.78 12.8C15.01 12.9 15.22 12.99 15.43 13.06L10.95 17.51ZM17.37 11.09L16.45 12.02C16.39 12.08 16.31 12.11 16.23 12.11C16.2 12.11 16.16 12.11 16.14 12.1C14.11 11.52 12.49 9.9 11.91 7.87C11.88 7.76 11.91 7.64 11.99 7.57L12.92 6.64C14.44 5.12 15.89 5.15 17.38 6.64C18.14 7.4 18.51 8.13 18.51 8.89C18.5 9.61 18.13 10.33 17.37 11.09Z" fill="currentColor"></path> </g></svg>';

$sender_edit = '<svg <svg style="transform: translateY(-3px)" fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 65.111 56.111" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M51,11.756V6.062c0-0.553-0.447-1-1-1h-6c-0.233,0-0.438,0.092-0.608,0.226C32.759-1.491,18.869-0.051,9.848,8.97 c-4.379,4.379-6.956,9.457-7.714,15.092H1c-0.552,0-1,0.447-1,1v6c0,0.553,0.448,1,1,1h1.162 c0.942,5.646,3.699,11.106,7.686,15.092c5.1,5.1,11.879,7.909,19.092,7.909c7.212,0,13.992-2.81,19.092-7.909 C57.562,37.623,58.803,22.472,51,11.756z M45,7.062h4v4h-4V7.062z M11.262,10.384C19.808,1.838,33.073,0.632,43,7.414V8.89 l-13.111,6.733c-0.163-0.33-0.496-0.562-0.889-0.562h-6c-0.552,0-1,0.447-1,1v3.613L8,26.863v-1.802c0-0.553-0.448-1-1-1H4.152 C4.897,18.976,7.271,14.375,11.262,10.384z M28,17.062v4h-4v-4H28z M2,26.062h4v4H2V26.062z M46.617,45.739 c-3.008,3.008-6.648,5.151-10.62,6.313c-0.007-0.546-0.45-0.987-0.997-0.987c-0.552,0-1,0.448-1,1c0,0.167,0.051,0.318,0.124,0.456 c-1.659,0.348-3.365,0.533-5.099,0.539C29.565,53.047,30,52.609,30,52.066c0-0.552-0.448-1-1-1s-1,0.448-1,1 c0,0.545,0.438,0.985,0.981,0.996c-0.014,0-0.027,0.001-0.041,0.001c-1.727,0-3.426-0.177-5.079-0.517 c0.081-0.145,0.14-0.303,0.14-0.48c0-0.552-0.448-1-1-1s-1,0.448-1,1c0,0.007,0.004,0.014,0.004,0.021 c-2.51-0.721-4.889-1.831-7.062-3.306c-0.124-0.411-0.491-0.715-0.943-0.715c-0.016,0-0.03,0.008-0.046,0.009 c-0.698-0.525-1.371-1.091-2.018-1.693C11.97,46.281,12,46.178,12,46.066c0-0.552-0.448-1-1-1c-0.107,0-0.204,0.03-0.3,0.061 c-0.601-0.645-1.171-1.323-1.704-2.037C8.995,43.081,9,43.074,9,43.066c0-0.444-0.294-0.807-0.694-0.938 c-2.041-3.009-3.47-6.487-4.115-10.066H7c0.552,0,1-0.447,1-1v-1.95l14-7.189v0.139c0,0.553,0.448,1,1,1h6c0.552,0,1-0.447,1-1 v-4.247l13-6.676v0.923c0,0.553,0.448,1,1,1h5.47c1.759,2.454,3.003,5.185,3.737,8.046c-0.069-0.015-0.133-0.042-0.207-0.042 c-0.552,0-1,0.448-1,1c0,0.552,0.448,1,1,1c0.23,0,0.431-0.091,0.6-0.221c0.314,1.717,0.434,3.465,0.398,5.213 c-0.005-0.548-0.449-0.992-0.998-0.992c-0.552,0-1,0.448-1,1c0,0.552,0.448,1,1,1c0.548,0,0.991-0.442,0.998-0.988 c-0.036,1.703-0.238,3.401-0.602,5.071c-0.122-0.053-0.255-0.083-0.396-0.083c-0.552,0-1,0.448-1,1 c0,0.519,0.401,0.932,0.907,0.981C51.731,39.006,49.639,42.718,46.617,45.739z"></path> <circle cx="26" cy="25.066" r="1"></circle> <circle cx="32" cy="25.066" r="1"></circle> <circle cx="44" cy="25.066" r="1"></circle> <circle cx="38" cy="19.066" r="1"></circle> <circle cx="44" cy="19.066" r="1"></circle> <circle cx="41" cy="16.066" r="1"></circle> <circle cx="35" cy="22.066" r="1"></circle> <circle cx="38" cy="25.066" r="1"></circle> <circle cx="41" cy="22.066" r="1"></circle> <circle cx="47" cy="16.066" r="1"></circle> <circle cx="47" cy="22.066" r="1"></circle> <circle cx="50" cy="25.066" r="1"></circle> <circle cx="50" cy="19.066" r="1"></circle> <circle cx="8" cy="37.066" r="1"></circle> <circle cx="20" cy="37.066" r="1"></circle> <circle cx="14" cy="31.066" r="1"></circle> <circle cx="20" cy="31.066" r="1"></circle> <circle cx="17" cy="28.066" r="1"></circle> <circle cx="11" cy="34.066" r="1"></circle> <circle cx="14" cy="37.066" r="1"></circle> <circle cx="17" cy="34.066" r="1"></circle> <circle cx="23" cy="28.066" r="1"></circle> <circle cx="26" cy="31.066" r="1"></circle> <circle cx="32" cy="31.066" r="1"></circle> <circle cx="29" cy="28.066" r="1"></circle> <circle cx="23" cy="34.066" r="1"></circle> <circle cx="26" cy="37.066" r="1"></circle> <circle cx="32" cy="37.066" r="1"></circle> <circle cx="44" cy="37.066" r="1"></circle> <circle cx="29" cy="34.066" r="1"></circle> <circle cx="35" cy="28.066" r="1"></circle> <circle cx="38" cy="31.066" r="1"></circle> <circle cx="44" cy="31.066" r="1"></circle> <circle cx="41" cy="28.066" r="1"></circle> <circle cx="35" cy="34.066" r="1"></circle> <circle cx="38" cy="37.066" r="1"></circle> <circle cx="41" cy="34.066" r="1"></circle> <circle cx="47" cy="28.066" r="1"></circle> <circle cx="47" cy="34.066" r="1"></circle> <circle cx="50" cy="37.066" r="1"></circle> <circle cx="50" cy="31.066" r="1"></circle> <circle cx="20" cy="49.066" r="1"></circle> <circle cx="11" cy="40.066" r="1"></circle> <circle cx="14" cy="43.066" r="1"></circle> <circle cx="20" cy="43.066" r="1"></circle> <circle cx="17" cy="40.066" r="1"></circle> <circle cx="17" cy="46.066" r="1"></circle> <circle cx="23" cy="40.066" r="1"></circle> <circle cx="26" cy="43.066" r="1"></circle> <circle cx="32" cy="43.066" r="1"></circle> <circle cx="29" cy="40.066" r="1"></circle> <circle cx="23" cy="46.066" r="1"></circle> <circle cx="26" cy="49.066" r="1"></circle> <circle cx="32" cy="49.066" r="1"></circle> <circle cx="29" cy="46.066" r="1"></circle> <circle cx="35" cy="40.066" r="1"></circle> <circle cx="38" cy="43.066" r="1"></circle> <circle cx="44" cy="43.066" r="1"></circle> <circle cx="41" cy="40.066" r="1"></circle> <circle cx="35" cy="46.066" r="1"></circle> <circle cx="38" cy="49.066" r="1"></circle> <circle cx="41" cy="46.066" r="1"></circle> <circle cx="47" cy="40.066" r="1"></circle> </g> </g></svg>';

checkAuth();

// Проверяем, загрузилась ли страница в течение 5 секунд
if (time() - $time_start > 5) {
    header("Location: account.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1.0">

    <meta property="og:image" content="— <?php echo $user["nickname"]; ?>" /> <!-- image link, make sure its jpg -->
    <!-- SEO Meta Tags -->
    <meta name="description" content="Московский политех - аккаунт организации">
    <meta name="author" content="TimQwees https://t.me/@timqwees">
    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="Московский политех - аккаунт организации" /> <!-- website name -->
    <meta property="og:site" content="https://envpolytech.ru/" /> <!-- website link -->
    <meta property="og:title" content="Московский политех - аккаунт организации" />
    <!-- title shown in the actual shared post -->
    <meta property="og:description" content="Твой личный кабинет от игрового профиля, управляй им как тебе угодно!" />
    <!-- description shown in the actual shared post -->
    <meta property="og:url" content="https://vk.com/moscowpolytech/" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />
    <!-- Website Title -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="account/style.css">
    <link rel="stylesheet" href="/../css/tap_browser.css">
    <link href="/../css/swiper.css" rel="stylesheet">
    <title>— <?php echo $user["nickname"]; ?></title>
    <!-- Favicon  -->
    <link style="border-radius: 50%" rel="icon" href="/../<?php echo $account_icon ?>">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v1.0.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v4.7.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v3.0.0/css/all.css">
    <!-- finish icon -->
    <!-- Box Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <style>
        @font-face {
            font-family: SB Sans Display;
            font-weight: 700;
            font-style: normal;
            src: url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff2"), url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff")
        }

        @font-face {
            font-family: SB Sans Display;
            font-weight: 600;
            font-style: normal;
            src: url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff2"), url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff")
        }

        @font-face {
            font-family: SB Sans Display;
            font-weight: 400;
            font-style: normal;
            src: url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff2"), url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff")
        }

        @font-face {
            font-family: CoFo Sans;
            font-weight: 700;
            font-style: normal;
            src: url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff2"), url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff")
        }

        @font-face {
            font-family: CoFo Sans;
            font-weight: 600;
            font-style: normal;
            src: url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff2"), url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff")
        }

        @font-face {
            font-family: CoFo Sans;
            font-weight: 400;
            font-style: normal;
            src: url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff2"), url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff")
        }

        @font-face {
            font-family: SB Spasibo Sans Display;
            font-weight: 700;
            font-style: normal;
            src: url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff2"), url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff")
        }

        @font-face {
            font-family: SB Spasibo Sans Display;
            font-weight: 600;
            font-style: normal;
            src: url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff2"), url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff")
        }

        @font-face {
            font-family: SB Spasibo Sans Display;
            font-weight: 400;
            font-style: normal;
            src: url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff2"), url(/../_next/static/media/CoFoSans-BoldItalic.99969f70.woff2) format("woff")
        }

        .tooltip {
            position: relative;
            cursor: pointer;
        }

        .tooltip::after {
            content: attr(title);
            position: absolute;
            top: 120%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgb(51, 51, 51, 0.5);
            color: #fff;
            font-family: monospace;
            padding: 20px;
            border-radius: 5px;
            font-size: 100%;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s, visibility 0.5s;
        }

        .tooltip:hover::after {
            opacity: 1;
            visibility: visible;
        }

        .disnot {
            color: #FF988E;
            margin-left: 10px;
        }

        .notification_mes {
            background-color: #3a6df0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-left: 10px;
        }

        .styctyr {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }

        .bx-log {
            background: transparent;
            font-size: 20px;
            color: white;
            border: none;
            transform: translate(-3px, 0px);
            border-radius: 5px;
            padding: 5px;
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .title_important {
            margin-top: 7px;
            font-size: 18px;
            transition: 1s ease all;
        }

        @media (min-width: 768px) {
            .title_important {
                font-size: 22px;
                transition: 1s ease all;
                margin-top: 4px;
            }

            .title_important:after {
                content: "[<?php echo $user['nickname'] ?>]";
                font-size: 18px;
                margin-left: 15px;
                text-transform: uppercase;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                background: linear-gradient(149deg, #42C2FF 20%, #BB6EFF 70%, #FF5296 100%);
                animation: gradient 5s infinite linear;
                background-size: 400%;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            @keyframes gradient {
                0% {
                    background-position: 50% 50%;
                }

                50% {
                    background-position: 300% 600%;
                }

                100% {
                    background-position: 300% 500%;
                }
            }
        }

        @media screen and (max-width: 768px) {
            .slide-thumbnails {
                width: 150px !important;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin-bottom: 10px;
                margin-left: 5px;
            }

            .checkbox_click {
                width: auto;
                max-width: 200px;
                word-break: break-word;
                flex-flow: row;
            }

            .av {
                margin-top: -10px !important;
            }
        }

        @media screen and (min-width: 768px) {
            .slide-thumbnails {
                width: 150px !important;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin-bottom: 10px;
                margin-left: 5px;
            }

            .checkbox_click {
                width: auto;
                max-width: 200px;
                word-break: break-word;
                flex-flow: row;
            }

            .av {
                margin-top: -10px !important;
            }
        }

        @media screen and (max-width: 992px) {
            .prev {
                margin-left: -65px !important;
            }

            .next {
                margin-left: 40px !important;
            }

            .slide-thumbnails {
                width: 150px !important;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin-bottom: 10px;
                margin-left: 10px !important;
            }

            .slide-thumbnail {
                width: 150px !important;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin-bottom: 10px;
                margin-left: 5px !important;
            }

            .checkbox_click {
                width: auto;
                max-width: 270px;
                word-break: break-word;
                flex-flow: row;
            }

            .av {
                margin-top: -10px !important;
            }
        }

        @media screen and (min-width: 1200px) {
            .prev {
                margin-left: -65px !important;
            }

            .next {
                margin-left: 40px !important;
            }

            .slide-thumbnails {
                width: 150px !important;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin-bottom: 10px;
                margin-left: 10px !important;
            }

            .slide-thumbnail {
                width: 150px !important;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin-bottom: 10px;
                margin-left: 5px !important;
            }

            .checkbox_click {
                width: auto;
                max-width: 270px;
                word-break: break-word;
                flex-flow: row;
            }

            .av {
                margin-top: -10px !important;
            }
        }

        @media (min-width: 768px) {
            .list_content {
                display: grid;
                grid-template-columns: 1fr;
                grid-gap: 15px;
                overflow-y: scroll;
                height: auto;
                transition: all ease 1s;
                max-height: calc(30rem + 15rem);
                padding-right: calc(15px + 5px);
            }
        }

        @media (max-width: 767px) {
            .list_content {
                display: grid;
                grid-template-columns: 1fr;
                grid-gap: 15px;
                overflow-y: scroll;
                height: auto;
                transition: all ease 1s;
                max-height: 55vh;
                padding-right: calc(15px + 5px);
            }
            .responsive-table {
                gap: 1rem;
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }
            .button-wrapper 
            .sertting_bar_admin>.sertting_bar textarea {
                width: 100%;
            }
            .responsive-table {
                flex-direction: column !important;
            }
        }

        .lock {
            position: absolute;
            opacity: 0;
            z-index: -999;
            transition: all ease-out 1s;
        }

        .unlock {
            position: flex;
            opacity: 1;
            transition: all ease-out 1s;
        }

        .scroll-users {
            overflow-y: scroll;
            scroll-snap-type: y mandatory;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
            max-height: 30rem;
        }

        .sertting_bar_admin>.sertting_bar {
            height: 40px;
            display: flex;
            width: 100%;
            max-width: 100%;
            padding-left: 16px;
            border-radius: 4px;
            align-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            flex-direction: column;
            justify-content: center;
        }

        .sertting_bar_admin>.sertting_bar_desport {
            height: auto;
            display: flex !important;
            align-items: flex-start !important;
            justify-content: space-between !important;
            flex-direction: row !important;
        }

        .admin_log>.app-card {
            width: calc(100% - 20px);
        }

        .admin_log>.app-card:hover {
            background-color: var(--content-bg);
        }

        .admin_log>.app-card>.app-card__subtext {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: space-between;
        }

        .admin_log>.app-card>.app-card__subtext>.sertting_bar input:hover {
            width: 70%;
            background-color: var(--content-bg);
        }
        input[name='change_title'],
        input[name='title'],
        input[name='author']
        {
            padding-right: 3rem !important;
        }

        .admin_log>.app-card>.app-card__subtext>.sertting_bar textarea:hover {
            background-color: var(--content-bg);
        }

        .admin_log>.app-card>.app-card__subtext>.sertting_bar input {
            padding: 10px;
        }

        .sertting_bar_admin>.sertting_bar {
            display: flex;
            width: 100%;
            padding-left: 16px;
            border-radius: 4px;
            align-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            flex-direction: column;
            justify-content: center;
        }

        .sertting_bar_admin>.sertting_bar textarea {
            width: 70%;
            height: 100%;
            background-color: var(--search-bg);
            border-radius: 4px;
            font-family: var(--body-font);
            font-size: 15px;
            font-weight: 500;
            padding: 10px;
            box-shadow: 0 0 0 2px rgba(134, 140, 160, 0.02);
            background-size: 14px;
            background-repeat: no-repeat;
            background-position: 16px 48%;
            color: var(--theme-color);
            transition: 0.5s ease all;
            resize: vertical;
            border: none;
        }

        @media screen and (min-width: 1610px) {
            .admin_log>.app-card>.app-card__subtext {
                display: flex;
                flex-wrap: nowrap;
                gap: 1rem;
                flex-direction: row;
            }

            .sertting_bar_admin>.sertting_bar textarea {
                width: 90.5%
            }

            .sertting_bar_desport {
                margin-bottom: 20px;
            }
        }

        .event_description {
            display: flex;
            background-color: var(--popup-bg);
            word-wrap: normal;
            overflow: overlay;
            width: 70%;
            flex-flow: column;
            margin-left: auto;
            border-radius: 5px;
            color: white;
            padding: .5rem;
            flex-direction: column;
            justify-content: flex-end;
        }

        .event_content {
            list-style: none;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            font-size: 16px;
            width: 100%;
            height: 100%;
            white-space: normal;
            transition: 0.3s;
        }

        .event_content>.products>.button-wrapper {
            width: auto;
        }

        .new_change {
            gap: .25rem;
        }

        .new_change ul li {
            list-style: none;
            padding: 10px 18px;
            display: flex;
            font-size: 16px;
            width: 100%;
            height: 100%;
            gap: 1rem;
            white-space: normal;
            transition: 0.3s;
            flex-direction: column;
            align-content: stretch;
            flex-wrap: wrap;
            align-items: baseline;
        }

        .event_content .products {
            width: auto;
        }

        .event_date_content {
            background-color: slateblue;
            border-radius: 5.5px;
            padding: .35rem .5rem;
            width: auto;
        }

        .event_date_content_center {
            background-color: #4b4c4f;
            border-radius: 5.5px;
            padding: .35rem .5rem;
            width: auto;
        }

        .event_date_content_center_profile {
            background-color: dodgerblue;
            border-radius: 5.5px;
            padding: .35rem .5rem;
            width: auto;
        }

        .responsive-table {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .event_description {
            display: flex;
            background-color: var(--popup-bg);
            word-wrap: normal;
            overflow: overlay;
            width: 100%;
            flex-flow: column;
            margin-left: auto;
            border-radius: 5px;
            color: white;
            padding: .5rem;
            flex-direction: column;
            justify-content: flex-end;
        }

        .event_content {
            list-style: none;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            font-size: 16px;
            width: 100%;
            height: 100%;
            white-space: normal;
            transition: 0.3s;
        }

        .event_content>.products>.button-wrapper {
            width: auto;
        }

        .new_change {
            gap: .25rem;
        }

        .new_change ul li {
            list-style: none;
            padding: 10px 18px;
            display: flex;
            font-size: 16px;
            width: 100%;
            height: 100%;
            white-space: normal;
            transition: 0.3s;
            flex-direction: column;
            align-content: stretch;
            flex-wrap: wrap;
            align-items: baseline;
        }

        .event_content .products {
            width: auto;
        }

        .event_date_content {
            background-color: slateblue;
            border-radius: 5.5px;
            padding: .35rem .5rem;
            width: auto;
        }

        .event_date_content_center {
            background-color: #4b4c4f;
            border-radius: 5.5px;
            padding: .35rem .5rem;
            width: auto;
        }

        .event_date_content_center_profile {
            background-color: dodgerblue;
            border-radius: 5.5px;
            padding: .35rem .5rem;
            width: auto;
        }

        .responsive-table {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    </style>
    <script async src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body data-spy="scroll" data-target=".fixed-top" style="background: var(--body-color)">
    <div class="app">
        <div class="header">
            <div class="menu-circle"></div>
            <div class="header-menu">
                <a class="menu-link is-active close_block_admin" href="#">Главная</a>
                <?php echo $admin_panel; ?>
            </div>
            <div class="title">
                <form action="/../php/src/actions/logout.php" method="post">

                    <?php
                    $max_length = 19;
                    $max_length2 = 24;
                    $max_length3 = 28;
                    $size = null;
                    $text = "<style>.title_important:after { font-size: $size !important;transition: all ease 1s;}</style>";

                    if (strlen($user['nickname']) > $max_length) {
                        $size = "14px";
                        echo $text;
                    } elseif (strlen($user['nickname']) > $max_length2) {
                        $size = "10px";
                        echo $text;
                    } elseif (strlen($user['nickname']) > $max_length3) {
                        $size = "5px";
                        echo $text;
                    }
                    ?>
                    <button class="bx-log"><i title="Выйти с профиля <?php echo $user["nickname"]; ?>"
                            class="tooltip bx bx-log-out"></i></button>
                </form>
                <a href="/../index.php" style="text-decoration: none"><span class="bx-log"><i title="На главную"
                            class="tooltip bx bx-user"></i></span></a>

                <font class="title_important">Полититех – Account</font>
                <img alt='logo' style="margin-top: 1px"
                    src="/../images/logo/project_logo_technologies_of_the_future.png" class="logo" />
            </div>
            <div class="header-profile">
                <div class="notification">
                    <span class="notification-number" style="margin-top: 7px;transform: translateX(-3.5px)">0</span>
                    <svg id="my-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="нет уведомлений"
                        data-bs-delay="35" viewBox="0 0 24 24" style="margin-top: 5.5px" fill="currentColor"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-bell">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
                    </svg>
                </div>
                <svg viewBox="0 0 512 512" fill="currentColor">
                    <path
                        d="M448.773 235.551A135.893 135.893 0 00451 211c0-74.443-60.557-135-135-135-47.52 0-91.567 25.313-115.766 65.537-32.666-10.59-66.182-6.049-93.794 12.979-27.612 19.013-44.092 49.116-45.425 82.031C24.716 253.788 0 290.497 0 331c0 7.031 1.703 13.887 3.006 20.537l.015.015C12.719 400.492 56.034 436 106 436h300c57.891 0 106-47.109 106-105 0-40.942-25.053-77.798-63.227-95.449z" />
                </svg>
                <img class="profile-img" src="/../<?php echo $user["icon"]; ?>" alt="icon">
            </div>
        </div>
        <div class="wrapper">
            <div class="left-side">
                <div class="side-wrapper">
                    <div class="side-title">
                        Основные
                    </div>
                    <div class="side-menu">
                        <a href="<?php echo $profile_index ?>">
                            <svg viewBox="0 0 512 512">
                                <g xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <path
                                        d="M0 0h128v128H0zm0 0M192 0h128v128H192zm0 0M384 0h128v128H384zm0 0M0 192h128v128H0zm0 0"
                                        data-original="#bfc9d1" />
                                </g>
                                <path xmlns="http://www.w3.org/2000/svg" d="M192 192h128v128H192zm0 0"
                                    fill="currentColor" data-original="#82b1ff" />
                                <path xmlns="http://www.w3.org/2000/svg"
                                    d="M384 192h128v128H384zm0 0M0 384h128v128H0zm0 0M192 384h128v128H192zm0 0M384 384h128v128H384zm0 0"
                                    fill="currentColor" data-original="#bfc9d1" />
                            </svg>
                            На главную <?php echo $notification_profil ?>
                        </a>
                        <a href="<?php echo $profile_regist ?>">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM16 12.75H12.75V16C12.75 16.41 12.41 16.75 12 16.75C11.59 16.75 11.25 16.41 11.25 16V12.75H8C7.59 12.75 7.25 12.41 7.25 12C7.25 11.59 7.59 11.25 8 11.25H11.25V8C11.25 7.59 11.59 7.25 12 7.25C12.41 7.25 12.75 7.59 12.75 8V11.25H16C16.41 11.25 16.75 11.59 16.75 12C16.75 12.41 16.41 12.75 16 12.75Z"
                                        fill="currentColor"></path>
                                </g>
                            </svg> Создать профиль
                        </a>

                        <a href="<?php echo $profile_update ?>">
                            <svg fill="currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 297 297" xml:space="preserve"
                                stroke="#ffffff">
                                <g fill="currentColor" id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g fill="currentColor" id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                    stroke-linejoin="round"></g>
                                <g fill="currentColor" id="SVGRepo_iconCarrier">
                                    <g>
                                        <g>
                                            <g>
                                                <path fill="currentColor"
                                                    d="M94.755,145.625l50.09,33.394c1.105,0.736,2.377,1.105,3.648,1.105c1.272,0,2.544-0.369,3.648-1.105l50.09-33.393 c1.83-1.219,2.929-3.273,2.929-5.473V95.629c0-2.426-1.335-4.654-3.474-5.799c-2.137-1.145-4.733-1.021-6.752,0.326 L171.768,105.6l0.001-65.628c0-12.834-10.44-23.274-23.274-23.274c-12.833,0-23.274,10.44-23.275,23.273v0.001V105.6 l-23.168-15.445c-2.02-1.346-4.615-1.471-6.752-0.326c-2.138,1.144-3.474,3.373-3.474,5.799v44.525 C91.826,142.351,92.925,144.406,94.755,145.625z">
                                                </path>
                                                <path fill="currentColor"
                                                    d="M257.029,200.36H39.971C17.931,200.36,0,218.291,0,240.331s17.931,39.971,39.971,39.971h217.058 c22.04,0,39.971-17.931,39.971-39.971C297,218.291,279.069,200.36,257.029,200.36z M221.012,246.059 c-1.508,1.507-3.593,2.368-5.728,2.368c-2.126,0-4.22-0.861-5.728-2.368c-1.498-1.508-2.368-3.593-2.368-5.728 c0-2.136,0.87-4.22,2.368-5.728c1.508-1.508,3.602-2.368,5.728-2.368c2.135,0,4.22,0.86,5.728,2.368 c1.507,1.508,2.368,3.602,2.368,5.728C223.379,242.456,222.519,244.551,221.012,246.059z M254.405,246.059 c-1.508,1.507-3.593,2.368-5.728,2.368c-2.136,0-4.22-0.861-5.718-2.368c-1.508-1.508-2.378-3.593-2.378-5.728 c0-2.136,0.87-4.22,2.378-5.728c1.498-1.508,3.582-2.368,5.718-2.368c2.135,0,4.22,0.86,5.728,2.368 c1.507,1.508,2.368,3.592,2.368,5.728C256.773,242.466,255.912,244.551,254.405,246.059z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg> Обновления <?php echo $notification_profil2 ?>
                        </a>
                    </div>
                </div>
                <div class="side-wrapper">
                    <div class="side-title">
                        Политех
                    </div>
                    <div class="side-menu">
                        <a href="<?php echo $profile_donate ?>">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 496 496" xml:space="preserve"
                                fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path style="fill:#9B9B9B;"
                                        d="M256,478.3c0,4.8-3.2,8.8-8,8.8l0,0c-4.8,0-8-4-8-8.8V341.5c0-4.8,3.2-8.8,8-8.8l0,0c4.8,0,8,4,8,8.8 V478.3z">
                                    </path>
                                    <path style="fill:#D6D6D6;"
                                        d="M496,239.9c0,4.8-3.2,8-8,8H352c-4.8,0-8-3.2-8-8l0,0c0-4.8,3.2-8,8-8h136 C492.8,231.9,496,235.1,496,239.9L496,239.9z">
                                    </path>
                                    <path style="fill:#515151;"
                                        d="M152,239.9c0,4.8-3.2,8-8,8H8c-4.8,0-8-3.2-8-8l0,0c0-4.8,3.2-8,8-8h136 C148.8,231.9,152,235.1,152,239.9L152,239.9z">
                                    </path>
                                    <path style="fill:#EDEDED;"
                                        d="M326.4,172.7c-3.2,3.2-8.8,3.2-12,0l0,0c-3.2-3.2-3.2-8.8,0-12l96.8-96.8c3.2-3.2,8.8-3.2,12,0l0,0 c3.2,3.2,3.2,8.8,0,12L326.4,172.7z">
                                    </path>
                                    <path style="fill:#7A7A7A;"
                                        d="M84.8,414.3c-3.2,3.2-8.8,3.2-12,0l0,0c-3.2-3.2-3.2-8.8,0-12l96.8-96.8c3.2-3.2,8.8-3.2,12,0l0,0 c3.2,3.2,3.2,8.8,0,12L84.8,414.3z">
                                    </path>
                                    <path style="fill:#BFBFBF;"
                                        d="M314.4,317.5c-3.2-3.2-3.2-8.8,0-12l0,0c3.2-3.2,8.8-3.2,12,0l96.8,96.8c3.2,3.2,3.2,8.8,0,12l0,0 c-3.2,3.2-8.8,3.2-12,0L314.4,317.5z">
                                    </path>
                                    <path style="fill:#2B2B2B;"
                                        d="M72.8,75.1c-3.2-3.2-3.2-8,0-11.2l0,0c3.2-3.2,8.8-3.2,12,0l96.8,96.8c3.2,3.2,3.2,8.8,0,12l0,0 c-3.2,3.2-8.8,3.2-12,0L72.8,75.1z">
                                    </path>
                                    <path style="fill:#F4F4F4;"
                                        d="M295.2,147.1c-2.4,4.8-7.2,6.4-11.2,4.8l0,0c-4-1.6-6.4-6.4-4.8-11.2l52-126.4 c1.6-4,6.4-6.4,11.2-4.8l0,0c4,1.6,6.4,6.4,4.8,11.2L295.2,147.1z">
                                    </path>
                                    <path style="fill:#898989;"
                                        d="M164.8,463.9c-1.6,4-6.4,6.4-11.2,4.8l0,0c-4-1.6-6.4-6.4-4.8-11.2l52-126.4c1.6-4,6.4-6.4,11.2-4.8 l0,0c4,1.6,6.4,6.4,4.8,11.2L164.8,463.9z">
                                    </path>
                                    <path style="fill:#CCCCCC;"
                                        d="M340,285.5c-4-1.6-6.4-6.4-4.8-11.2l0,0c1.6-4,6.4-6.4,11.2-4.8l126.4,52c4,1.6,6.4,6.4,4.8,11.2l0,0 c-1.6,4-6.4,6.4-11.2,4.8L340,285.5z">
                                    </path>
                                    <path style="fill:#3F3F3F;"
                                        d="M23.2,155.1c-4-1.6-6.4-6.4-4.8-11.2l0,0c1.6-4,6.4-6.4,11.2-4.8L156,191.9c4,1.6,6.4,6.4,4.8,11.2 l0,0c-1.6,4-6.4,6.4-11.2,4.8L23.2,155.1z">
                                    </path>
                                    <path style="fill:#E2E2E2;"
                                        d="M345.6,207.1c-4,1.6-8.8,0-11.2-4.8l0,0c-1.6-4,0-9.6,4.8-11.2l126.4-52.8c4-1.6,9.6,0,11.2,4.8l0,0 c1.6,4,0,9.6-4.8,11.2L345.6,207.1z">
                                    </path>
                                    <path style="fill:#6D6D6D;"
                                        d="M30.4,339.1c-4,1.6-9.6,0-11.2-4.8l0,0c-1.6-4,0-9.6,4.8-11.2l126.4-52.8c4-1.6,8.8,0,11.2,4.8l0,0 c1.6,4,0,9.6-4.8,11.2L30.4,339.1z">
                                    </path>
                                    <path style="fill:#ADADAD;"
                                        d="M280,336.7c-1.6-4,0-8.8,4.8-11.2l0,0c4-1.6,9.6,0,11.2,4.8l52.8,126.4c1.6,4,0,9.6-4.8,11.2l0,0 c-4,1.6-9.6,0-11.2-4.8L280,336.7z">
                                    </path>
                                    <path style="fill:#0C0C0C;"
                                        d="M148,20.7c-1.6-4,0-9.6,4.8-11.2l0,0c4-1.6,9.6,0,11.2,4.8l52,126.4c1.6,4,0,9.6-4.8,11.2l0,0 c-4,1.6-9.6,0-11.2-4.8L148,20.7z">
                                    </path>
                                </g>
                            </svg>
                            MosPolytech <?php echo $notification_profil3 ?>
                        </a>
                        <a href="<?php echo $profile_rules ?>">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g fill="currentColor" id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g fill="currentColor" id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                    stroke-linejoin="round"></g>
                                <g fill="currentColor" id="SVGRepo_iconCarrier">
                                    <path fill="currentColor"
                                        d="M15.7997 2.21048C15.3897 1.80048 14.6797 2.08048 14.6797 2.65048V6.14048C14.6797 7.60048 15.9197 8.81048 17.4297 8.81048C18.3797 8.82048 19.6997 8.82048 20.8297 8.82048C21.3997 8.82048 21.6997 8.15048 21.2997 7.75048C19.8597 6.30048 17.2797 3.69048 15.7997 2.21048Z"
                                        fill="#292D32"></path>
                                    <path fill="currentColor"
                                        d="M20.5 10.19H17.61C15.24 10.19 13.31 8.26 13.31 5.89V3C13.31 2.45 12.86 2 12.31 2H8.07C4.99 2 2.5 4 2.5 7.57V16.43C2.5 20 4.99 22 8.07 22H15.93C19.01 22 21.5 20 21.5 16.43V11.19C21.5 10.64 21.05 10.19 20.5 10.19ZM11.5 17.75H7.5C7.09 17.75 6.75 17.41 6.75 17C6.75 16.59 7.09 16.25 7.5 16.25H11.5C11.91 16.25 12.25 16.59 12.25 17C12.25 17.41 11.91 17.75 11.5 17.75ZM13.5 13.75H7.5C7.09 13.75 6.75 13.41 6.75 13C6.75 12.59 7.09 12.25 7.5 12.25H13.5C13.91 12.25 14.25 12.59 14.25 13C14.25 13.41 13.91 13.75 13.5 13.75Z"
                                        fill="#292D32"></path>
                                </g>
                            </svg>
                            Поступающим <?php echo $notification_profil4 ?>
                        </a>
                        <a href="<?php echo $profile_ip ?>">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g fill="currentColor" id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g fill="currentColor" id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                    stroke-linejoin="round"></g>
                                <g fill="currentColor" id="SVGRepo_iconCarrier">
                                    <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M1 4.75C1 3.10996 2.47275 2 4 2H20C21.5273 2 23 3.10996 23 4.75V8.25C23 9.89004 21.5273 11 20 11H4C2.47275 11 1 9.89004 1 8.25V4.75ZM7 6.5C7 7.32843 6.32843 8 5.5 8C4.67157 8 4 7.32843 4 6.5C4 5.67157 4.67157 5 5.5 5C6.32843 5 7 5.67157 7 6.5Z"
                                        fill="#000000"></path>
                                    <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M1 15.75C1 14.11 2.47275 13 4 13H20C21.5273 13 23 14.11 23 15.75V19.25C23 20.89 21.5273 22 20 22H4C2.47275 22 1 20.89 1 19.25V15.75ZM7 17.5C7 18.3284 6.32843 19 5.5 19C4.67157 19 4 18.3284 4 17.5C4 16.6716 4.67157 16 5.5 16C6.32843 16 7 16.6716 7 17.5Z"
                                        fill="#000000"></path>
                                </g>
                            </svg>
                            Школам <?php echo $notification_profil5 ?>
                        </a>
                    </div>
                </div>

                <div class="side-wrapper">
                    <div class="side-title">
                        Особенные
                    </div>
                    <div class="side-menu">
                        <a href="<?php echo $profile_fqa ?>">
                            <svg viewBox="0 0 332 332" fill="currentColor">
                                <path
                                    d="M282.341 8.283C275.765 2.705 266.211 0 253.103 0c-18.951 0-36.359 5.634-51.756 16.743-14.972 10.794-29.274 28.637-42.482 53.028-4.358 7.993-7.428 11.041-8.973 12.179h-26.255c-10.84 0-19.626 8.786-19.626 19.626 0 8.989 6.077 16.486 14.323 18.809l-.05.165h.589c1.531.385 3.109.651 4.757.651h18.833l-32.688 128.001c-7.208 27.848-10.323 37.782-11.666 41.24-1.445 3.711-3.266 7.062-5.542 10.135-.42-5.39-2.637-10.143-6.508-13.854-4.264-4.079-10.109-6.136-17.364-6.136-8.227 0-15.08 2.433-20.37 7.229-5.416 4.93-8.283 11.193-8.283 18.134 0 5.157 1.701 12.712 9.828 19.348 6.139 4.97 14.845 7.382 26.621 7.382 17.096 0 32.541-4.568 45.891-13.577 13.112-8.845 24.612-22.489 34.166-40.522 9.391-17.678 18.696-45.124 28.427-83.9l18.598-73.479h30.016c10.841 0 19.625-8.785 19.625-19.625s-8.784-19.626-19.625-19.626h-19.628c6.34-21.62 14.175-37.948 23.443-48.578 2.284-2.695 5.246-5.692 8.412-7.678-1.543 3.392-2.325 6.767-2.325 10.055 0 6.164 2.409 11.714 6.909 16.03 4.484 4.336 10.167 6.54 16.888 6.54 7.085 0 13.373-2.667 18.17-7.716 4.76-5.005 7.185-11.633 7.185-19.703.017-9.079-3.554-16.899-10.302-22.618z" />
                            </svg>
                            FQA <?php echo $notification_profil6 ?>
                        </a>
                    </div>
                </div>
                <div class="side-wrapper">
                    <div class="side-title">
                        Внешии ссылки
                    </div>
                    <div class="side-menu">
                        <a href="<?php echo $profile_contract ?>">
                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                                fill="#000000">
                                <g fill="currentColor" id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g fill="currentColor" id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                    stroke-linejoin="round"></g>
                                <g fill="currentColor" id="SVGRepo_iconCarrier">
                                    <g>
                                        <path fill="currentColor"
                                            d="M255.366,141.046c-7.4,3.583-14.732,8.548-21.533,15.357c-34.091,34.098-65.081,65.088-65.081,65.088 l0.013,0.02c-0.185,0.186-0.371,0.338-0.557,0.53c-8.824,8.831-9.174,22.909-1.025,32.146c0.323,0.371,0.668,0.736,1.025,1.086 c9.161,9.174,24.036,9.196,33.232,0l35.797-35.797c6.176,2.263,12.248,3.583,18.074,4.243c7.937,0.88,15.392,0.55,22.022-0.385 c16.162-2.29,14.47-1.623,23.844-4.704c9.353-3.068,19.862-9.354,19.862-9.354l6.362,6.355 c0.701,0.681,16.919,16.925,25.192,25.185c1.465,1.471,2.709,2.682,3.542,3.549c0.956,0.997,2.022,1.719,2.682,2.682l41.278,41.279 c11.898-13.35,25.488-33.232,23.81-56.058L320.763,129.14C320.763,129.14,285.062,126.589,255.366,141.046z">
                                        </path>
                                        <path fill="currentColor"
                                            d="M261.115,394.362c-9.134-9.147-23.961-9.147-33.101,0l-6.794,6.794c9.119-9.132,9.112-23.926-0.021-33.066 c-9.14-9.126-23.947-9.126-33.087,0.007c9.14-9.133,9.14-23.94,0-33.087c-9.133-9.148-23.947-9.133-33.087,0 c9.14-9.133,9.14-23.947,0-33.095c-9.134-9.132-23.947-9.132-33.088,0.014l-20.46,20.453c-9.14,9.147-9.14,23.947,0,33.094 c9.133,9.134,23.941,9.134,33.08,0c-9.14,9.134-9.14,23.947,0,33.087c9.147,9.133,23.954,9.133,33.094,0 c-9.14,9.133-9.14,23.941,0,33.088c9.14,9.133,23.947,9.133,33.088,0l6.802-6.809c-9.119,9.147-9.113,23.94,0.02,33.081 c9.14,9.132,23.947,9.132,33.088,0l20.467-20.468C270.248,418.302,270.248,403.495,261.115,394.362z">
                                        </path>
                                        <path fill="currentColor"
                                            d="M507.987,178.28L387.543,57.822c-5.351-5.337-14.002-5.337-19.339,0l-38.631,38.63 c-5.337,5.337-5.337,13.989,0,19.333l120.458,120.451c5.33,5.35,13.996,5.35,19.326,0l38.63-38.638 C513.338,192.276,513.338,183.624,507.987,178.28z M473.655,204.992c-5.75,5.736-15.048,5.736-20.777,0 c-5.735-5.743-5.735-15.041,0-20.777c5.729-5.736,15.027-5.736,20.777,0C479.391,189.951,479.384,199.249,473.655,204.992z">
                                        </path>
                                        <path fill="currentColor"
                                            d="M182.417,99.864l-38.624-38.63c-5.336-5.337-13.995-5.337-19.332,0L4.003,181.691 c-5.337,5.323-5.337,13.989,0,19.319l38.631,38.644c5.33,5.331,14.002,5.331,19.325,0l120.458-120.458 C187.761,113.859,187.761,105.207,182.417,99.864z M59.118,208.403c-5.736,5.729-15.04,5.729-20.777,0 c-5.735-5.742-5.735-15.041,0-20.777c5.736-5.735,15.041-5.735,20.777,0C64.854,193.362,64.854,202.66,59.118,208.403z">
                                        </path>
                                        <path fill="currentColor"
                                            d="M397.528,312.809l-7.468-7.482l-72.509-72.509l-4.883,2.166l-5.316,1.919l-0.384,0.117 c-0.936,0.296-9.684,2.971-26.932,5.412c-9.12,1.273-18.156,1.431-26.904,0.434c-3.459-0.385-6.898-0.95-10.296-1.692 l-27.757,27.744c-16.678,16.678-43.836,16.678-60.514,0c-0.585-0.591-1.149-1.19-1.671-1.781l-0.179-0.2 c-10.529-11.939-13.204-28.28-8.252-42.461l10.673-16.609l-0.02-0.02l65.081-65.074c2.647-2.641,5.426-5.103,8.314-7.428 c-20.281-3.982-37.296-2.806-37.296-2.806L88.093,235.679c-1.389,18.988,11.651,39.799,20.928,51.952 c16.692-15.963,43.239-15.756,59.641,0.654c6.107,6.1,9.952,13.617,11.574,21.498c7.895,1.637,15.406,5.475,21.513,11.582 c6.107,6.114,9.952,13.631,11.575,21.519c7.888,1.623,15.412,5.46,21.513,11.568c4.078,4.078,7.152,8.783,9.222,13.817 c11.1-0.137,22.242,4.016,30.688,12.455c16.65,16.636,16.643,43.733,0,60.363l-6.809,6.822l3.411,3.412 c9.148,9.147,23.954,9.147,33.095,0c9.14-9.134,9.14-23.947,0-33.088l6.808,6.83c9.147,9.133,23.947,9.133,33.087,0 c9.14-9.147,9.147-23.954,0-33.101c9.147,9.147,23.947,9.147,33.087,0c9.134-9.126,9.154-23.94,0-33.088 c9.154,9.148,23.954,9.148,33.088,0c9.147-9.132,9.147-23.947,0-33.08L397.528,312.809z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            ЦРС <?php echo $notification_profil7 ?>
                        </a>
                        <a href="<?php echo $profile_support ?>">
                            <svg viewBox="0 0 512 512" fill="currentColor">
                                <path
                                    d="M352 0H64C28.704 0 0 28.704 0 64v320a16.02 16.02 0 009.216 14.496A16.232 16.232 0 0016 400c3.68 0 7.328-1.248 10.24-3.712L117.792 320H352c35.296 0 64-28.704 64-64V64c0-35.296-28.704-64-64-64z" />
                                <path
                                    d="M464 128h-16v128c0 52.928-43.072 96-96 96H129.376L128 353.152V400c0 26.464 21.536 48 48 48h234.368l75.616 60.512A16.158 16.158 0 00496 512c2.336 0 4.704-.544 6.944-1.6A15.968 15.968 0 00512 496V176c0-26.464-21.536-48-48-48z" />
                            </svg>
                            Поддержка <?php echo $notification_profil8 ?>
                        </a>
                        <a href="https://vk.com/moscowpolytech">
                            <svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <g fill="currentColor" id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g fill="currentColor" id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                    stroke-linejoin="round"></g>
                                <g fill="currentColor" id="SVGRepo_iconCarrier">
                                    <title>vk</title>
                                    <path fill="currentColor"
                                        d="M25.217 22.402h-2.179c-0.825 0-1.080-0.656-2.562-2.158-1.291-1.25-1.862-1.418-2.179-1.418-0.445 0-0.572 0.127-0.572 0.741v1.968c0 0.53-0.169 0.847-1.566 0.847-2.818-0.189-5.24-1.726-6.646-3.966l-0.021-0.035c-1.632-2.027-2.835-4.47-3.43-7.142l-0.022-0.117c0-0.317 0.127-0.614 0.741-0.614h2.179c0.55 0 0.762 0.254 0.975 0.846 1.078 3.112 2.878 5.842 3.619 5.842 0.275 0 0.402-0.127 0.402-0.825v-3.219c-0.085-1.482-0.868-1.608-0.868-2.137 0.009-0.283 0.241-0.509 0.525-0.509 0.009 0 0.017 0 0.026 0.001l-0.001-0h3.429c0.466 0 0.635 0.254 0.635 0.804v4.34c0 0.465 0.212 0.635 0.339 0.635 0.275 0 0.509-0.17 1.016-0.677 1.054-1.287 1.955-2.759 2.642-4.346l0.046-0.12c0.145-0.363 0.493-0.615 0.9-0.615 0.019 0 0.037 0.001 0.056 0.002l-0.003-0h2.179c0.656 0 0.805 0.337 0.656 0.804-0.874 1.925-1.856 3.579-2.994 5.111l0.052-0.074c-0.232 0.381-0.317 0.55 0 0.975 0.232 0.317 0.995 0.973 1.503 1.566 0.735 0.727 1.351 1.573 1.816 2.507l0.025 0.055c0.212 0.612-0.106 0.93-0.72 0.93zM20.604 1.004h-9.207c-8.403 0-10.392 1.989-10.392 10.392v9.207c0 8.403 1.989 10.392 10.392 10.392h9.207c8.403 0 10.392-1.989 10.392-10.392v-9.207c0-8.403-2.011-10.392-10.392-10.392z">
                                    </path>
                                </g>
                            </svg>
                            ВК Политеха<?php echo $notification_profil9 ?>
                        </a>
                    </div>
                </div>

                <div class="side-wrapper">
                    <div class="side-title">
                        Профиль
                        <?php echo $status_profile; ?>
                    </div>
                    <div class="side-menu">
                        <a href="#" id="logout-link">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 503.284 503.284"
                                xml:space="preserve" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path style="fill:#ae9cff;"
                                            d="M325.784,74.142c-33.67,0-66.443,9.476-94.775,27.403c-27.546,17.429-49.763,42.048-64.25,71.196 l35.82,17.803c23.422-47.126,70.632-76.401,123.205-76.401c75.817,0,137.5,61.682,137.5,137.5s-61.683,137.5-137.5,137.5 c-52.573,0-99.783-29.275-123.205-76.401l-35.82,17.803c14.487,29.147,36.704,53.767,64.25,71.196 c28.332,17.927,61.105,27.403,94.775,27.403c97.874,0,177.5-79.626,177.5-177.5S423.658,74.142,325.784,74.142z">
                                        </path>
                                        <polygon style="fill:#7d72ff;"
                                            points="325.784,271.642 325.784,231.642 76.569,231.642 102.427,205.784 74.142,177.5 0,251.643 74.143,325.784 102.426,297.5 76.568,271.642 ">
                                        </polygon>
                                    </g>
                                </g>
                            </svg>
                            Выйти с профиля
                        </a>
                    </div>
                    <script>
                        // Находим ссылку для выхода из профиля
                        const logoutLink = document.getElementById('logout-link');

                        // Добавляем обработчик клика на ссылку
                        logoutLink.addEventListener('click', (event) => {
                            event.preventDefault(); // Отменяем стандартное поведение ссылки

                            // Создаем форму и отправляем ее
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = '/../php/src/actions/logout.php';
                            document.body.appendChild(form);
                            form.submit();
                        });
                    </script>
                </div>
            </div>
            <div class="main-container">
                <div class="main-header">
                    <a class="menu-link-main" href="#">Панели</a>
                    <div class="header-menu">
                        <a class="main-header-link is-active" href="#">Профиль</a>
                        <a class="main-header-link" href="#">Настройки</a>
                        <a class="main-header-link" href="#">События</a>
                        <a class="main-header-link lock" href="#">Панель управления</a>
                    </div>
                </div>

                <div class="content-wrapper">

                    <div class="profile">

                        <style>
                            @media (min-width: 768px) {
                                .controller-infor-pc {
                                    opacity: 0;
                                    transition: 1s ease all;
                                    position: absolute;
                                }
                            }
                        </style>
                        <div class="content-section controller-infor-pc" style="margin-top: 0px;margin-bottom: 1.5rem">
                            <ul
                                style="overflow: clip;font-size: 13px !important;font-family: monospace;font-weight: 500;flex-flow:row;word-break: break-word">
                                <div class="products" style="width: auto !important;">
                                    <!--here can add icon-->
                                    <style>
                                        @keyframes svgr {
                                            0% {
                                                filter: drop-shadow(0px 0px 1px #FEE187);
                                                transition: 1s ease all;
                                            }

                                            50% {
                                                filter: drop-shadow(0px 0px 7px #FEE187);
                                            }

                                            100% {
                                                filter: drop-shadow(0px 0px 1px #FEE187);
                                            }
                                        }
                                    </style>
                                    <svg style="margin-left: 15px;animation: svgr 1.2s infinite ease;transition: 1s ease all;"
                                        height="45px" width="40px" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path style="fill:#FEE187;"
                                                d="M162.135,395.253L88.471,267.662c-4.167-7.218-4.167-16.108,0-23.326l73.664-127.591 c4.167-7.218,11.866-11.663,20.201-11.663h147.329c8.333,0,16.034,4.445,20.201,11.663l73.664,127.591 c4.167,7.218,4.167,16.108,0,23.326l-73.664,127.591c-4.167,7.218-11.866,11.663-20.201,11.663H182.336 C174.002,406.916,166.302,402.471,162.135,395.253z">
                                            </path>
                                            <g>
                                                <path style="fill:#FFC61B;"
                                                    d="M506.855,236.741l-69.12-119.72c-4.194-7.266-13.487-9.758-20.752-5.56 c-7.266,4.196-9.756,13.486-5.56,20.752l69.12,119.72c1.448,2.508,1.448,5.624,0,8.134L371.794,448.426 c-1.448,2.508-4.147,4.067-7.045,4.067H147.252c-2.897,0-5.597-1.557-7.045-4.067L31.458,260.067c-1.448-2.508-1.448-5.624,0-8.134 L140.207,63.574c1.448-2.508,4.147-4.067,7.045-4.067h154.334c8.391,0,15.192-6.803,15.192-15.192s-6.801-15.192-15.192-15.192 H147.252c-13.717,0-26.498,7.379-33.357,19.259L5.144,236.741c-6.859,11.879-6.859,26.638,0,38.518l108.75,188.359 c6.859,11.879,19.64,19.259,33.357,19.259h217.497c13.717,0,26.498-7.379,33.357-19.259l108.749-188.359 C513.716,263.379,513.716,248.62,506.855,236.741z">
                                                </path>
                                                <path style="fill:#FFC61B;"
                                                    d="M148.979,109.151l-73.664,127.59c-6.859,11.879-6.859,26.638,0,38.518l73.663,127.59 c6.859,11.879,19.64,19.26,33.359,19.26h147.33c13.717,0,26.499-7.38,33.357-19.26l73.664-127.59 c6.859-11.879,6.859-26.638,0-38.518l-73.663-127.59c-6.859-11.879-19.64-19.26-33.359-19.26h-147.33 C168.618,89.891,155.837,97.271,148.979,109.151z M336.709,124.343l73.664,127.59c1.448,2.508,1.448,5.624,0,8.134l-73.664,127.59 c-1.448,2.508-4.147,4.068-7.043,4.068h-147.33c-2.896,0-5.595-1.559-7.045-4.068l-73.664-127.59c-1.448-2.508-1.448-5.624,0-8.134 l73.664-127.59c1.448-2.508,4.147-4.068,7.043-4.068h147.33C332.56,120.275,335.26,121.834,336.709,124.343z">
                                                </path>


                                                <path style="fill:#333;"
                                                    d="M142.331,238.368c0,24.78,33.568,22.556,33.568,35.37c0,5.082-5.401,6.988-10.271,6.988 c-9.849,0-13.026-7.836-18.002-7.836c-4.024,0-7.201,5.294-7.201,8.893c0,6.99,11.648,13.767,25.521,13.767 c15.355,0,26.474-8.26,26.474-23.508c0-26.683-33.568-24.673-33.568-35.262c0-3.283,3.07-6.353,10.589-6.353 c8.684,0,10.695,4.024,14.508,4.024c4.659,0,6.566-5.823,6.566-8.682c0-8.261-15.461-9.319-21.073-9.319 C156.203,216.449,142.331,222.485,142.331,238.368z">
                                                </path>
                                                <path style="fill:#333;"
                                                    d="M200.673,231.91h14.613v57.499c0,3.389,4.129,5.083,8.26,5.083c4.129,0,8.26-1.694,8.26-5.083 V231.91h14.613c3.177,0,4.977-3.496,4.977-7.52c0-3.494-1.483-7.306-4.977-7.306h-45.746c-3.494,0-4.977,3.812-4.977,7.306 C195.696,228.415,197.496,231.91,200.673,231.91z">
                                                </path>
                                                <path style="fill:#333;"
                                                    d="M281.889,295.129c14.613,0,26.05-6.777,26.05-24.991v-28.061c0-18.215-11.437-24.992-26.05-24.992 c-14.613,0-25.943,6.777-25.943,24.992v28.061C255.946,288.35,267.276,295.129,281.889,295.129z M272.465,242.075 c0-7.307,3.494-10.59,9.424-10.59c5.931,0,9.531,3.283,9.531,10.59v28.061c0,7.307-3.6,10.589-9.531,10.589 c-5.929,0-9.424-3.283-9.424-10.589V242.075z">
                                                </path>
                                                <path style="fill:#333;"
                                                    d="M326.783,294.492c4.131,0,8.26-1.694,8.26-5.083v-22.872h10.484c14.613,0,26.05-6.777,26.05-24.568 v-0.529c0-17.79-11.013-24.356-24.991-24.356h-21.921c-3.707,0-6.142,2.33-6.142,4.978v67.348 C318.523,292.8,322.654,294.492,326.783,294.492z M335.043,231.485h10.484c5.931,0,9.53,3.388,9.53,10.59v1.165 c0,7.201-3.6,10.589-9.53,10.589h-10.484V231.485z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                    <span>Для доступа к полным возможностям профиля перейдите в режим PC!

                                        <svg style="transform: translate(5px,-1px);position: absolute" id="my-tooltip"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Вы так же можете изменить масштаб экрана и наклонить устройство для работы со всеми возможностями!"
                                            data-bs-delay="35" fill="currentColor" viewBox="0 0 40 30"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M14.7071068,4 L17.5,4 C18.8807119,4 20,5.11928813 20,6.5 L20,9.29289322 L21.1464466,8.14644661 C21.3417088,7.95118446 21.6582912,7.95118446 21.8535534,8.14644661 C22.0488155,8.34170876 22.0488155,8.65829124 21.8535534,8.85355339 L19.8535534,10.8535534 C19.6582912,11.0488155 19.3417088,11.0488155 19.1464466,10.8535534 L17.1464466,8.85355339 C16.9511845,8.65829124 16.9511845,8.34170876 17.1464466,8.14644661 C17.3417088,7.95118446 17.6582912,7.95118446 17.8535534,8.14644661 L19,9.29289322 L19,6.5 C19,5.67157288 18.3284271,5 17.5,5 L14.7071068,5 L15.8535534,6.14644661 C16.0488155,6.34170876 16.0488155,6.65829124 15.8535534,6.85355339 C15.6582912,7.04881554 15.3417088,7.04881554 15.1464466,6.85355339 L13.1464466,4.85355339 C12.9511845,4.65829124 12.9511845,4.34170876 13.1464466,4.14644661 L15.1464466,2.14644661 C15.3417088,1.95118446 15.6582912,1.95118446 15.8535534,2.14644661 C16.0488155,2.34170876 16.0488155,2.65829124 15.8535534,2.85355339 L14.7071068,4 Z M4.5,2 L9.5,2 C10.8807119,2 12,3.11928813 12,4.5 L12,15.5 C12,16.8807119 10.8807119,18 9.5,18 L4.5,18 C3.11928813,18 2,16.8807119 2,15.5 L2,4.5 C2,3.11928813 3.11928813,2 4.5,2 Z M4.5,3 C3.67157288,3 3,3.67157288 3,4.5 L3,15.5 C3,16.3284271 3.67157288,17 4.5,17 L9.5,17 C10.3284271,17 11,16.3284271 11,15.5 L11,4.5 C11,3.67157288 10.3284271,3 9.5,3 L4.5,3 Z M16.5,13 C16.2238576,13 16,12.7761424 16,12.5 C16,12.2238576 16.2238576,12 16.5,12 L17.5,12 C17.7761424,12 18,12.2238576 18,12.5 C18,12.7761424 17.7761424,13 17.5,13 L16.5,13 Z M13.5,13 C13.2238576,13 13,12.7761424 13,12.5 C13,12.2238576 13.2238576,12 13.5,12 L14.5,12 C14.7761424,12 15,12.2238576 15,12.5 C15,12.7761424 14.7761424,13 14.5,13 L13.5,13 Z M16.5,22 C16.2238576,22 16,21.7761424 16,21.5 C16,21.2238576 16.2238576,21 16.5,21 L17.5,21 C17.7761424,21 18,21.2238576 18,21.5 C18,21.7761424 17.7761424,22 17.5,22 L16.5,22 Z M13.5,22 C13.2238576,22 13,21.7761424 13,21.5 C13,21.2238576 13.2238576,21 13.5,21 L14.5,21 C14.7761424,21 15,21.2238576 15,21.5 C15,21.7761424 14.7761424,22 14.5,22 L13.5,22 Z M10.5,22 C10.2238576,22 10,21.7761424 10,21.5 C10,21.2238576 10.2238576,21 10.5,21 L11.5,21 C11.7761424,21 12,21.2238576 12,21.5 C12,21.7761424 11.7761424,22 11.5,22 L10.5,22 Z M19.5,13 C19.2238576,13 19,12.7761424 19,12.5 C19,12.2238576 19.2238576,12 19.5,12 C20.8807119,12 22,13.1192881 22,14.5 C22,14.7761424 21.7761424,15 21.5,15 C21.2238576,15 21,14.7761424 21,14.5 C21,13.6715729 20.3284271,13 19.5,13 Z M21,16.5 C21,16.2238576 21.2238576,16 21.5,16 C21.7761424,16 22,16.2238576 22,16.5 L22,17.5 C22,17.7761424 21.7761424,18 21.5,18 C21.2238576,18 21,17.7761424 21,17.5 L21,16.5 Z M21,19.5 C21,19.2238576 21.2238576,19 21.5,19 C21.7761424,19 22,19.2238576 22,19.5 C22,20.8807119 20.8807119,22 19.5,22 C19.2238576,22 19,21.7761424 19,21.5 C19,21.2238576 19.2238576,21 19.5,21 C20.3284271,21 21,20.3284271 21,19.5 Z M8.5,21 C8.77614237,21 9,21.2238576 9,21.5 C9,21.7761424 8.77614237,22 8.5,22 C7.11928813,22 6,20.8807119 6,19.5 C6,19.2238576 6.22385763,19 6.5,19 C6.77614237,19 7,19.2238576 7,19.5 C7,20.3284271 7.67157288,21 8.5,21 Z">
                                                </path>
                                            </g>
                                        </svg>

                                    </span>
                                </div>
                            </ul>
                        </div>

                        <!-- Broadchast -->
                        <?php echo $placat[0]; ?>
                        <!-- finish broadchast -->
                        <div class="content-section">
                            <div class="content-section-title">
                                Мои записи:</div>
                            <ul>
                                <?php
                                // Предполагается, что мы знаем user_id текущего пользователя
                                $user_id = $user['id']; // Замените это значение на актуальный ID пользователя
                                $my_events = null;

                                $sql = 'SELECT events.title, events.date, events.time
        FROM registrations
        JOIN events ON registrations.event_id = events.event_id
        WHERE registrations.user_id = ?';
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('i', $user_id);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $my_events = "
                                <li class='adobe-product'>
                                    <div class='products'>
                                        <!--here can add icon-->
                                        <svg version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'
    viewBox='0 0 512 512' xml:space='preserve' fill='#000000'>
    <g id='SVGRepo_bgCarrier' stroke-width='0'></g>
    <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g>
    <g id='SVGRepo_iconCarrier'>
        <g>
            <g>
                <g>
                    <g>
                        <g>
                            <path style='fill:#83B832;'
                                d='M318.124,491.209c-3.063,0-5.963-1.834-7.173-4.851c-1.589-3.961,0.333-8.459,4.293-10.048 c30.784-12.351,54.872-31.609,71.595-57.237c13.459-20.627,22.286-45.484,26.233-73.882 c6.791-48.844-3.302-91.325-3.405-91.749c-1.006-4.147,1.54-8.324,5.687-9.33c4.15-1.008,8.324,1.539,9.331,5.686 c0.448,1.845,10.885,45.792,3.694,97.521c-9.656,69.458-46.788,119.021-107.38,143.333 C320.056,491.03,319.082,491.209,318.124,491.209z'>
                            </path>
                            <g>
                                <g>
                                    <path style='fill:#BDEB73;'
                                        d='M428.204,191.055c4.255,26.707,0.114,63.715-11.961,65.639 c-12.075,1.924-27.511-31.965-31.766-58.672c-4.255-26.707,4.283-36.118,16.357-38.041 C412.91,158.057,423.949,164.349,428.204,191.055z'>
                                    </path>
                                </g>
                                <g>
                                    <path style='fill:#9AD63B;'
                                        d='M416.241,256.688c-2.81,0.451-5.809-1.046-8.811-3.947 c5.958-12.568,7.449-38.173,4.279-58.072c-3.368-21.12-10.979-29.467-19.994-31.089c2.625-1.93,5.73-3.069,9.12-3.602 c12.075-1.917,23.117,4.37,27.371,31.074C432.459,217.767,428.317,254.771,416.241,256.688z'>
                                    </path>
                                </g>
                                <g>
                                    <path style='fill:#8EC737;'
                                        d='M419.261,357.948c-5.938,2.956-15.975-3.85-25.836-14.552 c-8.316-9.037-16.515-20.838-22.034-31.917c-12.057-24.218-6.729-35.745,4.219-41.2c10.636-5.293,22.667-2.889,34.407,19.49 c0.344,0.637,0.675,1.294,1.012,1.973C423.077,315.948,430.209,352.493,419.261,357.948z'>
                                    </path>
                                    <path style='fill:#83B832;'
                                        d='M419.261,357.948c-5.938,2.956-15.975-3.85-25.836-14.552c0.17-4.604,0.885-9.71,2.142-15.297 c2.794-12.452,8.082-26.4,14.449-38.331c0.344,0.637,0.675,1.294,1.012,1.973 C423.077,315.948,430.209,352.493,419.261,357.948z'>
                                    </path>
                                    <path style='fill:#BDEB73;'
                                        d='M425.822,292.275c-13.78,23.27-23.541,59.207-13.02,65.437 c10.521,6.23,37.34-19.606,51.119-42.876c13.78-23.27,9.302-35.161-1.219-41.391S439.601,269.006,425.822,292.275z'>
                                    </path>
                                    <path style='fill:#9AD63B;'
                                        d='M463.922,314.839c-13.783,23.263-40.595,49.101-51.125,42.872 c-2.454-1.444-3.795-4.509-4.251-8.647c12.611-5.76,30.229-24.616,40.544-42.029c10.861-18.35,10.378-29.617,4.532-36.62 c3.17,0.222,6.206,1.323,9.082,3.026C473.222,279.68,477.697,291.564,463.922,314.839z'>
                                    </path>
                                </g>
                                <g>
                                    <path style='fill:#8EC737;'
                                        d='M373.157,460.499c-6.626,0.376-13.155-9.847-17.989-23.579 c-4.083-11.576-6.95-25.668-7.655-38.018c-1.527-26.996,7.924-35.5,20.13-36.187c11.877-0.669,21.984,6.291,23.935,31.502 c0.058,0.717,0.104,1.443,0.147,2.191C393.24,423.412,385.366,459.802,373.157,460.499z'>
                                    </path>
                                    <path style='fill:#83B832;'
                                        d='M373.157,460.499c-6.626,0.376-13.155-9.847-17.989-23.579 c1.964-4.168,4.633-8.571,7.996-13.21c7.491-10.34,17.854-21.055,28.414-29.494c0.058,0.717,0.104,1.443,0.147,2.191 C393.24,423.412,385.366,459.802,373.157,460.499z'>
                                    </path>
                                    <path style='fill:#BDEB73;'
                                        d='M405.103,402.742c-21.844,15.943-44.996,45.111-37.787,54.987 c7.208,9.876,42.046-3.279,63.891-19.222s22.423-28.636,15.215-38.513C439.212,390.119,426.947,386.8,405.103,402.742z'>
                                    </path>
                                    <path style='fill:#9AD63B;'
                                        d='M431.207,438.504c-21.848,15.945-56.681,29.1-63.891,19.224 c-1.113-1.523-1.501-3.517-1.275-5.848c14.092-1.573,35.562-11.308,50.755-22.389c21.273-15.524,22.379-27.969,15.77-37.739 c6.033,0.455,10.498,3.635,13.852,8.24C453.628,409.868,453.052,422.57,431.207,438.504z'>
                                    </path>
                                </g>
                            </g>
                        </g>
                        <g>
                            <path style='fill:#83B832;'
                                d='M193.876,491.209c-0.958,0-1.931-0.179-2.875-0.557 c-60.592-24.312-97.723-73.875-107.38-143.333c-7.191-51.729,3.246-95.676,3.694-97.521c1.006-4.147,5.183-6.699,9.33-5.686 c4.145,1.005,6.691,5.18,5.688,9.325l0,0c-0.103,0.428-10.236,43.316-3.344,92.2c3.992,28.309,12.843,53.088,26.308,73.646 c16.717,25.523,40.759,44.71,71.458,57.027c3.96,1.59,5.882,6.088,4.293,10.048 C199.839,489.375,196.939,491.209,193.876,491.209z'>
                            </path>
                            <g>
                                <path style='fill:#BDEB73;'
                                    d='M83.796,191.055c-4.255,26.707-0.114,63.715,11.961,65.639 c12.075,1.924,27.511-31.965,31.766-58.672c4.255-26.707-4.283-36.118-16.357-38.041 C99.09,158.057,88.051,164.349,83.796,191.055z'>
                                </path>
                            </g>
                            <g>
                                <path style='fill:#9AD63B;'
                                    d='M127.522,198.026c-4.254,26.704-19.687,60.59-31.764,58.662 c-2.965-0.467-5.455-3.052-7.451-7.095c9.68-9.876,19.236-34.089,22.443-54.212c3.21-20.168-0.871-30.478-8.26-35.125 c2.765-0.727,5.687-0.753,8.675-0.279C123.242,161.906,131.775,171.311,127.522,198.026z'>
                                </path>
                            </g>
                            <g>
                                <path style='fill:#8EC737;'
                                    d='M92.739,357.948c5.938,2.956,15.975-3.85,25.836-14.552 c8.316-9.037,16.515-20.838,22.034-31.917c12.057-24.218,6.729-35.745-4.219-41.2c-10.636-5.293-22.667-2.889-34.407,19.49 c-0.344,0.637-0.675,1.294-1.012,1.973C88.923,315.948,81.791,352.493,92.739,357.948z'>
                                </path>
                                <path style='fill:#83B832;'
                                    d='M140.609,311.479c-5.52,11.079-13.718,22.88-22.034,31.917 c-9.861,10.702-19.897,17.508-25.836,14.552c-1.61-0.804-2.841-2.295-3.707-4.306c4.071-2.698,8.491-6.686,12.874-11.44 c8.316-9.037,16.515-20.838,22.034-31.917c11.865-23.826,6.892-35.371-3.692-40.924c5.571-2.396,11.026-1.629,16.141,0.918 C147.337,275.734,152.666,287.261,140.609,311.479z'>
                                </path>
                                <path style='fill:#83B832;'
                                    d='M92.739,357.948c5.938,2.956,15.975-3.85,25.836-14.552c-0.17-4.604-0.885-9.71-2.142-15.297 c-2.794-12.452-8.082-26.4-14.449-38.331c-0.344,0.637-0.675,1.294-1.012,1.973C88.923,315.948,81.791,352.493,92.739,357.948 z'>
                                </path>
                                <path style='fill:#BDEB73;'
                                    d='M86.178,292.275c13.78,23.27,23.541,59.207,13.02,65.437s-37.34-19.606-51.119-42.876 c-13.78-23.27-9.302-35.161,1.219-41.391S72.399,269.006,86.178,292.275z'>
                                </path>
                                <path style='fill:#9AD63B;'
                                    d='M99.202,357.711c-2.65,1.566-6.332,1.106-10.58-0.843c1.871-13.448-6.433-39.32-17.183-57.472 c-9.803-16.546-18.985-22.226-27.257-21.888c1.44-1.581,3.173-2.92,5.113-4.067c10.519-6.228,23.106-4.433,36.878,18.831 C99.958,315.547,109.721,351.484,99.202,357.711z'>
                                </path>
                            </g>
                            <g>
                                <path style='fill:#8EC737;'
                                    d='M138.843,460.499c6.626,0.376,13.155-9.847,17.989-23.579 c4.083-11.576,6.95-25.668,7.655-38.018c1.527-26.996-7.924-35.5-20.13-36.187c-11.877-0.669-21.984,6.291-23.935,31.502 c-0.058,0.717-0.104,1.443-0.147,2.191C118.76,423.412,126.634,459.802,138.843,460.499z'>
                                </path>
                                <path style='fill:#83B832;'
                                    d='M164.487,398.902c-0.705,12.351-3.572,26.443-7.655,38.018 c-4.834,13.732-11.364,23.955-17.989,23.579c-3.121-0.179-5.957-2.692-8.429-6.781c3.495-4.239,6.737-10.836,9.439-18.525 c4.083-11.576,6.95-25.668,7.655-38.018c1.109-19.558-3.555-29.417-10.844-33.615c2.423-0.754,5.014-0.993,7.694-0.845 C156.563,363.402,166.014,371.907,164.487,398.902z'>
                                </path>
                                <path style='fill:#83B832;'
                                    d='M138.843,460.499c6.626,0.376,13.155-9.847,17.989-23.579c-1.964-4.168-4.633-8.57-7.996-13.21 c-7.491-10.34-17.854-21.055-28.414-29.494c-0.058,0.717-0.104,1.443-0.147,2.191 C118.76,423.412,126.634,459.802,138.843,460.499z'>
                                </path>
                                <path style='fill:#BDEB73;'
                                    d='M106.897,402.742c21.844,15.943,44.996,45.111,37.787,54.987 c-7.208,9.876-42.046-3.279-63.891-19.222s-22.423-28.636-15.215-38.513S85.053,386.8,106.897,402.742z'>
                                </path>
                                <path style='fill:#9AD63B;'
                                    d='M144.685,457.729c-2.304,3.158-7.437,3.965-14.068,3.068 c0.22-12.385-19.956-36.555-39.118-50.537c-10.488-7.658-18.765-10.865-25.334-11.044c7.277-9.257,19.467-11.993,40.729,3.533 C128.739,418.683,151.895,447.853,144.685,457.729z'>
                                </path>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
            <path style='fill:#8998DD;'
                d='M365.314,113.605L263.718,3.383c-4.157-4.51-11.279-4.51-15.436,0L146.686,113.605 c-6.199,6.726-1.429,17.611,7.718,17.611h36.594v219.175c0,5.797,4.7,10.497,10.497,10.497h109.009 c5.797,0,10.497-4.7,10.497-10.497V131.216h36.594C366.743,131.216,371.513,120.331,365.314,113.605z'>
            </path>
            <path style='fill:#6D80D6;'
                d='M357.596,131.214h-23.797c9.148,0,13.918-10.879,7.716-17.606L244.101,7.912l4.183-4.533 c4.152-4.502,11.281-4.502,15.432,0l101.596,110.229C371.514,120.336,366.744,131.214,357.596,131.214z'>
            </path>
            <path style='fill:#6D80D6;'
                d='M321.004,131.214v219.181c0,5.792-4.695,10.487-10.487,10.487H287.06 c5.8,0,10.498-4.698,10.498-10.487v-213c0-3.414,2.767-6.181,6.181-6.181H321.004z'>
            </path>
            <g>
                <path style='fill:#8998DD;'
                    d='M190.999,399.408v25.51c0,5.797,4.7,10.497,10.497,10.497h109.009 c5.797,0,10.497-4.7,10.497-10.497v-25.51c0-5.797-4.7-10.497-10.497-10.497H201.495 C195.698,388.911,190.999,393.611,190.999,399.408z'>
                </path>
                <path style='fill:#6D80D6;'
                    d='M321.004,399.411v25.507c0,5.8-4.698,10.497-10.498,10.497H287.06 c5.8,0,10.498-4.697,10.498-10.497v-25.507c0-5.8-4.698-10.497-10.498-10.497h23.447 C316.307,388.914,321.004,393.612,321.004,399.411z'>
                </path>
            </g>
            <g>
                <path style='fill:#8998DD;'
                    d='M190.999,475.993v25.51c0,5.797,4.7,10.497,10.497,10.497h109.009 c5.797,0,10.497-4.7,10.497-10.497v-25.51c0-5.797-4.7-10.497-10.497-10.497H201.495 C195.698,465.497,190.999,470.196,190.999,475.993z'>
                </path>
                <path style='fill:#6D80D6;'
                    d='M321.004,475.995v25.507c0,5.8-4.698,10.497-10.498,10.497H287.06 c5.8,0,10.498-4.698,10.498-10.497v-25.507c0-5.8-4.698-10.498-10.498-10.498h23.447 C316.307,465.497,321.004,470.195,321.004,475.995z'>
                </path>
            </g>
        </g>
    </g>
</svg>
                                        " . htmlspecialchars($row['title']) . "
                                    </div>
                                    <div class='button-wrapper event_date_content_center_profile'>
                                        <span class='open'>" . formatDate(htmlspecialchars($row['date'])) . ", Время: " . formatTime(htmlspecialchars($row['time'])) . "</span>
                                    </div>
                                </li>";
                                        echo $my_events;
                                    }
                                } else {

                                    $my_events = "                                <li class='adobe-product'>
    <div class='products'>
        <!--here can add icon-->
        <svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' viewBox='0 0 48 48'>
    <linearGradient id='SVGID_1__v3dThkAMrXvu_gr1' x1='37.5' x2='10.5' y1='10.5' y2='37.5'
        gradientUnits='userSpaceOnUse'>
        <stop offset='.014' stop-color='#fe6d60'></stop>
        <stop offset='.046' stop-color='#fe766a'></stop>
        <stop offset='.208' stop-color='#fea097'></stop>
        <stop offset='.37' stop-color='#ffc2bd'></stop>
        <stop offset='.532' stop-color='#ffddda'></stop>
        <stop offset='.692' stop-color='#fff0ee'></stop>
        <stop offset='.849' stop-color='#fffbfb'></stop>
        <stop offset='1' stop-color='#fff'></stop>
    </linearGradient>
    <path fill='url(#SVGID_1__v3dThkAMrXvu_gr1)'
        d='M39.975,12.975l-4.95-4.95c-0.781-0.781-2.047-0.781-2.828,0L24,16.222l-8.197-8.197	c-0.781-0.781-2.047-0.781-2.828,0l-4.95,4.95c-0.781,0.781-0.781,2.047,0,2.828L16.222,24l-8.197,8.197	c-0.781,0.781-0.781,2.047,0,2.828l4.95,4.95c0.781,0.781,2.047,0.781,2.828,0L24,31.778l8.197,8.197	c0.781,0.781,2.047,0.781,2.828,0l4.95-4.95c0.781-0.781,0.781-2.047,0-2.828L31.778,24l8.197-8.197	C40.756,15.022,40.756,13.756,39.975,12.975z'>
    </path>
    <path fill='none' stroke='#e02f24' stroke-linecap='round' stroke-linejoin='round' stroke-miterlimit='10'
        stroke-width='3'
        d='M11.728,28.494l-3.703,3.703c-0.781,0.781-0.781,2.047,0,2.828l4.95,4.95c0.781,0.781,2.047,0.781,2.828,0	L24,31.778l8.197,8.197c0.781,0.781,2.047,0.781,2.828,0l4.95-4.95c0.781-0.781,0.781-2.047,0-2.828L31.778,24l8.197-8.197	c0.781-0.781,0.781-2.047,0-2.828l-2.571-2.571'>
    </path>
    <path fill='none' stroke='#e02f24' stroke-linecap='round' stroke-linejoin='round' stroke-miterlimit='10'
        stroke-width='3'
        d='M33.079,7.143L24,16.222l-8.197-8.197c-0.781-0.781-2.047-0.781-2.828,0l-4.95,4.95	c-0.781,0.781-0.781,2.047,0,2.828L16.222,24'>
    </path>
</svg>
        пусто
    </div>
    <div class='button-wrapper'>
        <span class='open'>нету</span>
    </div>
</li>";
                                    echo $my_events;
                                }

                                ?>
                            </ul>
                        </div>
                        <!-- Информация -->
                        <div class="content-section">
                            <div class="content-section-title">
                                Персональные данные:</div>
                            <ul>
                                <!-- Nickname -->
                                <li class="adobe-product">
                                    <div class="products">
                                        <!--here can add icon-->
                                        <svg viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            stroke="#000000" stroke-width="0.00024000000000000003">
                                            <g fill="currentColor" id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g fill="currentColor" id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.384"></g>
                                            <g fill="currentColor" id="SVGRepo_iconCarrier">
                                                <path fill="currentColor" opacity="0.5"
                                                    d="M20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355Z"
                                                    fill="#ffffff"></path>
                                                <path fill="currentColor"
                                                    d="M11.9697 9.53033C11.6768 9.23744 11.6768 8.76256 11.9697 8.46967C12.2626 8.17678 12.7374 8.17678 13.0303 8.46967L16.0303 11.4697C16.3232 11.7626 16.3232 12.2374 16.0303 12.5303L13.0303 15.5303C12.7374 15.8232 12.2626 15.8232 11.9697 15.5303C11.6768 15.2374 11.6768 14.7626 11.9697 14.4697L14.4393 12L11.9697 9.53033Z"
                                                    fill="#ffffff"></path>
                                                <path fill="currentColor"
                                                    d="M7.96967 9.53033C7.67678 9.23744 7.67678 8.76256 7.96967 8.46967C8.26256 8.17678 8.73744 8.17678 9.03033 8.46967L12.0303 11.4697C12.3232 11.7626 12.3232 12.2374 12.0303 12.5303L9.03033 15.5303C8.73744 15.8232 8.26256 15.8232 7.96967 15.5303C7.67678 15.2374 7.67678 14.7626 7.96967 14.4697L10.4393 12L7.96967 9.53033Z"
                                                    fill="#ffffff"></path>
                                            </g>
                                        </svg>
                                        Школа:
                                    </div>
                                    <div class="button-wrapper">
                                        <span class="information"><?php echo $user['nickname']; ?></span>
                                    </div>
                                </li>
                                <!-- Email -->
                                <li class="adobe-product">
                                    <div class="products">
                                        <!--here can add icon-->
                                        <svg viewBox="0 0 24 24" fill="none" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g fill="currentColor" id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g fill="currentColor" id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12ZM16 12V13.5C16 14.8807 17.1193 16 18.5 16V16C19.8807 16 21 14.8807 21 13.5V12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21H16"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        Email:
                                    </div>
                                    <div class="button-wrapper">
                                        <span class="information"><?php echo $user["email"]; ?></span>
                                    </div>
                                </li>
                                <!-- Icon -->
                                <li class="adobe-product">
                                    <div class="products">
                                        <!--here can add icon-->
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M14.2647 15.9377L12.5473 14.2346C11.758 13.4519 11.3633 13.0605 10.9089 12.9137C10.5092 12.7845 10.079 12.7845 9.67922 12.9137C9.22485 13.0605 8.83017 13.4519 8.04082 14.2346L4.04193 18.2622M14.2647 15.9377L14.606 15.5991C15.412 14.7999 15.8149 14.4003 16.2773 14.2545C16.6839 14.1262 17.1208 14.1312 17.5244 14.2688C17.9832 14.4253 18.3769 14.834 19.1642 15.6515L20 16.5001M14.2647 15.9377L18.22 19.9628M11 4H7.2C6.07989 4 5.51984 4 5.09202 4.21799C4.7157 4.40973 4.40973 4.71569 4.21799 5.09202C4 5.51984 4 6.0799 4 7.2V16.8C4 17.4466 4 17.9066 4.04193 18.2622M4.04193 18.2622C4.07264 18.5226 4.12583 18.7271 4.21799 18.908C4.40973 19.2843 4.7157 19.5903 5.09202 19.782C5.51984 20 6.07989 20 7.2 20H16.8C17.9201 20 18.4802 20 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V13M15 5.28571L16.8 7L21 3"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        Icon:
                                    </div>
                                    <div class="button-wrapper">
                                        <span class="information"><img class="profile-img"
                                                src="/../<?php echo $user["icon"]; ?>" alt="icon"></span>
                                    </div>
                                </li>
                                <!-- Password -->
                                <li class="adobe-product">
                                    <div class="products">
                                        <!--here can add icon-->
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path opacity="0.5"
                                                    d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M12.7504 10C12.7504 9.58579 12.4146 9.25 12.0004 9.25C11.5861 9.25 11.2504 9.58579 11.2504 10V10.7012L10.6429 10.3505C10.2842 10.1434 9.82553 10.2663 9.61842 10.625C9.41131 10.9837 9.53422 11.4424 9.89294 11.6495L10.4999 11.9999L9.8927 12.3505C9.53398 12.5576 9.41108 13.0163 9.61818 13.375C9.82529 13.7337 10.284 13.8566 10.6427 13.6495L11.2504 13.2987V14C11.2504 14.4142 11.5861 14.75 12.0004 14.75C12.4146 14.75 12.7504 14.4142 12.7504 14V13.2993L13.357 13.6495C13.7158 13.8566 14.1745 13.7337 14.3816 13.375C14.5887 13.0163 14.4658 12.5576 14.107 12.3505L13.4999 11.9999L14.1068 11.6495C14.4655 11.4424 14.5884 10.9837 14.3813 10.625C14.1742 10.2663 13.7155 10.1434 13.3568 10.3505L12.7504 10.7006V10Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M6.73278 9.25C7.147 9.25 7.48278 9.58579 7.48278 10V10.7006L8.08923 10.3505C8.44795 10.1434 8.90664 10.2663 9.11375 10.625C9.32085 10.9837 9.19795 11.4424 8.83923 11.6495L8.23229 11.9999L8.83946 12.3505C9.19818 12.5576 9.32109 13.0163 9.11398 13.375C8.90687 13.7337 8.44818 13.8566 8.08946 13.6495L7.48278 13.2993V14C7.48278 14.4142 7.147 14.75 6.73278 14.75C6.31857 14.75 5.98278 14.4142 5.98278 14V13.2987L5.37513 13.6495C5.01641 13.8566 4.55771 13.7337 4.35061 13.375C4.1435 13.0163 4.26641 12.5576 4.62513 12.3505L5.23229 11.9999L4.62536 11.6495C4.26664 11.4424 4.14373 10.9837 4.35084 10.625C4.55795 10.2663 5.01664 10.1434 5.37536 10.3505L5.98278 10.7012V10C5.98278 9.58579 6.31857 9.25 6.73278 9.25Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M18.0182 10C18.0182 9.58579 17.6824 9.25 17.2682 9.25C16.854 9.25 16.5182 9.58579 16.5182 10V10.7012L15.9108 10.3505C15.552 10.1434 15.0934 10.2663 14.8863 10.625C14.6791 10.9837 14.802 11.4424 15.1608 11.6495L15.7677 11.9999L15.1605 12.3505C14.8018 12.5576 14.6789 13.0163 14.886 13.375C15.0931 13.7337 15.5518 13.8566 15.9105 13.6495L16.5182 13.2987V14C16.5182 14.4142 16.854 14.75 17.2682 14.75C17.6824 14.75 18.0182 14.4142 18.0182 14V13.2993L18.6249 13.6495C18.9836 13.8566 19.4423 13.7337 19.6494 13.375C19.8565 13.0163 19.7336 12.5576 19.3749 12.3505L18.7677 11.9999L19.3746 11.6495C19.7334 11.4424 19.8563 10.9837 19.6492 10.625C19.442 10.2663 18.9834 10.1434 18.6246 10.3505L18.0182 10.7006V10Z"
                                                    fill="currentColor"></path>
                                            </g>
                                        </svg>
                                        Password:
                                    </div>
                                    <div class="button-wrapper">
                                        <i style="margin-right: 10px" class="fa fa-hand-pointer"></i>
                                        <span class="information">
                                            <div id="passwordField"
                                                style="background-color: transparent; color: var(--thame-color); cursor: pointer;">
                                                <?php echo $passsendphp_js ?>
                                            </div>
                                        </span>

                                    </div>
                                </li>

                                <!-- GREAM_ID -->
                                <li class="adobe-product">
                                    <div class="products">
                                        <!--here can add icon-->
                                        <svg viewBox="0 0 64.00 64.00" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="iconify iconify--emojione-monotone"
                                            preserveAspectRatio="xMidYMid meet" fill="currentColor">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M39 19.434h-5.384v25.133H39c2.969 0 5.386-2.322 5.386-5.174V24.609c0-2.853-2.417-5.175-5.386-5.175"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M52 2H12C6.477 2 2 6.477 2 12v40c0 5.523 4.477 10 10 10h40c5.523 0 10-4.477 10-10V12c0-5.523-4.477-10-10-10M23 49h-4V15h4v34m26-9.607a9.251 9.251 0 0 1-.787 3.738a9.592 9.592 0 0 1-2.143 3.055a10.032 10.032 0 0 1-3.178 2.059A10.302 10.302 0 0 1 39 49H29V15h10c1.348 0 2.657.254 3.893.754c1.19.484 2.26 1.176 3.178 2.059s1.638 1.912 2.143 3.053A9.294 9.294 0 0 1 49 24.609v14.784"
                                                    fill="currentColor"></path>
                                            </g>
                                        </svg>
                                        GREAM_ID:
                                    </div>
                                    <div class="button-wrapper">
                                        <span class="information"><?php echo $user["id"]; ?></span>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="events" style="display: none">
                        <div class="list_content">
                            <!-- Broadchast -->
                            <?php echo $placat[2]; ?>
                            <!-- finish broadchast -->
                        </div>
                    </div>

                    <div class="setting" style="display: none">
                        <!-- Broadchast -->
                        <?php echo $placat[1]; ?>
                        <!-- finish broadchast -->
                        <div class="content-section">
                            <div class="content-section-title">
                                Внешний-интерфеис
                            </div>
                            <ul>
                                <!-- Nickname -->
                                <li class="adobe-product">
                                    <div class="products">
                                        <!--here can add icon-->
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 48 48"
                                            fill="currentColor">
                                            <path
                                                d="M 4.5 3 C 3.67 3 3 3.67 3 4.5 L 3 38.070312 C 3 41.890313 6.14 45 10 45 C 13.86 45 17 41.890312 17 38.070312 L 17 4.5 C 17 3.67 16.33 3 15.5 3 L 4.5 3 z M 31.210938 7.5097656 C 30.820937 7.5097656 30.430391 7.6692187 30.150391 7.9492188 L 22.730469 15.369141 L 32.630859 25.269531 L 40.050781 17.849609 C 40.640781 17.259609 40.640781 16.310469 40.050781 15.730469 L 32.269531 7.9492188 C 31.989531 7.6692187 31.610938 7.5097656 31.210938 7.5097656 z M 20.609375 17.490234 L 19 19.099609 C 19 19.099609 18.989219 38.659219 18.949219 38.949219 L 20 37.900391 L 23 34.900391 L 23.080078 34.820312 L 30.509766 27.390625 L 20.609375 17.490234 z M 29.720703 31 C 29.720703 31 17.260703 43.4 16.720703 44 C 16.670703 44.05 16.620312 44.110156 16.570312 44.160156 C 16.460313 44.280156 16.340938 44.399531 16.210938 44.519531 C 16.200937 44.539531 16.180156 44.550313 16.160156 44.570312 C 16.000156 44.720313 15.839922 44.86 15.669922 45 L 32 45 L 32 31 L 29.720703 31 z M 35 31 L 35 45 L 45.5 45 C 46.33 45 47 44.33 47 43.5 L 47 32.5 C 47 31.67 46.33 31 45.5 31 L 35 31 z M 10 36 C 11.1 36 12 36.9 12 38 C 12 39.1 11.1 40 10 40 C 8.9 40 8 39.1 8 38 C 8 36.9 8.9 36 10 36 z">
                                            </path>
                                        </svg>
                                        Тёмная тема/Светлая тема:
                                    </div>
                                    <div class="button-wrapper">
                                        <div class="dark-light">
                                            <svg viewBox="0 0 30 24" stroke="currentColor" stroke-width="1.5"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                                            </svg>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe"
                                                style="transfor">
                                        </div>
                                    </div>
                                </li>
                        </div>
                        <div class="content-section">
                            <div class="content-section-title">
                                Настройки личного кабинета</div>

                            <!-- nickname window -->
                            <div class="pop-up">
                                <div class="pop-up__title">Поддтверждение об изменениях данных никнейма
                                    <svg class="close" width="24" height="24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-x-circle">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M15 9l-6 6M9 9l6 6" />
                                    </svg>
                                </div>
                                <div class="pop-up__subtitle">Мы просим вас чательно обдумать ваше решение об
                                    изменениях, подробнее вы можете ознакомиться <a
                                        href="/../privacy-policy.php">политика проекта</a></div>
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" id="check1" class="checkbox">
                                    <label id="timer_return_send" for="check1" style="width: 100%">Принимаю повторное
                                        изменение через 1 д 60 мин 0 с</label>
                                </div>
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" id="check2" class="checkbox" style="width: 100%">
                                    <label style="width: 100%" for="check2">Я подтверждаю внесённые изменения</label>
                                </div>
                                <div class="content-button-wrapper">

                                    <div class="styctyr">
                                        <span class="content-button status-button open close"
                                            style="margin-right: 5px">Отмена</span>
                                        <form action="/../php/src/actions/replace.php" method="post">
                                            <input type="hidden" name="replace_mysql__nick" id='replace_mysql__nick'>
                                            <button style="display: none" class="content-button status-button" id="send"
                                                name="replace_mysql_information">Продолжить</button>
                                        </form>
                                        <?php echo $button_nickname ?>

                                        <div id="errorMessage" class="alert-anime alert duble mt-3 d-none perm">
                                            <svg viewBox="-2 -2 350 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                stroke="#fdc700" stroke-width="0.00024000000000000003"
                                                transform="matrix(1, 0, 0, 1, 0, 0)">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.144">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path opacity="0.4"
                                                        d="M21.0802 8.58003V15.42C21.0802 16.54 20.4802 17.58 19.5102 18.15L13.5702 21.58C12.6002 22.14 11.4002 22.14 10.4202 21.58L4.48016 18.15C3.51016 17.59 2.91016 16.55 2.91016 15.42V8.58003C2.91016 7.46003 3.51016 6.41999 4.48016 5.84999L10.4202 2.42C11.3902 1.86 12.5902 1.86 13.5702 2.42L19.5102 5.84999C20.4802 6.41999 21.0802 7.45003 21.0802 8.58003Z"
                                                        fill="#ffab01"></path>
                                                    <path
                                                        d="M12 13.75C11.59 13.75 11.25 13.41 11.25 13V7.75C11.25 7.34 11.59 7 12 7C12.41 7 12.75 7.34 12.75 7.75V13C12.75 13.41 12.41 13.75 12 13.75Z"
                                                        fill="#ffab01"></path>
                                                    <path
                                                        d="M12 17.2499C11.87 17.2499 11.74 17.2198 11.62 17.1698C11.49 17.1198 11.39 17.0499 11.29 16.9599C11.2 16.8599 11.13 16.7499 11.07 16.6299C11.02 16.5099 11 16.3799 11 16.2499C11 15.9899 11.1 15.7298 11.29 15.5398C11.39 15.4498 11.49 15.3799 11.62 15.3299C11.99 15.1699 12.43 15.2598 12.71 15.5398C12.8 15.6398 12.87 15.7399 12.92 15.8699C12.97 15.9899 13 16.1199 13 16.2499C13 16.3799 12.97 16.5099 12.92 16.6299C12.87 16.7499 12.8 16.8599 12.71 16.9599C12.52 17.1499 12.27 17.2499 12 17.2499Z"
                                                        fill="#ffab01"></path>
                                                </g>
                                            </svg>
                                            <p>Пожалуйста, примите все согласия!</p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- avatar window -->
                            <div class="pop-up-avatar">
                                <div class="pop-up__title">Поддтверждение об изменениях иконки профиля
                                    <svg class="close" width="24" height="24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-x-circle">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M15 9l-6 6M9 9l6 6" />
                                    </svg>
                                </div>
                                <div class="pop-up__subtitle">Мы просим вас чательно обдумать ваше решение об
                                    изменениях, подробнее вы можете ознакомиться <a
                                        href="/../privacy-policy.php">политика
                                        проекта</a></div>
                                <div class="checkbox-wrapper">

                                    <div class="slide-container">
                                        <div class="slide-thumbnail">
                                            <img src="../images/icon/1.jpg"
                                                onclick="selectAvatar('../images/icon/1.jpg')">
                                            <img src="../images/icon/2.jpg"
                                                onclick="selectAvatar('../images/icon/2.jpg')">
                                            <img src="../images/icon/3.jpg"
                                                onclick="selectAvatar('../images/icon/3.jpg')">
                                            <img src="../images/icon/4.jpg"
                                                onclick="selectAvatar('../images/icon/4.jpg')">
                                            <img src="../images/icon/5.jpg"
                                                onclick="selectAvatar('../images/icon/5.jpg')">
                                            <img src="../images/icon/6.jpg"
                                                onclick="selectAvatar('../images/icon/6.jpg')">
                                            <img src="../images/icon/7.jpg"
                                                onclick="selectAvatar('../images/icon/7.jpg')">
                                            <img src="../images/icon/8.jpg"
                                                onclick="selectAvatar('../images/icon/8.jpg')">
                                            <img src="../images/icon/happy.jpg"
                                                onclick="selectAvatar('../images/icon/happy.jpg')">
                                        </div>
                                        <div class="slide-thumbnails">
                                            <img src="../images/icon/1.jpg"
                                                onclick="selectAvatar('../images/icon/1.jpg')">
                                            <img src="../images/icon/2.jpg"
                                                onclick="selectAvatar('../images/icon/2.jpg')">
                                            <img src="../images/icon/3.jpg"
                                                onclick="selectAvatar('../images/icon/3.jpg')">
                                            <img src="../images/icon/4.jpg"
                                                onclick="selectAvatar('../images/icon/4.jpg')">
                                            <img src="../images/icon/5.jpg"
                                                onclick="selectAvatar('../images/icon/5.jpg')">
                                            <img src="../images/icon/6.jpg"
                                                onclick="selectAvatar('../images/icon/6.jpg')">
                                            <img src="../images/icon/7.jpg"
                                                onclick="selectAvatar('../images/icon/7.jpg')">
                                            <img src="../images/icon/8.jpg"
                                                onclick="selectAvatar('../images/icon/8.jpg')">
                                            <img src="../images/icon/happy.jpg"
                                                onclick="selectAvatar('../images/icon/happy.jpg')">
                                        </div>
                                        <div class="slide-controls">
                                            <button class="prev but" id="prev-btn"
                                                onclick="plusSlides(-1);event.preventDefault();">
                                                < </button>
                                                    <button class="next but" id="next-btn"
                                                        onclick="plusSlides(1);event.preventDefault();">></button>
                                        </div>
                                    </div>

                                    <div class="checkbox_click">
                                        <div class="checkbox-wrapper-avatar">
                                            <input type="checkbox" id="check5" class="checkbox_avatar">

                                            <label style="width: 100%" id="timer_return_send_avatar"
                                                for="check5">Принимаю
                                                повторное изменение через 1 д 60 мин 0 с</label>
                                        </div>
                                        <div class="checkbox-wrapper-avatar">

                                            <input type="checkbox" id="check6" class="checkbox_avatar">
                                            <label style="width: 100%" for="check6">Я подтверждаю внесённые
                                                изменения</label>
                                        </div>
                                    </div>

                                    <div class="content-button-wrapper"
                                        style="margin-left: -15rem;text-align: center;margin-top: 1.5rem">

                                        <div
                                            style="display: grid;grid-auto-rows:auto auto;grid-auto-columns: auto auto;row-gap: 10px;column-gap: 10px">

                                            <span class="content-button status-button-avatar open close av"
                                                style="margin-right: 5px">Отмена</span>

                                            <form action="/../php/src/actions/replace.php" method="post">

                                                <input type="hidden" name="replace_mysql__avatar"
                                                    id='replace_mysql__avatar'>


                                                <button style="display: none"
                                                    class="content-button status-button-avatar" id="send_avatar"
                                                    name="replace_mysql_information_icon">Продолжить</button>
                                            </form>

                                            <?php echo $button_avatar ?>

                                            <div id="errorMessage_avatar"
                                                class="alert-anime d-none perm alert duble mt-3">
                                                <svg viewBox="-2 -2 325 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" stroke="#fdc700"
                                                    stroke-width="0.00024000000000000003"
                                                    transform="matrix(1, 0, 0, 1, 0, 0)">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.144">
                                                    </g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path opacity="0.4"
                                                            d="M21.0802 8.58003V15.42C21.0802 16.54 20.4802 17.58 19.5102 18.15L13.5702 21.58C12.6002 22.14 11.4002 22.14 10.4202 21.58L4.48016 18.15C3.51016 17.59 2.91016 16.55 2.91016 15.42V8.58003C2.91016 7.46003 3.51016 6.41999 4.48016 5.84999L10.4202 2.42C11.3902 1.86 12.5902 1.86 13.5702 2.42L19.5102 5.84999C20.4802 6.41999 21.0802 7.45003 21.0802 8.58003Z"
                                                            fill="#ffab01"></path>
                                                        <path
                                                            d="M12 13.75C11.59 13.75 11.25 13.41 11.25 13V7.75C11.25 7.34 11.59 7 12 7C12.41 7 12.75 7.34 12.75 7.75V13C12.75 13.41 12.41 13.75 12 13.75Z"
                                                            fill="#ffab01"></path>
                                                        <path
                                                            d="M12 17.2499C11.87 17.2499 11.74 17.2198 11.62 17.1698C11.49 17.1198 11.39 17.0499 11.29 16.9599C11.2 16.8599 11.13 16.7499 11.07 16.6299C11.02 16.5099 11 16.3799 11 16.2499C11 15.9899 11.1 15.7298 11.29 15.5398C11.39 15.4498 11.49 15.3799 11.62 15.3299C11.99 15.1699 12.43 15.2598 12.71 15.5398C12.8 15.6398 12.87 15.7399 12.92 15.8699C12.97 15.9899 13 16.1199 13 16.2499C13 16.3799 12.97 16.5099 12.92 16.6299C12.87 16.7499 12.8 16.8599 12.71 16.9599C12.52 17.1499 12.27 17.2499 12 17.2499Z"
                                                            fill="#ffab01"></path>
                                                    </g>
                                                </svg>
                                                <p>Пожалуйста, примите все согласия!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- email window -->
                            <div class="pop-up-email">
                                <div class="pop-up__title">Поддтверждение об изменениях данных почты
                                    <svg class="close" width="24" height="24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-x-circle">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M15 9l-6 6M9 9l6 6" />
                                    </svg>
                                </div>
                                <div class="pop-up__subtitle">Мы просим вас чательно обдумать ваше решение об
                                    изменениях, подробнее вы можете ознакомиться <a
                                        href="/../privacy-policy.php">политика
                                        проекта</a></div>
                                <div class="checkbox-wrapper">

                                    <input type="checkbox" id="check3" class="checkbox_email">
                                    <label style="width: 100%" id="timer_return_send_email" for="check3">Принимаю
                                        повторное изменение через 1 д 60 мин 0 с</label>
                                </div>
                                <div class="checkbox-wrapper">
                                    <input style="width: 100%" type="checkbox" id="check4" class="checkbox_email">
                                    <label style="width:100%" for="check4">Я подтверждаю внесённые изменения</label>
                                </div>

                                <div class="content-button-wrapper">

                                    <div class="styctyr">
                                        <span class="content-button status-button-email open close"
                                            style="margin-right: 5px">Отмена</span>

                                        <form action="/../php/src/actions/replace.php" method="post">

                                            <input type="hidden" name="replace_mysql__email" id='replace_mysql__email'>


                                            <button style="display: none" class="content-button status-button-email"
                                                id="send_email"
                                                name="replace_mysql_information_email">Продолжить</button>
                                        </form>
                                        <?php echo $button_email ?>

                                        <div id="errorMessage_email" class="alert-anime alert duble mt-3 d-none perm">
                                            <svg viewBox="-2 -2 350 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                stroke="#fdc700" stroke-width="0.00024000000000000003"
                                                transform="matrix(1, 0, 0, 1, 0, 0)">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.144">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path opacity="0.4"
                                                        d="M21.0802 8.58003V15.42C21.0802 16.54 20.4802 17.58 19.5102 18.15L13.5702 21.58C12.6002 22.14 11.4002 22.14 10.4202 21.58L4.48016 18.15C3.51016 17.59 2.91016 16.55 2.91016 15.42V8.58003C2.91016 7.46003 3.51016 6.41999 4.48016 5.84999L10.4202 2.42C11.3902 1.86 12.5902 1.86 13.5702 2.42L19.5102 5.84999C20.4802 6.41999 21.0802 7.45003 21.0802 8.58003Z"
                                                        fill="#ffab01"></path>
                                                    <path
                                                        d="M12 13.75C11.59 13.75 11.25 13.41 11.25 13V7.75C11.25 7.34 11.59 7 12 7C12.41 7 12.75 7.34 12.75 7.75V13C12.75 13.41 12.41 13.75 12 13.75Z"
                                                        fill="#ffab01"></path>
                                                    <path
                                                        d="M12 17.2499C11.87 17.2499 11.74 17.2198 11.62 17.1698C11.49 17.1198 11.39 17.0499 11.29 16.9599C11.2 16.8599 11.13 16.7499 11.07 16.6299C11.02 16.5099 11 16.3799 11 16.2499C11 15.9899 11.1 15.7298 11.29 15.5398C11.39 15.4498 11.49 15.3799 11.62 15.3299C11.99 15.1699 12.43 15.2598 12.71 15.5398C12.8 15.6398 12.87 15.7399 12.92 15.8699C12.97 15.9899 13 16.1199 13 16.2499C13 16.3799 12.97 16.5099 12.92 16.6299C12.87 16.7499 12.8 16.8599 12.71 16.9599C12.52 17.1499 12.27 17.2499 12 17.2499Z"
                                                        fill="#ffab01"></path>
                                                </g>
                                            </svg>
                                            <p>Пожалуйста, примите все согласия!</p>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- password window -->
                            <div class="pop-up-password">
                                <div class="pop-up__title">Поддтверждение об изменениях данных пароля
                                    <svg class="close" width="24" height="24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-x-circle">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M15 9l-6 6M9 9l6 6" />
                                    </svg>
                                </div>
                                <div class="pop-up__subtitle">Мы просим вас чательно обдумать ваше решение об
                                    изменениях, подробнее вы можете ознакомиться <a
                                        href="/../privacy-policy.php">политика
                                        проекта</a></div>
                                <div class="checkbox-wrapper">

                                    <input type="checkbox" id="check7" class="checkbox_password">
                                    <label style="width: 100%" id="timer_return_send_password" for="check7">Принимаю
                                        повторное изменение через 1 д 60 мин 0 с</label>
                                </div>
                                <div class="checkbox-wrapper">
                                    <input style="width: 100%" type="checkbox" id="check8" class="checkbox_password">
                                    <label style="width:100%" for="check8">Я подтверждаю внесённые изменения</label>
                                </div>

                                <div class="content-button-wrapper">

                                    <div class="styctyr">
                                        <span class="content-button status-button-password open close"
                                            style="margin-right: 5px">Отмена</span>

                                        <form action="/../php/src/actions/replace.php" method="post">

                                            <input type="hidden" name="replace_mysql__password"
                                                id='replace_mysql__password'>

                                            <button style="display: none" class="content-button status-button-password"
                                                id="send_password"
                                                name="replace_mysql_information_password">Продолжить</button>

                                        </form>
                                        <?php echo $button_email ?>

                                        <div id="errorMessage_password"
                                            class="alert-anime alert duble mt-3 d-none perm">
                                            <svg viewBox="-2 -2 350 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                stroke="#fdc700" stroke-width="0.00024000000000000003"
                                                transform="matrix(1, 0, 0, 1, 0, 0)">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.144">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path opacity="0.4"
                                                        d="M21.0802 8.58003V15.42C21.0802 16.54 20.4802 17.58 19.5102 18.15L13.5702 21.58C12.6002 22.14 11.4002 22.14 10.4202 21.58L4.48016 18.15C3.51016 17.59 2.91016 16.55 2.91016 15.42V8.58003C2.91016 7.46003 3.51016 6.41999 4.48016 5.84999L10.4202 2.42C11.3902 1.86 12.5902 1.86 13.5702 2.42L19.5102 5.84999C20.4802 6.41999 21.0802 7.45003 21.0802 8.58003Z"
                                                        fill="#ffab01"></path>
                                                    <path
                                                        d="M12 13.75C11.59 13.75 11.25 13.41 11.25 13V7.75C11.25 7.34 11.59 7 12 7C12.41 7 12.75 7.34 12.75 7.75V13C12.75 13.41 12.41 13.75 12 13.75Z"
                                                        fill="#ffab01"></path>
                                                    <path
                                                        d="M12 17.2499C11.87 17.2499 11.74 17.2198 11.62 17.1698C11.49 17.1198 11.39 17.0499 11.29 16.9599C11.2 16.8599 11.13 16.7499 11.07 16.6299C11.02 16.5099 11 16.3799 11 16.2499C11 15.9899 11.1 15.7298 11.29 15.5398C11.39 15.4498 11.49 15.3799 11.62 15.3299C11.99 15.1699 12.43 15.2598 12.71 15.5398C12.8 15.6398 12.87 15.7399 12.92 15.8699C12.97 15.9899 13 16.1199 13 16.2499C13 16.3799 12.97 16.5099 12.92 16.6299C12.87 16.7499 12.8 16.8599 12.71 16.9599C12.52 17.1499 12.27 17.2499 12 17.2499Z"
                                                        fill="#ffab01"></path>
                                                </g>
                                            </svg>
                                            <p>Пожалуйста, примите все согласия!</p>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="apps-card">
                                <div class="app-card">
                                    <span>
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1891.8 2411.5"
                                            xml:space="preserve" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <style type="text/css">
                                                    .st0 {
                                                        fill: #4688F1;
                                                    }

                                                    .st1 {
                                                        fill: #FFFFFF;
                                                    }

                                                    .st2 {
                                                        fill: #3566B8;
                                                    }
                                                </style>
                                                <g>
                                                    <path class="st0"
                                                        d="M1891.6,893.8V273L946,0L0.2,273v620.7c0,0-35.8,1092,945.9,1517.7C1927.4,1985.7,1891.6,893.8,1891.6,893.8 L1891.6,893.8z">
                                                    </path>
                                                    <circle class="st1" cx="939.4" cy="1001.2" r="568.3"></circle>
                                                    <path class="st2"
                                                        d="M506.9,1369.8c-84.6-99.2-135.7-227.9-135.7-368.6c0-313.8,254.4-568.3,568.3-568.3s568.3,254.4,568.3,568.3 c0,140.6-51.1,269.3-135.6,368.5c-13.5-137.8-291.3-213.5-432.5-213.5C798.4,1156.2,519.7,1231.9,506.9,1369.8L506.9,1369.8z M939.4,1019c119.6,0,216.6-97,216.6-216.6s-97-216.6-216.6-216.6s-216.6,97-216.6,216.6S819.8,1019,939.4,1019z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg> Школа:
                                    </span>
                                    <div class="app-card__subtext">
                                        <div class='sertting_bar'>
                                            <div class="icput"><?php echo $sender_edit_full ?></div>
                                            <input style="text-transform: uppercase;" type='text'
                                                value="<?php echo $user['nickname']; ?>" id="input-nickname"
                                                onkeyup="TrakerN()">
                                        </div>
                                    </div>
                                    <div class="app-card-buttons">
                                        <span id="traker_nickname"
                                            class="content-button status-button">Save/Сохранить</span>

                                        <span
                                            style="display: none;padding: 3.8% 15%;font-size: 15px;margin-right: 48px;opacity: 0.45;margin-top: 0px;"
                                            id="traker_nickname_error" class="sta">Save/Сохранить</span>
                                    </div>
                                </div>
                                <div class="app-card">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" aria-label="Mail" role="img"
                                            viewBox="0 0 512 512" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <rect width="512" height="512" rx="15%" fill="#328cff"></rect>
                                                <path
                                                    d="m250 186c-46 0-69 35-69 74 0 44 29 72 68 72 43 0 73-32 73-75 0-44-34-71-72-71zm-1-37c30 0 57 13 77 33 0-22 35-22 35 1v150c-1 10 10 16 16 9 25-25 54-128-14-187-64-56-149-47-195-15-48 33-79 107-49 175 33 76 126 99 182 76 28-12 41 26 12 39-45 19-168 17-225-82-38-68-36-185 67-248 78-46 182-33 244 32 66 69 62 197-2 246-28 23-71 1-71-32v-11c-20 20-47 32-77 32-57 0-108-51-108-108 0-58 51-110 108-110"
                                                    fill="#ffffff"></path>
                                            </g>
                                        </svg> Email
                                    </span>
                                    <div class="app-card__subtext">
                                        <div class='sertting_bar'>
                                            <div class="icput"><?php echo $sender_edit_full ?></div>
                                            <input type='text' value="<?php echo $user['email']; ?>" id="input-email"
                                                onkeyup="TrakerE()">
                                        </div>
                                    </div>
                                    <div class="app-card-buttons">
                                        <span id="input_Email"
                                            class="content-button status-button-email">Save/Сохранить</span>

                                        <span
                                            style="display: none;padding: 3.8% 15%;font-size: 15px;margin-right: 48px;opacity: 0.45;margin-top: 0px;"
                                            id="input_Email_Error" class="sta">Save/Сохранить</span>
                                    </div>
                                </div>
                                <div class="app-card">
                                    <span>
                                        <svg viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <rect fill="#ffffff" height="60" rx="10" width="60"></rect>
                                                <path
                                                    d="M24,22V15.515l-1.071-1.071a6,6,0,0,0-8.485,0h0a6,6,0,0,0,0,8.485L20.1,28.586a6,6,0,0,0,8.485,0h0a6.142,6.142,0,0,0,.537-.657A6,6,0,0,1,24,22Z"
                                                    fill="#ffe1a0"></path>
                                                <path
                                                    d="M24.343,31.839a7.475,7.475,0,0,1-5.3-2.193l-5.657-5.657A7.5,7.5,0,0,1,23.989,13.383l1.072,1.071a1.5,1.5,0,0,1,.439,1.061V22a4.519,4.519,0,0,0,3.841,4.445,1.5,1.5,0,0,1,.981,2.386,7.285,7.285,0,0,1-.675.815A7.479,7.479,0,0,1,24.343,31.839ZM18.687,14.188a4.5,4.5,0,0,0-3.183,7.68l5.657,5.657a4.512,4.512,0,0,0,5.029.922A7.54,7.54,0,0,1,22.5,22V16.136l-.632-.632A4.485,4.485,0,0,0,18.687,14.188Z"
                                                    fill="#f29580"></path>
                                                <path
                                                    d="M45.556,37.071,39.9,31.414a6,6,0,0,0-8.485,0h0a6.142,6.142,0,0,0-.537.657A6,6,0,0,1,36,38v6.485l1.071,1.071a6,6,0,0,0,8.485-8.485Z"
                                                    fill="#c1f7fd"></path>
                                                <path
                                                    d="M41.313,48.813a7.451,7.451,0,0,1-5.3-2.2l-1.072-1.071a1.5,1.5,0,0,1-.439-1.061V38a4.519,4.519,0,0,0-3.841-4.445,1.5,1.5,0,0,1-.981-2.386,7.285,7.285,0,0,1,.675-.815,7.509,7.509,0,0,1,10.607,0l5.657,5.657a7.5,7.5,0,0,1-5.3,12.8ZM37.5,43.864l.632.631A4.5,4.5,0,1,0,44.5,38.132l-5.657-5.657a4.507,4.507,0,0,0-5.029-.922A7.54,7.54,0,0,1,37.5,38Z"
                                                    fill="#7bcdd1"></path>
                                                <path
                                                    d="M28.586,31.414h0a6.142,6.142,0,0,0-.657-.537A6,6,0,0,1,22,36H15.515l-1.071,1.071a6,6,0,0,0,8.485,8.485L28.586,39.9A6,6,0,0,0,28.586,31.414Z"
                                                    fill="#f2bdd6"></path>
                                                <path
                                                    d="M18.687,48.813a7.5,7.5,0,0,1-5.3-12.8l1.071-1.072a1.5,1.5,0,0,1,1.061-.439H22a4.517,4.517,0,0,0,4.444-3.841,1.5,1.5,0,0,1,2.386-.98,7.193,7.193,0,0,1,.815.672v0a7.508,7.508,0,0,1,0,10.606l-5.657,5.657A7.451,7.451,0,0,1,18.687,48.813ZM16.136,37.5l-.632.632A4.5,4.5,0,0,0,21.868,44.5l5.657-5.657a4.509,4.509,0,0,0,.922-5.029A7.54,7.54,0,0,1,22,37.5Z"
                                                    fill="#bf95bc"></path>
                                                <path
                                                    d="M38,24h6.485l1.071-1.071a6,6,0,0,0,0-8.485h0a6,6,0,0,0-8.485,0L31.414,20.1a6,6,0,0,0,0,8.486h0a6.013,6.013,0,0,0,.657.536A6,6,0,0,1,38,24Z"
                                                    fill="#f1f3f4"></path>
                                                <path
                                                    d="M32.071,30.623a1.5,1.5,0,0,1-.9-.3,7.193,7.193,0,0,1-.815-.672,7.511,7.511,0,0,1,0-10.609l5.657-5.657A7.5,7.5,0,1,1,46.617,23.989l-1.071,1.072a1.5,1.5,0,0,1-1.061.439H38a4.517,4.517,0,0,0-4.444,3.841,1.5,1.5,0,0,1-1.485,1.282Zm9.242-16.435A4.485,4.485,0,0,0,38.132,15.5l-5.657,5.657a4.509,4.509,0,0,0-.922,5.029A7.54,7.54,0,0,1,38,22.5h5.864l.632-.632a4.5,4.5,0,0,0-3.183-7.68Z"
                                                    fill="#f2bf80"></path>
                                                <path
                                                    d="M31.414,20.1,36,15.515V14a6,6,0,0,0-12,0v8a5.959,5.959,0,0,0,6.877,5.929A5.985,5.985,0,0,1,31.414,20.1Z"
                                                    fill="#eff28d"></path>
                                                <path
                                                    d="M30,29.5A7.508,7.508,0,0,1,22.5,22V14a7.5,7.5,0,0,1,15,0v1.515a1.5,1.5,0,0,1-.439,1.06l-4.586,4.586a4.508,4.508,0,0,0-.4,5.867,1.5,1.5,0,0,1-.982,2.385A7.485,7.485,0,0,1,30,29.5Zm0-20A4.505,4.505,0,0,0,25.5,14v8a4.507,4.507,0,0,0,2.921,4.214,7.506,7.506,0,0,1,1.933-7.174L34.5,14.894V14A4.505,4.505,0,0,0,30,9.5Z"
                                                    fill="#f2bf80"></path>
                                                <path
                                                    d="M30,32a6.033,6.033,0,0,0-.877.071,5.983,5.983,0,0,1-.537,7.828L24,44.485V46a6,6,0,0,0,12,0V38A6,6,0,0,0,30,32Z"
                                                    fill="#bec6f4"></path>
                                                <path
                                                    d="M30,53.5A7.508,7.508,0,0,1,22.5,46V44.485a1.5,1.5,0,0,1,.439-1.06l4.586-4.586a4.508,4.508,0,0,0,.4-5.867,1.5,1.5,0,0,1,.982-2.385A7.458,7.458,0,0,1,37.5,38v8A7.508,7.508,0,0,1,30,53.5Zm-4.5-8.394V46a4.5,4.5,0,0,0,9,0V38a4.507,4.507,0,0,0-2.921-4.214,7.506,7.506,0,0,1-1.933,7.174Z"
                                                    fill="#8d9cf4"></path>
                                                <path
                                                    d="M20.1,28.586,15.515,24H14a6,6,0,0,0,0,12h8a5.96,5.96,0,0,0,5.929-6.878A5.982,5.982,0,0,1,20.1,28.586Z"
                                                    fill="#ffafc5"></path>
                                                <path
                                                    d="M22,37.5H14a7.5,7.5,0,0,1,0-15h1.515a1.5,1.5,0,0,1,1.06.439l4.586,4.586a4.508,4.508,0,0,0,5.867.4,1.5,1.5,0,0,1,2.385.982A7.372,7.372,0,0,1,29.5,30,7.508,7.508,0,0,1,22,37.5Zm-8-12a4.5,4.5,0,0,0,0,9h8a4.507,4.507,0,0,0,4.214-2.921,7.506,7.506,0,0,1-7.174-1.933L14.894,25.5Z"
                                                    fill="#f28080"></path>
                                                <path
                                                    d="M46,24H38a5.959,5.959,0,0,0-5.929,6.877,5.983,5.983,0,0,1,7.828.537L44.485,36H46a6,6,0,0,0,0-12Z"
                                                    fill="#c1f7fd"></path>
                                                <path
                                                    d="M46,37.5H44.485a1.5,1.5,0,0,1-1.06-.439l-4.586-4.586a4.5,4.5,0,0,0-5.866-.4,1.5,1.5,0,0,1-2.386-.982A7.372,7.372,0,0,1,30.5,30,7.508,7.508,0,0,1,38,22.5h8a7.5,7.5,0,0,1,0,15Zm-.894-3H46a4.5,4.5,0,0,0,0-9H38a4.507,4.507,0,0,0-4.214,2.921,7.511,7.511,0,0,1,7.174,1.933Z"
                                                    fill="#bbd9c8"></path>
                                                <path
                                                    d="M24,23.5A1.5,1.5,0,0,1,22.5,22V14A7.508,7.508,0,0,1,30,6.5a1.5,1.5,0,0,1,0,3A4.505,4.505,0,0,0,25.5,14v8A1.5,1.5,0,0,1,24,23.5Z"
                                                    fill="#f2c4bb"></path>
                                            </g>
                                        </svg>
                                        Icon
                                    </span>
                                    <div class="app-card__subtext">
                                        <div class='sertting_bar'>
                                            <div class="icput"><?php echo $sender_edit ?></div>

                                            <input type='text' value="<?php echo $user['icon']; ?>" id="input-avatar"
                                                readonly disabled>

                                        </div>
                                    </div>
                                    <div class="app-card-buttons">
                                        <span class="content-button status-button-avatar">Выбрать</span>

                                    </div>


                                </div>
                                <div class="app-card">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" aria-label="imgur" role="img"
                                            viewBox="0 0 512 512" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <rect width="512" height="512" rx="15%" fill="#175DDC"></rect>
                                                <path fill="#ffffff"
                                                    d="M372 297V131H256v294c47-28 115-74 116-128zm49-198v198c0 106-152 181-165 181S91 403 91 297V99s0-17 17-17h296s17 0 17 17z">
                                                </path>
                                            </g>
                                        </svg> Password
                                    </span>
                                    <div class="app-card__subtext">
                                        <div class='sertting_bar'>
                                            <div class="icput"><?php echo $sender_edit_full ?></div>
                                            <input type="text" value="<?php echo $psd ?>" id="input-password"
                                                onkeyup="TrakerP()">

                                        </div>
                                    </div>
                                    <div class="app-card-buttons">

                                        <span id="traker_password"
                                            class="content-button status-button-password">Save/Сохранить</span>

                                        <span
                                            style="display: none;padding: 3.8% 15%;font-size: 15px;margin-right: 48px;opacity: 0.45;margin-top: 0px;"
                                            id="traker_password_error" class="sta">Save/Сохранить</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admin_panel" style="display: none">

                        <div class="content-section scroll-users">
                            <div class="content-section-title" style="color: white">
                                Записи на мероприятия:</div>
                            <?php
                            $sql = "SELECT users.id AS user_id, users.nickname, events.title, events.date, events.time, events.description
        FROM registrations
        JOIN events ON registrations.event_id = events.event_id
        JOIN users ON registrations.user_id = users.id
        ORDER BY users.id, events.date";

                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $current_user_id = null; // Переменная для отслеживания текущего пользователя
                                while ($row = $result->fetch_assoc()) {
                                    // Если user_id изменился, выводим название пользователя
                                    if ($current_user_id !== $row['user_id']) {
                                        if ($current_user_id !== null) {
                                            echo "</ul></div><hr style='width:100%;opacity:0.4;margin: 1rem 0'>"; // Закрытие предыдущего блока пользователя
                                        }
                                        $current_user_id = $row['user_id'];
                                        echo "<div><p class='content-section-title' style='margin: .5rem 0;display: flex;align-items: center;justify-content: flex-start;gap: 1rem'><svg fill='currentColor' width='25px' height='25px' viewBox='0 0 512.00 512.00' xmlns='http://www.w3.org/2000/svg'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'><title>ionicons-v5-q</title><path d='M256,368a16,16,0,0,1-7.94-2.11L108,285.84a8,8,0,0,0-12,6.94V368a16,16,0,0,0,8.23,14l144,80a16,16,0,0,0,15.54,0l144-80A16,16,0,0,0,416,368V292.78a8,8,0,0,0-12-6.94L263.94,365.89A16,16,0,0,1,256,368Z'></path><path d='M495.92,190.5s0-.08,0-.11a16,16,0,0,0-8-12.28l-224-128a16,16,0,0,0-15.88,0l-224,128a16,16,0,0,0,0,27.78l224,128a16,16,0,0,0,15.88,0L461,221.28a2,2,0,0,1,3,1.74V367.55c0,8.61,6.62,16,15.23,16.43A16,16,0,0,0,496,368V192A14.76,14.76,0,0,0,495.92,190.5Z'></path></g></svg> " . htmlspecialchars($row['nickname']) . "</p><ul>"; // Имя пользователя строка 1
                                    }
                                    // Выводим информацию о мероприятии строка 2
                                    echo "<li class='adobe-product'>
                                    <div class='products'>
                                        <!--here can add icon-->
                                             <svg viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <path fill-rule='evenodd' clip-rule='evenodd' d='M1.5 12C1.5 6.20101 6.20101 1.5 12 1.5C17.799 1.5 22.5 6.20101 22.5 12C22.5 17.799 17.799 22.5 12 22.5C6.20101 22.5 1.5 17.799 1.5 12ZM15.7127 10.7197C16.0055 10.4268 16.0055 9.95192 15.7127 9.65903C15.4198 9.36614 14.9449 9.36614 14.652 9.65903L10.9397 13.3713L9.34869 11.7804C9.0558 11.4875 8.58092 11.4875 8.28803 11.7804C7.99514 12.0732 7.99514 12.5481 8.28803 12.841L10.4093 14.9623C10.7022 15.2552 11.1771 15.2552 11.47 14.9623L15.7127 10.7197Z' fill='#00de79'></path> </g></svg>
                                        " . htmlspecialchars($row['title']) . "
                                    </div>
                                    <div class='button-wrapper event_date_content_center'>
                                        <span class='open'>" . formatDate(htmlspecialchars($row['date'])) . ", Время: " . formatTime(htmlspecialchars($row['time'])) . "</span>
                                    </div>
                                </li>";
                                }
                                echo "</div>"; // Закрытие последнего блока
                            } else {
                                echo "Нет зарегистрированных на мероприятия.";
                            }
                            ?>
                        </div>

                        <div class="content-section new_change scroll-users">
                            <div class="content-section-title" style="color: white">
                                Список мероприятий:</div>
                            <?php
                            $sql = "SELECT * FROM events";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<ul>
                                    <li class='event_content'>
                                    <div class='responsive-table'>
                                    <div class='products'>
                                        <!--here can add icon-->
<svg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'
    viewBox='0 0 512 512' xml:space='preserve' fill='#000000'>
    <g id='SVGRepo_bgCarrier' stroke-width='0'></g>
    <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g>
    <g id='SVGRepo_iconCarrier'>
        <path style='fill:#EAEAEA;'
            d='M417.392,173.744h-7.584c-7.536-31.728-36.128-55.504-70.336-55.504c-8.304,0-16.72,1.824-23.68,4.16 c-16.72-47.488-62.032-81.584-115.44-81.584c-67.616,0-122.448,54.544-122.448,121.84c0,4.24,0.224,8.432,0.64,12.544 C34.112,182.848,0,221.552,0,267.872c0,51.776,42.576,94.144,94.608,94.144h322.784c52.032,0,94.608-42.368,94.608-94.144 C512,216.112,469.424,173.744,417.392,173.744z'>
        </path>
        <path style='fill:#32BEA6;'
            d='M355.552,471.184H234.944L116.544,351.2l118.4-119.984h120.608L236.96,351.2L355.552,471.184z'></path>
    </g>
</svg>                                        " . htmlspecialchars($row['title']) . "
                                    </div>
                                    <div class='button-wrapper event_date_content'>
                                        <span class='open'>" . formatDate(htmlspecialchars($row['date'])) . ", Время: " . formatTime(htmlspecialchars($row['time'])) . ", ID: " . htmlspecialchars($row['event_id']) . "</span>
                                    </div>
                                    </div>
                                    <div class='button-wrapper' style='width: 100%'>
                                        <span class='event_description'>" . htmlspecialchars($row['description'] ?? "null") . "</span>
                                    </div>
                                    <div class='button-wrapper' style='width: 100%'>
                                        <span class='event_description'>" . htmlspecialchars($row['author'] ?? "null") . "</span>
                                    </div>
                                </li>
                                </ul>";
                                }
                            } else {
                                echo "Нет зарегистрированных мероприятий.";
                            }
                            $conn->close();
                            $stmt->close();
                            ?>
                        </div>

                        <!-- создать мероприятие -->
                        <div class="content-section ">
                            <div class="content-section-title" style="color: white">
                                Добавить мероприятие:</div>
                            <form action=" /../php/src/actions/replace.php" method="POST">
                                <div class="admin_log">
                                    <div class="app-card">
                                        <span>
                                            <svg style="border-radius: 0;" version="1.1" id="Layer_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                xml:space="preserve" fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path style="fill:#999999;"
                                                        d="M256.04,0h-14.928h-0.264h-1.768h-0.272l0,0h-0.28l0,0h-0.28l0,0h-0.176h-0.128h-0.176h-0.128h-0.176 h-0.112h-0.192l0,0h-0.296l0,0h-0.288l0,0h-0.288l0,0h-0.296l0,0h-0.296l0,0l-0.8,0.064l0,0h-0.304l0,0h-0.296l0,0h-0.304l0,0 c-5.936,0.536-11.8,1.24-17.6,2.128L218.864,18c12.32-1.616,24.752-2.288,37.176-2L256.04,0L256.04,0z M177.32,12.328 c-12.696,4.088-25.048,9.176-36.944,15.2l7.2,14.272c11.152-5.656,22.728-10.424,34.624-14.272l-4.912-15.2H177.32z M106.264,48.328 c-10.816,7.824-21,16.48-30.472,25.888l11.264,11.36c8.888-8.808,18.44-16.912,28.576-24.24l-9.368-12.968 C106.264,48.368,106.264,48.328,106.264,48.328z M49.68,104.472c-2.136,2.928-4.224,5.904-6.28,8.92l0,0l-0.256,0.384l0,0 l-0.168,0.256l0,0l-0.088,0.128l0,0l-0.168,0.248l0,0l-0.08,0.12l0,0l-0.08,0.12l0,0l-0.08,0.12l0,0l-0.16,0.24l0,0l-0.08,0.12l0,0 l-0.08,0.12l0,0l-0.08,0.12l0,0l-0.08,0.12l0,0l-0.072,0.112l0,0l-0.072,0.112l0,0l-0.072,0.112l0,0l-0.08,0.12l0,0l-0.072,0.112 l0,0l-0.072,0.104l0,0l-0.072,0.112l0,0l-0.072,0.112l0,0l-0.072,0.104l0,0l-0.072,0.112l0,0l-0.064,0.104l0,0l-0.072,0.112l0,0 l-0.072,0.112l0,0L41,117.024l0,0l-0.072,0.112l0,0l-0.072,0.112l0,0l-0.072,0.104l0,0l-0.072,0.112l0,0l-0.064,0.104l0,0 l-0.072,0.112l0,0l-0.072,0.112l0,0l-0.056,0.096l0,0l-0.064,0.104l0,0l-0.056,0.088l0,0l-0.056,0.096v0.04l-0.064,0.104l0,0 l-0.056,0.088l0,0l-0.064,0.104l0,0l-0.064,0.096l0,0l-0.056,0.088l0,0l-0.064,0.104l0,0l-0.056,0.08l0,0l-0.064,0.096v0.04 l-0.064,0.104l0,0l-0.048,0.08l0,0l-0.064,0.104l0,0l-0.056,0.088v0.048l-0.048,0.08l0,0l-0.064,0.104v0.04l-0.048,0.072v0.048 l-0.056,0.088v0.048l-0.896,1.2v0.04l-0.048,0.072v0.04l-0.064,0.104v0.048l-0.048,0.072v0.064l-0.048,0.08v0.048l-0.064,0.096v0.04 l-0.048,0.08l0,0l-0.064,0.104v0.048L38,122.144v0.048l-0.048,0.08v0.04l-0.064,0.096v0.04l-0.048,0.08v0.048l-0.056,0.088v0.048 l-0.064,0.096v0.048l-0.048,0.072v0.04l-0.064,0.096v0.048l-0.056,0.096l0,0l-0.056,0.088v0.04l-0.064,0.104v0.04l-0.048,0.08v0.056 l-0.056,0.088v0.048l-0.064,0.104v0.04l-0.04,0.072v0.048l-0.056,0.096v0.048l-0.048,0.08v0.056l-0.048,0.08v0.048l-0.064,0.104 v0.04l-0.048,0.072v0.048l-0.056,0.096v0.048l-0.048,0.08v0.064l-0.04,0.072v0.048l-0.056,0.096v0.056v0.064v0.064l-0.048,0.08 v0.048l-0.056,0.104v0.04l-0.048,0.072v0.04l-0.064,0.104v0.04l-0.056,0.088v0.056l-0.048,0.08v0.048l-0.056,0.096v0.048 l-0.04,0.072v0.056l-0.056,0.088v0.048l-0.056,0.104v0.048l-0.04,0.072v0.048l-0.056,0.096V127l-0.048,0.08v0.056l-0.048,0.08v0.048 l-0.056,0.096v0.048l-0.04,0.072v0.048l-0.056,0.096v0.048l-0.056,0.088v0.048l-0.048,0.08v0.04l-0.056,0.104v0.04l-0.048,0.088 v0.048l-0.056,0.088v0.048l-0.056,0.104v0.04l-0.048,0.08l0,0l-0.056,0.104v0.04l-0.056,0.096l0,0l-0.048,0.088v0.048l-0.056,0.104 v0.04l-0.048,0.088v0.04l-0.056,0.096v0.048l-0.056,0.104v0.04l-0.04,0.08v0.04l-0.056,0.104v0.04l-0.056,0.096v0.04l-0.048,0.088 v0.048l-0.056,0.104l0,0l-0.048,0.08l0,0l-0.056,0.104v0.04l-0.056,0.104v0.04l-0.048,0.08l0,0l-0.056,0.104l0,0l-0.056,0.096l0,0 l-0.056,0.104l0,0l-0.064,0.112l0,0l-0.048,0.096l0,0l-0.064,0.112l0,0l-0.056,0.104l0,0l-0.048,0.096l0,0L32.04,132l0,0 l-0.056,0.096l0,0l-0.064,0.112l0,0l-0.064,0.112l0,0l-0.056,0.104l0,0l-0.064,0.12l0,0l-0.064,0.112l0,0l-0.056,0.104l0,0 l-0.064,0.112l0,0l-0.064,0.112l0,0l-0.064,0.12l0,0l-0.064,0.12l0,0l-0.056,0.112l0,0l-0.072,0.128l0,0l-0.136,0.248l0,0 l-0.064,0.12l0,0l-0.064,0.12l0,0l-0.064,0.128l0,0l-0.136,0.256l0,0l-0.064,0.128l0,0l-0.064,0.128l0,0l-0.072,0.128l0,0 l-0.072,0.128l0,0l-0.072,0.128l0,0l-0.064,0.128l0,0l-0.136,0.256l0,0l-0.064,0.128l0,0l-0.064,0.128l0,0l-0.072,0.128l0,0 l-0.072,0.128l0,0L29.88,136l0,0l-0.072,0.136l0,0l-0.144,0.264l0,0l-0.072,0.136l0,0l-0.072,0.136l0,0l-0.072,0.136l0,0 l-0.144,0.272l0,0l-0.072,0.136l0,0l-0.144,0.272l0,0l-0.144,0.272l14.208,7.36c5.752-11.104,12.368-21.744,19.776-31.816 L49.68,104.472z M13.048,175.2c-1.304,3.912-2.512,7.872-3.624,11.872l0,0l-0.08,0.296l0,0l-0.08,0.296l0,0l-0.12,0.448l0,0 l-0.08,0.296l0,0l-0.08,0.288l0,0v0.144l0,0v0.144l0,0v0.144l0,0l-0.072,0.28l0,0v0.136l0,0v0.128l0,0v0.136l0,0v0.128l0,0v0.136 l0,0v0.128l0,0v0.128l0,0v0.128l0,0v0.112l0,0v0.128l0,0v0.112l0,0v0.128l0,0v0.128l0,0v0.112l0,0v0.12l0,0v0.096v0.04v0.12v0.04 v0.104l0,0v0.12v0.048v0.104v0.056v0.088v0.056v0.112v0.048v0.088v0.048v0.112v0.056v0.088v0.064v0.088v0.056v0.096v0.064v0.072 v0.064v0.104v0.064v0.072v0.08v0.08v0.072v0.056v0.112v0.064v0.064v0.072v0.104v0.064v0.064v0.104v0.072v0.056v0.088v0.08v0.072 v0.064v0.104V195v0.072v0.056v0.112v0.056v0.072v0.104v0.072v0.048v0.12v0.056v0.072v0.048v0.12v0.048v0.072v0.056v0.12v0.048v0.128 v0.04v0.08v0.048v0.128v0.04v0.08v0.048v0.128v0.528v0.08l0,0v0.168l0,0V198l0,0v0.08v0.048v0.128v0.144v0.08l0,0v0.144l0,0 l-2.472,0.32l0,0v0.168l0,0v0.088l0,0v0.152l0,0v0.088l0,0v0.152l0,0L6.184,200v0.04v0.144l0,0v0.08l0,0v0.136v0.04v0.08l0,0v0.136 v0.144l-0.056,0.256v0.04v0.128v0.048v0.08v0.048v0.136l0,0v0.08l0,0v0.152v0.048v0.128v0.048v0.08v0.048v0.136v0.144v0.08v0.048 v0.12v0.048v0.072v0.08v0.096V203v0.104v0.064v0.072v0.056v0.112v0.056v0.072v0.064v0.104v0.064v0.072v0.104v0.072v0.064v0.096 v0.072v0.064v0.08v0.08v0.088v0.056v0.104v0.064v0.08v0.056v0.112v0.056v0.088v0.048v0.12v0.056v0.096v0.056v0.096v0.048v0.12v0.048 v0.096V206v0.12v0.04v0.096l0,0v0.12v0.024v0.12l0,0v0.104l0,0v0.128l0,0v0.12l0,0v0.136l0,0v0.128l0,0v0.144l0,0v0.144l0,0v0.136 l0,0v0.144l0,0v0.152l0,0v0.152l0,0l-0.056,0.296l0,0c-0.336,1.8-0.656,3.616-0.96,5.432l15.784,2.608 c2.04-12.336,5.04-24.488,8.976-36.352l-15.2-5.048L13.048,175.2z M0.04,253.824v0.264l0,0v1.168l0,0V256l0,0v1.64l0,0v13.8v0.264 v0.944l0,0v0.152v0.264v1.064v0.264l0,0v0.264v0.448v0.16v0.144v0.168l0,0v0.128v0.256v0.136v0.168v0.76v0.256v0.144v0.152v1.784 v0.136v3.456v0.12v0.176v0.12v0.176v0.112l0,0v0.112V284v0.12v0.176v0.12v0.168v0.128l0,0v0.112l0,0v0.136l0,0v0.128l0,0v0.272l0,0 v0.128l0,0v0.136l0,0v0.128l0,0v0.28l0,0v0.28l0,0v0.28l0,0c0.28,2.328,0.584,4.64,0.928,6.944L16.8,291.2 c-1.104-11.696-1.36-23.464-0.76-35.2v-2.04L0.04,253.824z M26.968,327.864l-15.264,4.8c0.632,2,1.28,3.992,1.952,5.976l0,0 l0.408,1.184l0,0c0.344,0.984,0.688,1.968,1.04,2.952l0,0c3.312,9.2,7.152,18.2,11.504,26.952l14.328-7.12 C35.376,351.416,30.704,339.8,26.968,327.864L26.968,327.864z M60.176,394.752L47.144,404c7.688,10.832,16.208,21.056,25.48,30.576 l0,0l0.104,0.112l11.456-11.2c-8.736-8.968-16.76-18.592-24-28.8L60.176,394.752z M112.344,448.256l-9.6,12.8 c8.056,6.032,16.464,11.584,25.176,16.632l0,0l0.416,0.24l0,0l0.24,0.136l0,0l0.144,0.08l0,0l0.232,0.136l0,0l0.144,0.08l0,0 l0.08,0.04l0,0l0.136,0.072l0,0l0.12,0.072l0,0h0.072l0,0l0.112,0.064l0,0h0.072h0.056l0.096,0.056h0.048l0.104,0.056h0.048h0.064 h0.048l0.096,0.056h0.056h0.056l0.096,0.056h0.056h0.064l0.08,0.04h0.064h0.056l0.096,0.056h0.048h0.072h0.048l0.104,0.056h0.048 l0.08,0.048h0.064l0.072,0.04h0.048l0.104,0.056h0.048l0.08,0.04h0.056l0.088,0.048h0.056l0.096,0.056h0.04l0.08,0.048l0,0 l0.104,0.056l0,0l0.104,0.056l0,0l0.096,0.056l0,0l0.112,0.064l0,0l0.096,0.056l0,0l0.112,0.064l0,0l0.112,0.064l0,0l0.104,0.056 l0,0l0.12,0.064l0,0l0.12,0.064l0,0l0.128,0.072l0,0l0.136,0.072l0,0l0.128,0.072l0,0l0.128,0.072l0,0l0.128,0.072l0,0l0.128,0.072 l0,0l0.128,0.072l0,0l0.264,0.144l0,0l0.128,0.072l0,0l0.136,0.072l0,0l0.136,0.072l0,0l0.264,0.144l0,0l0.136,0.072l0,0 l0.272,0.144l0,0l0.408,0.216l0,0l8.208-13.056c-11.056-5.848-21.632-12.552-31.648-20.048L112.344,448.256z M178.376,483.2 l-5.176,15.144c9.984,3.408,20.176,6.2,30.504,8.344l0,0l0.304,0.064l0,0l0.304,0.064l0,0h0.152l0,0l0.288,0.056l0,0l0.28,0.056l0,0 h0.136l0,0h0.128l0,0h0.136l0,0h0.128l0,0h0.136l0,0h0.136l0,0h0.112l0,0h0.128h0.04h0.104l0,0h0.12h0.048h0.104h0.048h0.096h0.056 h0.112h0.048h0.08h0.312h0.112h0.056h0.08h0.072h0.096h0.056h0.08h0.096h0.072h0.064h0.08h0.088h0.056h0.08h0.088h0.08h0.048h0.136 l0,0h0.088l0,0h0.152l0,0l0.272,0.048l0,0l0.28,0.048l0,0h0.192l0,0l0.296,0.056l0,0l1.784,0.312l2.736-15.76 C202.248,489.76,190.176,486.944,178.376,483.2z M289.392,493.744c-11.056,1.52-22.2,2.272-33.352,2.256c-1.36,0-2.72,0-4.08,0 l-0.264,16h0.952h19.392h0.256h0.152h0.264h0.44h0.256h0.16h0.256h0.152h0.264h0.432h0.264h0.144h0.264l0,0h0.408l0,0h0.408l0,0 l0.688-0.056l0,0h0.416l0,0c4.8-0.392,9.56-0.928,14.28-1.6l-2.2-15.848L289.392,493.744z M360.84,472 c-11.24,5.464-22.896,10.032-34.856,13.672l4.656,15.312h0.048l0,0l0.184-0.056l0,0l0.744-0.232l0,0 c4.76-1.472,9.464-3.072,14.104-4.8l0,0l0.272-0.104l0,0l0.272-0.104l0,0l0.168-0.064l0,0l0.264-0.096l0,0l0.16-0.064l0,0h0.08l0,0 l0.152-0.056l0,0l0.256-0.096l0,0l0.144-0.056l0,0h0.08l0,0l0.136-0.056l0,0l0.248-0.096l0,0l0.136-0.056l0,0h0.08h0.048l0.12-0.048 h0.048h0.072h0.056l0.104-0.04h0.048l0.112-0.04h0.056h0.064h0.064h0.096h0.056h0.064h0.096h0.064h0.056h0.072h0.088h0.056h0.088 h0.064h0.08h0.056l0.104-0.04h0.048h0.08h0.048l0.104-0.04h0.048h0.096h0.056h0.088h0.048l0.112-0.048h0.04h0.096l0,0l0.112-0.048 h0.04l0.12-0.048l0,0l0.104-0.04h0.04l0.112-0.048l0,0h0.096l0,0l0.552-1.208l0,0l0.12-0.048l0,0l0.112-0.048l0,0l0.12-0.048l0,0 l0.12-0.048l0,0l0.128-0.056l0,0l0.128-0.056l0,0l0.128-0.056l0,0l0.128-0.056l0,0l0.12-0.048l0,0l0.128-0.056l0,0l0.128-0.056l0,0 l0.128-0.056l0,0l0.136-0.056l0,0l0.272-0.112l0,0l0.272-0.112l0,0l0.136-0.056l0,0l0.28-0.12l0,0l0.28-0.12l0,0 c4.216-1.768,8.368-3.648,12.464-5.64l0,0l0.136-0.064L360.84,472z M422.128,429.28c-9.032,8.656-18.72,16.6-28.984,23.76 l9.152,13.128c6.168-4.296,12.128-8.856,17.88-13.664l0,0l0.232-0.2l0,0l0.352-0.296l0,0l0.232-0.192l0,0l0.112-0.096l0,0 l0.224-0.192l0,0l0.112-0.096l0,0l0.104-0.088l0,0l0.104-0.088l0,0l0.104-0.088l0,0l0.096-0.08l0,0l0.096-0.08l0,0l0.088-0.072l0,0 l0.096-0.08l0,0l0.096-0.08l0,0l0.08-0.072l0,0l0.096-0.08l0,0l0.088-0.08l0,0l0.072-0.064l0,0l0.088-0.08l0,0l0.072-0.064l0,0 l0.08-0.072l0,0l0.088-0.08l0,0l0.064-0.056l0,0l0.088-0.08l0,0l0.072-0.064l0.056-0.048l0.056-0.048l0.048-0.04l0.08-0.072 l0.056-0.048l0.632-0.56l0.072-0.064l0.048-0.048l0.056-0.048l0.056-0.048l0.072-0.064h0.04l0.088-0.072h0.04l0.056-0.048l0,0 l0.088-0.08l0,0l0.192-0.168l0,0l0.112-0.096l0,0l0.2-0.176l0,0l0.12-0.104l0,0l0.072-0.064l0,0l0.128-0.112l0,0l0.208-0.184l0,0 l0.128-0.112l0,0l0.208-0.184l0,0l0.352-0.312l0,0c2.232-1.992,4.424-4.024,6.584-6.096l-11.072-11.552L422.128,429.28z M467.4,369.848c-5.944,11.008-12.736,21.528-20.312,31.48l12.728,9.696v-0.04v-0.048l0.04-0.056l0.064-0.08l0.04-0.056l0.04-0.056 l0.056-0.072l0.048-0.064v-0.048l0.064-0.088v-0.04l0.048-0.064v-0.048l0.064-0.088v-0.048l0.048-0.064l0.056-0.072l0.048-0.064 v-0.048l0.072-0.088v-0.04l0.048-0.072v-0.04l0.064-0.088v-0.048l0.064-0.088v-0.048l0.048-0.072v-0.04l0.072-0.096l0,0l0.056-0.072 v-0.056l0.056-0.08l0,0l0.072-0.096l0,0l0.056-0.072l0,0l0.072-0.096v-0.04l0.064-0.088v-0.04l0.056-0.072l0,0l0.072-0.096l0,0 l0.056-0.08v-0.04l0.064-0.088l0,0l0.072-0.096l0,0l0.064-0.08l0,0l0.072-0.096l0,0l0.064-0.088l0,0l0.064-0.088l0,0l0.072-0.104 l0,0l0.056-0.08l0,0l0.072-0.096l0,0l0.072-0.096l0,0l0.064-0.088l0,0l0.072-0.104l0,0l1.072-0.728l0,0l0.072-0.096l0,0l0.072-0.104 l0,0l0.064-0.088l0,0l0.072-0.104l0,0l0.08-0.104l0,0l0.072-0.096l0,0l0.08-0.104l0,0l0.08-0.104l0,0l0.08-0.112l0,0l0.072-0.104 l0,0l0.064-0.088l0,0l0.072-0.104l0,0l0.08-0.112l0,0l0.072-0.104l0,0l0.08-0.112l0,0l0.08-0.104l0,0l0.08-0.112l0,0l0.08-0.112l0,0 l0.072-0.104l0,0l0.08-0.112l0,0l0.08-0.112l0,0l0.072-0.096l0,0l0.08-0.112l0,0l0.072-0.096l0,0l0.08-0.112l0,0l0.08-0.112l0,0 l0.064-0.096l0,0l0.072-0.104l0,0l0.08-0.112l0,0l0.072-0.104l0,0l0.08-0.112l0,0l0.08-0.112l0,0l0.08-0.112l0,0l0.08-0.112l0,0 l0.072-0.104l0,0l0.072-0.112l0,0l0.16-0.232l0,0l0.08-0.112l0,0l0.072-0.104l0,0l0.08-0.112l0,0l0.08-0.112l0,0l0.072-0.104l0,0 l0.072-0.112l0,0l0.08-0.12l0,0l0.08-0.112l0,0l0.08-0.112l0,0l0.072-0.104l0,0l0.08-0.112l0,0l0.08-0.112l0,0l0.072-0.112l0,0 l0.08-0.112l0,0l0.08-0.112l0,0l0.08-0.12l0,0l0.08-0.12l0,0l0.072-0.112l0,0l0.08-0.12l0,0l0.161-0.232l0,0l0.072-0.112l0,0 l0.072-0.112l0,0l0.08-0.12l0,0l0.08-0.112l0,0l0.072-0.104l0,0l0.08-0.112l0,0l0.152-0.232l0,0l0.072-0.112l0,0l0.072-0.104l0,0 l0.072-0.112l0,0l0.072-0.112l0,0l0.064-0.104l0,0l0.072-0.112l0,0l0.072-0.104l0,0l0.072-0.112l0,0l0.072-0.112l0,0l0.072-0.104 l0,0l0.072-0.112l0,0l0.08-0.12l0,0l0.064-0.104l0,0L470.44,396l0,0l0.064-0.096l0,0l0.072-0.104l0,0l0.072-0.104l0,0l0.064-0.096 l0,0l0.072-0.112l0,0l0.072-0.104l0,0l0.064-0.104l0,0l0.072-0.104l0,0l0.056-0.096l0,0l0.072-0.104l0,0l0.064-0.104l0,0 l0.056-0.088l0,0l0.072-0.104l0,0l0.064-0.104l0,0l0.064-0.104l0,0l0.072-0.112l0,0l0.056-0.088l0,0l0.064-0.104l0,0l0.408-0.672 l0,0l0.056-0.088l0,0l0.064-0.104l0,0l0.056-0.088l0,0l0.064-0.096l0,0l0.064-0.104l0,0l0.056-0.088l0,0l0.064-0.104v-0.04 l0.056-0.088v-0.04l0.048-0.08v-0.048l0.064-0.096v-0.04l0.048-0.08v-0.04l0.056-0.096v-0.048l0.064-0.096l0,0l0.048-0.08v-0.04 l0.064-0.096v-0.048l0.056-0.088l0,0l0.056-0.088v-0.048l0.064-0.096v-0.04l0.048-0.08v-0.048l0.056-0.088v-0.048l0.064-0.104l0,0 l0.048-0.072v-0.048l0.056-0.088v-0.056l0.04-0.064l0.04-0.072l0.04-0.072v-0.048l0.056-0.096v-0.048l0.04-0.072v-0.056l0.056-0.088 v-0.048l0.048-0.08v-0.064l0.04-0.064v-0.048l0.056-0.096v-0.048l0.04-0.072l0.04-0.064l0.04-0.072v-0.048l0.056-0.096v-0.048 l0.04-0.072v-0.048l0.064-0.096v-0.048l0.048-0.08v-0.064l0.04-0.072v-0.048l0.056-0.088v-0.056v-0.064l0.04-0.072l0.04-0.072 v-0.056l0.048-0.08v-0.064v-0.056v-0.056l0.056-0.088v-0.056v-0.064l0.048-0.088v-0.056v-0.056l0.048-0.08l0.048-0.072v-0.048 l0.056-0.096v-0.048v-0.064v-0.048l0.056-0.096v-0.048l0.064-0.104v-0.048v-0.064v-0.04l0.064-0.104v-0.048v-0.064v-0.056 l0.056-0.096v-0.048l0.056-0.104v-0.048v-0.064v-0.048l0.056-0.104v-0.04l0.072-0.128l0,0v-0.064v-0.048l0.056-0.104v-0.048v-0.064 l0,0l0.072-0.12l0,0l0.064-0.104v-0.04v-0.064V385.2l0.064-0.104v-0.04l0.128-0.224l0,0l0.072-0.12l0,0v-0.072l0,0l0.072-0.12l0,0 l0.08-0.128l0,0l0.04-0.072l0,0l0.072-0.12l0,0l0.04-0.072l0,0L475.84,384l0,0l0.072-0.12l0,0l0.04-0.072l0,0l0.08-0.144l0,0 l0.136-0.232l0,0l0.072-0.128l0,0l0.136-0.232l0,0l0.088-0.152l0,0l0.048-0.08l0,0l0.088-0.16l0,0l0.136-0.24l0,0l0.088-0.152l0,0 l0.136-0.24l0,0l0.136-0.24l0,0l0.08-0.152l0,0l0.136-0.24l0,0l0.088-0.152l0,0l2.64-1.264l0,0l0.136-0.248l0,0l0.088-0.16l0,0 l0.136-0.248l0,0l0.136-0.248l0,0l0.088-0.16l0,0l0.136-0.24l0,0l0.088-0.16l0,0l0.136-0.24l0,0l0.08-0.152l0,0l0.136-0.248l0,0 l0.136-0.248l0,0l0.04-0.08l-14.08-7.6L467.4,369.848z M492.144,299.448c-2.248,12.296-5.456,24.4-9.6,36.192l15.096,5.304 c0.776-2.216,1.528-4.448,2.248-6.696l0,0l0.088-0.272l0,0l0.064-0.376l0,0l0.048-0.144l0,0v-0.08l0,0l0.04-0.136v-0.04v-0.072 v-0.096v-0.072v-0.056V332.8v-0.056v-0.072V332.6v-0.088v-0.072v-0.064v-0.104v-0.048v-0.08v-0.056v-0.112v-0.056v-0.08v-0.056 v-0.104v-0.056v-0.096v-0.064v-0.088v-0.048v-0.112v-0.048v-0.088l0,0v-0.12v-0.048v-0.104l0,0v-0.128l0,0v-0.128l0,0v-0.112l0,0 v-0.128l0,0V330.2l0,0v-0.128l0,0l0.04-0.136l0,0v-0.128l0,0l0.04-0.136l0,0v-0.128l0,0l0.04-0.136l0,0l0.088-0.288l0,0l0.08-0.288 l0,0l1.352-0.832l0,0l0.088-0.288l0,0l0.128-0.448l0,0l0.088-0.296l0,0l0.088-0.296l0,0c1.256-4.392,2.4-8.832,3.432-13.32l0,0 l0.104-0.456l0,0l0.064-0.296l0,0l0.064-0.296l0,0v-0.144l0,0v-0.144l0,0v-0.144l0,0l0.064-0.28l0,0v-0.136l0,0v-0.128l0,0v-0.136 l0,0v-0.128l0,0v-0.136l0,0v-0.136l0,0v-0.128l0,0v-0.128l0,0v-0.112l0,0v-0.128l0,0v-0.12l0,0v-0.12v-0.048v-0.12l0,0v-0.096 v-0.432v-0.12v-0.048v-0.096v-0.04v-0.12v-0.056v-0.096v-0.064v-0.088v-0.064v-0.104V308.4v-0.072v-0.056v-0.112v-0.064v-0.072 v-0.088v-0.072v-0.072v-0.072v-0.096v-0.064v-0.072v-0.08v-0.096v-0.032v-0.152l0,0v-0.08l0,0v-0.144l0,0v-0.08l0,0v-0.16l0,0 l0.056-0.272l0,0c0.264-1.312,0.512-2.64,0.752-3.952l-15.736-2.872L492.144,299.448z M509.896,222.648l-15.864,2.064 c1.344,10.376,2.008,20.824,2.008,31.288c0,2.04-0.024,4.08-0.08,6.112l16,0.4c0-0.616,0-1.24,0-1.864l0,0v-1.792l0,0v-0.088l0,0 v-0.088l0,0v-0.088l0,0v-2.4l0,0V256l0,0v-7.432l0,0v-0.184l0,0v-0.504l0,0v-0.12v-0.384V247.2l0,0v-0.296l0,0v-0.096l0,0V246.4l0,0 v-0.104l0,0v-0.408l0,0c-0.304-7.864-0.96-15.632-1.96-23.296L509.896,222.648z M487.368,146.232l-14.448,6.872 c5.36,11.264,9.824,22.936,13.36,34.896l15.344-4.52c-0.888-3.016-1.832-6.016-2.832-8.992l0,0l-0.096-0.28l0,0l-0.048-0.144l0,0 l-0.048-0.136l0,0l-0.048-0.136l0,0l-0.048-0.136l0,0l-0.048-0.136l0,0l-0.04-0.128l0,0v-0.112l0,0l-0.04-0.128l0,0v-0.112l0,0 v-0.112v-0.048l-0.04-0.12l0,0v-0.096v-0.04v-0.112v-0.048v-0.088v-0.064v-0.088v-0.048v-0.104v-0.056v-0.072v-0.056v-0.104v-0.064 v-0.056v-0.096v-0.064v-0.064v-0.064v-0.096v-0.056v-0.072v-0.096v-0.072v-0.048l-0.04-0.12v-0.048v-0.08l0,0l-0.048-0.144l0,0 l-0.088-0.248l0,0l-0.056-0.16l0,0l-0.096-0.264l0,0c-2.504-6.976-5.288-13.8-8.368-20.48l0,0l-0.12-0.256l0,0l-0.072-0.16l0,0 v-0.08l0,0l-0.064-0.144l0,0l-0.112-0.24l0,0l-0.056-0.12v-0.04v-0.072v-0.048l-1.176-0.56v-0.048v-0.064l-0.04-0.096V147.4v-0.048 l-0.04-0.096v-0.064v-0.056v-0.072v-0.072v-0.072v-0.056l-0.048-0.104v-0.048v-0.08v-0.04l-0.048-0.112v-0.04l-0.048-0.104l0,0 l-0.04-0.096l0,0L487.368,146.232z M442.368,80.48l-11.64,10.976c8.584,9.104,16.44,18.864,23.512,29.184l13.2-9.04 c-3.76-5.496-7.728-10.824-11.896-16l0,0l-0.176-0.224l0,0L455.24,95.2l0,0l-0.176-0.216l0,0l-0.104-0.128l0,0l-0.056-0.072l0,0 l-0.104-0.128l0,0l-0.168-0.2l0,0l-0.08-0.096l0,0l-0.048-0.056v-0.048l-0.072-0.088l0,0l-0.064-0.08l-0.048-0.056l-0.04-0.048 l-0.048-0.056l-0.056-0.072l-0.04-0.048l-0.048-0.056l-0.064-0.08v-0.048l-0.048-0.064l-0.048-0.056l-0.056-0.072v-0.04 l-0.072-0.088v-0.04l-0.056-0.064l0,0l-0.08-0.096l0,0l-0.072-0.088l0,0l-0.064-0.072l0,0l-0.08-0.096l0,0l-0.072-0.08l0,0 l-0.072-0.088l0,0l-0.08-0.096l0,0l-0.072-0.088l0,0l-0.08-0.096l0,0l-0.08-0.096l0,0l-0.08-0.088l0,0l-0.08-0.096l0,0l-0.088-0.104 l0,0l-0.704-0.736l0,0l-0.088-0.104l0,0l-0.088-0.104l0,0l-0.096-0.112l0,0l-0.184-0.224l0,0l-0.088-0.112l0,0l-0.256-0.304l0,0 l-0.096-0.112l0,0l-0.192-0.232l0,0l-0.2-0.232l0,0c-2.704-3.16-5.488-6.256-8.344-9.288L442.368,80.48z M379.392,31.68 l-7.736,13.92c10.952,6.04,21.416,12.92,31.304,20.584l9.808-12.584c-6.016-4.664-12.24-9.056-18.664-13.184l0,0l-0.4-0.256l0,0 L393.456,40l0,0l-0.4-0.248l0,0l-0.216-0.2l0,0l-0.152-0.096l0,0l-0.232-0.152l0,0l-0.392-0.248l0,0l-0.232-0.144l0,0l-0.144-0.088 l0,0l-0.232-0.144l0,0l-0.232-0.144l0,0l-0.128-0.08l0,0l-0.224-0.144l0,0l-0.144-0.088l0,0l-0.08-0.048l0,0l-0.152-0.088l0,0 l-0.136-0.08l0,0l-0.072-0.04l0,0l-0.12-0.072l0,0L389.64,37.6l0,0l-0.112-0.072l0,0l-0.072-0.04l0,0l-0.128-0.08l0,0l-0.128-0.08 l0,0l-0.072-0.04h-0.04l-0.248-0.208h-0.048h-0.064h-0.048l-0.104-0.064h-0.04L388.4,36.8l0,0h-0.104l0,0l-0.12-0.072l0,0 l-0.136-0.08l0,0l-0.072-0.04l0,0l-0.112-0.064h-0.04l-0.064-0.04l0,0l-0.12-0.072h-0.04l-0.112-0.064l0,0l-0.24-0.248l0,0 L387.064,36l0,0l-0.224-0.136h-0.04l-0.112-0.064h-0.04h-0.064h-0.048l-0.096-0.168h-0.048l-0.096-0.056h-0.056h-0.064h-0.048 l-0.104-0.056h-0.04l-0.112-0.064h-0.04h-0.064h-0.04l-0.104-0.064h-0.048h-0.064h-0.056l-0.096-0.056h-0.04l-0.104-0.064h-0.048 h-0.064h-0.048l-0.104-0.064h-0.04h-0.064H384.8l-0.104-0.064h-0.04l-0.112-0.064h-0.04h-0.072l0,0l-0.192-0.68h-0.04l-0.112-0.064 l0,0l-0.072-0.04l0,0l-0.12-0.072l0,0l-0.224-0.128l0,0l-0.112-0.064l0,0l-0.072-0.04l0,0l-0.12-0.072l0,0l-0.144-0.08l0,0 l-0.336-0.24l0,0l-0.128-0.072l0,0l-0.32-0.176l0,0l-0.12-0.072l0,0l-0.072-0.04l0,0l-0.128-0.072l0,0l-0.232-0.128l0,0l-0.144-0.08 l0,0l-0.24-0.136l0,0l-0.24-0.136l0,0l-0.144-0.08l0,0l-0.24-0.136l0,0l-0.408-0.224l0,0L379.8,31.88l0,0l-0.216-0.12L379.392,31.68 z M304.44,4.568l-3.008,15.712c12.28,2.352,24.352,5.664,36.112,9.904l5.432-15.048c-5.384-1.944-10.856-3.712-16.408-5.304l0,0 l-0.296-0.088l0,0l-0.296-0.08l0,0l-0.16-0.064l0,0l-0.288-0.08l0,0l-0.288-0.08l0,0h-0.136l0,0h-0.128l0,0h-0.136l0,0h-0.128l0,0 h-0.136l0,0h-0.128l0,0h-0.12l0,0h-0.12l0,0h-0.104l0,0h-0.128l0,0h-0.112l0,0h-0.12h-0.04h-0.12l0,0h-0.104l0,0h-0.12h-0.04h-0.096 h-0.04h-0.112h-0.048h-0.104h-0.056h-0.096h-0.048h-0.112h-0.048h-0.08h-0.048h-0.112h-0.056h-0.08h-0.08h-0.08h-0.056h-0.096H321.8 h-0.072h-0.056h-0.112h-0.056h-0.072h-0.072h-0.096h-0.056h-0.08h-0.08h-0.072h-0.064h-0.096h-0.072h-0.064h-0.064h-0.104h-0.064 h-0.072L319.88,8h-0.072h-0.072h-0.056h-0.112h-0.048h-0.072H319.4h-0.12h-0.04h-0.144l0,0h-0.08l0,0h-0.144l0,0h-0.08l0,0h-0.144 h-0.208l-0.232-0.4l0,0l-0.16-0.04l0,0h-0.088l0,0h-0.16l0,0l-0.368-0.152l0,0l-0.288-0.072l0,0l-0.184-0.04l0,0L316.664,7.2l0,0 l-0.296-0.048l0,0l-0.48-0.12l0,0l-0.296-0.072l0,0l-0.288-0.064l0,0c-2.096-0.496-4.2-0.968-6.304-1.408l0,0l-0.8-0.16l0,0 l-0.264-0.064l0,0L307.64,5.2l0,0h-0.176l0,0l-0.312-0.096l0,0l-0.296-0.064l0,0h-0.184l0,0h-0.096l0,0h-0.184l0,0l-0.312-0.152l0,0 L305.784,4.8l0,0h-0.176l0,0h-0.128l0,0h-0.176l0,0L305,4.68l0,0l-0.16-0.04l0,0h-0.088l0,0h-0.136h-0.176L304.44,4.568 L304.44,4.568z M256.04,0v16c2.728,0,5.448,0.048,8.152,0.136l0.536-16c-1.792-0.048-3.576-0.096-5.376-0.136H256.04z">
                                                    </path>
                                                    <g>
                                                        <rect x="244.04" y="175.976" style="fill:#77bb41;" width="24"
                                                            height="160.08"></rect>
                                                        <rect x="176" y="244" style="fill:#77bb41;" width="160.08"
                                                            height="24"></rect>
                                                    </g>
                                                </g>
                                            </svg>Мероприятие:
                                        </span>
                                        <div class="app-card__subtext sertting_bar_admin">
                                            <div class='sertting_bar'>
                                                <div class="icput">
                                                    <?php echo $sender_edit_full; ?>
                                                </div>
                                                <!-- title -->
                                                <label for="title" label="title">Название:</label>
                                                <input name="title" type='text' id='title' required
                                                    contenteditable="true" autocapitalize='characters' spellcheck />
                                            </div>
                                            <div class='sertting_bar'>
                                                <div class="icput">
                                                    <?php echo $sender_edit_full; ?>
                                                </div>
                                                <!-- date -->
                                                <label for="date" label="date">Дата:</label>
                                                <input placeholder="год-месяц-день" name="date"
                                                    style="text-transform: uppercase;" type='date' id='date' required />
                                            </div>
                                            <div class='sertting_bar'>
                                                <div class="icput">
                                                    <?php echo $sender_edit_full; ?>
                                                </div>
                                                <!-- time -->
                                                <label for="time" label="time">Время:</label>
                                                <input placeholder="час:мин:сек" name="time"
                                                    style="text-transform: uppercase;" type='time' id='time' required />
                                            </div>
                                            <div class='sertting_bar'>
                                                <div class="icput">
                                                    <?php echo $sender_edit_full; ?>
                                                </div>
                                                <!-- author -->
                                                <label for="author" label="author">Автор(ы):</label>
                                                <input autocomplete="username" spellcheck="" name="author" type='text'
                                                    id='author' required autocapitalize='characters' spellcheck />
                                            </div>

                                        </div>
                                        <div class="app-card__subtext sertting_bar_admin">

                                            <div class='sertting_bar sertting_bar_desport'>
                                                <!-- description -->
                                                <label for="title" label="descriptions">Описание:</label>
                                                <textarea class="" name="description" type='text' id='descriptions'
                                                    required contenteditable="true" autocapitalize='characters'
                                                    spellcheck></textarea>
                                            </div>
                                        </div>
                                        <div class="app-card-buttons">
                                            <button class="content-button status-button" id="set_event">Создать</button>
                                        </div>
                            </form>
                        </div>

                        <!-- изменить мероприятие -->
                        <div class="content-section">
                            <div class="content-section-title" style="color: white">
                                Внесения изменения в мероприятия:</div>
                            <form action=" /../php/src/actions/replace.php" method="POST">
                                <div class="admin_log">
                                    <div class="app-card">
                                        <span>
                                            <svg style="border-radius: 0;" version="1.1" id="Layer_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                xml:space="preserve" fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path style="fill:#999999;"
                                                        d="M468.984,49.552h-40v16h40V49.552z M388.984,49.552h-40v16h40V49.552z M308.984,49.552h-40v16h40 V49.552z M228.984,49.552h-40v16h40V49.552z M148.984,49.552h-40v16h40V49.552z M68.984,49.552H49.552v16l0,0v4.56h16v-4.56h3.44 L68.984,49.552L68.984,49.552z M65.544,110.112h-16v40h16V110.112z M65.544,190.112h-16v40h16V190.112z M65.544,270.112h-16v40h16 V270.112z M65.544,350.112h-16v40h16V350.112z M65.544,430.112h-16v38.88h16V430.112z M130.664,452.992h-40v16h40V452.992z M210.664,452.992h-40v16h40V452.992z M290.664,452.992h-40v16h40V452.992z M370.664,452.992h-40v16h40V452.992z M450.664,452.992 h-40v16h40V452.992z M468.976,407.304h-16v40h16V407.304z M468.976,327.304h-16v40h16V327.304z M468.976,247.304h-16v40h16V247.304z M468.976,167.304h-16v40h16V167.304z M468.976,87.304h-16v40h16V87.304z">
                                                    </path>
                                                    <g>
                                                        <rect x="412.904" style="fill:#E21B1B;" width="99.096"
                                                            height="99.096"></rect>
                                                        <rect y="412.904" style="fill:#E21B1B;" width="99.096"
                                                            height="99.096"></rect>
                                                        <rect style="fill:#E21B1B;" width="99.096" height="99.096">
                                                        </rect>
                                                        <rect x="412.904" y="412.904" style="fill:#E21B1B;"
                                                            width="99.096" height="99.096"></rect>
                                                    </g>
                                                    <path style="fill:#999999;"
                                                        d="M221.6,311.608l-16.28,58.672h-53.6l69.88-228.56h67.816l70.872,228.56h-55.624l-17.6-58.672H221.6z M279.584,272.952l-14.248-48.488c-4.064-13.6-8.128-30.528-11.512-44.096h-0.704c-3.392,13.6-6.784,30.856-10.512,44.096 l-13.6,48.488H279.584z">
                                                    </path>
                                                </g>
                                            </svg> Редактирование данных:
                                        </span>
                                        <div class="app-card__subtext sertting_bar_admin">
                                            <div class='sertting_bar'>
                                                <div class="icput">
                                                    <?php echo $sender_edit_full; ?>
                                                </div>
                                                <style>
                                                    #select_id:has(+ [required])::after,
                                                    .required_label:has(+ [required])::after {
                                                        content: '*';
                                                        color: #e75454;
                                                        margin: .5rem;
                                                    }

                                                    input:focus,
                                                    textarea:focus {
                                                        outline: 2px solid white;
                                                    }
                                                </style><!-- id -->

                                                <label for="select_id" label="select_id" id="select_id">[SELECT]
                                                    ID:</label>
                                                <input name="select_id" oninput="fetchEventDetails(this.value)"
                                                    tyle="text-transform: uppercase;" placeholder="Введите сначала ID"
                                                    type='text' id='sel_id' required inputmode="numeric" />
                                            </div>
                                            <div class='sertting_bar'>
                                                <div class="icput">
                                                    <?php echo $sender_edit_full; ?>
                                                </div>
                                                <!-- title -->
                                                <label for="change_title" label="change_title">Название:</label>
                                                <input autocomplete="username" value="undefined" name="change_title"
                                                    type='text' id='change_title' required contenteditable="true"
                                                    autocapitalize='characters' spellcheck autocopitalize />
                                            </div>
                                            <div class=' sertting_bar'>
                                                <div class="icput">
                                                    <?php echo $sender_edit_full; ?>
                                                </div>
                                                <!-- date -->
                                                <label for="change_date" label="change_date">Дата:</label>
                                                <input placeholder="год-месяц-день" name="change_date"
                                                    style="text-transform: uppercase;" type='date' id='change_date'
                                                    required inputmode="numeric" />
                                            </div>
                                            <div class='sertting_bar'>
                                                <div class="icput">
                                                    <?php echo $sender_edit_full; ?>
                                                </div>
                                                <!-- time -->
                                                <label for="change_time" label="change_time">Время:</label>
                                                <input placeholder="час:мин:сек" name="change_time"
                                                    style="text-transform: uppercase;" type='time' id='change_time'
                                                    required inputmode="numeric" />
                                            </div>

                                        </div>
                                        <div class="app-card__subtext sertting_bar_admin">

                                            <div class='sertting_bar sertting_bar_desport' style="gap: .5rem">
                                                <!-- description -->
                                                <label for="change_description" label="change_description">[NEW]
                                                    Описание:</label>
                                                <textarea name="change_description" type='text' id='change_description'
                                                    required inputmode="email" contenteditable="true"
                                                    autocapitalize='characters' spellcheck autocopitalize></textarea>
                                            </div>
                                            <div class='sertting_bar sertting_bar_desport' style="gap: .5rem">
                                                <!-- author-->
                                                <label for="change_author" label="change_author">[NEW]
                                                    Автор(ы):</label>
                                                <textarea name=" change_author" type='text' id='change_author' required
                                                    style="resize: none" autocapitalize='characters' spellcheck
                                                    autocomplete="username"></textarea>
                                            </div>
                                        </div>
                                        <div class="app-card-buttons">
                                            <button class="content-button status-button" id="replace_edit">Отредактировать</button>
                                        </div>
                            </form>
                        </div>

                    </div>

                </div>
                <!--finish -->
            </div>
        </div>

        <div class=" overlay-app">
        </div>
    </div>

    <script src="js/next.js"></script>
    <!-- Bootstrap framework -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="js/setting/save-setting.js"></script>
    <script src="js/setting/button.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="element/account.js"></script>
    <script src="account/main.js"></script>
    <script src="../js/icon.js"></script>
    <script src="../js/swiper.min.js"></script>
    <!-- Swiper for image and text sliders -->
    <script>
        document.getElementById('change_description').value = 'Ожидание поиска...';
        document.getElementById('change_author').value = 'Ожидание поиска...';
        document.getElementById('change_title').value = 'Ожидание поиска...';
        document.getElementById('sel_id').style.outline = '1px solid red';
        const replace_edit = document.getElementById('replace_edit');
        const set_event = document.getElementById('set_event');
        const overlay = document.querySelector('.overlay-app');

        set_event.addEventListener('click', function () {
            if (overlay.classList.contains('is-active')) {
                overlay.classList.remove('is-active');
            }
        });
        replace_edit.addEventListener('click', function () {
            if (overlay.classList.contains('is-active')) {
                overlay.classList.remove('is-active');
            }
        });
        
        function fetchEventDetails(id) {
            if (id === '') {
                document.getElementById('change_title').value = 'Неккоректный [ID]';
                document.getElementById('change_time').value = 'Неккоректный [ID]';
                document.getElementById('change_date').value = 'Неккоректный [ID]';
                document.getElementById('change_description').value = 'Неккоректный [ID]';
                document.getElementById('change_author').value = 'Неккоректный [ID]';
                document.getElementById('sel_id').style.outline = '1px solid red';
            }
            fetch(`php/server.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error === 'true'
                        || document.getElementById('change_author').value === '') {
                        document.getElementById('change_title').value = 'Неккоректный [ID]';
                        document.getElementById('change_time').value = 'Неккоректный [ID]';
                        document.getElementById('change_date').value = 'Неккоректный [ID]';
                        document.getElementById('change_description').value = 'Неккоректный [ID]';
                        document.getElementById('change_author').value = 'Неккоректный [ID]';
                        document.getElementById('sel_id').style.outline = '1px solid red';
                    } else {
                        document.getElementById('sel_id').style.outline = '1px solid greenyellow';
                        document.getElementById('change_title').value = data.title;
                        document.getElementById('change_time').value = data.time;
                        document.getElementById('change_date').value = data.date;
                        document.getElementById('change_description').value = data.description;
                        document.getElementById('change_author').value = data.author;
                    }
                })
                .catch(error => console.error('Ошибка:', error));
        }
    </script>
</body>

</html>