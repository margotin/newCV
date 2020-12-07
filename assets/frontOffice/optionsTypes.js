export function getStrings(title) {
  const strings = [];
  if (title !== null) {
    const qualities = title.dataset.title;

    const arrayTitle = qualities.split(",");
    const arrayTitleLength = arrayTitle.length;
    let element = null;

    for (let index = 0; index < arrayTitleLength; index++) {
      element = arrayTitle[index].trim();
      if (index === 0) {
        strings[index] = element;
        continue;
      }
      strings[index] = strings[index - 1] + ", " + element;
    }
  }
  return strings;
}

const title = document.querySelector("div[data-title]");

export const options = {
  strings: getStrings(title),
  stringsElement: null,
  typeSpeed: 40,
  smartBackspace: true,
  onComplete: (self) => {
    setTimeout(() => {
      self.cursor.classList.add("invisible");
    }, 1000);
  },
};
