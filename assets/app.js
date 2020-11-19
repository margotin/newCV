/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";
import "./styles/css/style.css";
import "../node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css";
import "@fortawesome/fontawesome-free/css/all.css"

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from "jquery";
global.$ = global.jQuery = $;

// bootstrap
import "bootstrap";
import "bootstrap-datepicker";

$.fn.datepicker.dates["fr"] = {
  days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
  daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
  daysMin: ["d", "l", "ma", "me", "j", "v", "s"],
  months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
  monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
  today: "Aujourd'hui",
  monthsTitle: "Mois",
  clear: "Effacer",
  weekStart: 1,
  format: "dd/mm/yyyy",
};

//button responsive menu
const button = document.querySelector(".navbar-toggler");
const links = document.querySelectorAll(".navbar-nav .nav-link");

if (button !== null) {
  button.addEventListener("click", () => {
    const nav = document.querySelector(".navbar-collapse");    
    if (nav.classList.contains("show")) {
      nav.classList.remove("show");
    } else {
      nav.classList.add("show");
    }
  });

  links.forEach((link)=>{
    link.addEventListener("click",() => {
      const nav = document.querySelector(".navbar-collapse");    
      if (nav.classList.contains("show")) {
        nav.classList.remove("show");
      } else {
        nav.classList.add("show");
      }
    });
  })
}


