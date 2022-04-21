document.querySelector(".menu-icons").addEventListener("click", () => {
  document.querySelector(".nav-menu").classList.add("active");
  document.querySelector(".overlay").classList.add("active");
});
document.querySelector(".overlay").addEventListener("click", () => {
  document.querySelector(".nav-menu").classList.remove("active");
  document.querySelector(".overlay").classList.remove("active");
});