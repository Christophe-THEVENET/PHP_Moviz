// remove success message auto
document.addEventListener('DOMContentLoaded', () => {
    const messages = document.querySelectorAll('.message');
    messages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = 0;
            setTimeout(() => {
                message.parentNode.removeChild(message);
            }, 500); // Wait for 1 second (1000 milliseconds) for the fade out animation to complete
        }, 2000); // 5000 milliseconds = 5 seconds
    });
});

// remove error message auto
document.addEventListener('DOMContentLoaded', () => {
    const errors = document.querySelectorAll('.error');
    errors.forEach(error => {
        setTimeout(() => {
            error.style.opacity = 0;
            setTimeout(() => {
                error.parentNode.removeChild(error);
            }, 500); // Wait for 1 second (1000 milliseconds) for the fade out animation to complete
        }, 2000); // 5000 milliseconds = 5 seconds
    });
});


// Get a reference to the "Add genre" button
const addGenreButton = document.getElementById('add-genre');

// Add an event listener to the button
addGenreButton.addEventListener('click', function() {
    // Create a new input element

       
        let input = document.createElement('input');
        input.type = 'text';
        input.classList.add('form-control');
        input.name = 'genre[]';
         let div= document.createElement('div');
        div.classList.add('mb-3');
       
        // Create a new label element
        const label = document.createElement('label');
        label.textContent = 'Genre:';

        // Append the label and input elements to the form
        const form = document.querySelector('.movie-form');
        
        div.appendChild(label);
        div.appendChild(input);
        form.insertBefore(div, addGenreButton);
        
});

// Get a reference to the "Add genre" button
const addDirectorButton = document.getElementById('add-director');

// Add an event listener to the button
addDirectorButton.addEventListener('click', function() {
    // Create a new input element

    let input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Prénom';
    input.classList.add('form-control');
    input.name = 'first_name[]';
    let input2 = document.createElement('input');
    input2.type = 'text';
    input2.placeholder = 'Nom';
    input2.classList.add('form-control');
    input2.name = 'last_name[]';
    let div = document.createElement('div');
    div.classList.add('mb-3');

    // Create a new label element
    const label = document.createElement('label');
    label.textContent = 'Réalisateur:';

    // Append the label and input elements to the form
    const form = document.querySelector('.movie-form');

    div.appendChild(label);
    div.appendChild(input);
    div.appendChild(input2);
    form.insertBefore(div, addDirectorButton);
});

