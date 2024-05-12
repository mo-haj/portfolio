
 //                         save settings                   //
 document.addEventListener("DOMContentLoaded", function() {
    // Get the modal element
    var settingsModal = document.getElementById("settingsModal");
    
    // Get the "Save" button
    var saveSettingsBtn = document.getElementById("saveSettingsBtn");
    
    // Add click event listener to the "Save" button
    saveSettingsBtn.addEventListener("click", function() {
        // Get the selected color
        var selectedColor = document.querySelector(".btn-group .btn.active").innerText.trim();
        
        // Save the selected color to local storage
        localStorage.setItem("selectedColor", selectedColor);
        
        // Close the modal
        var modal = bootstrap.Modal.getInstance(settingsModal);
        modal.hide();
    });
    
    // Apply the saved color when the page loads
    var savedColor = localStorage.getItem("selectedColor");
    if (savedColor) {
        // Apply the saved color to the interface
        var btnGroup = document.querySelector(".btn-group");
        var btns = btnGroup.querySelectorAll(".btn");
        btns.forEach(function(btn) {
            if (btn.innerText.trim() === savedColor) {
                btn.classList.add("active");
            } else {
                btn.classList.remove("active");
            }
        });
    }
  });