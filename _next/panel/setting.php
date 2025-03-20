<?php
/** СТРУКТУРА ПОДКЛЮЧЕНИЯ **/
require_once __DIR__ . '/../php/src/helpers.php';
$user = currentUser();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


/** НАСТРОЙКА ССЫЛОК МЕНЮ **/

// главная
$bagus = "/../../index.php";
//црс
$fqa = "#";
//О политехе
$title_self = "#";
//пусто
$title1_self = "#";
//пусто
$title2_self = "";
// мероприятия
$title3_self = "#";
//для студентов
$title4_self = "#";
//пусто
$title5_self = "#";
//пусто
$title6_self = "#";

/** НАСТРОЙКА НАЗВАНИЙ МЕНЮ **/

//ГЛАВНОЕ МЕНЮ
$title = "— Объявления";
//ИНФОРМАЦИЯ
$title1 = "— Исполнители";
//ДОНАТЫ
$title2 = "Услуги";
//ПРАВИЛА
$title3 = "О нас";
//ПОД РАЗМЫШЛЕНИЕ
$title4 = "Чат";
//ЗАГРУЗКИ
$title5 = "";
//НАСТРОЙКИ
$title6 = "";
//Обращение
$title11 = "";
//Заключение договора
$title8 = "";
//FQA
$title9 = "";
//Исправление ошибок
$title10 = "";


/** УВЕДОМЛЕНИЯ В МЕНЮ **/

/**
 * ['not'] => закрыт;
 * ['update'] => обновлён;
 * [''] => без уведомления;
 * ------------------------
 * 0 => Вернуться;
 * 1 => INFO контент;
 * 2 => Донаты;
 * 3 => Правила;
 * 4 => Скоро;
 * 5 => Загрузки;
 * 6 => Настройки;
 * 7 => Личный кабинет;
 * 8 => FQA;
 * 9 => Исправление ошибок;
 * 10 => Заключение договора;
 * 11 => Обращение;
 **/

$nothave = [
    '',/* Вернуться */         /*#0*/
    '',/* INFO контент */   /*#1*/
    '',/* Донаты */         /*#2*/
    '',/* Правила */        /*#3*/
    '',/* Скоро */       /*#4*/
    '',/* Загрузки */       /*#5*/
    '',/* Настройки */         /*#6*/
    '',/* Личный кабинет*/     /*#7*/
    '',/* FQA */            /*#8*/
    '',/* Баги */            /*#9*/
    '',/* Обращение */        /*#10*/
    ''/* Договор */       /*#11*/
];


/** КОЛИЧЕСТВО УВЕДОМЛЕНИЙ В МЕНЮ **/

/** Указываем цифры в массие для отображения количество обновлений **/

$notification = [
    "0",/* Вернуться */         /*#0*/
    "0",/* INFO контент */   /*#1*/
    "0",/* Донаты */         /*#2*/
    "0",/* Правила */        /*#3*/
    "0",/* Скоро */       /*#4*/
    "0",/* Загрузки */       /*#5*/
    "0",/* Настройки */         /*#6*/
    "0",/* Личный кабинет*/     /*#7*/
    "0",/* FQA */            /*#8*/
    "0",/* Баги */            /*#9*/
    "0",/* Обращение */        /*#10*/
    "0"/* Договор */       /*#11*/
];

/** СИСТЕМА ВЫВОДА ПЛАКАТОВ **/

//ПЛАКАТЫ
$p = "<div class='content-wrapper-header'>
<div class='content-wrapper-context'>
<h3 class='img-content' style='color: white !important'>
<img src=' /../images/logo/project_logo_technologies_of_the_future.png'></img>
День открытых дверей Политеха!
</h3>
<div class='content-text'>
20 и 18 января в Московском Политехе пройдет первый в новом году очный День открытых дверей в главном корпусе на Большой Семеновской.
</div>
<a href='https://mospolytech.ru/postupayushchim/dni-otkrytykh-dverey/'>
<button class='content-button'>Подробнее</button></a>
</div>
<img class='content-wrapper-img' src='https://assets.codepen.io/3364143/glass.png' alt=''>
</div>";


/** LIVE ВЫВОД ОДИНАРНЫХ ПЛАКАТОВ **/

//ГЛАВНАЯ СТРАНИЦА [ПОД ВЫБОР ПЛАКАТА]
$live = "$p";

//НАСТРОЙКИ ПРОФИЛЯ [ПОД ВЫБОР ПЛАКАТА]
$live2 = "";


/** LIVE ВЫВОД ВСЕХ ПЛАКАТОВ **/

//СОБЫТИЯ
$list = "$p";


/** 
 * "on" => Включение плаката на странице
 * "off" or "" => Не показывает плакат **/
$turn = [
    "off",/*Главная страница*/
    "off",/*Настройки*/
    "on"/*События*/
];


/** УВЕДОМЛЕНИЯ В МЕНЮ PROFILE **/

