const container = document.querySelector('.btn-container');
container.addEventListener('animationend', () => {
    container.classList.remove('active');
});