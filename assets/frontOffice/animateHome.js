import Typed from "typed.js";

const options = {
  strings: [
    "Investi",
    "Investi, impliqué",
    "Investi, impliqué, rigoureux",
    "Investi, impliqué, rigoureux, curieux",
    "Investi, impliqué, rigoureux, curieux, autonome.",
  ],
  stringsElement: null,
  typeSpeed: 90,
  smartBackspace: true,
  onComplete: (self) => {
    setTimeout(() => {
      self.cursor.classList.add("invisible");
    }, 1000);
  },
};

const typed = new Typed("#typed", options);

document.addEventListener("swup:contentReplaced", (event) => {
    if(event.target.activeElement.pathname === '/'){ 
        const typed = new Typed("#typed", options);
    }
});
