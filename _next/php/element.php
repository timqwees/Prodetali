<?php
require_once __DIR__ . '/src/helpers.php';
include_once __DIR__ . '/../panel/setting.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user = currentUser();

$content_date = "Обновления отсувствуют";

if ($content_vk[0] === "on") {
    $content_date = $content_1;
} elseif ($content_vk[1] === "on") {
    $content_date = $content_2;
}

$important_sref = $important_title = null;
if (!isset($_SESSION['user']['id'])) {
    $rand = mt_rand(1, 4);
    if ($rand === 1) {
        $important_title = 'Начни сейчас!';
    } elseif ($rand === 2) {
        $important_title = 'Открой профиль!';
    } elseif ($rand === 3) {
        $important_title = 'В новый путь!';
    } elseif ($rand === 4) {
        $important_title = 'Начни прямо сейчас!';
    }
    $important_sref = "regist/log-in.php";
} else {
    $us = $user['nickname'];
    $rander = mt_rand(1, 12);
    if ($rander === 1) {
        $important_title = 'Войти в профиль!';
    } elseif ($rander === 2) {
        $important_title = 'Открыть лобби!';
    } elseif ($rander === 3) {
        $important_title = 'Перейти к себе!';
    } elseif ($rander === 4) {
        $important_title = 'Погнали!';
    } elseif ($rander === 5) {
        $important_title = 'Перейти в личный кабинет!';
    } elseif ($rander === 6) {
        $important_title = 'Зайди к себе!';
    } elseif ($rander === 7) {
        $important_title = 'Посмотреть профиль!';
    } elseif ($rander === 8) {
        $important_title = "Войти в $us";
    } elseif ($rander === 9) {
        $important_title = 'Хочешь в личный кабинет!';
    } elseif ($rander === 10) {
        $important_title = 'Личный кабинет!';
    } elseif ($rander === 11) {
        $important_title = "Профиль: $us!";
    } elseif ($rander === 12) {
        $important_title = "$us — Profile";
    }
    $important_sref = "regist/account.php";
}

//---------  ELEMENTS
$search = "";
/*$search = "<div class='search_bar'>
<input type='text' placeholder='Search' />
</div>";на будущие заготовленная переменная*/

//-------------------------------------------------------------------------------


//---------  NOTIFICATION IN MENU
$upmes = $upmes1 = $upmes2 = $upmes3 = $upmes4 = $upmes5 = $upmes6 = $upmes7 = $upmes8 = $upmes9 = $upmes10 = $upmes11 = "";
//NO WORK
$not = "<span style='right: 30% !important;transform: translateY(0px) !important' class='noentrance'><i class='fa fa-ban'></i></span>";
$not1 = "<span style='right: 20% !important;transform: translateY(0px) !important' class='noentrance'><i class='fa fa-ban'></i></span>";
$not2 = "<span style='right: 33% !important; transform: translateY(-19px) !important;' class='noentrance'><i style='transform: translateY(.5px)' class='fa fa-ban'></i></span>";//DONAT'S
$not3 = "<span style='right: 29% !important;transform: translateY(-19px) !important' class='noentrance'><i style='transform: translateY(.5px)' class='fa fa-ban'></i></span>";//RULES
$not4 = "<span style='right: 31% !important;transform: translateY(-19px) !important' class='noentrance'><i style='transform: translateY(.5px)' class='fa fa-ban'></i></span>";//SOON
$not5 = "<span style='right: 26% !important;transform: translateY(-19px) !important' class='noentrance'><i style='transform: translateY(.2px)' class='fa fa-ban'></i></span>";//DOWENLOAD
$not6 = "<span style='right: 22% !important;transform: translateY(-19px) !important' class='noentrance'><i style='transform: translate(0px, .5px)' class='fa fa-ban'></i></span>";//SETTING
$not7 = "<span style='right: 2% !important;transform: translateY(-19px) !important' class='noentrance'><i style='transform: translateY(.5px)' class='fa fa-ban'></i></span>";//AUTH
$not8 = "<span style='right: 48% !important;transform: translateY(0px) !important' class='noentrance'><i class='fa fa-ban'></i></span>";//FQA
$not9 = "<span style='right: 2% !important;transform: translateY(0px) !important' class='noentrance'><i class='fa fa-ban'></i></span>";//БАГ
$not10 = "<span style='right: 28% !important;transform: translateY(0px) !important' class='noentrance'><i class='fa fa-ban'></i></span>";//ОБРАЩЕНИЕ
$not11 = "<span style='right: 0% !important;transform: translateY(0px) !important' class='noentrance'><i class='fa fa-ban'></i></span>";//ДОГОВОР
//NOTIFICATION
$update = "<span style='right: 30% !important;transform: translateY(0px) !important' class='yeaentrance'>" . $notification[0] . "</span>";
$update1 = "<span style='right: 20% !important;transform: translateY(0px) !important' class='yeaentrance'>" . $notification[1] . "</span>";
$update2 = "<span style='right: 33% !important;transform: translateY(-19px) !important' class='yeaentrance'>" . $notification[2] . "</span>";
$update3 = "<span style='right: 29% !important;transform: translateY(-19px) !important' class='yeaentrance'>" . $notification[3] . "</span>";
$update4 = "<span style='right: 31% !important;transform: translateY(-19px) !important' class='yeaentrance'>" . $notification[4] . "</span>";
$update5 = "<span style='right: 26% !important;transform: translateY(-19px) !important' class='yeaentrance'>" . $notification[5] . "</span>";
$update6 = "<span style='right: 22% !important;transform: translateY(-19px) !important' class='yeaentrance'>" . $notification[6] . "</span>";
$update7 = "<span style='right: 2% !important;transform: translateY(-19px) !important' class='yeaentrance'>" . $notification[7] . "</span>";
$update8 = "<span style='right: 48% !important;transform: translateY(0px) !important' class='yeaentrance'>" . $notification[8] . "</span>";
$update9 = "<span style='right: 2% !important;transform: translateY(0px) !important' class='yeaentrance'>" . $notification[9] . "</span>";
$update10 = "<span style='right: 28% !important;transform: translateY(0px) !important' class='yeaentrance'>" . $notification[10] . "</span>";
$update11 = "<span style='right: 0% !important;transform: translateY(0px) !important' class='yeaentrance'>" . $notification[11] . "</span>";

