console.log("start");

var sessionId = null;

function doLogin() {
    console.log("doLogin");

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/login.php', true);
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            sessionId = response.Data.SessionId;
            appendLog(response.Message);
        }
    }

    var data = {
        'UserId': document.getElementById('userId').value,
        'Password': document.getElementById('password').value
    };
    xhr.send(JSON.stringify(data));
}

function doLogout() {
    console.log("doLogout");

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/logout.php', true);
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            appendLog(response.Message);
        }
    }

    var data = {
        'SessionId': sessionId,
    };
    console.log(JSON.stringify(data));
    xhr.send(JSON.stringify(data));
}

function doZugriff() {
    console.log("doZugriff");

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/clubcockpit.php', true);
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            appendLog(response.Message);
        }
    }

    var data = {
        'SessionId': sessionId,
    };
    console.log(JSON.stringify(data));
    xhr.send(JSON.stringify(data));
}

function appendLog(message) {
    var el = document.getElementById('log');
    var entry = document.createElement('div');
    entry.innerHTML = message;
    el.insertBefore(entry, el.firstChild);
}

document.getElementById("login").addEventListener("click", doLogin);
document.getElementById("logout").addEventListener("click", doLogout);
document.getElementById("zugriff").addEventListener("click", doZugriff);
