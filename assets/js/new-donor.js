document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.new-donor-form');
    const icNumberInput = document.getElementById('ic-number');
    const phoneNumberInput = document.getElementById('phone-number');

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const isValid = validateForm();
        if (isValid) {
            // Form is valid, show success message and submit form
            alert('Form submitted successfully!');
            form.submit(); // Submit the form
        }
    });

    function validateForm() {
        let isValid = true;

        // Validate IC Number format (xxxxxx-xx-xxxx)
        const icNumberRegex = /^\d{6}-\d{2}-\d{4}$/;
        if (!icNumberRegex.test(icNumberInput.value)) {
            isValid = false;
            alert('IC Number format should be xxxxxx-xx-xxxx');
        }

        // Validate Phone Number format (minimum 10 numbers)
        const phoneNumberRegex = /^\d{10,}$/;
        if (!phoneNumberRegex.test(phoneNumberInput.value)) {
            isValid = false;
            alert('Phone Number should contain at least 10 numbers');
        }

        // Validate all fields are filled
        const formInputs = form.querySelectorAll('input, select, textarea');
        formInputs.forEach(input => {
            if (input.value.trim() === '') {
                isValid = false;
                alert(`${getFieldName(input)} is required`);
            }
        });

        return isValid;
    }

    function getFieldName(input) {
        return input.getAttribute('name');
    }
});
