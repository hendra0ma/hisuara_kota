const {
  setSpeechStatus,
  setCommandRoute,
  showImage,
  hideImage,
} = require('../helper')

const commands = [
  {
    keyword: /^hai sila/,
    exceptions: [],
    execute: (finalTranscript) => {
      setSpeechStatus(true);
      showImage()
    }
  },
  {
    keyword: /^sila berhenti/,
    exceptions: [],
    execute: (finalTranscript) => {
      hideImage()
      setSpeechStatus(false);
    }
  },
  {
    keyword: /^muat ulang/,
    exceptions: [],
    execute: (finalTranscript) => {
      location.reload()
    }
  },
  {
    keyword: /^naik/,
    exceptions: [],
    execute: (finalTranscript) => {
      window.scrollBy(0, -700);
    }
  },
  {
    keyword: /^turun/,
    exceptions: [],
    execute: (finalTranscript) => {
      window.scrollBy(0, 700);
    }
  },
  {
    keyword: /^kembali/,
    exceptions: [],
    execute: (finalTranscript) => {
      history.back()
    }
  },
  {
    keyword: /^halaman sebelumnya/, // previous pagination
    exceptions: [],
    execute: () => {
      document.querySelector('button[dusk="previousPage"]').click()
    }
  },
  {
    keyword: /^halaman berikutnya/, // next pagination
    exceptions: [],
    execute: () => {
      document.querySelector('button[dusk="nextPage"]').click()
    }
  },
  {
    keyword: /^sila keluar sistem/,
    exceptions: [],
    execute: (finalTranscript) => {
      const selectedElement = document.querySelector('[data-command-target="keluar-sistem"]')
      const commandTargetMenuName = selectedElement?.getAttribute('data-command-target-menu');
      const commandTargetMenuElement = document.querySelector('[data-command-target="' + commandTargetMenuName + '"]')

      if (commandTargetMenuElement) commandTargetMenuElement.click()
      selectedElement.click()
    }
  },
]

module.exports = setCommandRoute(null, commands)