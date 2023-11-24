const {
  getTextAfterSpecificWord,
  formatFinalTranscriptToCommandTargetFormat,
  setCommandRoute,
} = require('../helper')

const commands = [
  {
    keyword: /^buka/, // 'buka (nama menu)'
    exceptions: [],
    execute: (finalTranscript) => {
      const keyword = this.keyword
      const dataTargetValue = getTextAfterSpecificWord(keyword, finalTranscript)
      const formattedFinalTranscript = formatFinalTranscriptToCommandTargetFormat(dataTargetValue)
      const selectedElement = document.querySelector('[data-command-target="' + formattedFinalTranscript + '"]')
      const commandTargetMenuName = selectedElement?.getAttribute('data-command-target-menu');
      const commandTargetMenuElement = document.querySelector('[data-command-target="' + commandTargetMenuName + '"]')

      if (commandTargetMenuElement) commandTargetMenuElement.click()
      return selectedElement.click()
    }
  }
]

module.exports = setCommandRoute(null, commands)