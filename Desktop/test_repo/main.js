document.addEventListener('DOMContentLoaded', function() {
    // Function to handle form submissions
    function handleFormSubmit(event) {
        event.preventDefault();
        // Add your form submission logic here
        console.log('Form submitted');
    }

    // Function to toggle visibility of elements
    function toggleVisibility(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            element.style.display = element.style.display === 'none' ? 'block' : 'none';
        }
    }

    // Function to filter ideas based on checkboxes
    function filterIdeas() {
        const checkboxes = document.querySelectorAll('input[name="fields[]"]:checked');
        const selectedFields = Array.from(checkboxes).map(cb => cb.value);
        
        const ideaCards = document.querySelectorAll('.idea-card');
        ideaCards.forEach(card => {
            const fieldOfStudy = card.querySelector('.field-of-study').textContent;
            if (selectedFields.length === 0 || selectedFields.includes(fieldOfStudy)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Function to handle AJAX requests
    function makeAjaxRequest(url, method, data, callback) {
        const xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                callback(JSON.parse(xhr.responseText));
            }
        };
        xhr.send(JSON.stringify(data));
    }

    // Event listeners
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', handleFormSubmit);
    });

    const filterCheckboxes = document.querySelectorAll('input[name="fields[]"]');
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterIdeas);
    });

    // Example of using the AJAX function
    // makeAjaxRequest('/api/get-ideas', 'GET', {}, function(response) {
    //     console.log(response);
    // });
});

// Function to validate form inputs
function validateForm(formId) {
    const form = document.getElementById(formId);
    let isValid = true;

    // Reset previous error messages
    const errorMessages = form.querySelectorAll('.error-message');
    errorMessages.forEach(msg => msg.remove());

    // Validate required fields
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            const errorMessage = document.createElement('span');
            errorMessage.className = 'error-message';
            errorMessage.textContent = 'This field is required';
            field.parentNode.insertBefore(errorMessage, field.nextSibling);
        }
    });

    // Add more specific validation rules here if needed

    return isValid;
}

// Function to show a confirmation dialog
function confirmAction(message) {
    return confirm(message);
}