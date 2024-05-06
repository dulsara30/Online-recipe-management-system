function redirect(isLoggedIn) {
    if (isLoggedIn === 'false') {
        alert("Please login first");
        window.location.href = "login.php";
    } else {
        window.location.href = "recipe-details.php";
    }
}
