document.addEventListener("DOMContentLoaded", function() {
  const turnElement = document.querySelector('.turn');
  const turn = turnElement.value;
  //timeout elements
  const checkbox_element = document.getElementById('terms');
  const send_email = document.getElementById('send_email');
  const sql_send_date = document.getElementById('sql_send_date');
  const traker_window = document.getElementById('traker_window');
  const informationSection = document.querySelector('.information');
  const codeemailSection = document.querySelector('.codeemail');
 //timer
const bloctime = document.getElementById("bloctime");
const inform = document.getElementById("inform");
const ti = document.getElementById("ti");
const date_reg = document.querySelector(".dater_1");
const date = document.querySelector(".dater");
const title = document.getElementById("title_timer");
const message = document.getElementById("message_timer");

let timerInterval;
let now;
let endDate;
let duration;

function resetTime(newDuration) {
  clearInterval(timerInterval);
  now = new Date().getTime();
  endDate = now + newDuration * 1000;
  duration = newDuration;
  startTimer();
}

function resetTimeBlock(newDuration) {
  clearInterval(timerInterval);
  now = new Date().getTime();
  endDate = now + newDuration * 1000;
  duration = newDuration;
  startTimerBlock();
}

function updateTimer() {
  now = new Date().getTime();
  const timeLeft = endDate - now;

  if (timeLeft < 0) {
    clearInterval(timerInterval);
    document.getElementById('minutes').textContent = '0';
    document.getElementById('seconds').textContent = '0';
    return;
  }

  const minutes = Math.floor(timeLeft / (1000 * 60));
  const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

  document.getElementById('minutes').textContent = minutes;
  document.getElementById('seconds').textContent = seconds;
}

function updateTimerBlock() {
  now = new Date().getTime();
  const timeLeft = endDate - now;

  if (timeLeft < 0) {
    clearInterval(timerInterval);
    document.getElementById('minutes').textContent = '0';
    document.getElementById('seconds').textContent = '0';
    window.location.href = "traker.php";
    return;
  }

  const minutes = Math.floor(timeLeft / (1000 * 60));
  const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

  document.getElementById('minutes').textContent = minutes;
  document.getElementById('seconds').textContent = seconds;
}

function startTimer() {
  timerInterval = setInterval(updateTimer, 1000);
}
function startTimerBlock() {
  timerInterval = setInterval(updateTimerBlock, 1000);
}

//запуск 5м2c
resetTime(302);

  if (turn === "true") {
    setTimeout(() => {
    //checkbox
    checkbox_element.setAttribute('disabled', 'true');
    checkbox_element.style.display = "none";
    //button send email
    send_email.setAttribute('disabled', 'true');
    send_email.classList.add('disabled-button-input');
    //send mysql date-base
    sql_send_date.setAttribute('disabled', 'true');
    sql_send_date.classList.add('disabled-button-input');
    //close window
      informationSection.classList.add('transition');
      codeemailSection.classList.add('transition');
      traker_window.classList.add('full');
      informationSection.classList.remove('full');
      codeemailSection.classList.remove('full');
      traker_window.classList.remove('transition');
    //timer
    bloctime.classList.add("bloctime_red");
    inform.classList.add("inform_red");
    ti.classList.add("ti_red");
    date_reg.classList.add("date_reg_red1");
    date_reg.classList.remove("date_reg");
    date.classList.add("mes");
    date.classList.add("date_reg_red");
    date.classList.remove("date");
    title.textContent = "GREMSW_UPDATE";
    message.textContent = "До обновления осталось:";
    //send the bew window traker
    resetTimeBlock(62);
    turnElement.value = "STOP";
    }, 302 * 1000);//время сессии
  }
});

