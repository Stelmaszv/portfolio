$validate= new Validate('.formContakt',{'invalid':'is-invalid','valid':'is-valid','errorContent':'invalid-feedback'});
$validateMobile= new Validate('.mobileForm',{'invalid':'is-invalid','valid':'is-valid','errorContent':'invalid-feedback'});
$('.formContakt').on("submit",function(event){
    sent($validate,event,'.sentSuccess','.errors')
});
$('.mobileForm').on("submit",function(event){
    event.preventDefault();
    sent($validateMobile,event,'.sentSuccessMobile','.errorsMobile')
});
$("#validationTooltip02").keyup(function(){
    $validate.getfield("#validationTooltip02");
    $validateMobile.getfield("#validationTooltip02");
});
var sent=function($validate,event,sucess,error){
    event.preventDefault();
    $validate.runvalidate();
    if($validate.validStan){
        $.post("contact/sendmessage/", {
            name: $validate.faindbyname('name'),
            email: $validate.faindbyname('email'),
            subject: $validate.faindbyname('subject'),
            message: $validate.faindbyname('message')
        }).done(resp => {
            var jasson= JSON.parse(resp);
            $(sucess).fadeOut();
            $(error).fadeOut();
            $(error).html('');
            switch(jasson.stan){
                case 'sucess':
                    $(sucess).fadeIn();
                    $validate.resetClass();
                break;
                case 'failure':
                    for(x=0;x<jasson.errors.length;x++){
                        $(error).prepend('<li>'+jasson.errors[x].errorname+'</li>');
                    }
                    $(error).fadeIn();
                break;
            }
        });
    }
}
