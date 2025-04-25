// Function to toggle the menu
function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.classList.toggle('open');
}

// Add event listener to the toggle button
document.getElementById('menuToggle').addEventListener('click', toggleMenu);