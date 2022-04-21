document.querySelectorAll(".delete-account-button").forEach(item => {
  item.addEventListener("click", (e) => {
    e.preventDefault();
    const isLogout = confirm("您确定要删除您的账户 ?");
    if(isLogout) {
      window.location.href = "delete-account.php";
    } else {
      console.log("s");
    }
  });
});