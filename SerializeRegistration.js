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

    const date = new Date();
    data.last_seen = null;
    data.date_hired = date.toISOString().split('T')[0];
    data.date_fired = null;
    data.working_status = 1;
    data.termination_reason = null;


    return JSON.stringify(data);
};

// Send serialized form data to the server
registrationForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const serializedData = serializeFormData();
    console.log(serializedData);
    //send a POST with the serialized data
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/Sys-Dev-Project/index.php?resource=user&action=create', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(serializedData);

    // send the data as a cookie
    document.cookie = "userRegistration=" + serializedData;
    console.log(document.cookie);


});
