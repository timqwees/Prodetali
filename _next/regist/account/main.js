$(function () {
    $(".menu-link").click(function () {
     $(".menu-link").removeClass("is-active");
     $(this).addClass("is-active");
    });
   });
   
   $(function () {
    $(".main-header-link").click(function () {
     $(".main-header-link").removeClass("is-active");
     $(this).addClass("is-active");
    });
   });
   
   const dropdowns = document.querySelectorAll(".dropdown");
   dropdowns.forEach((dropdown) => {
    dropdown.addEventListener("click", (e) => {
     e.stopPropagation();
     dropdowns.forEach((c) => c.classList.remove("is-active"));
     dropdown.classList.add("is-active");
    });
   });
   
   $(".search-bar input")
    .focus(function () {
     $(".header").addClass("wide");
    })
    .blur(function () {
     $(".header").removeClass("wide");
    });
   
   $(document).click(function (e) {
    var container = $(".status-button");
    var dd = $(".dropdown");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
     dd.removeClass("is-active");
    }
   });
   
   $(function () {
    $(".dropdown").on("click", function (e) {
     $(".content-wrapper").addClass("overlay");
     e.stopPropagation();
    });
    $(document).on("click", function (e) {
     if ($(e.target).is(".dropdown") === false) {
      $(".content-wrapper").removeClass("overlay");
     }
    });
   });
   
   $(function () {
    $(".status-button:not(.open)").on("click", function (e) {
     $(".overlay-app").addClass("is-active");
    });
    $(".pop-up .close").click(function () {
     $(".overlay-app").removeClass("is-active");
    });
   });
   
   $(".status-button:not(.open)").click(function () {
    $(".pop-up").addClass("visible");
   });
   
   $(".pop-up .close").click(function () {
    $(".pop-up").removeClass("visible");
   });
   
 //avatar
 
    $(function () {
    $(".status-button-avatar:not(.open)").on("click", function (e) {
     $(".overlay-app").addClass("is-active");
    });
    $(".pop-up-avatar .close").click(function () {
     $(".overlay-app").removeClass("is-active");
    });
   });
   
   $(".status-button-avatar:not(.open)").click(function () {
    $(".pop-up-avatar").addClass("visible");
   });
   
   $(".pop-up-avatar .close").click(function () {
    $(".pop-up-avatar").removeClass("visible");
   });
   
   const toggleButton = document.querySelector('.form-check');
   
   toggleButton.addEventListener('click', () => {
     document.body.classList.toggle('light-mode');
   });
   
 //email
 
   $(function () {
    $(".status-button-email:not(.open)").on("click", function (e) {
     $(".overlay-app").addClass("is-active");
    });
    $(".pop-up-email .close").click(function () {
     $(".overlay-app").removeClass("is-active");
    });
   });
   
   $(".status-button-email:not(.open)").click(function () {
    $(".pop-up-email").addClass("visible");
   });
   
   $(".pop-up-email .close").click(function () {
    $(".pop-up-email").removeClass("visible");
   });
   
   
 //password
 
   $(function () {
    $(".status-button-password:not(.open)").on("click", function (e) {
     $(".overlay-app").addClass("is-active");
    });
    $(".pop-up-password .close").click(function () {
     $(".overlay-app").removeClass("is-active");
    });
   });
   
   $(".status-button-password:not(.open)").click(function () {
    $(".pop-up-password").addClass("visible");
   });
   
   $(".pop-up-password .close").click(function () {
    $(".pop-up-password").removeClass("visible");
   });
  
        

const checkboxes = document.querySelectorAll('.checkbox');
const errorMessage = document.getElementById('errorMessage');
const resetTimerButton = document.getElementById('reset');/*очищаем все таймеры*/
var timerButton = document.getElementById('timer_return_send');
var button = document.getElementById('send');
let timerId;
let timeLeft = 60 * 60 * 25; // Time in seconds
//-----------------------------------------
const resetTimerButton_avatar = document.getElementById('reset_avatar');/*очищаем все таймеры*/
var button_avatar = document.getElementById('send_avatar');
const errorMessage_avatar = document.getElementById('errorMessage_avatar');
const errorMessage_avatar2 = document.getElementById('errorMessage_avatar1');

