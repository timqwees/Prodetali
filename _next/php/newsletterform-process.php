<?php
$errorMSG = "";

if (empty($_POST["email"])) {
    $errorMSG = "Пожалуйста, заполните поле почты ";
} else {
    $email = $_POST["email"];
}

if (empty($_POST["terms"])) {
    $errorMSG = "Terms is required ";
} else {
    $terms = $_POST["terms"];
}

$EmailTo = "yourname@domain.com";
$Subject = "Новая подписка на новости";

// prepare email body text
$Body = "";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Terms: ";
$Body .= $terms;
$Body .= "\n";

// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);

// redirect to success page
if ($success && $errorMSG == ""){
   echo "Успешно!";
}else{
    if($errorMSG == ""){
        echo "Что-то пошло не так! Пожалуйста, обратитесь в поддержку";
    } else {
        echo $errorMSG;
    }
}
?>