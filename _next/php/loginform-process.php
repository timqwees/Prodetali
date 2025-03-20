<?php
$errorMSG = "";

if (empty($_POST["email"])) {
    $errorMSG = "Пожалуйста, заполните поле почты ";
} else {
    $email = $_POST["email"];
}

if (empty($_POST["password"])) {
    $errorMSG = "Пожалуйста, заполните поле пароля ";
} else {
    $password = $_POST["password"];
}

$EmailTo = "yourname@domain.com";
$Subject = "Новый профиль на Gream's World";

// prepare email body text
$Body = "";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Password: ";
$Body .= $password;
$Body .= "\n";

// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);
// redirect to success page
if ($success && $errorMSG == ""){
   echo "Успешно!";
}else{
    if($errorMSG == ""){
        echo "Что-то пошло не так, обратитесь в поддержку!";
    } else {
        echo $errorMSG;
    }
}
?>