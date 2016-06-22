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

$(document).ready(function(){
    $("#myGantiFoto").click(function(){
        $("#myModalGantiFoto").modal();
    });
});

$(document).ready(function(){
    $("#myFoto").click(function(){
        $("#myModalFoto").modal();
    });
});


$(window).scroll(function() {
  if ($(document).scrollTop() > 1) {
    $('nav').addClass('shrink');
    $('#logo').css('width','50px');
    $('#logo').css('height','auto');
    $('#logo').css('margin-top','0px');
    $('#navbar-custom').css('background-color','#222');
    $('#navbar-custom').css('border-color','red');
  } else {
    $('nav').removeClass('shrink');
    $('#logo').css('width','100px');
    $('#logo').css('height','auto');
    $('#logo').css('margin-top','-30px');
    $('#navbar-custom').css('background-color','rgba(0, 0, 0, 0.05)');
    $('#navbar-custom').css('border-color','transparent');
  }
});

