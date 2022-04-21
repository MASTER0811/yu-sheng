function showPassword() {
  document.querySelectorAll(".type-password").forEach(item => {
    if (item.type === "password") {
      item.type = "text";
    } else {
      item.type = "password";
    }
  });
}