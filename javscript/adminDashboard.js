function toggleSidebar() {
    const container = document.getElementById('container');
    container.classList.toggle('sidebar-open');

    const closeBtn = document.querySelector('.close-btn');
    const imgElement = closeBtn.querySelector('img');

    imgElement.src = container.classList.contains('sidebar-open') ? 'pics/right-arrow.png' : 'pics/left-arrow.png';

}