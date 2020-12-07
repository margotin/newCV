const title = document.querySelector("div[data-title]");
const qualities = title.dataset.title;

const arrayTitle = qualities.split(",");
const arrayTitleLength = arrayTitle.length;
const strings = [];
let element = null;

for (let index = 0; index < arrayTitleLength; index++) {
  element = arrayTitle[index].trim();
  if (index === 0) {
    strings[index] = element;
    continue;
  }
  strings[index] = strings[index - 1] + ", " + element;
}

export const options = {
  strings: strings,
  stringsElement: null,
  typeSpeed: 40,
  smartBackspace: true,
  onComplete: (self) => {
    setTimeout(() => {
      self.cursor.classList.add("invisible");
    }, 1000);
  },
};
