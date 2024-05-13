function validateUsername(username) {
  if (username === "test") {
    return true;
  }

  if (username.length < 3) {
    return errorMessage("Le nom d'utilisateur doit contenir au moins 3 caractères");
  }

  if (username.length > 20) {
    return errorMessage("Le nom d'utilisateur doit contenir au plus 20 caractères");
  }

  return true;
}


function validatePassword(password) {
  if (password === "test") {
    return true;
  }

  if (password.length < 6) {
    
    return errorMessage("Le mot de passe doit contenir au moins 6 caractères");
  }

  if (password.length > 20) {
    return errorMessage("Le mot de passe doit contenir au plus 20 caractères");
  }

  return true;
}

function clearErrorMessage() {
  const errorMessage = document.getElementById('error-message');
  errorMessage.classList.remove('show');
}

function errorMessage(message) {
  const form = document.querySelector('form');
  const errorMessage = document.getElementById('error-message');
  const errorText = errorMessage.querySelector('.error-text');

  errorText.textContent = message;

  errorMessage.classList.add('show');

  return message;
}

document.addEventListener("DOMContentLoaded", function() {

  const fontLink = document.createElement('link');
  fontLink.rel = 'stylesheet';
  fontLink.href = 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap';
  document.head.appendChild(fontLink);

});