/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";
import "./styles/css/style.css";

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

// console.log('Hello Webpack Encore! Edit me in assets/app.js');
import "bootstrap";

const button = document.querySelector(".navbar-toggler");

if(button !== null){
    button.addEventListener('click', e =>{
        const nav = document.querySelector(".navbar-collapse")
        if(nav.classList.contains('show')){
            nav.classList.remove('show')
        }else {
            nav.classList.add('show')
        }
    })
}
