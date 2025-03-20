/* see pass */
let password = pass;
let hiddenPassword = "•".repeat(password.length);/*• повториться в длину текста*/

document.getElementById("passwordField").textContent = hiddenPassword;/*в изночальном виде будет закрыт*/

document.getElementById("passwordField").addEventListener("mouseover", function () {/*когда курсор наводит на id*/
    document.getElementById("passwordField").textContent = password;/*устанавливает содержимое*/
});

document.getElementById("passwordField").addEventListener("mouseout", function () {/*mouseout - когда покидает курсор*/
    document.getElementById("passwordField").textContent = hiddenPassword;/*устанавливаем дуругую переменную*/
});