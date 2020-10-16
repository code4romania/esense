// Get the container element
var avatarsContainer = document.querySelector(".avatars");

// Get all buttons with class="btn" inside the container
var avatars = avatarsContainer.getElementsByClassName("predifined-avatar");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < avatars.length; i++) {
  avatars[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active-avatar");
    current[0].className = current[0].className.replace(" active-avatar", "");
    this.className += " active-avatar";
  });
}