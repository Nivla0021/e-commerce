document.getElementById('addToCartBtn').addEventListener('click', function() {
    // Show the modal
    document.getElementById('cartModal').style.display = 'block';
});

// Close the modal when the close button is clicked
document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('cartModal').style.display = 'none';
});


document.getElementById('buyNowBtn').addEventListener('click', function() {
    // Show the modal
    document.getElementById('cartModal-buy').style.display = 'block';
});

// Close the modal when the close button is clicked


function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
}

function checkQuantity() {
    // Get the inputted quantity and current stock
    const inputQuantity = parseInt(document.getElementById('quantity').value);
    const currentStock = parseInt(document.getElementById('stock').innerText.split(':')[1].trim());

    // Check if the inputted quantity is valid
    if (isNaN(inputQuantity) || inputQuantity <= 0) {
        alert('Please enter a valid quantity.');
        document.getElementById('proceedBtn').disabled = true;
        return;
    }

    // Check if the inputted quantity is greater than the stock
    if (inputQuantity > currentStock) {
        document.getElementById('proceedBtn').disabled = true;
        alert('Not enough stock for this order.');
    } else {
        document.getElementById('proceedBtn').disabled = false;
    }
}

function checkQuantity2() {
    // Get the inputted quantity and current stock
    const inputQuantity = parseInt(document.getElementById('quantity2').value);
    const currentStock = parseInt(document.getElementById('stock2').innerText.split(':')[1].trim());

    // Check if the inputted quantity is valid
    if (isNaN(inputQuantity) || inputQuantity <= 0) {
        alert('Please enter a valid quantity.');
        document.getElementById('proceedBtn2').disabled = true;
        return;
    }

    // Check if the inputted quantity is greater than the stock
    if (inputQuantity > currentStock) {
        document.getElementById('proceedBtn2').disabled = true;
        alert('Not enough stock for this order.');
    } else {
        document.getElementById('proceedBtn2').disabled = false;
    }
}

$('input').on('change', function() {
    $('body').toggleClass('blue');
});

function submitForm(id) {
    try {
        document.getElementById('form-' + id).submit();
    } catch (error) {
        console.error('Error submitting form:', error);
    }
}