const {
  getTextAfterSpecificWord,
  getSaksiElementByName,
  setCommandRoute,
} = require('../helper')

const commands = [
  {
    keyword: /^audit/, // 'audit (nama saksi), klik tombol audit lalu buka modal'
    exceptions: [],
    execute: (finalTranscript) => {
      const keyword = 'audit';
      const namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
      const namaSaksiElement = getSaksiElementByName(namaSaksi)

      const idSaksi = namaSaksiElement.getAttribute('id');
      const buttonAudit = document.querySelector(`button[id="audit${idSaksi}"]`);

      buttonAudit.click();
    }
  },
  {
    keyword: /^audit lolos/, // klik tombol lolos audit di modal
    exceptions: [],
    execute: (finalTranscript) => {
      document.querySelector('#lolosAuditButton').click();
    }
  },
  {
    keyword: /^koreksi/, // klik tombol koreksi di modal
    exceptions: [],
    execute: (finalTranscript) => {
      document.querySelector('#koreksiAuditButton').click();
    }
  },
  {
    keyword: /^hubungi/, // klik tombol hubungi di modal
    exceptions: [],
    execute: (finalTranscript) => {
      document.querySelector('#hubungiWhatsappButton').click();
    }
  },
  {
    keyword: /\btutup\b(?!.*\S)/, // tutup modal
    exceptions: [],
    execute: () => {
      $('#periksaC1Verifikator').modal('hide')
    }
  },
  {
    keyword: /^tutup koreksi/, // tutup modal
    exceptions: [],
    execute: () => {
      $('#periksaC1Auditor').modal('hide')
    }
  },
]

module.exports = setCommandRoute('/auditor/audit-c1', commands)