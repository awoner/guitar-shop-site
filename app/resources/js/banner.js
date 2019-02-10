var picIndex = 0;
var slideInterval = setInterval(autoNextPic,7000);
showPics(picIndex);

function currentPic(n) {
    clearInterval(slideInterval);
    showPics(picIndex = n);
    slideInterval = setInterval(nextPic,7000);
}

function autoNextPic() {
    showPics(picIndex += 1);
}

function nextPic() {
    clearInterval(slideInterval);
    showPics(picIndex += 1);
    slideInterval = setInterval(nextPic,7000);
}

function prevPic() {
    clearInterval(slideInterval);
    showPics(picIndex -= 1)
    slideInterval = setInterval(nextPic,7000);
}

function showPics(n) {
    var i;
    var pics = document.getElementsByClassName("myPictures");
    var miniPics = document.getElementsByClassName("miniPic");

    if (n > pics.length){
        picIndex = 1;
    }
    if (n < 1){
        picIndex = pics.length;
    }

    for (i = 0; i < pics.length; i++){
        pics[i].style.display = "none";
    }

    for (i = 0; i < miniPics.length; i++){

        miniPics[i].style.border = "#34495e solid 5px";
        miniPics[i].style.transition = "all 0.5s ease";

        if (i === picIndex - 1) {
            pics[i].style.display = "block";
            miniPics[i].style.border = "white solid 5px";

        }
    }

}