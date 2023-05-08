// Serialize form data into a JSON object
const registrationForm = document.querySelector('#registration-form');
const serializeFormData = () => {
    const formData = new FormData(registrationForm);
    const data = {};
    for (const [key, value] of formData.entries()) {
        data[key] = value;
    }

    // If there's no key for 'enable2fa', add it and set it to 0
    if (!data.hasOwnProperty('enable2fa')) {
        data.enable2fa = 0;
    }

    

    return JSON.stringify(data);
};

// Send serialized form data to the server
registrationForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const serializedData = serializeFormData();
    console.log(serializedData);
    // Add code to send serializedData to the server via AJAX or fetch()
});
