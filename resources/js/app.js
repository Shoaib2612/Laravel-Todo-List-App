import './bootstrap';


function toggleMenu() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
  }
  
  // Close the dropdown menu when clicking outside
  window.onclick = function(event) {
    const dropdownMenu = document.getElementById('dropdownMenu');
    if (event.target !== dropdownMenu && !event.target.matches('.hamburger-btn')) {
      dropdownMenu.style.display = 'none';
    }
  };