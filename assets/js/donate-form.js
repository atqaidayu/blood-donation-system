document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.donation-form');
    const icNumber = document.getElementById('ic-number');
    const bloodType = document.getElementById('blood-type');
    const quantity = document.getElementById('quantity');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const icPattern = /^[0-9]{6}-[0-9]{2}-[0-9]{4}$/;
        const isICValid = icPattern.test(icNumber.value);
        const isFormComplete = icNumber.value && bloodType.value && quantity.value;

        if (!isICValid) {
            alert('Invalid IC Number format. Please use the format: XXXXXX-XX-XXXX.');
            return;
        }

        if (!isFormComplete) {
            alert('Please fill out all required fields.');
            return;
        }

        alert('Form successfully submitted!');
        form.reset();
    });

    document.querySelector('.cancel-btn').addEventListener('click', function() {
        form.reset();
    });
});
