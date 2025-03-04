const isDarkTheme = localStorage.getItem('darkTheme') === 'true';

// Apply the theme on page load
if (isDarkTheme) {
    document.body.classList.add("dark-theme");
    document.getElementById('check').checked="true";
}

// Add event listener to the checkbox
document.getElementById('check').addEventListener('click', function() {
    // Toggle the dark theme class
    if(check.checked==false){
      document.body.classList.remove("dark-theme");
  }else{
      document.body.classList.add("dark-theme");
  }

    // Update the theme setting in localStorage
    localStorage.setItem('darkTheme', document.body.classList.contains("dark-theme"));
});





