document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('addOrganizerForm');
    const nameInput = document.getElementById('organizerName');
    const emailInput = document.getElementById('organizerEmail');

    form.addEventListener('submit', (event) => {
        let isValid = true;
        let errorMessage = '';

        // Validate name (at least 3 characters)
        if (nameInput.value.trim().length < 3) {
            isValid = false;
            errorMessage += '⚠️ Organizer name must contain at least 3 letters.\n';
        }

        // Validate email (basic email pattern check)
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value.trim())) {
            isValid = false;
            errorMessage += '⚠️Please enter a valid email address.\n';
        }

        // If validation fails, prevent form submission and show an alert
        if (!isValid) {
            alert(errorMessage);
            event.preventDefault(); // Prevent form from submitting
        }
    });
});
