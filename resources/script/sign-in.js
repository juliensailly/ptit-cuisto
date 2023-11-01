let signBackground = document.querySelector(".sign-up-background"),
    signInWindow = document.querySelector(".sign-in-window"),
    signUpWindow = document.querySelector(".sign-up-window"),
    signUpLink = document.querySelector(".sign-up-link"),
    signInLink = document.querySelector(".sign-in-link");

document.querySelector(".sign-in-btn").addEventListener("click", () => {
    signBackground.style.display = "flex";
});

document.querySelector(".sign-in-window .xmark").addEventListener("click", () => {
    signBackground.style.display = "none";
    signInWindow.style.display = "flex";
    signUpWindow.style.display = "none";
});

document.querySelector(".sign-up-window .xmark").addEventListener("click", () => {
    signBackground.style.display = "none";
    signInWindow.style.display = "flex";
    signUpWindow.style.display = "none";
});

signUpLink.addEventListener("click", () => {
    signInWindow.style.display = "none";
    signUpWindow.style.display = "flex";
});

signInLink.addEventListener("click", () => {
    signInWindow.style.display = "flex";
    signUpWindow.style.display = "none";
});