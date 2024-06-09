document.addEventListener('DOMContentLoaded', () => {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const form = document.querySelector('form');

    form.addEventListener('submit', (event) => {
        // Prevent the form from submitting by default
        event.preventDefault();

        // Check if both username and password fields are filled and not null
        if (usernameInput.value.trim() === '' && passwordInput.value.trim() === '') {
            // If any field is empty, display an alert message
            alert('Please fill in both username and password fields.');
            return; // Exit the function early
        }

        // Check if password meets length requirement
        if (passwordInput.value.trim().length < 8) {
            // If password length is less than 8 characters, display an alert message
            alert('Password must be at least 8 characters long.');
            return; // Exit the function early
        }

        // If both fields are filled and password meets length requirement, submit the form
        form.submit();
    });
});
