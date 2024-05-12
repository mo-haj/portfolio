// PHONE NUMBER AS +963
function formatPhoneNumber(value) {
    if (!value) return value;
    // Remove any non-digit characters from the input
    const phoneNumber = value.replace(/\D/g, '');
    // Check the prefix of the phone number
    if (phoneNumber.startsWith('011')) {
        // If it starts with '011', format as a landline/home phone number with 7 digits
        const formattedNumber = phoneNumber.slice(0, 10); // Ensure no more than 10 digits
        return formattedNumber.replace(/^(\d{3})(\d{3})(\d{4})$/, '$1-$2-$3');
    } else if (phoneNumber.startsWith('09')) {
        // If it starts with '09', format as a mobile phone number with 10 digits
        const formattedNumber = phoneNumber.slice(0, 9); // Ensure exactly 10 digits
        return formattedNumber.replace(/^(\d{4})(\d{3})(\d{3})$/, '$1-$2-$3');
    } else {
        // For other cases, simply return the first 10 digits
        return phoneNumber.slice(0, 10);
    }
}

document.getElementById('number').addEventListener('input', function(event) {
    const inputField = event.target;
    // Remove any non-digit characters from the input
    inputField.value = inputField.value.replace(/\D/g, '');
    // Ensure that the input does not exceed 10 characters
    if (inputField.value.length > 10) {
        inputField.value = inputField.value.slice(0, 10);
    }
});