document.addEventListener("DOMContentLoaded", function() {
  const emailInput = document.getElementById('email');
  const messageElement = document.getElementById('email-message');
  const ok = document.getElementById('ok');
  const load = document.getElementById('load');
  const not = document.getElementById('not');
  const valid = document.getElementById('valid');
  const validator = document.getElementById('validator');
  const checkbox_element = document.getElementById('terms');
  let allFilled = false;

  messageElement.style.display = "flex";
  ok.style.display = "none";
  valid.style.display = "none";
  load.style.display = "flex";
  not.style.display = "none";
  validator.style.display = "none";
  checkbox_element.style.display = "none";

  emailInput.addEventListener('input', function() {
    const email = emailInput.value;
    const atIndex = email.indexOf("@");
    const dotIndex = email.lastIndexOf(".");
    const domain = email.substring(atIndex + 1, dotIndex);

    // Отправка запроса на сервер для проверки email
    const formData = new FormData();
    formData.append('email', email);

    fetch('a.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
    
if (domain === "" && !(email === "")) {
    ok.style.display = "none";
    load.style.display = "none";
    not.style.display = "none";
    validator.style.display = "none";
    valid.style.display = "flex";
    checkbox_element.setAttribute('disabled', 'true');
    checkbox_element.style.display = "none";
}

if (!(email.includes("@")) && !(email === "")) {
    ok.style.display = "none";
    load.style.display = "none";
    not.style.display = "none";
    valid.style.display = "none";
    validator.style.display = "flex";
    checkbox_element.setAttribute('disabled', 'true');
    checkbox_element.style.display = "none";
    return;
}
    if (!(atIndex !== -1 && dotIndex > atIndex && dotIndex !== email.length - 1)  && !(email === "")) {//валидатор
ok.style.display = "none";
load.style.display = "none";
not.style.display = "none";
validator.style.display = "none";
valid.style.display = "flex";
checkbox_element.setAttribute('disabled', 'true');
checkbox_element.style.display = "none";
return;
    }
    if (domain.length === 1 && !(email === "")) {
    // Если домен отсутствует, то показываем сообщение об ошибке
    ok.style.display = "none";
    load.style.display = "none";
    not.style.display = "none";
    valid.style.display = "flex";
    validator.style.display = "none";
    checkbox_element.setAttribute('disabled', 'true');
    checkbox_element.style.display = "none";
    }
    if (!(email.includes("@")) && !(email === "")) {//валидатор
ok.style.display = "none";
load.style.display = "none";
not.style.display = "none";
valid.style.display = "none";
validator.style.display = "flex";
checkbox_element.setAttribute('disabled', 'true');
checkbox_element.style.display = "none";
return;
    } 
    if (email.trim() === '') {//пусто
ok.style.display = "none";
load.style.display = "flex";
not.style.display = "none";
valid.style.display = "none";
validator.style.display = "none";
checkbox_element.setAttribute('disabled', 'true');
checkbox_element.style.display = "none";
return;
    }
    if (data.exists) {//занят
ok.style.display = "none";
load.style.display = "none";
not.style.display = "flex";
allFilled = false;
valid.style.display = "none";
validator.style.display = "none";
checkbox_element.setAttribute('disabled', 'true');
checkbox_element.style.display = "none";
return;
    } else {//свободен
ok.style.display = "flex";
load.style.display = "none";
not.style.display = "none";
valid.style.display = "none";
checkbox_element.style.display = "flex";
validator.style.display = "none";
return;
        
    }
    })
    .catch(error => {
        console.error(error);
    });
  });
  
        const form = document.querySelector('form');
        const ddd = document.getElementById('see');
        const submitButton = document.getElementById('send_email');
        const inputs = form.querySelectorAll('input');
        const checkbox = form.querySelector('input[type="checkbox"]');
        
  inputs.forEach(input => {
    input.addEventListener('input', checkInputs);
  });

  checkbox.addEventListener('change', checkInputs);

  form.addEventListener('submit', function(event) {
    if (!checkbox.checked) {
      event.preventDefault();
    }
  });

    const passwordInput = document.getElementById('password');
    const passwordLengthMessage = document.getElementById('password_length_message');

    passwordInput.addEventListener('input', function() {
        const password = passwordInput.value;
        
if (password.length < 6) {
            passwordLengthMessage.innerHTML = "<span style='font-size: 10px' class='mestext'>Пароль должен содержать не менее [<font color='red'>6 символов</font>]</span>";
            passwordLengthMessage.style.display = 'flex';
allFilled = false;
checkbox_element.setAttribute('disabled', 'true');
} else if (password.length > 40) {
            passwordLengthMessage.innerHTML = "<span class='mestext'style='font-size: 10px'>Пароль должен содержать не менее [<font color='red'>40 символов</font>]</span>";
            passwordLengthMessage.style.display = 'flex';
allFilled = false;
checkbox_element.setAttribute('disabled', 'true');
} else {
            passwordLengthMessage.style.display = 'none';
allFilled = true;
checkbox_element.removeAttribute('disabled');
        }
    });

        function checkInputs() {
            inputs.forEach(input => {
                if (input.getAttribute('type') !== 'checkbox') {
                    if (input.value.trim() === '') {
                        allFilled = false;
                    }
                }
            });

            if (allFilled && checkbox.checked) {
                submitButton.removeAttribute('disabled', 'false');
                ddd.classList.remove('disabled-button');
                submitButton.classList.remove('disabled-button-input');
            } else {
                submitButton.setAttribute('disabled', 'true');
                ddd.classList.add('disabled-button');
                submitButton.classList.add('disabled-button-input');
            }
        }
});
/* windows change */

