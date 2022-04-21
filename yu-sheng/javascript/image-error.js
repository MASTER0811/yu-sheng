document.querySelectorAll("img").forEach(item => {
  item.addEventListener("error", () => {
    item.src = "image/questions-mark.png";
    item.alt = "Failed to load image";
  });
});