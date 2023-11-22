const ROUTE_HALAMAN_VERIFIKASI_SAKSI = 'administrator/verifikasi_saksi'

const keywordRedirect = 'buka';
const keywordClickBagian = 'buka bagian';
const keywordClickTab = 'buka tab';
const keywordClickButtonVerifikasi = 'buka verifikasi';
const keywordClickHubungiButtonOnModalVerifikasi = 'hubungi';
const keywordClickVerifikasiButtonOnModalVerifikasi = 'verifikasi oke';
const keywordClickKoreksiButtonOnModalVerifikasi = 'koreksi';
const keywordClickCloseModalButtonVerifikasi = 'tutup verifikasi';
const clickButtonVerifikasiExceptions = ['buka verifikasi c1', 'buka verifikasi saksi', 'buka verifikasi crowd c1', 'buka verifikasi admin'];

const keywordClickKtpButton = 'lihat ktp';
const keywordClickDiterimaButton = 'diterima';
const keywordClickDitolakButton = 'ditolak';
const keywordClickHubungiButton = 'hubungi';
const keywordClickCloseModalButtonSaksi = 'tutup modal';

const keywordScrollUp = ['scroll up', 'naik']
const keywordScrollDown = ['scroll down', 'turun']

const startSpeech = 'hai sila'
const endSpeech = 'sila berhenti'
try {
  $(document).ready(function () {
    const namaLocalStorageCheckboxStatus = 'speechCheckboxStatus'
    setCheckboxStatusForTheFirstTime(namaLocalStorageCheckboxStatus)
    listenCheckboxStatus(namaLocalStorageCheckboxStatus);

    const recognition = new webkitSpeechRecognition() || new SpeechRecognition();
    recognition.lang = 'id-ID';
    recognition.continuous = true;
    recognition.interimResults = true;
    // const isSpeechOn = document.querySelector('#speechCheckbox').checked
    recognition.start();
    const isSpeechOn = getSpeechStatus()

    if (isSpeechOn == 'true') {
      let speechGotError = false;

      function dontEndTheSpeech() {
        if (getSpeechStatus()) {
          recognition.start();
        }
        console.log('Speech still listening...');
      }

      recognition.onerror = function (event) {
        console.error('Speech recognition error:', event.error);
        if (event.error === 'not-allowed') {
          // Handle the case where microphone access was denied
          console.warn('Microphone access denied.');
          recognition.stop();
          speechGotError = true;
        }
      };

      recognition.onend = function () {
        if (speechGotError == false) dontEndTheSpeech()
      };

      recognition.onspeechend = function () {
        if (speechGotError == false) dontEndTheSpeech()
      };
    }

    recognition.onresult = function (event) {
      for (let i = event.resultIndex; i < event.results.length; i++) {
        if (event.results[i].isFinal) {
          let finalTranscript = event.results[i][0].transcript.trim().toLowerCase();

          if (finalTranscript.includes(startSpeech)) setSpeechStatus(true)
          if (finalTranscript.includes(endSpeech)) setSpeechStatus(false)
          console.log('sila status', getSpeechStatus());
          if (getSpeechStatus() == 'false') return

          const isCommandHasKeywordClickButtonVerifikasi = finalTranscript.includes(keywordClickButtonVerifikasi)
          const isCommandHasKeywordRedirect =
            finalTranscript.includes(keywordRedirect)
            && isCommandHasKeywordClickButtonVerifikasi == false

          const isClickButtonVerifikasiCommandHasExceptions = clickButtonVerifikasiExceptions.includes(finalTranscript);
          const isCommandHasKeywordClickHubungiButtonOnModal = finalTranscript.includes(keywordClickHubungiButtonOnModalVerifikasi)
          const isCommandHasKeywordClickVerifikasiButtonOnModal = finalTranscript.includes(keywordClickVerifikasiButtonOnModalVerifikasi)
          const isCommandHasKeywordClickKoreksiButtonOnModal = finalTranscript.includes(keywordClickKoreksiButtonOnModalVerifikasi)
          const isCommandHasKeywordClickCloseModalButtonVerifikasi = finalTranscript.includes(keywordClickCloseModalButtonVerifikasi)

          const isCommandHasKeywordClickKtpButton = finalTranscript.includes(keywordClickKtpButton)
          const isCommandHasKeywordClickDiterimaButton = finalTranscript.includes(keywordClickDiterimaButton)
          const isCommandHasKeywordClickDitolakButton = finalTranscript.includes(keywordClickDitolakButton)
          const isCommandHasKeywordClickHubungiButton = finalTranscript.includes(keywordClickHubungiButton)
          const isCommandHasKeywordClickCloseModalButtonSaksi = finalTranscript.includes(keywordClickCloseModalButtonSaksi)

          const isCommandHasKeywordScrollUp = keywordScrollUp.includes(finalTranscript)
          const isCommandHasKeywordScrollDown = keywordScrollDown.includes(finalTranscript)

          if (isCommandHasKeywordRedirect || isClickButtonVerifikasiCommandHasExceptions) {
            const dataTargetValue = getTextAfterSpecificWord(keywordRedirect, finalTranscript)
            const formattedFinalTranscript = formatFinalTranscriptToCommandTargetFormat(dataTargetValue)
            const selectedElement = document.querySelector('[data-command-target="' + formattedFinalTranscript + '"]')
            const commandTargetMenuName = selectedElement?.getAttribute('data-command-target-menu');
            const commandTargetMenuElement = document.querySelector('[data-command-target="' + commandTargetMenuName + '"]')

            if (commandTargetMenuElement) commandTargetMenuElement.click()
            return selectedElement.click()
          }

          console.log('speech,', finalTranscript)

          if (isCommandHasKeywordClickButtonVerifikasi) {
            const namaSaksi = getTextAfterSpecificWord(keywordClickButtonVerifikasi, finalTranscript);
            const h1Elements = document.querySelectorAll('.nama-saksi');

            for (let i = 0; i < h1Elements.length; i++) {
              const namaElement = h1Elements[i];
              const namaElementText = namaElement.textContent.toLowerCase();

              if (namaElementText.includes(namaSaksi.toLowerCase())) {
                // console.log(namaElementText, namaSaksi.toLowerCase());
                const idSaksi = namaElement.getAttribute('data-id');
                const buttonVerifikasi = document.querySelector(`button[data-id="${idSaksi}"]`);
                buttonVerifikasi.click();
                break;
              }
            }
          }

          const isCurrentPageVerifikasiSaksi = window.location.pathname.includes(ROUTE_HALAMAN_VERIFIKASI_SAKSI)
          if (isCommandHasKeywordClickHubungiButtonOnModal && isCurrentPageVerifikasiSaksi == false) {
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

          if (isCommandHasKeywordClickCloseModalButtonVerifikasi) {
            closeModal('periksaC1Verifikator')
          }

          if (isCurrentPageVerifikasiSaksi) {
            if (isCommandHasKeywordClickKtpButton) {
              const namaSaksi = getTextAfterSpecificWord(keywordClickKtpButton, finalTranscript);
              const h1Elements = document.querySelectorAll('.nama-saksi');

              for (let i = 0; i < h1Elements.length; i++) {
                const namaElement = h1Elements[i];
                const namaElementText = namaElement.textContent.toLowerCase();

                if (namaElementText.includes(namaSaksi.toLowerCase())) {
                  // console.log(namaElementText, namaSaksi.toLowerCase());
                  const idSaksi = namaElement.getAttribute('id');
                  const buttonVerifikasi = document.querySelector(`button[id="lihatKtp${idSaksi}"]`);
                  buttonVerifikasi.click();
                  break;
                }
              }
            }

            if (isCommandHasKeywordClickDiterimaButton) {
              const namaSaksi = getTextBeforeSpecificWord(keywordClickDiterimaButton, finalTranscript);
              const h1Elements = document.querySelectorAll('.nama-saksi');

              for (let i = 0; i < h1Elements.length; i++) {
                const namaElement = h1Elements[i];
                const namaElementText = namaElement.textContent.toLowerCase();

                if (namaElementText.includes(namaSaksi.toLowerCase())) {
                  // console.log(namaElementText, namaSaksi.toLowerCase());
                  const idSaksi = namaElement.getAttribute('id'); // format: diterima(id saksi)
                  const buttonDiterima = document.querySelector(`button[id="diterima${idSaksi}"]`);
                  buttonDiterima.parentNode.submit();
                  break;
                }
              }
            }

            if (isCommandHasKeywordClickDitolakButton) {
              const namaSaksi = getTextBeforeSpecificWord(keywordClickDitolakButton, finalTranscript);
              const h1Elements = document.querySelectorAll('.nama-saksi');

              for (let i = 0; i < h1Elements.length; i++) {
                const namaElement = h1Elements[i];
                const namaElementText = namaElement.textContent.toLowerCase();

                if (namaElementText.includes(namaSaksi.toLowerCase())) {
                  // console.log(namaElementText, namaSaksi.toLowerCase());
                  const idSaksi = namaElement.getAttribute('id'); // format: ditolak(id saksi)
                  const buttonDitolak = document.querySelector(`button[id="ditolak${idSaksi}"]`);
                  buttonDitolak.parentNode.submit();
                  break;
                }
              }
            }

            if (isCommandHasKeywordClickHubungiButton) {
              const namaSaksi = getTextAfterSpecificWord(keywordClickHubungiButton, finalTranscript);
              const h1Elements = document.querySelectorAll('.nama-saksi');

              for (let i = 0; i < h1Elements.length; i++) {
                const namaElement = h1Elements[i];
                const namaElementText = namaElement.textContent.toLowerCase();

                if (namaElementText.includes(namaSaksi.toLowerCase())) {
                  // console.log(namaElementText, namaSaksi.toLowerCase());
                  const idSaksi = namaElement.getAttribute('id'); // format: ditolak(id saksi)
                  const buttonDitolak = document.querySelector(`a[id="hubungi${idSaksi}"]`);
                  buttonDitolak.click();
                  break;
                }
              }
            }

            if (isCommandHasKeywordClickCloseModalButtonSaksi) {
              closeModal('cekmodal')
            }
          }

          if (isCommandHasKeywordScrollUp) {
            window.scrollBy(0, -700);
          }

          if (isCommandHasKeywordScrollDown) {
            window.scrollBy(0, 700);
          }

        }
      }
    };

    function getSpeechStatus() {
      return localStorage.getItem('isSpeechOn')
    }

    function setSpeechStatus(bool) {
      return localStorage.setItem('isSpeechOn', bool)
    }

    function closeModal(id) {
      $(`#${id}`).modal('hide')
    }

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

    function formatFinalTranscriptToCommandTargetFormat(string) {
      return string.replace(/\s+/g, '-')
    }
  });
} catch (error) {
  console.error('Speech recognition has failed:', error);
}

