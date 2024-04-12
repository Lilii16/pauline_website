
const form =  document.querySelector('form');
const nomInput = document.querySelector('#InputNom');
const prenomInput = document.querySelector('#InputPrenom');
const emailInput = document.querySelector('input[type=email]');
const sujetInput = document.querySelector('#InputSujet');
const msgInput = document.querySelector('#InputMessage');

const NameRegex = /^[a-zA-Z][a-zA-Z-_]{3,23}$/;
const PasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@&#$%]).{8,23}$/;
const EmailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const SujetRegex = /^[^<>{}$]{3,200}$/;
const MessageRegex = /^[^<>{}$]{24,}$/;

emailInput.addEventListener('input', (e)=>{
    console.log(e.target.value)
    if(EmailRegex.test(emailInput.value)){
        emailInput.classList.add('is-valid');
        emailInput.classList.remove('is-invalid')
    } else{
        emailInput.classList.add('is-invalid');
        emailInput.classList.remove('is-valid')
    }
}) 


function addClass(element,regex,value,valid) {
    if (regex.test(value)) {
        element.classList.add('is-valid')
        element.classList.remove('is-invalid') 
        valid = true
    } else {
        element.classList.remove('is-valid')
        element.classList.add('is-invalid')
        valid = false
    }
}

nomInput.addEventListener('input', e => addClass(nomInput,NameRegex, e.target.value,nomValid));
prenomInput.addEventListener('input', e => addClass(prenomInput,NameRegex, e.target.value,prenomValid));
sujetInput.addEventListener('input', e=>addClass(sujetInput,SujetRegex, e.target.value,sujetValid));
emailInput.addEventListener('input', e=>addClass(emailInput,EmailRegex, e.target.value,emailValid));
msgInput.addEventListener('input', e=>addClass(msgInput,MessageRegex, e.target.value,msgValid));










// function validateForm(event) {
//   var name = document.getElementById("inputLastName").value;
//   var firstName = document.getElementById("first-name").value;
//   var email = document.getElementById("inputEmail").value;
//   // Ajoutez des validations pour d'autres champs ici...

//   var nameRegex = /^[a-zA-ZÀ-ÿ\s\-]+$/;
//   var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//   const NameRegex = /^[a-zA-Z][a-zA-Z-_]{3,23}$/;
//   const EmailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
//   const SujetRegex = /^[^<>{}$]{3,200}$/;
//   const MessageRegex = /^[^<>{}$]{24,}$/;

//   if (!nameRegex.test(name)) {
//     alert("Nom invalide");
//     event.preventDefault();
//     return false;
//   }

//   if (!nameRegex.test(firstName)) {
//     alert("Prénom invalide");
//     event.preventDefault();
//     return false;
//   }

//   if (!emailRegex.test(email)) {
//     alert("Adresse e-mail invalide");
//     event.preventDefault();
//     return false;
//   }

//   // Autres validations pour les autres champs...

//   // Si toutes les validations réussissent, le formulaire sera soumis normalement
// }

// document.getElementById("myForm").addEventListener("submit", validateForm);
