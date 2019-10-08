class Validate{
    validStan=false;
    setings=[];
    constructor(form,setings) {
        this.setings=setings;
        this.form=$(form);
        this.getfieldStart=false;
        this.errors=[];
    }
    faindbyname(name){
        var returnval='';
        var $inputs=this.form.find('input,textarea');
        $inputs.each(function (index, value) {
            if($(this).attr('name')===name){  
                returnval=$(this).val();
            }
        })
        return returnval;
    }
    resetClass(){
        var isinvalid=this.setings.valid;
        var isvalid=this.setings.invalid;
        var $inputs=this.form.find('input,textarea');
        $inputs.each(function (index, value) {
            $(this).removeClass( isinvalid )
            $(this).removeClass( isvalid )
        })
    }
    getfield($field){
        var $inputs=this.form.find('input,textarea');
        var isinvalid=this.setings.invalid;
        var setings=this.setings;
        if(!$field){
            $inputs.each(function (index, value) {
                 var error = fieldStan(this,setings);
                 if($(this).attr('required')){
                     if(!$(this).val()){
                         $(this).addClass(isinvalid);
                     }
                 }
            })
            this.setvalidStan();
        }
        function fieldStan($field,setings){
            let actions=[];
            actions['text']=new validBase(setings);
            actions['email']=new emailvalid(setings);
            actions[$($field).attr('type')].check($field);
        }   
        if($field){
            return fieldStan= fieldStan($field,setings);
        }
    }
    setvalidStan(){
        var $inputs=this.form.find('input,textarea');
        var isvalid=this.setings.valid;
        var count=0;
        $inputs.each(function (index, value) {
            if($(this).hasClass(isvalid)){
                count=count+1;
            }
        })
        if(count==$inputs.length){
            this.validStan=true;
        }
    }
    runvalidate(){
        this.resetClass();
        this.getfield();

        return this.validStan;
    }
}
class validBase{
    constructor(setings) {
        this.setings=setings;
        this.error=[];
    }
    addclass(field,cssval){
        $(field).addClass(cssval);
    }
    check(field){
        this.length(field);
        this.checkErrors(field);  
        return this.error;
    }
    checkErrors(field){
        if(!this.error){
            this.addclass(field,this.setings.invalid);
        }else{
            this.addclass(field,this.setings.valid);
        }
    }

    length(field){
        var lenghtError=0
        var $max=$(field).attr('max')*1;
        var $min=$(field).attr('min')*1;
        var $value=$(field).val();
        if($value.length<$min*1){
            lenghtError=lenghtError+1;
        }
        if($value.length>$max*1){
            lenghtError=lenghtError+1;
        }
        if(lenghtError){
            this.addclass(field,this.setings.invalid);
            this.error.push('length')
        }
        return lenghtError;
    }
}
class emailvalid extends validBase{
    check(field){
        var lenghtError=this.length(field);
        if(!lenghtError){
            this.emailvalid(field);
        }
        this.checkErrors(field); 
        return this.error; 
    }
    emailvalid(field){
        var email=$(field).val();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
            this.error.push('email')
            $(field).removeClass( this.setings.valid )
            $(field).addClass( this.setings.invalid )
            return false;
        }else{
            $(field).removeClass( this.setings.invalid )
            $(field).addClass( this.setings.valid)
            return true;
        }
    }
}