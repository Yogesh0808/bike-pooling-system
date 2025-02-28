document.addEventListener('DOMContentLoaded', () => {
    const checkBox = document.getElementById('check');
    const body = document.body;

    // Check Local Storage for dark mode preference
    if (localStorage.getItem('darkTheme') === 'true') {
        body.classList.add("dark-mode");
        checkBox.checked = true;
    }

    // Toggle Dark Mode on checkbox change
    checkBox.addEventListener('change', () => {
        if (checkBox.checked) {
            body.classList.add("dark-mode");
            localStorage.setItem('darkTheme', 'true');
        } else {
            body.classList.remove("dark-mode");
            localStorage.setItem('darkTheme', 'false');
        }
    });
});
