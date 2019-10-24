function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    console.log(username);
    console.log(password);

    $("#reload").load('login.php', {'username': username, 'password':password })
}

function logout() {
    $.post('logout.php');

    location.reload();
}

//empty array for the days selected
daysSelected = [];

function selectDay(day) {
    
    console.log("In selectDay method for " + day);
    // if we havent selected anything
    if(!daysSelected.length) {

        // add this day to the front of our deque
        daysSelected.push(day);
        // change the class of the div to something else
        document.getElementsByName('date' + value).classname = "selected";
    }
    else {
        // check to see if it is - 1 of the beginning or + 1 of the end

    }
}
