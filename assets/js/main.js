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
