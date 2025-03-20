const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const emailMessage = document.getElementById("email_message");
const passwordMessage = document.getElementById("password_message");
const dater = document.querySelector(".dater");

// Проверка наличия email
function checkEmail() {
    const email = emailInput.value;

    if (!email) {
        email_message.innerHTML = "<p class='mess_check' ><span class='numeric'>1</span> Введите данные в поле почты!<i class='fa fa-warning bad_icon'></i></p>";
        return;
    }

    fetch(`login.php?action=check_email&email=${email}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                email_message.innerHTML = `<p class='mess_check' ><span class='numeric'>1</span> Почта: <font class='godowod'>${email}</font><i class='fa fa-user-lock god_icon'></i></p>`;
            } else {
                email_message.innerHTML = `<p class='mess_check'><span class='numeric'>1</span> Почта: <font class='notowod'>${email}</font><i class='fa fa-magnifying-glass bad_icon'></i> не зарегистрированна!</p>`;
            }
        })
        .catch(error => {
            console.error("Ошибка:", error);
            email_message.innerHTML = `<p class='mess_check'>Произошла ошибка <font class='notowod'>[G.R.S.W_ERROR::101]</font> <i class='fa fa-wifi bad_icon'></i> проверки почты!</p>`;
        });
}

// Проверка пароля
function checkPassword() {
    const password = passwordInput.value;
    const email = emailInput.value;

    if (!password) {
        password_message.innerHTML = `<p class='mess_check' ><span style='margin-right: 7px' class='numeric'>2</span>Введите данные в поле пароля! <i class='fa fa-warning bad_icon'></i></p>`;
        disableDater();
        return;
    }

    fetch(`login.php?action=check_password&email=${email}`)
        .then(response => response.json())
        .then(data => {
            if (!data.find) {
                password_message.innerHTML = `<p class='mess_check' ><span style='margin-right: 7.5px' class='numeric'>2</span>Пароль: <font class='notowod'>Профиль не найден!<i class='fa fa-hand bad_icon'></i></font></p>`;
                disableDater();
                return;
            }

            if (password !== data.password) {
                password_message.innerHTML = `<p class='mess_check' ><span class='numeric'>2</span> Пароль: <font class='notowod'>${password}</font><i class='fa fa-magnifying-glass bad_icon'></i> не верный!</p>`;
                disableDater();
                return;
            }

            // Включаем доступ только если почта существует И пароль совпадает
            if (password === data.password) {
                passwordMessage.innerHTML = `<p class='mess_check'><span class='numeric'>2</span> Пароль: <font class='godowod'>${password}</font><i class='fa fa-key god_icon'></i></p>`;
                enableDater();
            } else {
                disableDater(); // Гарантируем, что dater останется отключенным при неверном пароле
            }
        })
        .catch(error => {
            console.error("Ошибка:", error);
            password_message.innerHTML = `<p class='mess_check'>Произошла ошибка <font class='notowod'>[G.R.S.W_ERROR::102]</font> <i class='fa fa-wifi bad_icon'></i> если ошибка повториться обратитесь в <a href='https://vk.com/greamsrp' style='color:#FF6963;opacity: 0.9;text-decoration: underline;font-weight: 700;'>поддержку!</a></p>`;
            disableDater();
        });
}


// Функция для отключения элемента dater
function disableDater() {
    if (dater.hasAttribute("disabled")) {
        return;
    }

    dater.setAttribute("disabled", true);
    dater.classList.add("dater");
}

// Функция для включения элемента dater
function enableDater() {
    if (!dater.hasAttribute("disabled")) {
        return;
    }

    dater.removeAttribute("disabled");
    dater.classList.remove("dater");
}