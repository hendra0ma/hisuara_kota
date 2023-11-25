const {
  getTextAfterSpecificWord,
  formatTranscriptToCommandTargetFormat,
  setCommandRoute,
} = require('../helper')

const commands = [
  {
    keyword: /^buka/, // 'buka (nama menu)'
    exceptions: [],
    execute: (finalTranscript) => {
      const keyword = 'buka'
      const dataTargetValue = getTextAfterSpecificWord(keyword, finalTranscript)
      const formattedFinalTranscript = formatTranscriptToCommandTargetFormat(dataTargetValue)
      const selectedElement = document.querySelector('[data-command-target="' + formattedFinalTranscript + '"]')
      const commandTargetMenuName = selectedElement?.getAttribute('data-command-target-menu');
      const commandTargetMenuElement = document.querySelector('[data-command-target="' + commandTargetMenuName + '"]')

      if (commandTargetMenuElement) commandTargetMenuElement.click()
      selectedElement.click()
    }
  }
]

module.exports = setCommandRoute(null, commands)