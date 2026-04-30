// Validation formulaire ajout
const formAjout = document.getElementById('form-ajout');
if (formAjout) {
    formAjout.addEventListener('submit', function(e) {
        let valid = true;
        clearErrors();

        const nom = document.getElementById('nom');
        const prenom = document.getElementById('prenom');
        const filiere = document.getElementById('filiere_id');

        if (!nom.value.trim()) {
            showError(nom, 'err-nom', 'Le nom est obligatoire.');
            valid = false;
        }
        if (!prenom.value.trim()) {
            showError(prenom, 'err-prenom', 'Le prénom est obligatoire.');
            valid = false;
        }
        if (!filiere.value) {
            showError(filiere, 'err-filiere', 'Choisissez une filière.');
            valid = false;
        }

        if (!valid) e.preventDefault();
    });
}

// Validation formulaire modification
const formUpdate = document.getElementById('form-update');
if (formUpdate) {
    formUpdate.addEventListener('submit', function(e) {
        let valid = true;
        clearErrors();

        const nom = document.getElementById('nom');
        const prenom = document.getElementById('prenom');
        const filiere = document.getElementById('filiere_id');

        if (!nom.value.trim()) {
            showError(nom, 'err-nom', 'Le nom est obligatoire.');
            valid = false;
        }
        if (!prenom.value.trim())