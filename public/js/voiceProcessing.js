const keywordRedirect = 'buka';
const keywordClickBagian = 'buka bagian';
const keywordClickTab = 'buka tab';
const keywordClickButtonVerifikasi = 'buka verifikasi';
const keywordClickHubungiButtonOnModalVerifikasi = 'hubungi';
const keywordClickVerifikasiButtonOnModalVerifikasi = 'verifikasi oke';
const keywordClickKoreksiButtonOnModalVerifikasi = 'koreksi';
const keywordClickCloseModalButtonVerifikasi = 'tutup verifikasi';
const clickButtonVerifikasiExceptions = ['buka verifikasi c1'];

$(document).ready(function () {
  const namaLocalStorageCheckboxStatus = 'speechCheckboxStatus'
  setCheckboxStatusForTheFirstTime(namaLocalStorageCheckboxStatus)
  listenCheckboxStatus(namaLocalStorageCheckboxStatus);

  const recognition = new webkitSpeechRecognition() || new SpeechRecognition();
  recognition.lang = 'id-ID';
  recognition.continuous = true;
  recognition.interimResults = true;
  const isSpeechCheckboxOn = document.querySelector('#speechCheckbox').checked

  if (isSpeechCheckboxOn) {
    recognition.start();

    function dontEndTheSpeech() {
      if (document.querySelector('#speechCheckbox').checked) {
        recognition.start();
      }
      console.log('Speech still listening...');
    }

    recognition.onend = function () {
      dontEndTheSpeech()
    };

    // Clear the interval when the speech ends
    recognition.onspeechend = function () {
      dontEndTheSpeech()
    };
  }

  recognition.onresult = function (event) {
    for (let i = event.resultIndex; i < event.results.length; i++) {
      if (event.results[i].isFinal) {
        let finalTranscript = event.results[i][0].transcript.trim().toLowerCase();

        const isCommandHasKeywordClickButtonVerifikasi = finalTranscript.includes(keywordClickButtonVerifikasi)
        const isCommandHasKeywordRedirect =
        finalTranscript.includes(keywordRedirect)
        && isCommandHasKeywordClickButtonVerifikasi == false

        const isClickButtonVerifikasiCommandHasExceptions = clickButtonVerifikasiExceptions.includes(finalTranscript);
        const isCommandHasKeywordClickHubungiButtonOnModal = finalTranscript.includes(keywordClickHubungiButtonOnModalVerifikasi)
        const isCommandHasKeywordClickVerifikasiButtonOnModal = finalTranscript.includes(keywordClickVerifikasiButtonOnModalVerifikasi)
        const isCommandHasKeywordClickKoreksiButtonOnModal = finalTranscript.includes(keywordClickKoreksiButtonOnModalVerifikasi)
        const isCommandHasKeywordClickCloseModalButton = finalTranscript.includes(keywordClickCloseModalButtonVerifikasi)

        if (isCommandHasKeywordRedirect || isClickButtonVerifikasiCommandHasExceptions) {
          const dataTargetValue = getTextAfterSpecificWord(keywordRedirect, finalTranscript)
          const formattedFinalTranscript = formatFinalTranscriptToCommandTargetFormat(dataTargetValue)
          const selectedElement = document.querySelector('[data-command-target="' + formattedFinalTranscript + '"]')
          const commandTargetMenuName = selectedElement.getAttribute('data-command-target-menu');
          const commandTargetMenuElement = document.querySelector('[data-command-target="' + commandTargetMenuName + '"]')

          if (commandTargetMenuElement) commandTargetMenuElement.click()
          return selectedElement.click()
        }

        console.log('speech,', finalTranscript)

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

        if (isCommandHasKeywordClickHubungiButtonOnModal) {
          const idElementButtonHubungiOnModal = 'hubungiWhatsappButton';
          const url = $(`#${idElementButtonHubungiOnModal}`).attr('href');
          window.location = url
        }

        if (isCommandHasKeywordClickKoreksiButtonOnModal) {
          const idElementButtonKoreksiOnModal = 'koreksiButton';
          const url = $(`#${idElementButtonKoreksiOnModal}`).attr('data-url');
          window.location = url
        }

        if (isCommandHasKeywordClickVerifikasiButtonOnModal) {
          const idElementButtonVerifikasiOnModal = 'verifikasiButton';
          const url = $(`#${idElementButtonVerifikasiOnModal}`).attr('data-url');
          window.location = url
        }

        if (isCommandHasKeywordClickCloseModalButton) {
          const idElementButtonCloseModal = 'periksaC1Verifikator';
          $(`#${idElementButtonCloseModal}`).modal('hide')
        }
    }
  }
  };
});

function setCheckboxStatusForTheFirstTime(namaLocalStorage) {
  const checkboxElement = document.getElementById("speechCheckbox")
  const savedStatus = localStorage.getItem(namaLocalStorage)

  if (savedStatus === null) {
    localStorage.setItem(namaLocalStorage, checkboxElement.checked);
  } else {
    checkboxElement.checked = (savedStatus == 'true')
  }
}

function listenCheckboxStatus(namaLocalStorage) {
  const checkboxElement = document.getElementById("speechCheckbox");
  checkboxElement.addEventListener("change", () => {
    localStorage.setItem(namaLocalStorage, checkboxElement.checked);
    const savedStatus = localStorage.getItem(namaLocalStorage);

    checkboxElement.checked = savedStatus === "true";

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
