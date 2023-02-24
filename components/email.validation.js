const emailInput = document.querySelector('#email-input');
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

emailInput.addEventListener('input', () => {
  const email = emailInput.value;
  
  if (emailRegex.test(email)) {
    // email is valid
    emailInput.classList.remove('invalid');
    emailInput.classList.add('valid');
  } else {
    // email is invalid
    emailInput.classList.remove('valid');
    emailInput.classList.add('invalid');
  }
});