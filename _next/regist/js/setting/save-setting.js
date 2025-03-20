const sendButtonNick = document.getElementById("send");
const sendButtonEmail = document.getElementById("send_email");
const sendButtonAvatar = document.getElementById("send_avatar");
const sendButtonPass = document.getElementById("send_password");

$("#send").click(function () {
  var inputNickname = $("#input-nickname").val();

  $.ajax({
    url: '/../../php/src/actions/replace.php',
    type: 'POST',
    data: {
      value: inputNickname
    },
    success: function (response) {
      alert("Данные никнейма успешно обновлены!");
      sendButtonNick.style.display = "none";
    },
    error: function (error) {
      alert("Произошла ошибка обновления никнейма! Обратитесь в поддержку!");
    }
  });
});

$("#send_email").click(function () {
  var inputEmail = $("#input-email").val();

  $.ajax({
    url: '/../../php/src/actions/replace.php',
    type: 'POST',
    data: {
      value_email: inputEmail
    },
    success: function (response) {
      alert("Данные почты успешно обновлены!");
      sendButtonEmail.style.display = "none";
    },
    error: function (error) {
      alert("Произошла ошибка обновления почты! Обратитесь в поддержку!");
    }
  });
});

$("#send_avatar").click(function () {
  var inputIcon = $("#input-avatar").val();

  $.ajax({
    url: '/../../php/src/actions/replace.php',
    type: 'POST',
    data: {
      value_avatar: inputIcon
    },
    success: function (response) {
      alert("Данные аватарки успешно обновлены!");
      sendButtonAvatar.style.display = "none";
    },
    error: function (error) {
      alert("Произошла ошибка обновления аватарки! Обратитесь в поддержку!");
    }
  });
});

$("#send_password").click(function () {
  var inputPassword = $("#input-password").val();

  $.ajax({
    url: '/../../php/src/actions/replace.php',
    type: 'POST',
    data: {
      value_password: inputPassword
    },
    success: function (response) {
      alert("Данные пароля успешно обновлены!");
      sendButtonPass.style.display = "none";
    },
    error: function (error) {
      alert("Произошла ошибка обновления пароля! Обратитесь в поддержку!");
    }
  });
});

// [замена до восстановления прежней версии сохранения через Ajax]
$(document).ready(function () {
  //nickname
  if ($('#input-nickname').length) {
    $('#input-nickname').on('input', function () {
      var var_nick = $(this).val();
      $('#replace_mysql__nick').val(var_nick);
    });
  }
  //password
  if ($('#input-password').length) {
    $('#input-password').on('input', function () {
      var var_pass = $(this).val();
      $('#replace_mysql__password').val(var_pass);
    });
  }
  //avatar
  if ($('#input-avatar').length) {
    $('#input-avatar').on('input', function () {
      var var_av = $(this).val();
      $('#replace_mysql__avatar').val(var_av);
    });
  }
  //email
  if ($('#input-email').length) {
    $('#input-email').on('input', function () {
      var var_em = $(this).val();
      $('#replace_mysql__email').val(var_em);
    });
  }

});

/* SYSTEM CHECK ELEMENTS IN INPUTS */
function TrakerN() {
  const nickname = document.getElementById("input-nickname").value;
  const inputNickname = document.getElementById("traker_nickname");
  const inputNicknameError = document.getElementById("traker_nickname_error");

  if (nickname.length < 3) {
    alert("Никнейм не должен быть менее 3 символов!");
    inputNickname.style.display = "none";
    inputNicknameError.style.display = "flex";
  } else {
    inputNickname.style.display = "flex";
    inputNicknameError.style.display = "none";
  }
}

function TrakerE() {
  const email = document.getElementById("input-email").value;
  const inputEmail = document.getElementById("input_Email");
  const inputEmailError = document.getElementById("input_Email_Error");

  if (email === "") {
    alert("Пожалуйста заполните поле почты!");
  } else {
    const atIndex = email.indexOf("@");
    const dotIndex = email.lastIndexOf(".");
    const domain = email.substring(atIndex + 1, dotIndex);
    if (domain === "" || email.includes("@") === false
      || atIndex === -1
      || dotIndex > atIndex === false
      || dotIndex === email.length - 1
      || domain.length === 1) {
      inputEmail.style.display = "none";
      inputEmailError.style.display = "flex";
    } else {
      inputEmail.style.display = "flex";
      inputEmailError.style.display = "none";
    }
  }
}

function TrakerP() {

  if ($("#input-password").length === 0) {
    alert("Пожалуйста заполните поле пароля!");
  } else {
    // Get the value of the input field
    var passwordValue = $("#input-password").val();
    var button = document.getElementById("traker_password");
    var button_error = document.getElementById("traker_password_error");

    // Check if the length of the password value is less than 5 characters
    if (passwordValue.length <= 5) {
      alert("Пароль не должен быть меньше 5 символов! Пожалуйста дополните данные!");
      button.style.display = "none";
      button_error.style.display = "flex";
    } else {
      button.style.display = "flex";
      button_error.style.display = "none";
    }
  }
}