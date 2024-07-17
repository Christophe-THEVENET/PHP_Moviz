</main>



<footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Accueil</a></li>
    </ul>
    <p class="text-center text-muted">© <?= date('Y'); ?> - Moviz</p>
</footer>

</div>

<script>
    // remove success message auto
    document.addEventListener("DOMContentLoaded", () => {
        const messages = document.querySelectorAll(".message");
        messages.forEach(message => {
            setTimeout(() => {
                message.style.opacity = 0;
                setTimeout(() => {
                    message.parentNode.removeChild(message);
                }, 500); // Wait for 1 second (1000 milliseconds) for the fade out animation to complete
            }, 2000); // 5000 milliseconds = 5 seconds
        });
    });
</script>



</body>

</html>