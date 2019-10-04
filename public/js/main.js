$(".navbarEl").each(function (index, value) {
    $(this).removeClass('active');
    $(this).click(function(e) {
        if($(this).attr('rule')!=='admin'){
            e.preventDefault()
            $(this).addClass("active");
            $('html, body').animate({
                scrollTop: ($(this.getAttribute('dataScrol')).offset().top)
            },500);
        }
    });
});
$(".discription").each(function (index, value) {
    $(this).mouseenter(function() {
        $(this).animate({
            top: '100%'
        },500);
    });
    $(this).click(function() {
        $(this).animate({
            top: '130%'
        },500);
    });
});


/*
(function scrool() {
    let nav = document.querySelectorAll(".navbarEl");
    for (let el of nav) {
        el.addEventListener('click',function(e){
            e.preventDefault()
            RemoveActiveEl();
            el.classList.add('active');
            $('html, body').animate({
                scrollTop: ($(el.getAttribute('dataScrol')).offset().top)
            },500);
        })

        el.addEventListener('click',function(e){
            RemoveActiveEl()
            e.preventDefault()
            el.classList.add('active');
            $('html, body').animate({
                scrollTop: ($(el.getAttribute('dataScrol')).offset().top)
            },500);
        })
        
    }
    function RemoveActiveEl(){
        for (let el of nav) {
            el.classList.remove('active');
        }
    }
})();
*/