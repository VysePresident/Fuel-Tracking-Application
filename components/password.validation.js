
const passwordInput = document.querySelector('#password-input');
const confirmPasswordInput = document.querySelector('#confirm-password-input');

const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

confirmPasswordInput.addEventListener('input', () => {
  const confirmPassword = confirmPasswordInput.value;
  const password = passwordInput.value;
  
  if (confirmPassword === password) {
    confirmPasswordInput.classList.remove('invalid');
    confirmPasswordInput.classList.add('valid');
  } else {
    confirmPasswordInput.classList.remove('valid');
    confirmPasswordInput.classList.add('invalid');
  }
});

passwordInput.addEventListener('input', () => {
  const password = passwordInput.value;
  
  if (passwordRegex.test(password)) {
    passwordInput.classList.remove('invalid');
    passwordInput.classList.add('valid');
  } else {
    passwordInput.classList.remove('valid');
    passwordInput.classList.add('invalid');
  }
  
  // check if confirm password field matches
  const confirmPassword = confirmPasswordInput.value;
  if (confirmPassword === password) {
    confirmPasswordInput.classList.remove('invalid');
    confirmPasswordInput.classList.add('valid');
  } else {
    confirmPasswordInput.classList.remove('valid');
    confirmPasswordInput.classList.add('invalid');
  }
});