const checkboxes_avatar = document.querySelectorAll('.checkbox_avatar');
var timerButton_avatar = document.getElementById('timer_return_send_avatar');
let timerId_avatar;
let timeLeft_avatar = 60 * 60 * 25; // Time in seconds
//-----------------------------------------email
const resetemail = document.getElementById('resetemail');
var button_email = document.getElementById('send_email');
const errorMessage_email = document.getElementById('errorMessage_email');
const checkboxes_email = document.querySelectorAll('.checkbox_email');
var timerButton_email = document.getElementById('timer_return_send_email');
let timerId_email;
let timeLeft_email = 60 * 60 * 25; // Time in seconds
//-----------------------------------------password
const resetpassword = document.getElementById('resetpassword');
var button_password = document.getElementById('send_password');
const errorMessage_password = document.getElementById('errorMessage_password');
const checkboxes_password = document.querySelectorAll('.checkbox_password');
var timerButton_password = document.getElementById('timer_return_send_password');
let timerId_password;
let timeLeft_password = 60 * 60 * 25; // Time in seconds

function formatTime(seconds) {
  const days = Math.floor(seconds / (24 * 60 * 60));
  const remainingSeconds = seconds % (24 * 60 * 60);
  const minutes = Math.floor(remainingSeconds / 60);
  const remainingMinutes = remainingSeconds % 60;

  return `${days} д ${minutes} мин ${remainingMinutes} с`;
}

//СТРУКТУРА ЗАПУСКА ТАЙМЕРА
function startTimer() {
  timerButton.textContent = `Повторное изменение через ${formatTime(timeLeft)}`;

  timerId = setInterval(() => {
    timeLeft--;
    timerButton.textContent = `Повторное изменение через ${formatTime(timeLeft)}`;
    saveTime();
    if (timeLeft === 0) {
      clearInterval(timerId);
      timerButton.textContent = `Принимаю повторное изменение через 1 д 60 мин 0 с`;
      timeLeft = 60 * 60 * 25;
      button.style.display = "flex";
      button.removeAttribute('disabled');
      localStorage.removeItem('timeLeft');
      event.defaultPrevented = false;
    } else {
      event.preventDefault();
      button.setAttribute('disabled', 'true');
      button.style.display = "none";
      localStorage.setItem('timeLeft', timeLeft);
    }
  }, 1000);
}

//email
function startTimerEmail() {
  timerButton_email.textContent = `Повторное изменение через ${formatTime(timeLeft_email)}`;/*запускаем все таймеры*/    event.returnValue = true;

  timerId_email = setInterval(() => {
    timeLeft_email--;
    saveTimeEmail();
    timerButton_email.textContent = `Повторное изменение через ${formatTime(timeLeft_email)}`;

    if (timeLeft_email === 0) {
      clearInterval(timerId_email);
      timerButton_email.textContent = `Принимаю повторное изменение через 1 д 60 мин 0 с`;
      timeLeft_email = 60 * 60 * 25;
      
      button_email.style.display = "flex";
      button_email.removeAttribute('disabled');
      localStorage.removeItem('timeLeft_email');
      event.defaultPrevented = false;
    } else {
    event.preventDefault();
      button_email.setAttribute('disabled', 'true');
      
      button_email.style.display = "none";
      localStorage.setItem('timeLeft_email', timeLeft_email);
    }
  }, 1000);
}

