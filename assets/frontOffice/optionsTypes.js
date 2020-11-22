export const options = {
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
