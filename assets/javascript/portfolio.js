const phrases = ["PHP Developer", "Laravel Developer"];
let phraseIndex = 0;
let charIndex = 0;
let isDeleting = false;
const typingSpeed = 250; // typing speed in milliseconds (slower)
const eraseSpeed = 50; // erase speed in milliseconds

function type() {
  const currentPhrase = phrases[phraseIndex];
  const delay = isDeleting ? eraseSpeed : typingSpeed;

  if (!isDeleting && charIndex <= currentPhrase.length) {
    document.getElementById("typing-animation").textContent = currentPhrase.substring(0, charIndex);
    charIndex++;
  } else if (isDeleting && charIndex >= 0) {
    document.getElementById("typing-animation").textContent = currentPhrase.substring(0, charIndex);
    charIndex--;
  }

  if (charIndex === currentPhrase.length) {
    isDeleting = true;
    document.getElementById("cursor").style.opacity = 1; // Reset cursor opacity
  } else if (charIndex === 0) {
    isDeleting = false;
    phraseIndex = (phraseIndex + 1) % phrases.length;
  }

  setTimeout(type, delay);
}

window.onload = function () {
  type();
};

document.getElementById("submitBtn").addEventListener("click", function() {
  var email = document.getElementById("email").value;
  var message = document.getElementById("message").value;

  // Basic email validation
  if (!email || !message) {
      alert("Please fill in all fields.");
      return;
  }

  // Send form data to server
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "send_email.php");
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onload = function() {
      if (xhr.status === 200) {
          alert("Message sent successfully!");
      } else {
          alert("Error: Message could not be sent.");
      }
  };
  xhr.send(JSON.stringify({ email: email, message: message }));
});