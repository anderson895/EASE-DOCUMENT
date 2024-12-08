window.onload = function() {
    // Check if the page has been loaded before
    if (!sessionStorage.getItem('loaded')) {
      // Set a 1-second delay before hiding the loading screen
      setTimeout(function() {
        document.getElementById('loadingScreen').style.opacity = '0';
        setTimeout(function() {
          document.getElementById('loadingScreen').style.display = 'none';
        }, 2000); // Hide after the opacity transition is complete
      }, 2000); // Show for 1 second
  
      // Mark the page as loaded in sessionStorage
      sessionStorage.setItem('loaded', 'true');
    } else {
      // Immediately hide the loading screen if the page has already been loaded
      document.getElementById('loadingScreen').style.opacity = '0';
      document.getElementById('loadingScreen').style.display = 'none';
    }
  };