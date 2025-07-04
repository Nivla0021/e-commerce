const modal = document.getElementById('reviewModal');

     
const writeReviewBtn = document.querySelector('.write-review-btn');


const closeBtn = document.querySelector('.close');


writeReviewBtn.addEventListener('click', () => {
    modal.style.display = 'block';
});


closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
}


window.addEventListener('click', (event) => {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});

document.getElementById('submitReviewBtn').addEventListener('click', () => {
    const rating = document.getElementById('rating').value;
    const comment = document.getElementById('comment').value;

    
    console.log('Rating:', rating);
    console.log('Comment:', comment);

    
    modal.style.display = 'none';
});