//СТРУКТУРА ЗАПУСКА ТАЙМЕРА
function startTimerPassword() {
  timerButton_password.textContent = `Повторное изменение через ${formatTime(timeLeft_password)}`;/*запускаем все таймеры*/
  event.returnValue = true;

  timerId_password = setInterval(() => {
    timeLeft_password--;
    saveTimePassword();
    timerButton_password.textContent = `Повторное изменение через ${formatTime(timeLeft_password)}`;

    if (timeLeft_password === 0) {
      clearInterval(timerId_password);
      timerButton_password.textContent = `Принимаю повторное изменение через 1 д 60 мин 0 с`;
      timeLeft_password = 60 * 60 * 25;
      
      button_password.style.display = "flex";
      button_password.removeAttribute('disabled');
      localStorage.removeItem('timeLeft_password');
      event.defaultPrevented = false;
    } else {
    event.preventDefault();
      
      button_password.style.display = "none";
      button_password.setAttribute('disabled', 'true');
      localStorage.setItem('timeLeft_password', timeLeft_password);
    }
  }, 1000);
}

//avatar
function startTimeravatar() {
  timerButton_avatar.textContent = `Повторное изменение через ${formatTime(timeLeft_avatar)}`;/*запускаем все таймеры*/

  timerId_avatar = setInterval(() => {
    timeLeft_avatar--;
    saveTimeavatar();
    timerButton_avatar.textContent = `Повторное изменение через ${formatTime(timeLeft_avatar)}`;

    if (timeLeft_avatar === 0) {
      clearInterval(timerId_avatar);
      timerButton_avatar.textContent = `Принимаю повторное изменение через 1 д 60 мин 0 с`;
      timeLeft_avatar = 60 * 60 * 25;
      
      button_avatar.style.display = "none";
      button_avatar.removeAttribute('disabled');
      localStorage.removeItem('timeLeft_avatar');
      event.defaultPrevented = false;
    } else {
    event.preventDefault();
      
      button_avatar.style.display = "none";
      button_avatar.setAttribute('disabled', 'true');
      localStorage.setItem('timeLeft_avatar', timeLeft_avatar);
    }
  }, 1000);
}

//СТРУКТУРА СБРОСА ТАЙМЕРА
function resetTimer() {
  clearInterval(timerId);
  timeLeft = 60 * 60 * 25;
  button.style.display = "flex";
  
  timerButton.textContent = 'Принимаю повторное изменение через 1 д 60 мин 0 с';
  button.removeAttribute('disabled');
  event.defaultPrevented = false;
  localStorage.removeItem('timeLeft');
}

//avatar
function resetTimeravatar() {
  clearInterval(timerId_avatar);
  timeLeft_avatar = 60 * 60 * 25;
  button_avatar.style.display = "flex";
  
  timerButton_avatar.textContent = 'Принимаю повторное изменение через 1 д 60 мин 0 с';
  button_avatar.removeAttribute('disabled');
  event.defaultPrevented = false;
  localStorage.removeItem('timeLeft_avatar');
}

//email
function resetTimerEmail() {
  clearInterval(timerId_email);
  timeLeft_email = 60 * 60 * 25;
  timerButton_email.textContent = 'Принимаю повторное изменение через 1 д 60 мин 0 с';
  button_email.style.display = "flex";
  
  button_email.removeAttribute('disabled');
  event.defaultPrevented = false;
  localStorage.removeItem('timeLeft_email');
}

function resetTimerPassword() {
  clearInterval(timerId_password);
  timeLeft_password = 60 * 60 * 25;
  timerButton_password.textContent = 'Принимаю повторное изменение через 1 д 60 мин 0 с';
  button_password.style.display = "flex";
  
  button_password.removeAttribute('disabled');
  event.defaultPrevented = false;
  localStorage.removeItem('timeLeft_password');
}


/**структура касания запуска таймера**/
  
button.addEventListener('click', (event) => {
  let allChecked = true;
  checkboxes.forEach(checkbox => {
    if (!checkbox.checked) {
      allChecked = false;
    }
  });

  if (allChecked) {
    startTimer();
    errorMessage.classList.add('d-none');
    button.style.display = "flex";/*here*/

if(!event.defaultPrevented){
    button.addEventListener('click', (event) => {
    button.setAttribute('disabled', 'true');
    button.style.display = "none";
    
    event.preventDefault();
    });//button
}
if(event.defaultPrevented){
    button.addEventListener('click', (event) => {
    button.removeAttribute('disabled');
    button.style.display = "flex";
    
    event.defaultPrevented = false;
    });//button
}//event

     } else {//allChecked
    errorMessage.classList.remove('d-none');
    event.preventDefault();
    button.style.display = "flex";
    
  }
});

