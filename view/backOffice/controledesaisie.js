document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("serviceForm");

    form.addEventListener("submit", function (e) {
        let isValid = true;

        // Validate "Type de Service"
        const serviceType = document.getElementById("service_type_id");
        if (serviceType.value.trim() === "") {
            alert("Le type de service est requis.");
            isValid = false;
        }

        // Validate "Nom"
        const name = document.getElementById("nom");
        if (name.value.trim() === "") {
            alert("Le nom est requis.");
            isValid = false;
        }

        // Validate "Contact"
        const contact = document.getElementById("contact");
        if (contact.value.trim() !== "" && !/^\+?[0-9\s\-]+$/.test(contact.value)) {
            alert("Le contact doit être un numéro valide.");
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // Empêcher l'envoi du formulaire si validation échoue
        }
    });
});