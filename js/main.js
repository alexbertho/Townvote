function fetchLoginCredentials(username, password) {
  const formData = new FormData();
  formData.append('username', username);
  formData.append('password', password);

  fetch('api/login.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (response.ok) {
      return response.json();
    }
    throw new Error('Erreur de connexion');
  })
  .then(data => {
    console.log('Success:', data);
    console.log(data);
    if (data.success) {
      location.href = 'index.php';
    } else {
      var message = document.getElementById('resultat');
      message.innerHTML = data.message;
    }
  })
  .catch(error => {
    console.error('Erreur:', error);
  });
}


function fetchRegisterCredentials(username, password) {
  fetch('/api/register.php')
    .then(response => response.json())
    .then(data => {
      // Call the validation functions
      const usernameValidation = validateUsername(username);
      const passwordValidation = validatePassword(password);

      // Handle the validation results
      if (usernameValidation === true && passwordValidation === true) {
        // Credentials are valid, proceed with registration
        register(username, password);
      } else {
        // Display validation errors
        if (typeof usernameValidation === 'string') {
          console.log(usernameValidation);
        }
        if (typeof passwordValidation === 'string') {
          console.log(passwordValidation);
        }
      }
    })
    .catch(error => {
      console.log('Error fetching register credentials:', error);
    });
}


function login(username, password) {
  if (validateUsername(username) !== true) {
    return validateUsername(username);
  }
  if (validatePassword(password) !== true) {
    return validatePassword(password);
  }
  else {
    return true;
  }
}


function validateUsername(username) {
  if (username === "test") {
    return true;
  }

  if (username.length < 3) {
    return "Le nom d'utilisateur doit contenir au moins 3 caractères";
  }

  if (username.length > 20) {
    return "Le nom d'utilisateur doit contenir au plus 20 caractères";
  }

  if (!/^[a-zA-Z0-9_]+$/.test(username)) {
    return "Le nom d'utilisateur ne peut contenir que des lettres, des chiffres et des underscores";
  }

  return true;
}

function register(username, password, confirmPassword) {
  if (password !== confirmPassword) {
    return "Les mots de passe ne correspondent pas";
  }

  if (validatePassword(password) !== true) {
    return validatePassword(password);
  }
  else {
    fetchRegisterCredentials(username, password)
  }

}

function validatePassword(password) {
  if (password === "test") {
    return true;
  }

  if (password.length < 6) {
    return "Le mot de passe doit contenir au moins 6 caractères";
  }

  if (password.length > 20) {
    return "Le mot de passe doit contenir au plus 20 caractères";
  }

  if (!/[^A-Za-z0-9]/.test(password)) {
    return "Le mot de passe doit contenir au moins un caractère spécial";
  }

  if (!/[A-Z]/.test(password)) {
    return "Le mot de passe doit contenir au moins une lettre majuscule";
  }

  if (!/[a-z]/.test(password)) {
    return "Le mot de passe doit contenir au moins une lettre minuscule";
  }

  if (!/\d/.test(password)) {
    return "Le mot de passe doit contenir au moins un chiffre";
  }

  return true;
}


document.addEventListener("DOMContentLoaded", function() {

  document.getElementById('tologin').addEventListener('click', function(event) {
    event.preventDefault(); // Empêcher le comportement par défaut du bouton submit

    const username = document.getElementById('username').value; 
    const password = document.getElementById('password').value;
    
    if (login(username, password)=== true) {
      fetchLoginCredentials(username, password); 
    }
  });
  
});
