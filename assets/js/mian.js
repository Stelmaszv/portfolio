const replace='http://piotrstelmaszv.byethost7.com/assets/img/no-image.jpg';
$("img").each(function (index, value) {
    if(!$(this).attr('src')){
       $(this).attr('src',replace);
    }else{
        let value=$(this).attr('src');
        let ext = value.substring(value.length-4,value.length);
        if(ext[0]!=='.'){
            $(this).attr('src',replace);
        }
    }
});

