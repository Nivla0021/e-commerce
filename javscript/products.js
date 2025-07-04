function openModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "block";
}

// Function to close the modal
function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
}




function toggleSidebar() {
    const container = document.getElementById('container');
    container.classList.toggle('sidebar-open');

    const closeBtn = document.querySelector('.close-btn');
    const imgElement = closeBtn.querySelector('img');

    imgElement.src = container.classList.contains('sidebar-open') ? 'pics/right-arrow.png' : 'pics/left-arrow.png';
}





function confirmDelete() {
    return confirm("Are you sure you want to delete this product?");
}

document.getElementById('searchInput').addEventListener('input', function() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("productTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
});

const suggestions = [
    // Tops
    "T-Shirts",
    "Blouses",
    "Shirts",
    "Tank Tops",
    "Polo-shirt",
    "Crop Tops",
    "Sweaters",
    "Sando",
    "Hoodie",
    "Sweatshirts",
    "Cardigans",
    "Tunics",
    "Polos",
    "Bodysuits",
    "Henley Shirts",
  
    // Bottoms
    "Jeans",
    "Pants",
    "Shorts",
    "Skirts",
    "Leggings",
    "Trousers",
    "Capris",
    "Culottes",
    "Joggers",
    "Sweatpants",
  
    // Dresses
    "Casual Dresses",
    "Dress",
    "Evening Dresses",
    "Maxi Dresses",
    "Midi Dresses",
    "Mini Dresses",
    "Bodycon Dresses",
    "A-line Dresses",
    "Shift Dresses",
    "Shirt Dresses",
    "Wrap Dresses",
  
    // Outerwear
    "Jackets",
    "Coats",
    "Blazers",
    "Parkas",
    "Trench Coats",
    "Bomber Jackets",
    "Denim Jackets",
    "Leather Jackets",
    "Windbreakers",
    "Vests",
  
    // Activewear
    "Sports Bras",
    "Athletic Tops",
    "Athletic Shorts",
    "Leggings",
    "Tracksuits",
    "Yoga Pants",
    "Sweat-Wicking Shirts",
  
    // Underwear
    "Bras",
    "Panties",
    "Boxers",
    "Briefs",
    "Trunks",
    "Camisoles",
    "Slips",
    "Thermal Underwear",
  
    // Sleepwear
    "Pajamas",
    "Nightgowns",
    "Robes",
    "Sleep Shirts",
    "Sleep Shorts",
    "Sleep Pants",
  
    // Swimwear
    "Bikinis",
    "One-Piece Swimsuits",
    "Swim Trunks",
    "Swim Shorts",
    "Rash Guards",
    "Cover-Ups",
  
    // Special Occasion Wear
    "Formal Dresses",
    "Suits",
    "Cocktail Dresses",
    "Prom Dresses",
    "Wedding Dresses",
    "Bridesmaid Dresses",
  
    // Accessories
    "Hats",
    "Scarves",
    "Gloves",
    "Belts",
    "Sunglasses",
    "Jewelry",
    "Handbags",
    "Ties",
    "Bow Ties",
    "Socks",
  
    // Footwear
    "Sneakers",
    "Sandals",
    "Boots",
    "Flats",
    "Heels",
    "Loafers",
    "Slippers",
    "Athletic Shoes"
  ];
  

  const searchInput = document.getElementById('keyword');
  const suggestionsContainer = document.getElementById('suggestions');

  searchInput.addEventListener('input', function() {
    const query = this.value.toLowerCase();
    suggestionsContainer.innerHTML = '';
    if (query) {
      const filteredSuggestions = suggestions.filter(item => item.toLowerCase().includes(query));
      filteredSuggestions.forEach(item => {
        const suggestionItem = document.createElement('div');
        suggestionItem.className = 'suggestion-item';
        suggestionItem.textContent = item;
        suggestionItem.addEventListener('click', function() {
          searchInput.value = item;
          suggestionsContainer.innerHTML = '';
        });
        suggestionsContainer.appendChild(suggestionItem);
      });
      suggestionsContainer.style.display = 'block';
    } else {
      suggestionsContainer.style.display = 'none';
    }
  });

  document.addEventListener('click', function(e) {
    if (e.target !== searchInput) {
      suggestionsContainer.style.display = 'none';
    }
  });

  searchInput.addEventListener('focus', function() {
    if (suggestionsContainer.innerHTML !== '') {
      suggestionsContainer.style.display = 'block';
    }
  });
