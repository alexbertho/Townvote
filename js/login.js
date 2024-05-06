async function fetchLoginCredentials(username, password) {
    clearErrorMessage();
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
      errorMessage('La connexion n\'a pas pu être établie');
    }
  }

  function login(username, password) {
    if (validateUsername(username) !== true) {
      return validateUsername(username);
    }
    else if (validatePassword(password) !== true) {
      return validatePassword(password);
    }
    else {
      return true;
    }
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

    document.getElementById('registerbutton').addEventListener('click', function(event) {
        location.href = 'register.php';
    });

});
