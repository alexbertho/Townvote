  async function fetchRegisterCredentials(username, password) {
    clearErrorMessage();
    try {
      const formData = new FormData();
      formData.append('username', username);
      formData.append('password', password);
  
      const response = await fetch('api/register.php', {
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

  function register(username, password, confirmPassword) {
    if (validateUsername(username) !== true) {
        return validateUsername(username);
    }
    else if (validatePassword(password) !== true) {
        return validatePassword(password);
    }
    else if (validatePassword(confirmPassword) !== true) {
        return validatePassword(confirmPassword);
    }
    else if (password !== confirmPassword) {
        return errorMessage("Les mots de passe ne correspondent pas");
    }
    else {
        return true;
    }
  }

  document.addEventListener("DOMContentLoaded", function() {

    document.getElementById('toregister').addEventListener('click', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du bouton submit
    
        const username = document.getElementById('login').value; 
        const password = document.getElementById('register_pass').value;
        const confirmPassword = document.getElementById('register_pass_bis').value;
        
        if (register(username, password, confirmPassword) === true) {
            console.log("registering");
            fetchRegisterCredentials(username, password);
        }
      });



});
