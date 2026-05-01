function showError(input, errId, message) {
    input.style.borderColor = 'red';
    var el = document.getElementById(errId);
    if (el) {
        el.textContent = message;
        el.style.display = 'block';
        el.style.color = 'red';
        el.style.fontSize = '12px';
        el.style.marginTop = '-10px';
        el.style.marginBottom = '10px';
    }
}

function clearErrors() {
    var msgs = document.querySelectorAll('.error-msg');
    for (var i = 0; i < msgs.length; i++) {
        msgs[i].textContent = '';
        msgs[i].style.display = 'none';
    }
    var inputs = document.querySelectorAll('input, select');
    for (var j = 0; j < inputs.length; j++) {
        inputs[j].style.borderColor = '#ccc';
    }
}

function confirmerSuppression(id, nom, prenom) {
    return confirm('Supprimer ' + prenom + ' ' + nom + ' ?');
}

var formAjout = document.getElementById('form-ajout');
if (formAjout) {
    formAjout.addEventListener('submit', function(e) {
        var valid = true;
        clearErrors();
        var nom = document.getElementById('nom');
        var prenom = document.getElementById('prenom');
        var filiere = document.getElementById('filiere_id');
        if (!nom.value.trim()) {
            showError(nom, 'err-nom', 'Le nom est obligatoire.');
            valid = false;
        }
        if (!prenom.value.trim()) {
            showError(prenom, 'err-prenom', 'Le prenom est obligatoire.');
            valid = false;
        }
        if (!filiere.value) {
            showError(filiere, 'err-filiere', 'Choisissez une filiere.');
            valid = false;
        }
        if (!valid) e.preventDefault();
    });
}

var formUpdate = document.getElementById('form-update');
if (formUpdate) {
    formUpdate.addEventListener('submit', function(e) {
        var valid = true;
        clearErrors();
        var nom = document.getElementById('nom');
        var prenom = document.getElementById('prenom');
        var filiere = document.getElementById('filiere_id');
        if (!nom.value.trim()) {
            showError(nom, 'err-nom', 'Le nom est obligatoire.');
            valid = false;
        }
        if (!prenom.value.trim()) {
            showError(prenom, 'err-prenom', 'Le prenom est obligatoire.');
            valid = false;
        }
        if (!filiere.value) {
            showError(filiere, 'err-filiere', 'Choisissez une filiere.');
            valid = false;
        }
        if (!valid) e.preventDefault();
    });
}