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
        /*
        el.addEventListener('click',function(e){
            RemoveActiveEl()
            e.preventDefault()
            el.classList.add('active');
            $('html, body').animate({
                scrollTop: ($(el.getAttribute('dataScrol')).offset().top)
            },500);
        })
        */
    }
    function RemoveActiveEl(){
        for (let el of nav) {
            el.classList.remove('active');
        }
    }
})();