async function fetchLoginCredentials(username, password) {
  try {
    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    const response = await fetch('api/login.php', {
      method: 'POST',
      body: formData
    });

    if (!response.ok) {
      throw new Error('Erreur de connexion');
    }

    const data = await response.json();
    
    if (data.success) {
      location.href = 'index.php';
    } else {
      errorMessage(data.message);
    }
  } catch (error) {
    // pas de réponse d'erreur du serveur ducoup la connexion a pas pu être établie
  }
}


// async function fetchLoginCredentials(username, password) {
//   try {
//     const formData = new FormData();
//     formData.append('username', username);
//     formData.append('password', password);

//     const response = await fetch('api/login.php', {
//       method: 'POST',
//       body: formData
//     });

//     if (!response.ok) {
//       throw new Error('Erreur de connexion');
//     }

//     const data = await response.json();

//     console.log(data);
    
//     if (data.success) {
//       location.href = 'index.php';
//     } else {
//       var message = document.getElementById('resultat');
//       message.innerHTML = data.message;
//     }
//   } catch (error) {
//     console.log('Error fetching login credentials:', error);
//     console.error('Erreur:', error);
//   }
// }


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

function errorMessage(message) {
  const form = document.querySelector('form');
  const errorMessage = document.getElementById('error-message');
  const errorText = errorMessage.querySelector('.error-text');

  errorText.textContent = message;

  errorMessage.classList.remove('show');
  setTimeout(() => {
      errorMessage.classList.add('show');
  }, 0);

  return message;
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
