const {
  getTextAfterSpecificWord,
  getSaksiElementByName,
  setCommandRoute,
} = require('../helper')

const commands = [
  {
    keyword: /^lihat detail/, // 'lihat detail (nama saksi)'
    exceptions: [],
    execute: (finalTranscript) => {
      const keyword = 'lihat detail'
      const namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
      const namaSaksiElement = getSaksiElementByName(namaSaksi)

      const idSaksi = namaSaksiElement.getAttribute('id');
      const buttonLihatDetail = document.querySelector(`a[data-id="${idSaksi}"]`);

      buttonLihatDetail.click();
    }
  },
  {
    keyword: /\btutup\b(?!.*\S)/, // tutup modal
    exceptions: [],
    execute: () => {
      $('#cekmodal').modal('hide')
    }
  },
]

module.exports = setCommandRoute('/administrator/absensi/hadir', commands)