//email
button_email.addEventListener('click', (event) => {
  let allCheckede_email= true;
  checkboxes_email.forEach(checkboxes_email => {
    if (!checkboxes_email.checked) {
      allCheckede_email = false;
    }
  });
  
  if (allCheckede_email) {
    startTimerEmail();
    errorMessage_email.classList.add('d-none');
    button_email.style.display = "flex";
    

if(!event.defaultPrevented){
    button_email.addEventListener('click', (event) => {
    button_email.setAttribute('disabled', 'true');
    button_email.style.display = "none";
    

    event.preventDefault();
    });//button
}
if(event.defaultPrevented){
    button_email.addEventListener('click', (event) => {
    button_email.removeAttribute('disabled');
    button_email.style.display = "flex";
    

    event.defaultPrevented = false;
    });//button
}//event

     } else {//allChecked
    errorMessage_email.classList.remove('d-none');
    button_email.style.display = "none";
    

    event.preventDefault();
  }
});

//password
button_password.addEventListener('click', (event) => {
  let allCheckede_password = true;
  checkboxes_password.forEach(checkboxes_password => {
    if (!checkboxes_password.checked) {
      allCheckede_password = false;
    }
  });
  
  if (allCheckede_password) {
    startTimerPassword();
    errorMessage_password.classList.add('d-none');
    button_password.style.display = "flex";
    


if(!event.defaultPrevented){
    button_password.addEventListener('click', (event) => {
    button_password.setAttribute('disabled', 'true');
    button_password.style.display = "none";
    

    event.preventDefault();
    });//button
}
if(event.defaultPrevented){
    button_password.addEventListener('click', (event) => {
    button_password.removeAttribute('disabled');
    button_password.style.display = "flex";
    

    event.defaultPrevented = false;
    });//button
}//event

     } else {//allChecked
    errorMessage_password.classList.remove('d-none');
    button_password.style.display = "none";
    

    event.preventDefault();
  }
});

//avatar
button_avatar.addEventListener('click', (event) => {
  let allCheckede_avatar = true;
  checkboxes_avatar.forEach(checkboxes_avatar => {
    if (!checkboxes_avatar.checked) {
      allCheckede_avatar = false;
    }
  });
  
  if (allCheckede_avatar) {
    startTimeravatar();
    errorMessage_avatar.classList.add('d-none');
    
    button_avatar.style.display = "flex";

if(!event.defaultPrevented){
    button_avatar.addEventListener('click', (event) => {
    button_avatar.setAttribute('disabled', 'true');
    
    button_avatar.style.display = "flex";

    event.preventDefault();
    });//button
}
if(event.defaultPrevented){
    button_avatar.addEventListener('click', (event) => {
    button_avatar.removeAttribute('disabled');
    
    button_avatar.style.display = "flex";

    event.defaultPrevented = false;
    });//button
}//event

     } else {//allChecked
    errorMessage_avatar.classList.remove('d-none');
    event.preventDefault();
  }
});

window.addEventListener('load', () => {
  const savedTimeLeft = localStorage.getItem('timeLeft');
  const savedTimeLeft_avatar = localStorage.getItem('timeLeft_avatar');
  const savedTimeLeft_email = localStorage.getItem('timeLeft_email');
  const savedTimeLeft_password = localStorage.getItem('timeLeft_password');

  if (savedTimeLeft) {
    // Устанавливаем таймер на сохраненное время
    timeLeft = parseInt(savedTimeLeft);
    
    if (timeLeft !== 60 * 60 * 25) {
    button.style.display = "none";
    

      startTimer();
    }
  }

  if (savedTimeLeft_avatar) {
    // Устанавливаем таймер на сохраненное время
    timeLeft_avatar = parseInt(savedTimeLeft_avatar);
    
    if (timeLeft_avatar !== 60 * 60 * 25) {
    button_avatar.style.display = "none";
    

      startTimeravatar();
    }
  }

  if (savedTimeLeft_email) {
    // Устанавливаем таймер на сохраненное время
    timeLeft_email = parseInt(savedTimeLeft_email);
    
    if (timeLeft_email !== 60 * 60 * 25) {
    button_email.style.display = "none";
    

      startTimerEmail();
    }
  }

  if (savedTimeLeft_password) {
    // Устанавливаем таймер на сохраненное время
    timeLeft_password = parseInt(savedTimeLeft_password);
    
    if (timeLeft_password !== 60 * 60 * 25) {
      timerButton_password.textContent = `Повторное изменение через ${formatTime(timeLeft_password)}`;
    button_password.style.display = "none";
    

      startTimerPassword();
    }
  }
});