/**
 * ['not'] => закрыт;
 * ['update'] => обновлён;
 * [''] => без уведомления;
 * ------------------------
 * 0 => На главну;
 * 1 => Обновление;
 * 2 => Донаты;
 * 3 => Правила;
 * 4 => IP/PORT;
 * 5 => FQA;
 * 6 => Сотрудничество;
 * 7 => Поддержка;
 * 8 => ВК;
 **/
$nothave_profile = [
    "",/* На главную */         /*#0*/
    "not",/* Обновления */      /*#1*/
    "",/* MosPolytech */        /*#2*/
    "",/* Поступающим */        /*#3*/
    "",/* Щколам */             /*#4*/
    "",/* FQA */                /*#5*/
    "",/* црс */                /*#6*/
    "",/* Поддержка*/           /*#7*/
    "",/* ВК политеха */        /*#8*/
    ""/* ADMIN */               /*#9*/
];

/** КОЛИЧЕСТВО УВЕДОМЛЕНИЙ В ПРОФИЛЕ **/

/** Указываем цифры в массие для отображения количества **/

$mes = [
    "0",/* На главную */      /*#0*/
    "0",/* Обновления */      /*#1*/
    "0",/* MosPolytech */     /*#2*/
    "0",/* Поступающим */     /*#3*/
    "0",/* Щколам */          /*#4*/
    "0",/* FQA */             /*#5*/
    "0",/* црс */             /*#6*/
    "0",/* Поддержка*/        /*#7*/
    "0",/* ВК политеха */     /*#8*/
    ""/* ADMIN */             /*#9*/
];

/** МЕНЮ РАЗДЕЛЫ ПРОФИЛЯ [ССЫЛКИ]**/

/**
 * "not" or "" => на страницу 404 
 * **/

$profile_index = "/../index.php"; //главная страница
$profile_update = "not";//обновления
$profile_donate = "https://mospolytech.ru/";//mospolytech
$profile_rules = "https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/";//поступающим
$profile_ip = "https://mospolytech.ru/postupayushchim/dni-otkrytykh-dverey/";//школам
$profile_contract = "https://mospolytech.ru/postupayushchim/priem-v-universitet/faq/";//fqa
$profile_fqa = "https://mospolytech.ru/obuchauschimsya/mnogofunkcionalnyy-centr/";//црс
$profile_support = "https://mospolytech.ru/ob-universitete/adresa-i-kontakty/";//поддержка
$profile_regist = "/regist/sign-up.php";//регистрация
$profile_admin = "";//админ
$profile_developer = "";//разработчик

/** РЕЗЕРФОР ПЛАКАТА
 
   "on" => on placat
   "off" => off placat
**/
$broadchast = "on";


/** ADMIN GROUP MEMBERS 11 COUNT **/

//TIM QWEES
$admin_id = null; //используем int
$admin_email = '';//используем string

// //2
// $admin_id = 4; //используем int
// $admin_email = 'timqwees@gmail.com';//используем string

// //3
// $admin_id = 4; //используем int
// $admin_email = 'timqwees@gmail.com';//используем string


/** DEVELOPER GROUP MEMBER 2 COUNT **/

//TIM QWEES
$developer_id = 1;//используем int
$developer_email = "timqwees@gmail.com";//используем string

/** ОБНОВЛЕНИЕ ТЕКСТА КОНТЕНТА ВК **/

//ОБНОВЛЕНИЯ 
$content_1 = "До нового поста <span style='background: #64b3f4;padding: 3px;margin: 3px;border-radius: 5px;font-size: 12px;font-weight: 700'>VK</span> осталось :";

//БЕЗ ОБНОВЛЕНИЙ
$content_2 = "Ближайшие новости <span style='background: rgb(255,105,99);border-radius: 5.5px;padding: 0px 3px 2px 3px;font-weight:600;color: white;font-family: 'CoFo Sans;'>отсувствуют</span>";


/** ПЕРЕКЛЮЧАТЕЛЬ UPDATE ТЕКСТА ВК **/

//текст обновления
$content_vk = [
    'on',//content_1 [on/""]
    'off'//content_2 [on/""]
];


//ВРЕМЯ ОБНОВЛЕНИЯ КОНТЕНТА
//(год-месяц-день час:минута:секунда)
/** 
 * 1 Январь
 * 2 Февраль
 * 3 Март
 * 4 Апрель
 * 5 Май
 * 6 Июнь
 * 7 Июль
 * 8 Август
 * 9 Сентябрь
 * 10 Октябрь
 * 11 Ноябрь
 * 12 Декабрь
$endDate_start = 'год-месяц-деньTчас:мин:сек';*/
$endDate_start = '2024-09-30T13:10:00';
/** ПЕРЕКЛЮЧАТЕЛЬ ВРЕМЕНИ ОБВНОВЛЕНИЯ **/

//время обновения
$content_time = [
    'on',//$endDate_start [on/""]
    'off'//off [on/"off"]
];


/**
 * FORM CONTROL AND SETTING FULL WEB-INTERFEIS AND ACCOUNTS
 * AUTHOR HTTPS://T.ME/TIMQWEES
 * THE BIG TIMQWEES-STUDIO
 * SYSTEM SETTING YOUR WEB-INTERFEIS
 **/
?>