if ($nothave[0] === '') {
    $upmes = '';
} elseif ($nothave[0] === 'update') {
    $upmes = $update;//иконка обновления
} elseif ($nothave[0] === 'not') {
    $upmes = $not;//уведомление
}

if ($nothave[1] === '') {
    $upmes1 = '';
} elseif ($nothave[1] === 'update') {
    $upmes1 = $update1;
} elseif ($nothave[1] === 'not') {
    $upmes1 = $not1;
}

if ($nothave[2] === '') {
    $upmes2 = '';
} elseif ($nothave[2] === 'update') {
    $upmes2 = $update2;
} elseif ($nothave[2] === 'not') {
    $upmes2 = $not2;
}
if ($nothave[3] === '') {
    $upmes3 = '';
} elseif ($nothave[3] === 'update') {
    $upmes3 = $update3;
} elseif ($nothave[3] === 'not') {
    $upmes3 = $not3;
}

if ($nothave[4] === '') {
    $upmes4 = '';
} elseif ($nothave[4] === 'update') {
    $upmes4 = $update4;
} elseif ($nothave[4] === 'not') {
    $upmes4 = $not4;
}

if ($nothave[5] === '') {
    $upmes5 = '';
} elseif ($nothave[5] === 'update') {
    $upmes5 = $update5;
} elseif ($nothave[5] === 'not') {
    $upmes5 = $not5;
}

if ($nothave[6] === '') {
    $upmes6 = '';
} elseif ($nothave[6] === 'update') {
    $upmes6 = $update6;
} elseif ($nothave[6] === 'not') {
    $upmes6 = $not6;
}

if ($nothave[7] === '') {
    $upmes7 = '';
} elseif ($nothave[7] === 'update') {
    $upmes7 = $update7;
} elseif ($nothave[7] === 'not') {
    $upmes7 = $not7;
}

if ($nothave[8] === '') {
    $upmes8 = '';
} elseif ($nothave[8] === 'update') {
    $upmes8 = $update8;
} elseif ($nothave[8] === 'not') {
    $upmes8 = $not8;
}
if ($nothave[9] === '') {
    $upmes9 = '';
} elseif ($nothave[9] === 'update') {
    $upmes9 = $update9;
} elseif ($nothave[9] === 'not') {
    $upmes9 = $not9;
}
if ($nothave[10] === '') {
    $upmes10 = '';
} elseif ($nothave[10] === 'update') {
    $upmes10 = $update10;
} elseif ($nothave[10] === 'not') {
    $upmes10 = $not10;
}
if ($nothave[11] === '') {
    $upmes11 = '';
} elseif ($nothave[11] === 'update') {
    $upmes11 = $update11;
} elseif ($nothave[11] === 'not') {
    $upmes11 = $not11;
}


