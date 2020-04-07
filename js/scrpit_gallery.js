'use strict';
console.log(document.getElementsByClassName('image').length);
document.getElementById("gallery").onclick = function (event) {
    if (event.target.classList.contains("image")) {
        printSquare(event.target.getAttribute("src"), event.target.getAttribute("id"));
    }
}
function printSquare(src, pictureId) {
    let img = document.createElement('img');
    img.setAttribute("src", src);
    let place = document.getElementById("presentation");
    let left = document.getElementById('left');
    let right = document.getElementById('right');
    img.setAttribute("pic-id", pictureId);
    left.setAttribute("class", "left_arrow");
    right.setAttribute("class", "right_arrow");
    img.setAttribute("id", "big_center_picture");
    img.className = "big-block";
    place.innerHTML = "";
    img.innerHTML = "";
    place.append(left);
    place.append(img);
    place.append(right);
}

function next() {
    let pictureId = Number(document.getElementById('big_center_picture').getAttribute('pic-id'));
    if (pictureId == document.getElementsByClassName('image').length) {
        pictureId = 1;
    } else {
        pictureId++;
        console.log(pictureId);
    }
    let picture = document.getElementById(pictureId);
    let pictureSrc = picture.getAttribute('src');
    printSquare(pictureSrc, pictureId);
}

function prev() {
    let pictureId = Number(document.getElementById('big_center_picture').getAttribute('pic-id'));
    if (pictureId == 1 ){
        pictureId = document.getElementsByClassName('image').length;
    } else {
        pictureId--;
        console.log(pictureId);
    }
    let picture = document.getElementById(pictureId);
    let pictureSrc = picture.getAttribute('src');
    printSquare(pictureSrc, pictureId);
}