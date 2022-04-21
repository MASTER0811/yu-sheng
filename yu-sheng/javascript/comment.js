const commentForm = document.querySelector("#comment-form");
const commentButton = commentForm.querySelector("button");
const commentList = document.querySelector(".comment-list");
const commentQuantity = document.querySelector(".comment-quantity");

commentForm.addEventListener("submit", (e) => {
  e.preventDefault();
});

commentButton.addEventListener("click", () => {
  commentButton.classList.add("disabled");
  commentButton.innerHTML = `<div class="spinner-border text-white" style="width: 25px; height: 25px;"></div>`;
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "op-php/op-comment.php", true);
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4 && xhr.status === 200) {
      commentButton.classList.remove("disabled");
      commentButton.innerHTML = "留言";
      const result = xhr.response.charAt(1);
      if (result !== "d") {
        alert(xhr.response);
      } else {
        commentList.innerHTML = xhr.response;
        commentForm.querySelector("textarea").value = "";
        commentQuantity.textContent++;
        window.scrollTo(0, document.body.scrollHeight);
        commentList.scrollTo(0, document.body.scrollHeight);
      }
    }
  }
  xhr.send(new FormData(commentForm));
});

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "op-php/op-return-comment.php", true);
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4 && xhr.status === 200) {
      commentList.innerHTML = xhr.response;
    }
  }
  xhr.send(null);
}, 1000);
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "op-php/op-return-comment-quantity.php", true);
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4 && xhr.status === 200) {
      commentQuantity.textContent = xhr.response;
    }
  }
  xhr.send(null);
}, 1000);