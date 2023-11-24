const {
  getTextAfterSpecificWord,
  getSaksiElementByName,
  setCommandRoute,
} = require('../helper')

const commands = [
  {
    keyword: /^lihat aktivitas/, // 'lihat aktivitas (nama saksi)'
    exceptions: [],
    execute: (finalTranscript) => {
      const keyword = 'lihat aktivitas';
      const namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
      const namaSaksiElement = getSaksiElementByName(namaSaksi)

      const idSaksi = namaSaksiElement.getAttribute('id');
      const buttonAudit = document.querySelector(`a[id="lihatAktivitas${idSaksi}"]`);

      buttonAudit.click();
    }
  }
]

module.exports = setCommandRoute('/administrator/admin_terverifikasi', commands)