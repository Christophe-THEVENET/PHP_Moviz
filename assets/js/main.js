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
if (addDirectorButton) {
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
}

// *************** ETOILE NOTATION ***************************
// Sélectionnez tous les éléments d'entrée de type radio avec le nom "rate"
const rateRadios = document.querySelectorAll('input[name="rate"]');
// Ajoutez un gestionnaire d'événements pour chaque élément d'entrée de type radio
rateRadios.forEach(radio => {
    radio.addEventListener('change', () => {
        // Réinitialisez la couleur de toutes les étoiles
        rateRadios.forEach(r => {
            r.nextElementSibling.style.color = 'lightgrey';
        });
        // Changez la couleur des étoiles sélectionnées et de celles qui les précèdent
        let selectedValue = parseInt(radio.value);
        for (let i = 1; i <= selectedValue; i++) {
            document.getElementById(`rate_${i}`).nextElementSibling.style.color = 'gold';
        }
    });
});

// *******************************************************************************
// ************************ REQSUETES ASYNCHRONE********************************
// *******************************************************************************

// *************** DELETE DIRECTOR ***************************
document.querySelectorAll('.delete-link').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        let div = this.closest('div');
        let directorId = div.querySelector('input[name="director_id"]').value;
        let movieId = div.querySelector('input[name="movie_id"]').value;
        let data = {};
        data.director_id = directorId;
        data.movie_id = movieId;

        fetch('http://localhost:8080/Api/delete-link-director-movie.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error("La réponse du réseau n'était pas correcte");
                } else {
                    div.remove();
                    return response.text(); // Utilise .text() pour inspecter la réponse brute
                }
            })
            .then(text => {
                try {
                    const json = JSON.parse(text); // Essaie de convertir la réponse en JSON
                    console.log(json);
                } catch (error) {
                    console.error("La réponse n'est pas un JSON valide :", text);
                }
            })
            .catch(error => {
                console.error("Une erreur s'est produite lors de la requête AJAX :", error);
            });
    });
});
// *************** APPROUVED REVIEW ***************************
let approuvedButtons = document.querySelectorAll('input[name="approuved"]');
approuvedButtons.forEach(approuvedButton => {
    approuvedButton.addEventListener('change', () => {
        // récup la review et le approuved avec les dataset
        let reviewId = approuvedButton.dataset.id;
        let reviewApprouved = approuvedButton.checked ? 1 : 0;
        let data = {};
        data.review_id = parseInt(reviewId);
        data.review_approuved = parseInt(reviewApprouved);

        fetch('http://localhost:8080/Api/change-approuved-review.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error("La réponse du réseau n'était pas correcte");
                }
                return response.text(); // Utilise .text() pour inspecter la réponse brute
            })
            .then(text => {
                try {
                    const json = JSON.parse(text); // Essaie de convertir la réponse en JSON
                    console.log(json);
                } catch (error) {
                    console.error("La réponse n'est pas un JSON valide :", text);
                }
            })
            .catch(error =>
                console.error("Il y a eu un problème avec l'opération de fetch :", error)
            );
    });
});
// *************** POST REVIEW ***************************
let formPostReview = document.querySelector('.form-post-review');
formPostReview.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(e.target);
    let data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });
    data['approuved'] = 0;

    fetch('http://localhost:8080/Api/post-review-by-movie.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const successDiv = document.createElement('div');
            successDiv.classList.add('alert', 'alert-success');
            successDiv.textContent = data.success;

            formPostReview.appendChild(successDiv);
            setTimeout(() => {
                successDiv.remove();
                formPostReview.reset();
                rateRadios.forEach(r => {
                    r.nextElementSibling.style.color = 'lightgrey';
                });
            }, 3000);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            const errorDiv = document.createElement('div');
            errorDiv.classList.add('alert', 'alert-danger');
            errorDiv.textContent = 'An error occurred while processing your request.';
            formPostReview.appendChild(errorDiv);
            setTimeout(() => {
                errorDiv.remove();
            }, 3000);
        });
});
// *************** DELETE REVIEW ***************************
document.querySelectorAll('.delete-review').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        alert('confirmez la suppression de votre commentaire !');

        let reviewId = button.dataset.reviewId;
        let div = this.closest('div');
        let reviewBlock = div.parentNode;
        let data = {};
        data.review_id = reviewId

        fetch('http://localhost:8080/Api/delete-review.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                reviewBlock.remove();
                div.remove();
                return response.json();
            })
            .then(data => {
                console.log('Review deleted successfully:', data);
            })
            .catch(error => {
                console.error('Error deleting review:', error);
            });
    });
});
