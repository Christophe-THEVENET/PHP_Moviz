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

// Get a reference to the "Add director button
const addDirectorButton = document.getElementById('add-director');

// Add an event listener to the button
addDirectorButton.addEventListener('click', function() {
    // Create a new input element

    let label = document.createElement('label');
    label.textContent = 'Prénom';
    label.classList.add('form-label');
    let input = document.createElement('input');
    input.type = 'text';
    input.classList.add('form-control');
    input.name = 'first_name[]';
    let label2 = document.createElement('label');
    label2.textContent = 'Nom';
    label2.classList.add('form-label');
    let input2 = document.createElement('input');
    input2.type = 'text';
    input2.classList.add('form-control');
    input2.name = 'last_name[]';
    let div = document.createElement('div');
    div.classList.add('mb-3');
    let div2 = document.createElement('div');
    div2.classList.add('mb-3');
    let container = document.createElement('div');
    container.classList.add('d-flex');
    container.classList.add('directors-block');

    let inputHidden1 = document.createElement('input');
    inputHidden1.type = 'hidden';
    inputHidden1.name = 'director_id';

    let inputHidden2 = document.createElement('input');
    inputHidden2.type = 'hidden';
    inputHidden2.name = 'movie_id';

    let a = document.createElement('a');
    a.classList.add('delete-link-dyn');
    let i = document.createElement('i');
    i.classList.add('bi');
    i.classList.add('bi-x-square-fill');

    a.appendChild(i);

    // Append the label and input elements to the form
    const form = document.querySelector('.movie-form');

    div.appendChild(label);
    div.appendChild(input);
    div2.appendChild(label2);
    div2.appendChild(input2);
    container.appendChild(div);
    container.appendChild(div2);
    container.appendChild(inputHidden1);
    container.appendChild(inputHidden2);
    container.appendChild(a);
    form.insertBefore(container, addDirectorButton);

    document.querySelectorAll('.delete-link-dyn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            let div = this.closest('div');
            div.querySelector('input[name="director_id"]').value = '';
            div.querySelector('input[name="movie_id"]').value = '';
            container.remove();
        });
    });
});

// *************** DELETE DIRECTOR ***************************

document.querySelectorAll('.delete-link').forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault(); // Empêche le formulaire d'être soumis normalement

        let div = this.closest('div');
        let directorId = div.querySelector('input[name="director_id"]').value;
        let movieId = div.querySelector('input[name="movie_id"]').value;

        // Envoyez une requête AJAX au script PHP
        fetch('http://localhost:8080/Api/delete-link-director-movie.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `director_id=${directorId}&movie_id=${movieId}`
        })
            .then(response => {
                div.remove();
                if (response.ok) {
                    console.log('Le lien a été supprimé avec succès.');
                } else {
                    console.error("Une erreur s'est produite lors de la suppression du lien.");
                }
            })
            .catch(error => {
                console.error("Une erreur s'est produite lors de la requête AJAX :", error);
            });
    });
});
