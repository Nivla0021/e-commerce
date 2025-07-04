document.addEventListener('DOMContentLoaded', () => {
    const uploadInput = document.getElementById('uploads-input');
    const profilePic = document.getElementById('profile_pic');

    profilePic.addEventListener('click', () => {
        uploadInput.click();
    });

    uploadInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                profilePic.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});

function toggleSidebar() {
    const container = document.getElementById('container1');
    container.classList.toggle('sidebar-open');

    const closeBtn = document.querySelector('.close-btn');
    const imgElement = closeBtn.querySelector('img');

    imgElement.src = container.classList.contains('sidebar-open') ? 'pics/right-arrow.png' : 'pics/left-arrow.png';
}

const suggestions = [
    // Tops
    "T-Shirts",
    "Blouses",
    "Shirts",
    "Tank Tops",
    "Crop Tops",
    "Polo-shirt",
    "Sweaters",
    "Hoodie",
    "Sando",
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