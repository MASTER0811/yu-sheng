document.querySelector("#edit-profile").addEventListener("input", (e) => {
  if (e.target.value.trim() != "") {
    document.querySelector(".edit-profile-button").classList.remove("disabled");
  } else {
    document.querySelector(".edit-profile-button").classList.add("disabled");
  }
});