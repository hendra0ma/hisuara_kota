const {
  getTextAfterSpecificWord,
  getSaksiElementByName,
  setCommandRoute
} = require('../helper')

const commands = [
  {
    keyword: /^buka verifikasi/, // 'buka verifikasi (nama)'
    exceptions: ['buka verifikasi c1', 'buka verifikasi saksi', 'buka verifikasi crowd c1', 'buka verifikasi admin'],
    execute: (finalTranscript) => {
      const keyword = 'buka verifikasi'
      const namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
      const namaSaksiElement = getSaksiElementByName(namaSaksi)

      const idSaksi = namaSaksiElement.getAttribute('data-id');
      const buttonVerifikasi = document.querySelector(`button[data-id="${idSaksi}"]`);

      buttonVerifikasi.click();
    }
  },
  {
    keyword: /^hubungi/, // tombol hubungi di modal
    exceptions: [],
    execute: () => {
      const url = $('#hubungiWhatsappButton').attr('href');
      window.location = url
    }
  },
  {
    keyword: /^koreksi/, // tombol koreksi di modal
    exceptions: [],
    execute: () => {
      const url = $('#koreksiButton').attr('href');
      window.location = url
    }
  },
  {
    keyword: /^verifikasi oke/,
    exceptions: [],
    execute: (finalTranscript) => {
      const url = $('#verifikasiButton').attr('href');
      window.location = url
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

module.exports = setCommandRoute('/verifikator/verifikasi-c1', commands)
