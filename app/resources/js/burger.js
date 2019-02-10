$(document).ready(function() {
    $('.buttonMenu>span').click(function() {
        //$('.menuBurger').toggleClass('active');
        //$(".menuBurger").css("display", "flex");
        var e = document.getElementById('menuBurger');
       if(e.style.display == 'flex')
          e.style.display = 'none';
       else
          e.style.display = 'flex';
    });
});
