//Fonction d'allumage et d'extinction
function on() {
    var image = document.getElementById("switch");
    if (image.src.match("/inc/img/off.jpg")) {
        document.getElementById("btn").textContent = "Off";
        image.src = "/inc/img/on.jpg";
    } else {
        document.getElementById("btn").textContent = "On";
        image.src = "/inc/img/off.jpg";
    }
}