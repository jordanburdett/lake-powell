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
var daysSelected = [];

function selectDay(day) {
    
    console.log("In selectDay method for " + day);
    console.log('date' + day);

    // if we havent selected anything
    if(!daysSelected.length) {
        // always allowed because it's the first

        // add this day to the front of our deque
        daysSelected.push(day);
        // change the class of the div to something else
        $("[name='date" + day + "']").attr('onclick', 'removeSelected(' + day +')');
        $("[name='date" + day + "']").attr('id', 'selected');
        
    }
    else {

        // check to see if it is - 1 of the beginning or + 1 of the end if its allowed
        $("[name='date" + day + "']").attr('onclick', 'removeSelected(' + day +')');
        $("[name='date" + day + "']").attr('id', 'selected');
        console.log("[name='date" + day + "']");
        daysSelected.push(day);
    }
    console.log(daysSelected);
}

function removeSelected(day) {
    console.log("REMOVE SELECTED");
    $("[name='date" + day + "']").attr('id', 'avaliable');
    $("[name='date" + day + "']").attr('onclick', 'selectDay(' + day + ')');
    
    var indexToRemove = daysSelected.indexOf(day);
    daysSelected.splice(indexToRemove, 1);
    
}
    