//---------  PROFIL ICON

$account_icon = $account_icon_regist = $send_profil = "";

if (!isset($user['id'])) {
    $account_icon = '/images/icon/noauth.jpg';
    $account_icon_regist = '/images/icon/noauth.jpg';
    $send_profil = "/regist/log-in.php";
} else {
    $account_icon = $user['icon'];
    $account_icon_regist = $user['icon'];
    $send_profil = "/regist/account.php";
}

/** структура отправки на страницу ошибки без ссылок меню **/
if ($title_self === "") {
    $title_self = '/404.php';
} else {
    $title_self = $title_self;
}
if ($title1_self === "") {
    $title1_self = '/404.php';
} else {
    $title1_self = $title1_self;
}
if ($title2_self === "") {
    $title2_self = '/404.php';
} else {
    $title2_self = $title2_self;
}
if ($title3_self === "") {
    $title3_self = '/404.php';
} else {
    $title3_self = $title3_self;
}
if ($title4_self === "") {
    $title4_self = '/404.php';
} else {
    $title4_self = $title4_self;
}
if ($title5_self === "") {
    $title5_self = '/404.php';
} else {
    $title5_self = $title5_self;
}
if ($title6_self === "") {
    $title6_self = '/404.php';
} else {
    $title6_self = $title6_self;
}


//SETTING ADMIN PANEL
//проверка со стороны файла протокола >> до 10 администраторов
//id check admin
$admin_id = $admin_id ?? null;
$admin_id2 = $admin_id2 ?? null;
$admin_id3 = $admin_id3 ?? null;
$admin_id4 = $admin_id4 ?? null;
$admin_id5 = $admin_id5 ?? null;
$admin_id6 = $admin_id6 ?? null;
$admin_id7 = $admin_id7 ?? null;
$admin_id8 = $admin_id8 ?? null;
$admin_id9 = $admin_id9 ?? null;
$admin_id10 = $admin_id10 ?? null;
//email check admin
$admin_email = $admin_email ?? null;
$admin_email2 = $admin_email2 ?? null;
$admin_email3 = $admin_email3 ?? null;
$admin_email4 = $admin_email4 ?? null;
$admin_email5 = $admin_email5 ?? null;
$admin_email6 = $admin_email6 ?? null;
$admin_email7 = $admin_email7 ?? null;
$admin_email8 = $admin_email8 ?? null;
$admin_email9 = $admin_email9 ?? null;
$admin_email10 = $admin_email10 ?? null;
//id check developer's
$developer_id = $developer_id ?? null;
$developer_id2 = $developer_id2 ?? null;
//email check developer's
$developer_email = $developer_email ?? null;
$developer_email2 = $developer_email2 ?? null;
//set up panel
$admin_panel = null;
$not_admin_panel = null;
$developer_panel = null;
//set up button's
$admin_button = '<a class="menu-link notify admin_control" href="#"><i class="fa fa-hand"></i></a>'; //кнопка для администраторов
$not_admin_button = '<a class="menu-link" href="#"><i style="color: #ea7e7e;" class="fa fa-hand"></i></a>'; //кнопка для пользователей
$developer_button = '';//кнопка для разработчика
//status profile
$status_profile = null;

//check admin's
if (
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id &&
        $user['email'] === $admin_email)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id2 &&
        $user['email'] === $admin_email2)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id3 &&
        $user['email'] === $admin_email3)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id4 &&
        $user['email'] === $admin_email4)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id5 &&
        $user['email'] === $admin_email5)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id6 &&
        $user['email'] === $admin_email6)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id7 &&
        $user['email'] === $admin_email7)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id8 &&
        $user['email'] === $admin_email8)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id9 &&
        $user['email'] === $admin_email9)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $admin_id10 &&
        $user['email'] === $admin_email10)
) {
    $admin_panel = $admin_button; //устанавиваем панель под администратора
    $status_profile = "[Admin]";
} else if (
    (isset($_SESSION['user']['id']) && $user['id'] === $developer_id &&
        $user['email'] === $developer_email)
    ||
    (isset($_SESSION['user']['id']) && $user['id'] === $developer_id2 &&
        $user['email'] === $developer_email2)
) {
    $admin_panel = $admin_button; //устанавиваем панель под администратора
    $status_profile = "[Developer]";
} else {
    $admin_panel = $not_admin_button; //устанавиваем панель под пользователя
    $status_profile = "[User]";
}


