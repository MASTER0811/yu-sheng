document.querySelectorAll(".logout-button").forEach(item => {
  item.addEventListener("click", (e) => {
    e.preventDefault();
    const isLogout = confirm("您确定要登出? 登出后需要重新登入");
    if(isLogout) {
      window.location.href = "logout.php";
    } else {
      console.log("s");
    }
  });
});