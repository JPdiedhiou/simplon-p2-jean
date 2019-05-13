//fonction d'animation sortie et rentrer  menu
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle('active');

}

//fonction de creation d'un digital Clock
function showTime() {
    var date = new Date();
    var h = date.getHours(); //interval 0-23
    var m = date.getMinutes(); //interval 0-59
    var s = date.getSeconds(); //interval 0-59
    var session = "AM";

    if (h == 0) {
        h = 12;
    }

    if (h > 12) {
        h = h - 12;
        session = "PM";
    }
    //definir des conditions d'affichage des heures et minutes
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    /*if (h < 10) {
        h = "0" + h;
    }
    if(m < 10){
        m = "0" + m;
    }
    if(s < 10){
        s = "0" + s;
    }*/

    //conception de l'heure en entier
    var time = h + ":" + m + ":" + s + " " + session;
    //recuperation de la variable pour le rendu de l'heure
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;

    setTimeout(showTime, 1000);

}
showTime();