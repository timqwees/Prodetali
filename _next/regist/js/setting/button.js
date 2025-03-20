const check1 = document.getElementById("check1");
const check2 = document.getElementById("check2");
const check3 = document.getElementById("check3");
const check4 = document.getElementById("check4");
const check5 = document.getElementById("check5");
const check6 = document.getElementById("check6");
const check7 = document.getElementById("check7");
const check8 = document.getElementById("check8");
const sendButton = document.getElementById("send");
const sendButtonE = document.getElementById("send_email");
const sendButtonA = document.getElementById("send_avatar");
const sendButtonP = document.getElementById("send_password");

check1.addEventListener("change", () => {
  if (check1.checked && check2.checked) {
    if(timeLeft === 60 * 60 * 25){
    sendButton.style.display = "flex";
    } else {
    sendButton.style.display = "none";
    }
  } else {
    sendButton.style.display = "none";
  }
});

check2.addEventListener("change", () => {
  if (check1.checked && check2.checked) {
    if(timeLeft === 60 * 60 * 25){
    sendButton.style.display = "flex";
    } else {
    sendButton.style.display = "none";
    }
  } else {
    sendButton.style.display = "none";
  }
});

//email
check3.addEventListener("change", () => {
  if (check3.checked && check4.checked) {
    if(timeLeft_email === 60 * 60 * 25){
    sendButtonE.style.display = "flex";
    } else {
    sendButtonE.style.display = "none";
    }
  } else {
    sendButtonE.style.display = "none";
  }
});

check4.addEventListener("change", () => {
  if (check3.checked && check4.checked) {
    if(timeLeft_email === 60 * 60 * 25){
    sendButtonE.style.display = "flex";
    } else {
    sendButtonE.style.display = "none";
    }
  } else {
    sendButtonE.style.display = "none";
  }
});

//avatar
check5.addEventListener("change", () => {
  if (check5.checked && check6.checked) {
    if(timeLeft_avatar === 60 * 60 * 25){
    sendButtonA.style.display = "flex";
    } else {
    sendButtonA.style.display = "none";
    }
  } else {
    sendButtonA.style.display = "none";
  }
});

check6.addEventListener("change", () => {
  if (check5.checked && check6.checked) {
    if(timeLeft_avatar === 60 * 60 * 25){
    sendButtonA.style.display = "flex";
    } else {
    sendButtonA.style.display = "none";
    }
  } else {
    sendButtonA.style.display = "none";
  }
});

//password
check7.addEventListener("change", () => {
  if (check7.checked && check8.checked) {
    if(timeLeft_password === 60 * 60 * 25){
    sendButtonP.style.display = "flex";
    } else {
    sendButtonP.style.display = "none";
    }
  } else {
    sendButtonP.style.display = "none";
  }
});

check8.addEventListener("change", () => {
  if (check7.checked && check8.checked) {
    if(timeLeft_password === 60 * 60 * 25){
    sendButtonP.style.display = "flex";
    } else {
    sendButtonP.style.display = "none";
    }
  } else {
    sendButtonP.style.display = "none";
  }
});