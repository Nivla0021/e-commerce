function initializePasswordToggle() {
    const toggleIcons = document.querySelectorAll('.toggle-icon');

    toggleIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.src = type === 'password' ? 'pics/eye.png' : 'pics/visible.png';
        });
    });
}

document.addEventListener('DOMContentLoaded', initializePasswordToggle);