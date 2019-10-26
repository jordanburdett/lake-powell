function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    console.log(username);
    console.log(password);

    $("#reload").load('login.php', { 'username': username, 'password': password })
}

function logout() {
    $.post('logout.php');

    location.reload();
}

//empty array for the days selected
var daysSelected = [];

function selectDay(day) {

    // if we havent selected anything
    if (!daysSelected.length) {
        // always allowed because it's the first

        // add this day to the front of our deque
        daysSelected.push(day);
        // change the class of the div to something else
        $("[name='date" + day + "']").attr('onclick', 'removeSelected(' + day + ')');
        $("[name='date" + day + "']").attr('id', 'selected');

    }
    else {

        // check to see if it is - 1 of the beginning or + 1 of the end if its allowed

        if (daysSelected[0] - 1 == day || day == daysSelected[daysSelected.length - 1] + 1) {
            $("[name='date" + day + "']").attr('onclick', 'removeSelected(' + day + ')');
            $("[name='date" + day + "']").attr('id', 'selected');

            daysSelected.push(day);
        }
    }
    daysSelected.sort();
}

function removeSelected(day) {

    if (daysSelected[0] == day || day == daysSelected[daysSelected.length - 1]) {
        console.log("REMOVE SELECTED");
        $("[name='date" + day + "']").attr('id', 'avaliable');
        $("[name='date" + day + "']").attr('onclick', 'selectDay(' + day + ')');
        var indexToRemove = daysSelected.indexOf(day);
        daysSelected.splice(indexToRemove, 1);
    }

}

$("reserveButton").click(function(){
    var year = document.getElementById("yearNumber").value;
    var month = document.getElementById("monthNumber").value;
    var info = document.getElementById("info").value;

    console.log(info);

    $('confirm').load('login.php', { 'dayStart': daysSelected[0], 'dayEnd': daysSelected[daysSelected.length - 1]
                      , 'year' : year, 'month': month, 'info': info});
      
});
