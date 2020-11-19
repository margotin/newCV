import Swup from "swup";
import SwupSlideTheme from "@swup/slide-theme";

const swup = new Swup({ plugins: [new SwupSlideTheme({ reversed: true })] });

const CAPTCHA_SITE_KEY = process.env.CAPTCHA_SITE_KEY; 

global.onloadCallback = () => {
    grecaptcha.render('g-recaptcha', {
    'sitekey' : CAPTCHA_SITE_KEY
    });
}; 

document.addEventListener('swup:contentReplaced', (event) => {				
    if(event.target.activeElement.pathname === '/contact'){	
        const scriptRecaptchaId = document.querySelector('#script-recaptcha')						
        const errorFormContact = document.querySelector('#error_form_contact')						
        if(!scriptRecaptchaId){
            const script = document.createElement('script');
            script.src = "https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit";
            script.id = "script-recaptcha";
            document.body.appendChild(script); 							
        }else{
            onloadCallback();
        }

        if(errorFormContact){
            errorFormContact.parentNode.removeChild(errorFormContact);
        }
    }
});