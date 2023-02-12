// Initialize the function for personal phone number
addPhoneNumberField("personal");

// Initialize the function for home phone number
addPhoneNumberField("home");

/**
 * Adds phone number field dynamically.
 *
 * @param {string} type - The type of phone number field (personal or home)
 */
function addPhoneNumberField(type) {
    // Select the input field for the phone number type
    const phoneNumberField = document.querySelector(`input[name='${type}_phone_number[]']`);

    // Get the parent container of the field
    const parentContainer = phoneNumberField.parentNode;

    // Select the add button for the phone number type
    const addButton = document.querySelector(`#add-button-${type}`);

    // Attach click event to the add button
    addButton.addEventListener("click", function() {
        // Clone the phone number field
        const newField = phoneNumberField.cloneNode();
        newField.value = "";

        // Create a remove button
        const removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.innerHTML = "-";
        removeButton.classList.add("btn", "btn-danger");

        // Attach click event to the remove button
        removeButton.addEventListener("click", function() {
            // Remove the cloned field and remove button from the parent container
            parentContainer.removeChild(newField);
            parentContainer.removeChild(removeButton);
        });

        // Insert the remove button before the cloned field
        parentContainer.insertBefore(removeButton, newField.nextSibling);

        // Append the cloned field to the parent container
        parentContainer.appendChild(newField);
    });
}