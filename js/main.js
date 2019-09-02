class ValidateJS{
    constructor(fields) {
        this.Fields=fields;
        this.error=true;
    }
    IsEmail(Field,index) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!re.test(Field.value)){
            this.SetError(index,'email')
        }
    }
    Start(){
        this.Loop();
        this.FaindErros();
        return this.error;
    }
    FaindErros(){
        for (var i = 0; i < this.Fields.length; i++) {
            for (var x = 0; x < this.Fields[i].errrs.length; x++) {
               this.error=false;
            }
        }
    }
    SetSuccesAll(){
        for (let el of this.Fields) {
            el.classList.add('validatSuccces');
        }
    }
    NormalValidate(Field,index){
        if(Field.value==''){
            this.SetError(index,'empty')
            Field.classList.add('validated')
        }
        if(Field.getAttribute('leng')>Field.value.length){
            this.SetError(index,'Eleng')
            Field.classList.add('validated')
        }
    }
    SetError(index,message){
        var errors=[];
        errors.push({message})
        this.Fields[index].errrs=errors;
    }
    Loop(){
        var index=0;
        for (let Field of this.Fields) {
            this.ItemValid(index,Field);
            index++;
        }
    }
    ItemValid(index,Field){
        this.Fields[index].errrs=[]
        this.NormalValidate(Field,index)
        switch(Field.getAttribute('type')){
            case 'email':
                this.IsEmail(Field,index);
            break;
        }
        if(this.Fields[index].errrs.length==0){
            Field.classList.remove('validated')
            Field.classList.add('validatSuccces');
        }else{
            Field.classList.remove('validatSuccces')
            Field.classList.add('validated');
        }
    }
    ReturnErros(querySelector){
        var str="<ul>";
            for (var i = 0; i < this.Fields.length; i++) {
                for (var x = 0; x < this.Fields[i].errrs.length; x++) {
                    str+=SentError(this.Fields[i].errrs[x].message,this.Fields[i]);
                }
            }
        str+="</ul>";
        function SentError(message,field){
            var SetN=new Notification();
            var er='<li>'
            switch(message){
                case 'Eleng':
                    er+=SetN.class.SetLenghtError(field.getAttribute('name'),field.getAttribute('leng'));
                break;
                case 'email':
                    er+=SetN.class.SetEmialError(field.getAttribute('name'));
                break;
            }
            er+='</li>'
            return er;
        }
        document.querySelector(querySelector).innerHTML=str;
    }
    ReturnJassonSend(){
        var Jasson=[];
        for (let Field of this.Fields) {
            
            var cel=''+Field.classList[0]+''
            var el={
                cel:Field.value
            }
            Jasson.push(el)
        }
        console.log(Jasson)
    }
}

(function ActiveLanguage() {
    var el=document.querySelector("[ActiveLanguage]");
    el.innerHTML=ChangeLanguage()
    function ChangeLanguage(){
        var string='';
            if(Setlanguage=='pl'){
                string='<a href="index.php?action=setLanguage&&value=eng">English</a>';
            }else{
                string='<a href="index.php?action=setLanguage&&value=pl">Polski</a>';
            }
        return string;
    }
})();
(function Translate() {
    var Arrays = FaindLanguage();
    Start()
    function Start(){
        let TranslateList=document.querySelectorAll("[translate]");
        for (let el of TranslateList) {
            var Translate = FaindIndexInLangArray(el.getAttribute('translate'),0)
            if(!el.hasAttribute('form')){
                el.innerHTML=Translate;
            }
        }
        let TranslateFormList=document.querySelectorAll("[translateForm]");
        for (let el of TranslateFormList) {
            var Translate = FaindIndexInLangArray(el.getAttribute('translateForm'),1)
            if(el.hasAttribute('form')){
                el.setAttribute('placeholder',Translate.PlaceHolder)
                el.setAttribute('name',Translate.name)
            }
        }
    }
    function FaindIndexInLangArray(index,indexType){
        return Arrays[indexType][index]
    }
    function FaindLanguage(){
        var LangAarry=[]
        var FormsArray=[]
        for (let el of languageJASON) {
            if(el.lang==Setlanguage){
                LangAarry=el.translate;
            }
        }
        for (let el of languageJASONForms) {
            if(el.lang==Setlanguage){
                FormsArray=el.translate;
            }
        }
        return [LangAarry,FormsArray]
    }
})();
(function scrool() {
    let nav = document.querySelectorAll(".navelment");
    for (let el of nav) {
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
(function form() {
    var Data=document.querySelectorAll("[validate]");
    Validate=new ValidateJS(Data); 
    document.querySelector('.FormContaktSubmit').addEventListener('click', function(e){
        e.preventDefault() 
        alert('dqd');
        Validate.ReturnJassonSend()      
        document.querySelector('[ContentModel]').innerHTML='';
        if(Validate.Start()){
            Validate.SetSuccesAll();
            document.querySelector('.modal .modal-body').style.background="green";
            document.querySelector('.succesSend').style.display="block"
            SendMess();
        }else{
            Validate.ReturnErros('[ContentModel]');
        }
        document.querySelector('#Notification').click();
    })
    document.querySelector('.name').addEventListener('keyup', function(e){
        Validate.ItemValid(0,Data[0])
    })
    document.querySelector('.email').addEventListener('keyup', function(e){
        Validate.ItemValid(1,Data[1])
    })
    document.querySelector('.tiite').addEventListener('keyup', function(e){
        Validate.ItemValid(2,Data[2])
    })
    document.querySelector('.contet').addEventListener('keyup', function(e){
        Validate.ItemValid(3,Data[3])
    })
    function SendMess(){
        $.post("index.php",{
            name: "Donald Duck",
            city: "Duckburg"
        });
    }
})();

(function GenerateSkills() {
    var html='';
    for(var el of skillsJason){
        html+="<div class='row'>"
        html+="<div class='skill'><img src='"+el['logo']+"'></div>"
        html+= "<div class='level "+el['name']+"' procent='"+el['procent']+"'>"
        html+= "<div class='level-outer'><div class='level-inner'></div></div>"
        html+="</div></div>"
    }
    //document.querySlector(['generateSkillsMobile']).innerHTML=html
    document.querySelector('.skillLoobMobile').innerHTML=html
    if(window.screen.availWidth>1200){
        document.querySelector('.SkillsLoop').innerHTML=html
    }

})();   

var starsTotal=5;
document.addEventListener('DOMContentLoaded',getRatings)
function getRatings(){
    let querySlector = document.querySelectorAll('.level')
    for(let rating of querySlector){
        
        var ratingStar=rating.getAttribute('procent')

        const starProcentTag= (ratingStar/starsTotal) *100;
        
        //const starProcentageRounded= Math.random(starProcentTag/10)*10;       

    
        var classItem=rating.classList[1]
        document.querySelector(`.${classItem} .level-inner`).style.width=starProcentTag;
        
        
    }
}