// Получаем все элементы с классом main-header-link
const mainHeaderLinksr = document.querySelectorAll('.main-header-link-reg');

// Получаем контентные блоки с классами "information" и "codeemail"
const informationSection = document.querySelector('.information');
const codeemailSection = document.querySelector('.codeemail');

// Добавляем обработчик событий на каждую ссылку в меню
mainHeaderLinksr.forEach((link, index) => {
  link.addEventListener('click', () => {
    // Добавляем класс "transition" к обоим блокам, чтобы запустить анимацию
    informationSection.classList.add('transition');
    codeemailSection.classList.add('transition');

    // Показываем нужный контентный блок в зависимости от выбранной ссылки
    if (index === 0) { // INFO
      informationSection.classList.remove('transition');
      informationSection.classList.add('full');
      codeemailSection.classList.remove('full');
      codeemailSection.classList.add('transition');
    } else if (index === 1) { // EMAIL
      informationSection.classList.add('transition');
      informationSection.classList.remove('full');
      codeemailSection.classList.remove('transition');
      codeemailSection.classList.add('full');
    }
  });
});


// ПРОВЕРКА КОДА
document.addEventListener("DOMContentLoaded", function() {
    const CodeInput = document.getElementById('CHECK_CODE');
    const messageElement_code = document.getElementById('message_code');
    const ok_code = document.getElementById('ok_code');
    const not_code = document.getElementById('not_code');
    const dont_code = document.getElementById('dont_code');
    const sql_send_date = document.getElementById('sql_send_date');

    let Fill = false;

    sql_send_date.setAttribute('disabled', 'true');
    sql_send_date.classList.add('disabled-button-input');
    ok_code.style.display = "none";
    not_code.style.display = "none";
    dont_code.style.display = "flex";

    CodeInput.addEventListener('input', function() {
        const code = CodeInput.value;

        messageElement_code.style.display = "flex";

        if (code.trim() === '') {
            ok_code.style.display = "none";
            not_code.style.display = "none";
            dont_code.style.display = "flex";

            Fill = false;
        } else {
            fetch('server.php?code=' + encodeURIComponent(code))
                .then(response => response.json())
                .then(data => {
                    if (data.isValid) {
                        ok_code.style.display = "flex";
                        dont_code.style.display = "none";
                        sql_send_date.removeAttribute('disabled');
                        sql_send_date.classList.remove('disabled-button-input');
                        not_code.style.display = "none";
                        Fill = true;
                    } else {
                        dont_code.style.display = "none";
                        ok_code.style.display = "none";
                        not_code.style.display = "flex";
                        sql_send_date.setAttribute('disabled', 'true');
                        sql_send_date.classList.add('disabled-button-input');
                        Fill = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    // Fetching a new code from the server
    fetch('server.php')
        .then(response => response.json())
        .then(data => {
            // Не отображаем код в input
        })
        .catch(error => {
            console.error('Error:', error);
        });
});