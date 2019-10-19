function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    console.log(username);
    console.log(password);

    $("#reload").load('login.php', {'username': username, 'password':password })
}