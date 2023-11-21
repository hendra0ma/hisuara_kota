const keywordRedirect = 'buka';
const keywordClickBagian = 'buka bagian';
const keywordClickTab = 'buka tab';
const keywordClickButtonVerifikasi = 'buka verifikasi';

$(document).ready(function () {
  var recognition = new webkitSpeechRecognition() || new SpeechRecognition();
  recognition.lang = 'id-ID';
  recognition.continuous = true;
  recognition.interimResults = true;

  var speechOutput = $('#speechOutput');
  var startButton = $('#startSpeech');
  var stopButton = $('#stopSpeech');

  // startButton.click(function() {
  //     recognition.start();
  // });

  // stopButton.click(function() {
  //     recognition.stop();
  // });
  recognition.start();

  recognition.onresult = function (event) {
    var interimTranscript = '';
    console.log('all rsults,', event.results);
    for (var i = event.resultIndex; i < event.results.length; i++) {
      if (event.results[i].isFinal) {
        var finalTranscript = event.results[i][0].transcript.trim().toLowerCase();
        speechOutput.text('Hasil Pengenalan: ' + finalTranscript);

        // const isCommandHasKeywordClickBagian = finalTranscript.includes(keywordClickBagian);
        // const isCommandHasKeywordClickTab = finalTranscript.includes(keywordClickTab);
        const isCommandHasKeywordClickButtonVerifikasi = finalTranscript.includes(keywordClickButtonVerifikasi)
        const isCommandHasKeywordRedirect =
        finalTranscript.includes(keywordRedirect)
        // && isCommandHasKeywordClickBagian == false
        // && isCommandHasKeywordClickTab == false

        if (isCommandHasKeywordRedirect) {
          const dataTargetValue = getTextAfterSpecificWord(keywordRedirect, finalTranscript)
          const formattedFinalTranscript = formatFinalTranscriptToCommandTargetFormat(dataTargetValue)
          alert(dataTargetValue, formattedFinalTranscript)
          var selectedElement = document.querySelector('[data-command-target="' + formattedFinalTranscript + '"]')
          var commandTargetMenuName = selectedElement.getAttribute('data-command-target-menu');
          var commandTargetMenuElement = document.querySelector('[data-command-target="' + commandTargetMenuName + '"]')
          console.log(selectedElement);
          if (commandTargetMenuElement) commandTargetMenuElement.click()
          return selectedElement.click()
        }

        console.log('speech,', finalTranscript)

        if (isCommandHasKeywordClickButtonVerifikasi) {
          // alert('klik target')
          const namaSaksi = getTextAfterSpecificWord(keywordClickButtonVerifikasi, finalTranscript);
          const h1Elements = document.querySelectorAll('.nama-saksi');

          for (let i = 0; i < h1Elements.length; i++) {
            const element = h1Elements[i];
            const elementText = element.textContent.toLowerCase();

            console.log(elementText, namaSaksi.toLowerCase());

            if (elementText.includes(namaSaksi.toLowerCase())) {
              // Found a matching element
              console.log('Found: ' + elementText);

              const idSaksi = element.getAttribute('data-id');
              console.log(idSaksi);

              const buttonVerifikasi = document.querySelector(`button[data-id="${idSaksi}"]`);
              console.log(buttonVerifikasi.textContent);
              buttonVerifikasi.click();
              break;
            }
          }
        }

      } else {
        interimTranscript += event.results[i][0].transcript;
      }
    }
  };


  setInterval((recognition) => {
    const isSpeechCheckboxStillOn = document.querySelector('#speechCheckbox').checked

    recognition.onspeechend = () => {
      if (isSpeechCheckboxStillOn) {
        recognition.start();
      }
    };
    console.log('interval');
  }, 3000)
});

function getTextAfterSpecificWord(specificWord, text) {
  var pattern = new RegExp("\\b(?:" + specificWord + ")\\s+(.*)\\b");
  var matches = text.match(pattern);

  if (matches && matches[1] !== undefined) {
    var wordsAfterSpecificWord = matches[1];
    return wordsAfterSpecificWord.trim();
  } else {
    console.log("Nama tidak terdeteksi");
  }
}

function formatFinalTranscriptToCommandTargetFormat(string) {
  return string.replace(/\s+/g, '-')
}
