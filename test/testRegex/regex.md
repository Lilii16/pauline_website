Les regex , expression reguliere sont des modèles d'expression regulière qui servent à dectecter des combinaison possibles(motifs) dans des chaines de caractère.

methodes : 
* replace: va remplacer un element par un autre comme par exemple remplacer des espaces par des slash.

* match: cretourne toutes les occurences de l'element recherché.

* regex plus complexes come pour les telephones, emails, ou mots de pass. 

c'est largement utilisé pour la "validation" de données ou "reperer" des modeles dans une chaine de caractères ou des "remplacements" intéligents.

## expression regulière: 

* delimitée par  slash //, on peut utiliser des crochets pour chercher des mots avec differents caractères : /t[ea]nte/, on peut utiliser un pipez pour faire la meme chose = |, on peut chercher de a-z A-Z ou de 1-9.

* les ER sont case sensitive

* on a des caractères spéciaux qui peuvent faire des matchs plus rapides: 

- . = match avec n'importe quel caracter
- \d = match avec un nombre
- ^ = en debut d'expression 
- $ = en fin de ligne
- ^" = tout sauf guillemet

## quantifieur 

specifie quantité d'info qu'on veut recupérer
ex: /\d{2}/ - capture 2 nombres consécutifs, si on met une virgule entre 2 chiffres cela spécifie une plage: {1,2}
- * je veux capturer zero ou plus d'une fois
- + je veux capturer au moins une fois
- ? zero ou une fois

## Les drapeaux

se mettent après le dernier slash de l'expression et permet de modifier son conportement

- g: fait une capture genrerale cad continue la recherche
- i: non sensible a la case
on peut combiner les drapeaux


on peut utiliser une parenthese pour faire un regroupement de caractères:
ex: ch(ien|at) ou (pa){2} = papa



// Cette fonction ajoute ou supprime les classes CSS is-valid et is-invalid en fonction du résultat de la validation regex
function addClass(element,regex,value,valid) {
    if (regex.test(value)) {
        element.classList.add('is-valid') // Ajoute la classe 'is-valid' si la valeur est valide
        element.classList.remove('is-invalid')  // Supprime la classe 'is-invalid' si la valeur est valide
        valid = true
    } else {
        element.classList.remove('is-valid') // Supprime la classe 'is-valid' si la valeur est invalide
        element.classList.add('is-invalid') // Ajoute la classe 'is-invalid' si la valeur est invalide
        valid = false
    }
}

// Les événements d'entrée déclenchent la fonction addClass pour la validation
nomInput.addEventListener('input', e => addClass(nomInput,NameRegex, e.target.value,nomValid));
prenomInput.addEventListener('input', e => addClass(prenomInput,NameRegex, e.target.value,prenomValid));
sujetInput.addEventListener('input', e=>addClass(sujetInput,SujetRegex, e.target.value,sujetValid));
emailInput.addEventListener('input', e=>addClass(emailInput,EmailRegex, e.target.value,emailValid));
msgInput.addEventListener('input', e=>addClass(msgInput,MessageRegex, e.target.value,msgValid));

    const isNomValid = NameRegex.test(nomInput.value);
    const isPrenomValid = NameRegex.test(prenomInput.value);
    const isEmailValid = EmailRegex.test(emailInput.value);
    const isSujetValid = SujetRegex.test(sujetInput.value);
    const isMessageValid = MessageRegex.test(msgInput.value);