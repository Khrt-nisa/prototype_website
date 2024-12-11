// Pop-up Boxes
function showAlert() {
    alert("Welcome to Happy Kids Daycare!");
}

function showConfirm() {
    const confirmed = confirm("Are you sure you want to proceed?");
    if (confirmed) {
        alert("You confirmed!");
    } else {
        alert("Action canceled.");
    }
}

function showPrompt() {
    const name = prompt("Please enter your name:", "Guest");
    if (name) {
        alert("Hello, " + name + "!");
    }
}

// Snackbar / Toast Message
function showToast(message) {
    const snackbar = document.getElementById("snackbar");
    snackbar.innerText = message;
    snackbar.classList.add("show");
    setTimeout(() => snackbar.classList.remove("show"), 3000);
}

// Event Mouse: Change color on mouseover
document.getElementById("title").addEventListener("mouseover", () => {
    document.getElementById("title").style.color = "blue";
});
document.getElementById("title").addEventListener("mouseout", () => {
    document.getElementById("title").style.color = "black";
});

// Event Keyboard: Alert on Enter key
document.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
        alert("Enter key pressed!");
    }
});

// Event Form: Confirm on submit
document.getElementById("contactForm").addEventListener("submit", (event) => {
    event.preventDefault();
    alert("Form has been submitted!");
});

// Event Window: Alert on load
window.addEventListener("load", () => {
    alert("Page has fully loaded!");
});

// Web Storage
localStorage.setItem("welcomeMessage", "Hello, welcome back to Happy Kids Daycare!");
const message = localStorage.getItem("welcomeMessage");
alert(message);

sessionStorage.setItem("visitMessage", "Welcome to this session!");
const sessionMessage = sessionStorage.getItem("visitMessage");
console.log(sessionMessage);

// Asynchronous: Promise and Fetch
function asyncGreeting() {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve("Async Greeting: Hello from Happy Kids Daycare!");
        }, 2000);
    });
}

asyncGreeting().then((message) => alert(message));

fetch("https://jsonplaceholder.typicode.com/posts/1")
    .then((response) => response.json())
    .then((data) => {
        console.log("Fetched Data:", data);
        alert("Title: " + data.title);
    })
    .catch((error) => console.error("Error:", error));
