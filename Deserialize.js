// Make an AJAX request to retrieve the user data
const xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        const userData = JSON.parse(this.responseText);

        // Extract all the properties from the userData object
        for (const property in userData) {
            const value = userData[property];

            // Log the property and value to the console
            console.log(property + ": " + value);
        }
    }
};
xhr.open("GET", "GetUserData.php", true);
xhr.send();
