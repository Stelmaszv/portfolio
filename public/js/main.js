$(".navbarEl").each(function (index, value) {
    $(this).removeClass('active');
    $(this).click(function(e) {
        if($(this).attr('rule')!=='admin'){
            if($(this).attr('url')!=='login'){ 
                e.preventDefault()
                $('.slideMenu').slideUp();
                $(this).addClass("active");
                $('html, body').animate({
                    scrollTop: ($(this.getAttribute('dataScrol')).offset().top)
                },500);
            }
        }
    });
});
$el=$(".carousel-item");
$($el[0]).addClass("active");
$(".discription").each(function (index, value) {
    $(this).mouseenter(function() {
        $($(this).attr('discription')).slideDown();
    });
    $(this).click(function() {
        $($(this).attr('discription')).slideUp();
    });
});
$('.showMore').click(function(e) {
    $('html, body').animate({
        scrollTop: ($('#projects').offset().top)
    },500);
})
$('.mobileMenu').click(function(e) {
    $('.slideMenu').slideDown();
})