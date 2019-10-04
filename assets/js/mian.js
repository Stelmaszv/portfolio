$("img").each(function (index, value) {
    if(!$(this).attr('src')){
        $(this).attr('src','http://localhost/portfolio/assets/img/no-image.jpg');
    }
});

