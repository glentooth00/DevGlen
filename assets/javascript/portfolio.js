
const phrases = ["PHP Developer ", "Laravel Developer "];
let phraseIndex = 0;
let charIndex = 0;
let isDeleting = false;
const typingSpeed = 200; // typing speed in milliseconds
const eraseSpeed = 50; // erase speed in milliseconds
const delayBeforeErase = 2000; // delay before starting to erase in milliseconds

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

    if (charIndex === currentPhrase.length && !isDeleting) {
        isDeleting = true;
        document.getElementById("cursor").style.opacity = 0; // Hide cursor when typing completes
        setTimeout(startNextPhrase, delayBeforeErase); // Start erasing after delay
    } else if (charIndex === 0 && isDeleting) {
        isDeleting = false;
        phraseIndex = (phraseIndex + 1) % phrases.length;
    } else {
        setTimeout(type, delay);
    }
}

function startNextPhrase() {
    charIndex = phrases[phraseIndex].length; // Set charIndex to length of phrase
    setTimeout(eraseOneCharacter, eraseSpeed); // Start erasing one character at a time
}

function eraseOneCharacter() {
    const currentPhrase = phrases[phraseIndex];
    const remainingText = currentPhrase.substring(0, charIndex);
    document.getElementById("typing-animation").textContent = remainingText;

    charIndex--;

    if (charIndex >= 0) {
        setTimeout(eraseOneCharacter, eraseSpeed); // Erase next character after delay
    } else {
        // When erasing is complete, start typing the next phrase
        charIndex = 0;
        isDeleting = false;
        phraseIndex = (phraseIndex + 1) % phrases.length;
        document.getElementById("cursor").style.opacity = 1; // Show cursor for next phrase
        setTimeout(type, typingSpeed); // Start typing next phrase
    }
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
