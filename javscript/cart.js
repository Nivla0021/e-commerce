const checkoutBtn = document.getElementById('checkout');



        document.querySelectorAll('.cart-checkbox, .quantity input').forEach(function(element) {
            element.addEventListener('change', function() {
                updateTotal();
                checkCheckout();
            });
        });



        document.getElementById('checkout').addEventListener('click', function() {
            if (!this.classList.contains('disabled')) {
                document.getElementById('order-summary-modal').style.display = 'flex';
                showOrderSummary();
            }
        });

        document.querySelector('.modal-close').addEventListener('click', function() {
            document.getElementById('order-summary-modal').style.display = 'none';
        });



        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.cart-item').forEach(function(item) {
                const checkbox = item.querySelector('.cart-checkbox');
                if (checkbox.checked) {
                    const price = parseFloat(item.querySelector('.cart-item-info span').textContent.replace('₱', ''));
                    const quantity = parseInt(item.querySelector('.quantity input').value);
                    total += price * quantity;
                }
            });
            document.getElementById('total-price').textContent = 'Total Price:  ₱' + total.toFixed(2);
        }

        function updateCartCount() {
            const cartCount = document.querySelectorAll('.cart-item').length;
            document.getElementById('cart-count').textContent = 'Number of Items: ' + cartCount;
        }

        function showOrderSummary() {
            const cartItems = document.querySelectorAll('.cart-item');
            const orderedItemsList = document.getElementById('ordered-items');
            orderedItemsList.innerHTML = '';
            let totalAmount = 0;

            cartItems.forEach(function(item) {
                const checkbox = item.querySelector('.cart-checkbox');
                if (checkbox.checked) {
                    const pid = item.querySelector('.cart-item-info .prid').textContent;
                    const id = item.querySelector('.cart-item-info h1').textContent;
                    const name = item.querySelector('.cart-item-info h3').textContent;
                    const size = item.querySelector('.cart-item-info h5').textContent;
                    const price = parseFloat(item.querySelector('.cart-item-info span').textContent.replace('₱;', ''));
                    const quantity = parseInt(item.querySelector('.quantity input').value);

                    const totalItemPrice = price * quantity;
                    totalAmount += totalItemPrice;

                    const listItem = document.createElement('li');
                    const imgSrc = item.querySelector('img').src;
                    const imgAlt = item.querySelector('img').alt;
                    listItem.innerHTML = `<img src="${imgSrc}" alt="${imgAlt}" style="width: 50px; height: 50px; margin-right: 10px;"> ${name} <br>  ${size} <br> Price: &#8369;${price} <br> Quantity: ${quantity} <br> Total: &#8369;${totalItemPrice.toFixed(2)} <br> <br>`;
                    orderedItemsList.appendChild(listItem);
                }
            });

            document.getElementById('total-amount').textContent = `Total Amount:  ₱${totalAmount.toFixed(2)}`;

            // Add event listener for Confirm Payment button
            const confirmPaymentBtn = document.getElementById('confirm-payment');
            confirmPaymentBtn.addEventListener('click', function() {
                const inputAmount = parseFloat(document.getElementById('input-amount').value);
                const totalAmount = parseFloat(document.getElementById('total-price').textContent.replace('Total Price:  ₱', ''));
                if (isNaN(inputAmount) || inputAmount < totalAmount) {
                    alert('Issuficient payment, Please enter a valid amount!.');
                    return; // Exit the function if the input amount is invalid
                }
                document.getElementById('order-summary-modal').style.display = 'none';
                alert('Thank you for purchasing our product!');
                const dataToSend = {
                    id: [],
                    pid: [],
                    imgSrc: [],
                    name: [],
                    size: [],
                    price: [],
                    quantity: [],
                    totalItemPrice: [],
                    totalAmount: totalAmount.toFixed(2)
                };

                cartItems.forEach(function(item) {
                    const checkbox = item.querySelector('.cart-checkbox');
                    if (checkbox.checked) {
                        dataToSend.id.push(item.querySelector('.cart-item-info h1').textContent);
                        dataToSend.pid.push(item.querySelector('.cart-item-info .prid').textContent);
                        dataToSend.imgSrc.push(item.querySelector('img').src);
                        dataToSend.name.push(item.querySelector('.cart-item-info h3').textContent);
                        dataToSend.size.push(item.querySelector('.cart-item-info h5').textContent);
                        dataToSend.price.push(parseFloat(item.querySelector('.cart-item-info span').textContent.replace('₱;', '')));
                        dataToSend.quantity.push(parseInt(item.querySelector('.quantity input').value));
                        dataToSend.totalItemPrice.push(parseFloat(item.querySelector('.cart-item-info span').textContent.replace('₱;', '')) * parseInt(item.querySelector('.quantity input').value));
                    }
                });
                // Send the data using AJAX
                const xhr = new XMLHttpRequest();
                const url = 'process_order.php'; // Adjust the URL as needed
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the response from the PHP file if needed
                        console.log(xhr.responseText);

                        // Check if the response indicates success
                        if (xhr.responseText === 'Data received successfully.') {

                        }
                    }
                };
                xhr.send(JSON.stringify(dataToSend));

                setInterval(reloadPage, 300);



            });
        }

        function reloadPage() {
            console.log("Reloading page...");
            location.reload();
        }

        function checkCheckout() {
            const checkboxes = document.querySelectorAll('.cart-checkbox');
            let checkedItems = [];
            let canCheckout = true;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    const cartItem = checkbox.closest('.cart-item');
                    const inputQuantity = parseInt(cartItem.querySelector('.quantity input').value);
                    const currentStock = parseInt(cartItem.querySelector('.cart-item-info #stock').innerText.split(':')[1].trim());

                    if (inputQuantity > currentStock) {
                        canCheckout = false;
                        alert('Not enough stock for one or more selected items.');
                        return;
                    }

                    checkedItems.push(checkbox);
                }
            });

            if (canCheckout && checkedItems.length > 0) {
                checkoutBtn.classList.remove('disabled');
            } else {
                checkoutBtn.classList.add('disabled');
            }
        }

        checkCheckout();

        function confirmDelete() {
            return confirm("Are you sure you want to remove this item?");
        }

        function confirmDeleteAll() {
            return confirm("Are you sure you want to remove all items?");
        }