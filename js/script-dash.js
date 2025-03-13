//dashboard

document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', () => {
        item.classList.toggle('active');
    });
});


   