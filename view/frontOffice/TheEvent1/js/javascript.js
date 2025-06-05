document.addEventListener('DOMContentLoaded', function() {
    // Select the previous and next buttons
    const prevButton = document.querySelector('.hb-prev-month');
    const nextButton = document.querySelector('.hb-next-month');
    const monthDisplay = document.querySelector('.hb-current-month span');
    
    // Event listener for previous button
    prevButton.addEventListener('click', function() {
        let currentMonth = parseInt(monthDisplay.textContent.split(' ')[0], 10);  // e.g., "December" becomes 12
        let currentYear = parseInt(monthDisplay.textContent.split(' ')[1], 10);  // e.g., "2024" becomes 2024
        
        // Change the month and year
        currentMonth--;
        if (currentMonth < 1) {  // If we go before January
            currentMonth = 12;
            currentYear--;
        }

        // Update the month display
        monthDisplay.textContent = `${currentMonth} ${currentYear}`;
        prevButton.setAttribute('data-month', currentMonth);
        prevButton.setAttribute('data-year', currentYear);
        nextButton.setAttribute('data-month', currentMonth + 1);
        nextButton.setAttribute('data-year', currentYear);
    });

    // Event listener for next button
    nextButton.addEventListener('click', function() {
        let currentMonth = parseInt(monthDisplay.textContent.split(' ')[0], 10);  // e.g., "December" becomes 12
        let currentYear = parseInt(monthDisplay.textContent.split(' ')[1], 10);  // e.g., "2024" becomes 2024
        
        // Change the month and year
        currentMonth++;
        if (currentMonth > 12) {  // If we go past December
            currentMonth = 1;
            currentYear++;
        }

        // Update the month display
        monthDisplay.textContent = `${currentMonth} ${currentYear}`;
        prevButton.setAttribute('data-month', currentMonth - 1);
        prevButton.setAttribute('data-year', currentYear);
        nextButton.setAttribute('data-month', currentMonth + 1);
        nextButton.setAttribute('data-year', currentYear);
    });
});
