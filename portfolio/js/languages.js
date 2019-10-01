let TranslatePL=['Projekty','Umiejetnosci','Kontakt','Zmień język na: ','Tytuł wiadmosci','Twój addres Email','Tresc wiadmosci','Skontaktuj się','Imię','Dane kontaktowe','Telefon: ','Wyślij','Wysłanie zakończone Powodzniem','Więcej mojich projektów dostepnych na githab','O mnie','Zobacz umiejętności']
let TranslateENG=['Projects','Skills','Contakt','change language :','Messages Title','Your addres email','Message contet','Get in Touch','Name','Contakt','Phone number: ','Send','Sukcess','More my projects available on github','About me','Show skills']
let TranslateFromsPL=[
    {'index':0,'name':'Imię','PlaceHolder':'Twoje Imię ?'},
    {'index':1,'name':'Email','PlaceHolder':'Twój addres Email'},
    {'index':2,'name':'Tytuł','PlaceHolder':'Tytuł wiadmosci'},
    {'index':3,'name':'Treść','PlaceHolder':'Tresc wiadmosci'}
];
let TranslateFromsENG=[
    {'index':0,'name':'Name', 'PlaceHolder':'Your name'},
    {'index':1,'name':'Email','PlaceHolder':'Your addres email'},
    {'index':2,'name':'Title','PlaceHolder':'Messages Title'},
    {'index':3,'name':'Content','PlaceHolder':'Message contet'}
];
let languageJASON= [
    {'lang':'pl','translate' :TranslatePL},
    {'lang':'eng','translate':TranslateENG}
]
let languageJASONForms= [
    {'lang':'pl','translate' :TranslateFromsPL},
    {'lang':'eng','translate':TranslateFromsENG}
]
class NotificationPL{
    SetLenghtError(name,lenght){
        return 'Pole <b>'+name+'</b> jest za któtkie wymagana ilosć znaków to <b>'+lenght+'</b> !';
    }
    SetEmialError(name){
        return 'Pole <b>'+name+'</b> nie posiada poprawnego adresu emial np email@com.pl !'
    }
}
class NotificationEng{
    SetLenghtError(name,lenght){
        return 'Field <b>'+name+'</b> is to short required number is <b>'+lenght+'</b> !';
    }
    SetEmialError(name){
        return 'Field <b>'+name+'</b> has incorrect email e.g. email@com.pl !';
    }
}
let languageNotificationlist=[
    {'lang':'pl','class' :new NotificationPL()},
    {'lang':'eng','class':new NotificationEng()}
]

class Notification{
    constructor(fields) {
        this.leng=this.Set();
        this.class=languageNotificationlist[this.leng].class
    }
    Set(){
        var index=0
        for(let el of languageNotificationlist){
            if(el.lang==Setlanguage){
                return index;
            }
            index++;
        }
    }
}