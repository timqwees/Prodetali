/*password see*/
const passwordInput = document.getElementById('password');
const togglePasswordButton = document.getElementById('toggle-password');

togglePasswordButton.addEventListener('click', () => {
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    togglePasswordButton.classList.remove('fa-eye');
    togglePasswordButton.classList.add('fa-low-vision');
  } else {
    passwordInput.type = 'password';
    togglePasswordButton.classList.remove('fa-low-vision');
    togglePasswordButton.classList.add('fa-eye');
  }
});