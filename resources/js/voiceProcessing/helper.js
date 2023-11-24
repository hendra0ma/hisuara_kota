function getTextBeforeSpecificWord(specificWord, text) {
  const pattern = new RegExp("(.*)\\b(?:" + specificWord + ")\\b");
  const matches = text.match(pattern);

  if (matches && matches[1] !== undefined) {
    const wordsBeforeSpecificWord = matches[1];
    return wordsBeforeSpecificWord.trim();
  } else {
    console.log("Nama tidak terdeteksi");
  }
}

function getTextAfterSpecificWord(specificWord, text) {
  const pattern = new RegExp("\\b(?:" + specificWord + ")\\s+(.*)\\b");
  const matches = text.match(pattern);

  if (matches && matches[1] !== undefined) {
    const wordsAfterSpecificWord = matches[1];
    return wordsAfterSpecificWord.trim();
  } else {
    console.log("Nama tidak terdeteksi");
  }
}

function formatTranscriptToCommandTargetFormat(string) {
  return string.replace(/\s+/g, '-')
}

function getSpeechStatus() {
  return localStorage.getItem('isSpeechOn')
}

function setSpeechStatus(bool) {
  return localStorage.setItem('isSpeechOn', bool)
}

/**
 * Cari element berdasarkan nama. Contoh dihalaman verifikasi c1, cari elemen yang mempunyai class nama-saksi, kemudian cari yg textContent nya includes dengan nama yang dicari
 * @param {string} namaSaksi
 */
function getSaksiElementByName(namaSaksi) {
  const allElements = document.querySelectorAll('.nama-saksi');

  for (let i = 0; i < allElements.length; i++) {
    const selectedElement = allElements[i];
    const selectedElementText = selectedElement.textContent.toLowerCase();

    if (selectedElementText.includes(namaSaksi)) {
      return selectedElement
    }
  }
}

function setCommandRoute(route, arrayOfCommand) {
  const newCommands = []
  for (const command of arrayOfCommand) {
    command.route = route
    newCommands.push(command)
  }

  return newCommands
}

function showImage() {
  $('#imageHisuara').show(300)
}

function hideImage() {
  $('#imageHisuara').hide(300)
}

module.exports = {
  getTextBeforeSpecificWord,
  getTextAfterSpecificWord,
  formatTranscriptToCommandTargetFormat,
  getSpeechStatus,
  setSpeechStatus,
  getSaksiElementByName,
  setCommandRoute,
  showImage,
  hideImage,
};