// Функция для сохранения времени в localStorage
function saveTime() {
  localStorage.setItem('timeLeft', timeLeft);
}

function saveTimeavatar() {
  localStorage.setItem('timeLeft_avatar', timeLeft_avatar);
}

function saveTimeEmail() {
  localStorage.setItem('timeLeft_email', timeLeft_email);
}

function saveTimePassword() {
  localStorage.setItem('timeLeft_password', timeLeft_password);
}

// Функция для обновления отображения времени
function updateTimeDisplay() {
  timerButton.textContent = `Повторное изменение через ${formatTime(timeLeft)}`;
}

function updateTimeDisplayavatar() {
  timerButton_avatar.textContent = `Повторное изменение через ${formatTime(timeLeft_avatar)}`;
}

function updateTimeDisplayEmail() {
  timerButton_email.textContent = `Повторное изменение через ${formatTime(timeLeft_email)}`;
}

function updateTimeDisplayPassword() {
  timerButton_password.textContent = `Повторное изменение через ${formatTime(timeLeft_password)}`;
}

// Обновляем текст таймера каждую 100 милсек
setInterval(updateTimeDisplay, 100);
setInterval(updateTimeDisplayavatar, 100);
setInterval(updateTimeDisplayEmail, 100);
setInterval(updateTimeDisplayPassword, 100);

// Сохраняем время каждую 100 милсек
setInterval(saveTime, 100);
setInterval(saveTimeavatar, 100);
setInterval(saveTimeEmail, 100);
setInterval(saveTimePassword, 100);

/**СИСТЕМА УДАЛЕНИЕ СЧЕТЧИКА **/


resetTimerButton.addEventListener('click', () => {
if(timeLeft < 89990) {//10с промежуток
  resetTimer();
  timerButton.innerHTML = '<span>Принимаю повторное изменение через 1 д 60 мин 0 с <font style="color: #A8FF79">таймер успешно сброшен</font></span>';
  resetTimerButton.innerHTML = '<font style="color: color: var(--button-inactive)">Без таймера!</font>';
    event.defaultPrevented = false;
    button.removeAttribute('disabled');
    button.style.display = "flex";
    

} else if (timeLeft === 60 * 60 * 25) {
  resetTimerButton.innerHTML = '<font style="color: #fff;">Запрос откланён!</font>';
    button.setAttribute('disabled', 'true');
    button.style.display = "none";
    

    event.preventDefault();
}  else if (timeLeft !== 60 * 60 * 25 && timeLeft >= 89991) {
  resetTimerButton.innerHTML = '<font style="color: #fff">Временно недоступно!</font>';
    button.setAttribute('disabled', 'true');
    button.style.display = "none";
    

    event.preventDefault();
   }
});
//icon
resetTimerButton_avatar.addEventListener('click', () => {
if(timeLeft_avatar < 89990) {//10с промежуток
  resetTimeravatar();
  timerButton_avatar.innerHTML = '<span>Принимаю повторное изменение через 1 д 60 мин 0 с <font style="color: #A8FF79">таймер успешно сброшен</font></span>';
  resetTimerButton_avatar.innerHTML = '<font style="color: color: var(--button-inactive)">Без таймера!</font>';
    button_avatar.removeAttribute('disabled');
    button_avatar.style.display = "flex";
    

    event.defaultPrevented = false;
} else if (timeLeft_avatar === 60 * 60 * 25) {
  resetTimerButton_avatar.innerHTML = '<font style="color: #fff;">Запрос откланён!</font>';
    button_avatar.setAttribute('disabled', 'true');
    button_avatar.style.display = "none";
    

    event.preventDefault();
}  else if (timeLeft_avatar !== 60 * 60 * 25 && timeLeft_avatar >= 89991) {
  resetTimerButton_avatar.innerHTML = '<font style="color: #fff">Временно недоступно!</font>';
    button_avatar.setAttribute('disabled', 'true');
    button_avatar.style.display = "none";
    

    event.preventDefault();
   }
});

