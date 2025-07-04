function openModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "block";
  }
  
  // Function to close the modal
  function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
  }
  
  // Close the modal if the user clicks outside of it
  window.onclick = function(event) {
    var modals = document.getElementsByClassName('modal');
    for (var i = 0; i < modals.length; i++) {
      var modal = modals[i];
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }

  function notif(){
    alert("Please SIGN UP/ LOGIN first !");
  }