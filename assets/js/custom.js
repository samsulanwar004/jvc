$(document).ready(function(){
    $("#myLogin").click(function(){
        $("#myModalLogin").modal();
    });
});

$(document).ready(function(){
    $("#myEdit").click(function(){
        $("#myModalEdit").modal();
    });
});

$(document).ready(function(){
    $("#myGantiPassword").click(function(){
        $("#myModalGantiPassword").modal();
    });
});

$(window).scroll(function() {
  if ($(document).scrollTop() > 1) {
    $('nav').addClass('shrink');
    $('#logo').css('width','40px');
  } else {
    $('nav').removeClass('shrink');
    $('#logo').css('width','75px');
  }
});