//--------- TEXT IN MENU PROFILS

$title7 = "";
$title7_self = "";

if (!isset($user['id'])) {
    $title7 = 'Авторизоваться';
    $title7_self = "regist/log-in.php";
} else {
    $title7 = "Личный кабинет";
    $title7_self = "regist/account.php";
}

//---------  BROATCHAST IN PROFILE

$count = ["", "", ""];
if ($turn[0] === "on" && ($turn[1] === "off" || $turn[1] === "") && ($turn[2] === "off" || $turn[2] === "")) {
    $count = [
        "$live",
        "",
        ""
    ];
} elseif ($turn[0] === "on" && $turn[1] === "on" && ($turn[2] === "off" || $turn[2] === "")) {
    $count = [
        "$live",
        "$live2",
        ""
    ];
} elseif ($turn[0] === "on" && $turn[1] === "on" && $turn[2] === "on") {
    $count = [
        "$live",
        "$live2",
        "$list"
    ];
} elseif ($turn[1] === "on" && $turn[2] === "on" && ($turn[0] === "off" || $turn[0] === "")) {
    $count = [
        "",
        "$live2",
        "$list"
    ];
} elseif ($turn[0] === "on" && $turn[2] === "on" && ($turn[1] === "off" || $turn[1] === "")) {
    $count = [
        "$live",
        "",
        "$list"
    ];
} elseif ($turn[1] === "on" && ($turn[2] === "off" || $turn[2] === "") && ($turn[0] === "off" || $turn[0] === "")) {
    $count = [
        "",
        "$live2",
        ""
    ];
} elseif ($turn[2] === "on" && ($turn[1] === "off" || $turn[1] === "") && ($turn[0] === "off" || $turn[0] === "")) {
    $count = [
        "",
        "",
        "$list"
    ];
}

if (
    $broadchast === "" or $broadchast ===
    "off"
) {
    $placat = ["", "", ""];
}
if ($broadchast === "on") {
    $placat = ["$count[0]", "$count[1]", "$count[2]"];
}

//---------  SEND PHP IN JS PASSWORD
if (!isset($_SESSION['user']['id'])) {
    $passsendphp_js = null;
    $psd = null;
    return false;
} else {
    $psd = pass_back($user["psd"]);

    $passsendphp_js = "
<script>
const pass = '" . pass_back($user["psd"]) . "'</script>";
}

//---------  BUTTON SEND EDITS MYSQL
if ((isset($user['id']) === "1" || isset($user['id']) === "2" && isset($user['email']) === "artemnersisyan777@gmail.com") || (isset($user['email']) === "timqwees@gmail.com" && isset($user['id']) === "1" || isset($user['id']) === "2")) {//admin

    $button_nickname = '<span class="content-button status-button open" id="reset">Без таймера</span>';

    $button_email = '<span class="content-button status-button-email open" id="resetemail">Без таймера</span>';

    $button_avatar = '<span class="content-button status-button-avatar open" id="reset_avatar">Без таймера</span>';

} else {//user
    $button_nickname = '';

    $button_email = '';

    $button_avatar = '';
}

//----------      ПРОВЕРКИ
if ($profile_index === "not" || "") {
    $profile_index = "/../404.php";
} else {
    $profile_index = $profile_index;
}
if ($profile_update === "not" || "") {
    $profile_update = "/../404.php";
} else {
    $profile_update = $profile_update;
}
if ($profile_donate === "not" || "") {
    $profile_donate = "/../404.php";
} else {
    $profile_donate = $profile_donate;
}
if ($profile_rules === "not" || "") {
    $profile_rules = "/../404.php";
} else {
    $profile_rules = $profile_rules;
}
if ($profile_ip === "not" || "") {
    $profile_ip = "/../404.php";
} else {
    $profile_ip = $profile_ip;
}
if ($profile_contract === "not" || "") {
    $profile_contract = "/../404.php";
} else {
    $profile_contract = $profile_contract;
}
if ($profile_fqa === "not" || "") {
    $profile_fqa = "/../404.php";
} else {
    $profile_fqa = $profile_fqa;
}
if ($profile_admin === "not" || "") {
    $profile_admin = "/../404.php";
} else {
    $profile_admin = $profile_admin;
}
if ($profile_developer === "not" || "") {
    $profile_developer = "/../404.php";
} else {
    $profile_developer = $profile_developer;
}


