const keywordRedirect = 'buka';
const keywordClickBagian = 'buka bagian';
const keywordClickTab = 'buka tab';
const keywordClickButtonVerifikasi = 'buka verifikasi';

$(document).ready(function () {
  const recognition = new webkitSpeechRecognition() || new SpeechRecognition();
  recognition.lang = 'id-ID';
  recognition.continuous = true;
  recognition.interimResults = true;

  recognition.start();

  recognition.onresult = function (event) {
    for (let i = event.resultIndex; i < event.results.length; i++) {
      if (event.results[i].isFinal) {
        let finalTranscript = event.results[i][0].transcript.trim().toLowerCase();

        const isCommandHasKeywordClickButtonVerifikasi = finalTranscript.includes(keywordClickButtonVerifikasi)
        const isCommandHasKeywordRedirect =
        finalTranscript.includes(keywordRedirect)
        && isCommandHasKeywordClickButtonVerifikasi == false

        if (isCommandHasKeywordRedirect) {
          const dataTargetValue = getTextAfterSpecificWord(keywordRedirect, finalTranscript)
          const formattedFinalTranscript = formatFinalTranscriptToCommandTargetFormat(dataTargetValue)
          const selectedElement = document.querySelector('[data-command-target="' + formattedFinalTranscript + '"]')
          const commandTargetMenuName = selectedElement.getAttribute('data-command-target-menu');
          const commandTargetMenuElement = document.querySelector('[data-command-target="' + commandTargetMenuName + '"]')

          if (commandTargetMenuElement) commandTargetMenuElement.click()
          return selectedElement.click()
        }

        // console.log('speech,', finalTranscript)

        if (isCommandHasKeywordClickButtonVerifikasi) {
          const namaSaksi = getTextAfterSpecificWord(keywordClickButtonVerifikasi, finalTranscript);
          const h1Elements = document.querySelectorAll('.nama-saksi');

          for (let i = 0; i < h1Elements.length; i++) {
            const element = h1Elements[i];
            const elementText = element.textContent.toLowerCase();

            
            if (elementText.includes(namaSaksi.toLowerCase())) {
              // console.log(elementText, namaSaksi.toLowerCase());
              const idSaksi = element.getAttribute('data-id');
              const buttonVerifikasi = document.querySelector(`button[data-id="${idSaksi}"]`);
              buttonVerifikasi.click();
              break;
            }
          }
        }
    }
  }
  };

  listenCheckboxStatus();

  const dontEndTheSpeech = setInterval(() => {
    const isSpeechCheckboxStillOn = document.querySelector('#speechCheckbox').checked

    recognition.onend = () => {
      if (isSpeechCheckboxStillOn) {
        recognition.start();
      } else {
        clearInterval(dontEndTheSpeech)
      }
    };
    console.log('Speech still listening...');
  }, 3000)
});

function listenCheckboxStatus() {
  const checkboxElement = document.getElementById("speechCheckbox");
  checkboxElement.addEventListener("change", () => {
    const savedStatus = localStorage.getItem("speechCheckboxStatus");

    if (savedStatus !== null) {
      checkboxElement.checked = savedStatus === "true";
    }
    
    localStorage.setItem("speechCheckboxStatus", checkboxElement.checked);

    location.reload()
  });
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

function formatFinalTranscriptToCommandTargetFormat(string) {
  return string.replace(/\s+/g, '-')
}