//СБРОС СТРУКТУРА
/** ЧТОБЫ +СТРУКТУРА ИСПОЛЬЗУЙТЕ 

кнопка сброса.addEventListener('click', () => {
if(timeLeft_email таймер сброса < 89990) {//10с промежуток
  функция для сброса();
  текст_таймера.innerHTML = '<span>Ознакомлен о повторном использовании через 1 день 1 час <font style="color: #A8FF79">успешно сброшенно</font></span>';
  кнопка_сброса.innerHTML = '<font style="color: color: var(--button-inactive)">Без таймера!</font>';
  кнопка_запуска.disabled = false;
} else if (таймер === 60 * 60 * 25) {
  кнопка_сброса.innerHTML = '<font style="color: #fff;">Запрос откланён!</font>';
  кнопка_запуска.disabled = false;
}  else if (таймер !== 60 * 60 * 25 && timeLeft_email >= 89991) {
  кнопка_сброса.innerHTML = '<font style="color: #fff">Временно недоступно!</font>';
  кнопка_запуска.disabled = true;
   }
});

**/

resetemail.addEventListener('click', () => {
if(timeLeft_email < 89990) {//10с промежуток
  resetTimerEmail();
  timerButton_email.innerHTML = '<span>Принимаю повторное изменение через 1 д 60 мин 0 с <font style="color: #A8FF79">таймер успешно сброшен</font></span>';
  resetemail.innerHTML = '<font style="color: color: var(--button-inactive)">Без таймера!</font>';
    button_email.removeAttribute('disabled');
    button_email.style.display = "flex";
    

    event.defaultPrevented = false;
} else if (timeLeft_email === 60 * 60 * 25) {
  resetemail.innerHTML = '<font style="color: #fff;">Запрос откланён!</font>';
    button_email.setAttribute('disabled', 'true');
    button_email.style.display = "none";
    

    event.preventDefault();
}  else if (timeLeft_email !== 60 * 60 * 25 && timeLeft_email >= 89991) {
  resetemail.innerHTML = '<font style="color: #fff">Временно недоступно!</font>';
    button_email.setAttribute('disabled', 'true');
    button_email.style.display = "none";
    

    event.preventDefault();
   }
});

resetpassword.addEventListener('click', () => {
if(timeLeft_password < 89990) {//10с промежуток
  resetTimerPassword();
  timerButton_password.innerHTML = '<span>Принимаю повторное изменение через 1 д 60 мин 0 с <font style="color: #A8FF79">таймер успешно сброшен</font></span>';
  resetpassword.innerHTML = '<font style="color: color: var(--button-inactive)">Без таймера!</font>';
    button_password.removeAttribute('disabled');
    button_password.style.display = "flex";
    

    event.defaultPrevented = false;
} else if (timeLeft_password === 60 * 60 * 25) {
  resetpassword.innerHTML = '<font style="color: #fff;">Запрос откланён!</font>';
    button_password.setAttribute('disabled', 'true');
    button_password.style.display = "none";
    

    event.preventDefault();
}  else if (timeLeft_password !== 60 * 60 * 25 && timeLeft_password >= 89991) {
  resetpassword.innerHTML = '<font style="color: #fff">Временно недоступно!</font>';
    button_password.setAttribute('disabled', 'true');
    button_password.style.display = "none";
    event.preventDefault();
   }
});