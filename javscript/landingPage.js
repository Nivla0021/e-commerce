function submit(id) {
    let form = document.getElementById(id);
    form.submit();
  }

  const suggestions = [
    // Tops
    "T-Shirts",
    "Blouses",
    "Shirts",
    "Tank Tops",
    "Crop Tops",
    "Sweaters",
    "Hoodie",
    "Sando",
    "Polo-shirt",
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
  

  const searchInput = document.getElementById('srch');
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

  function initializePasswordToggle() {
    const toggleIcons = document.querySelectorAll('.toggle-icon');

    toggleIcons.forEach(icon => {
      icon.addEventListener('click', function() {
        const input = this.previousElementSibling;
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        this.src = type === 'password' ? 'pics/eye.png' : 'pics/visible.png';
      });
    });
  }

  document.addEventListener('DOMContentLoaded', initializePasswordToggle);