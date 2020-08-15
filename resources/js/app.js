require('./bootstrap');

window.onload = function () {
    const screenWidth = window.innerWidth;
    const screenHeight = window.innerHeight;
    document.getElementById("window_dimensions").innerHTML = screenWidth + ' x ' + screenHeight;
}