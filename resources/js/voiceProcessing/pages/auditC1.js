const {
  getTextAfterSpecificWord,
  formatTranscriptToCommandTargetFormat,
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
    keyword: /^tutup/, // tutup modal
    exceptions: [],
    execute: () => {
      $('#periksaC1Verifikator').modal('hide')
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
]

module.exports = setCommandRoute('/auditor/audit-c1', commands)