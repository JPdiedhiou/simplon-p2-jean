/**la variable slideIndex stockera la position actuelle de chaque slide
 * la variable slides est un tableau qui stock l'ensemble des images
 * la variable dots stockera les differents points
 * la variable captionText contiendra le text de chaque slide **/
var slideIndex, slides, dots, captionText;

/**Cette fonction initialise la gallerie **/
function initGallery() {
    slideIndex = 0;
    slides = document.getElementsByClassName("imageHolder");
    slides[slideIndex].style.opacity = 1;

    captionText = document.querySelector(".captionHolder .captionText");

    /** ceci recupere le contenu de chaque captionText 
     * correspondant a chaque image pour l'affichage au defilement **/
    captionText.innerText = slides[slideIndex].querySelector(".captionText").innerText;

    /** Ceci permettra de definir les points de defilement des slides **/
    dots = [];
    var dotsContainer = document.getElementById("dotsContainer");
    for (var i = 0; i < slides.length; i++) {
        var dot = document.createElement("span");
        dot.classList.add("dots");
        dot.setAttribute("onClick", "moveSlide(" + i + ")");
        dotsContainer.append(dot);
        dots.push(dot);
    }

    /**Permet l'activation du point ou est le slider**/
    dots[slideIndex].classList.add("active");
}
initGallery();

/** **/
function plusSlides(n) {
    moveSlide(slideIndex + n);
}

/** Cette fonction permettra de changer les slides 
 * via les boutons gauches et droites **/
function moveSlide(n) {
    var i, current, next;
    var moveSlideAnimeClass = {
        forCurrent: "",
        forNext: ""
    }
    var slideTextAnimClass;
    if (n > slideIndex) {

        if (n >= slides.length) {
            n = 0;
        }
        moveSlideAnimeClass.forCurrent = "moveLeftCurrentSlide";
        moveSlideAnimeClass.forNext = "moveLeftNextSlide";
        slideTextAnimClass = "slideTextFromTop";

    } else if (n < slideIndex) {

        if (n < 0) { slides.length - 1 }
        moveSlideAnimeClass.forCurrent = "moveRightCurrentSlide";
        moveSlideAnimeClass.forNext = "moveRightNextSlide";
        slideTextAnimClass = "slideTextFromBottom";
    }
    if (n != slideIndex) {
        next = slides[n];
        current = slides[slideIndex];

        for (i = 0; i < slides.length; i++) {
            slides[i].className = "imageHolder";
            slides[i].style.opacity = 0;
            dots[i].classList.remove("active");
        }
        current.classList.add(moveSlideAnimeClass.forCurrent);
        next.classList.add(moveSlideAnimeClass.forNext);
        dots[n].classList.add("active");
        slideIndex = n;
    }
    captionText.style.display = "none";
    captionText.className = "captionText " + slideTextAnimClass;
    captionText.innerText = slides[n].querySelector(".captionText").innerText;
    captionText.style.display = "block";
}
var timer = null;

function setTimer() {
    timer = setInterval(function() {
        plusSlides(1);
    }, 3000)
}
setTimer();

function playPauseSlides() {
    var playPauseBtn = document.getElementById("playPauseBtn");
    if (timer = null) {
        setTimer();
        playPauseBtn.style.backgroundPositionY = "0px";
    } else {
        clearInterval(timer);
        timer = null;
        playPauseBtn.style.backgroundPositionY = "-33px";
    }
}