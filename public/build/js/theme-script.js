// Immediately set the theme based on local storage
const darkMode = localStorage.getItem('darkMode');
const themeClass = darkMode === 'enabled' ? 'dark' : 'light';

// Apply the theme class to the document
document.documentElement.className = themeClass;

// Wait for DOM to be fully loaded before adding event listeners
document.addEventListener("DOMContentLoaded", function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const lightModeToggle = document.getElementById('light-mode-toggle');

    const darkModeToggleMobile = document.getElementById('dark-mode-toggle-mobile');
    const lightModeToggleMobile = document.getElementById('light-mode-toggle-mobile');

    function toggleMode(isDarkMode) {
        if (isDarkMode) {
            document.documentElement.classList.add('dark');
            darkModeToggle.classList.remove('activate');
            lightModeToggle.classList.add('activate');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            document.documentElement.classList.remove('dark');
            lightModeToggle.classList.remove('activate');
            darkModeToggle.classList.add('activate');
            localStorage.setItem('darkMode', 'disabled');
        }
    }

    // Initial activation based on the current theme
    if (themeClass === 'dark') {
        darkModeToggle.classList.remove('activate');
        lightModeToggle.classList.add('activate');
    } else {
        lightModeToggle.classList.remove('activate');
        darkModeToggle.classList.add('activate');
    }

    // Add event listeners
    if (darkModeToggle && lightModeToggle) {
        darkModeToggle.addEventListener('click', () => toggleMode(true));
        lightModeToggle.addEventListener('click', () => toggleMode(false));
    }














    function toggleModeMobile(isDarkModeMobile) {
        if (isDarkModeMobile) {
            document.documentElement.classList.add('dark');
            darkModeToggleMobile.classList.remove('activate');
            lightModeToggleMobile.classList.add('activate');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            document.documentElement.classList.remove('dark');
            lightModeToggleMobile.classList.remove('activate');
            darkModeToggleMobile.classList.add('activate');
            localStorage.setItem('darkMode', 'disabled');
        }
    }

    // Initial activation based on the current theme
    if (themeClass === 'dark') {
        darkModeToggleMobile.classList.remove('activate');
        lightModeToggleMobile.classList.add('activate');
    } else {
        lightModeToggleMobile.classList.remove('activate');
        darkModeToggleMobile.classList.add('activate');
    }

    // Add event listeners
    if (darkModeToggleMobile && lightModeToggleMobile) {
        darkModeToggleMobile.addEventListener('click', () => toggleModeMobile(true));
        lightModeToggleMobile.addEventListener('click', () => toggleModeMobile(false));
    }
});
