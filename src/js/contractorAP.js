profileButton = document.querySelector(".button-profile");
servicesButton = document.querySelector(".button-services");
requestsButton = document.querySelector(".button-requests");

profileSection = document.querySelector(".profile");
servicesSection = document.querySelector(".services");
requestsSection = document.querySelector(".requests");

let profileState = 1;
let servicesState = 0;
servicesSection.display = "none";
let requestsState = 0;
requestsSection.display = "none";

function profileToggle() {
  if (profileState === 0) {
    profileState = 1;
    profileSection.display = "flex";
    servicesState = 0;
    servicesSection.display = "none";
    requestsState = 0;
    requestsSection.display = "none";
  }
}

function servicesToggle() {
  if (servicesState === 0) {
    profileState = 0;
    profileSection.display = "none";
    servicesState = 1;
    servicesSection.display = "flex";
    requestsState = 0;
    requestsSection.display = "none";
  }
}

function requestsToggle() {
  if (requestsState === 0) {
    profileState = 0;
    profileSection.display = "none";
    servicesState = 0;
    servicesSection.display = "none";
    requestsState = 1;
    requestsSection.display = "flex";
  }
}

profileButton.addEventListener("click", profileToggle);
servicesButton.addEventListener("click", servicesToggle);
requestsButton.addEventListener("click", requestsToggle);
