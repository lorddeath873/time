var http_request = false;

function load_data() {
    http_request = false;
    if (window.XMLHttpRequest) {
        http_request = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }
    if (!http_request) {
        alert('Ende :( Kann keine XMLHTTP-Instanz erzeugen');
        return false;
    }
    document.getElementById("login").style.display='';
    document.getElementById("loginform").style.display='none';
    http_request.open('GET', 'login.php', true);
    http_request.onreadystatechange = InhaltPost;
    http_request.send(null);
}
 
function InhaltPost() {
    if (http_request.readyState == 4){
        var answer = http_request.responseText;
        document.getElementById("login").style.display='none';
        document.getElementById("loginform").style.display='block';
        if(document.getElementById("loginform").innerHTML != answer){
            document.getElementById("loginform").innerHTML = answer;
        }
    }
}

window.onload = "load_data()";
interval = window.setInterval("load_data();", 20000);