//-------- УВЕДОМЛЕНИЕ В ПРОФИЛЕ

$notification_profil = $notification_profil2 = $notification_profil3 = $notification_profil4 = $notification_profil5 = $notification_profil6 = $notification_profil7 = $notification_profil8 = $notification_profil9 =
    $notification_profil10 = "";

$up = "<span class='notification_mes'>" . $mes[0] . "</span>";
$up2 = "<span class='notification_mes'>" . $mes[1] . "</span>";
$up3 = "<span class='notification_mes'>" . $mes[2] . "</span>";
$up4 = "<span class='notification_mes'>" . $mes[3] . "</span>";
$up5 = "<span class='notification_mes'>" . $mes[4] . "</span>";
$up6 = "<span class='notification_mes'>" . $mes[5] . "</span>";
$up7 = "<span class='notification_mes'>" . $mes[6] . "</span>";
$up8 = "<span class='notification_mes'>" . $mes[7] . "</span>";
$up9 = "<span class='notification_mes'>" . $mes[8] . "</span>";
$up10 = "<span class='notification_mes'>" . $mes[9] . "</span>";
$no = "<i class='fa fa-ban disnot'></i>";

if ($nothave_profile[0] === '') {
    $notification_profil = '';
} elseif ($nothave_profile[0] === 'update') {
    $notification_profil = $up;//иконка обновления
} elseif ($nothave_profile[0] === 'not') {
    $notification_profil = $no;//уведомление
}

if ($nothave_profile[1] === '') {
    $notification_profil2 = '';
} elseif ($nothave_profile[1] === 'update') {
    $notification_profil2 = $up2;
} elseif ($nothave_profile[1] === 'not') {
    $notification_profil2 = $no;
}

if ($nothave_profile[2] === '') {
    $notification_profil3 = '';
} elseif ($nothave_profile[2] === 'update') {
    $notification_profil3 = $up3;
} elseif ($nothave_profile[2] === 'not') {
    $notification_profil3 = $no;
}
if ($nothave_profile[3] === '') {
    $notification_profil4 = '';
} elseif ($nothave_profile[3] === 'update') {
    $notification_profil4 = $up4;
} elseif ($nothave_profile[3] === 'not') {
    $notification_profil4 = $no;
}

if ($nothave_profile[4] === '') {
    $notification_profil5 = '';
} elseif ($nothave_profile[4] === 'update') {
    $notification_profil5 = $up5;
} elseif ($nothave_profile[4] === 'not') {
    $notification_profil5 = $no;
}

if ($nothave_profile[5] === '') {
    $notification_profil6 = '';
} elseif ($nothave_profile[5] === 'update') {
    $notification_profil6 = $up6;
} elseif ($nothave_profile[5] === 'not') {
    $notification_profil6 = $no;
}

if ($nothave_profile[6] === '') {
    $notification_profil7 = '';
} elseif ($nothave_profile[6] === 'update') {
    $notification_profil7 = $up7;
} elseif ($nothave_profile[6] === 'not') {
    $notification_profil7 = $no;
}

if ($nothave_profile[7] === '') {
    $notification_profil8 = '';
} elseif ($nothave_profile[7] === 'update') {
    $notification_profil8 = $up8;
} elseif ($nothave_profile[7] === 'not') {
    $notification_profil8 = $no;
}

if ($nothave_profile[8] === '') {
    $notification_profil9 = '';
} elseif ($nothave_profile[8] === 'update') {
    $notification_profil9 = $up9;
} elseif ($nothave_profile[8] === 'not') {
    $notification_profil9 = $no;
}

if ($nothave_profile[9] === '') {
    $notification_profil10 = '';
} elseif ($nothave_profile[9] === 'update') {
    $notification_profil10 = $up10;
} elseif ($nothave_profile[9] === 'not') {
    $notification_profil10 = $no;
}
?>