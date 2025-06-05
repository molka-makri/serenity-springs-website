// Validate Add Event form inputs
function validateAddEventForm(event) {
    // Get all the input fields for the Add Event form
    const eventName = document.getElementById('eventName');
    const eventDescription = document.getElementById('eventDescription');
    const eventDate = document.getElementById('eventDate');
    const eventLocation = document.getElementById('eventLocation');

    // Validate Event Name (at least 3 characters)
    if (eventName.value.trim().length < 3) {
        alert("⚠️ Event Name must be at least 3 characters long!");
        eventName.focus();
        event.preventDefault(); // Prevent form submission
        return false;
    }

    // Validate Event Description (at least 3 characters)
    if (eventDescription.value.trim().length < 3) {
        alert("⚠️ Event Description must be at least 3 characters long!");
        eventDescription.focus();
        event.preventDefault(); // Prevent form submission
        return false;
    }

    // Validate Event Date (not empty and valid date)
    if (!eventDate.value.trim()) {
        alert("⚠️ Please select a valid Event Date!");
        eventDate.focus();
        event.preventDefault(); // Prevent form submission
        return false;
    }

    // Validate Event Location (at least 3 characters)
    if (eventLocation.value.trim().length < 3) {
        alert("⚠️ Event Location must be at least 3 characters long!");
        eventLocation.focus();
        event.preventDefault(); // Prevent form submission
        return false;
    }

    // If all validations pass
    alert("✅ All inputs for Add Event are valid. Submitting the form!");
    return true;
}

// Add event listener for the "Add Event" form
document.addEventListener("DOMContentLoaded", function () {
    // Target only the Add Event form using its unique ID
    const addEventForm = document.getElementById("addEventForm");

    if (addEventForm) {
        addEventForm.addEventListener('submit', function (event) {
            validateAddEventForm(event);
        });
    }
});
