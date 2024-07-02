     // kéo xuống khoảng cách 300px thì xuất hiện nút backtop
     var offset = 300;
     $(function(){
    $(window).scroll(function () {
    if ($(this).scrollTop() > offset)
    $('#backtop').fadeIn();else
    $('#backtop').fadeOut();
    });
    $('#backtop').click(function () {
    $('body,html').animate({scrollTop: 0}, 100);// thời gian di trượt 0.1s ( 1000 = 1s )
});
}); 
