document.addEventListener("DOMContentLoaded", () => {
  const profileButton = document.querySelector(".pf-btn");
  const profileNavigation = document.querySelector(".pf-nav");

  profileButton.addEventListener("click", () => {
    profileNavigation.classList.toggle("hidden");
  });



});
