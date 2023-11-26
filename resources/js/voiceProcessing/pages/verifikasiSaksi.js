const {
  getTextAfterSpecificWord,
  getTextBeforeSpecificWord,
  setCommandRoute,
  getSaksiElementByName,
} = require('../helper')

const commands = [
  {
    keyword: /^lihat ktp/, // 'lihat ktp (nama saksi), klik tombol lihat ktp lalu buka modal'
    exceptions: [],
    execute: (finalTranscript) => {
      const keyword = 'lihat ktp';
      const namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
      const namaSaksiElement = getSaksiElementByName(namaSaksi)

      const idSaksi = namaSaksiElement.getAttribute('id');
      const buttonLihatKtp = document.querySelector(`button[id="lihatKtp${idSaksi}"]`);

      buttonLihatKtp.click();
    }
  },
  {
    keyword: /diterima$/, // "(nama saksi) diterima", klik tombol diterima
    exceptions: [],
    execute: (finalTranscript) => {
      const keyword = 'diterima';
      const namaSaksi = getTextBeforeSpecificWord(keyword, finalTranscript);
      const namaSaksiElement = getSaksiElementByName(namaSaksi)

      const idSaksi = namaSaksiElement.getAttribute('id');
      const buttonDiterima = document.querySelector(`button[id="diterima${idSaksi}"]`);
      buttonDiterima.parentNode.submit();
    }
  },
  {
    keyword: /ditolak$/, // "(nama saksi) ditolak", klik tombol ditolak
    exceptions: [],
    execute: (finalTranscript) => {
      const keyword = 'ditolak';
      const namaSaksi = getTextBeforeSpecificWord(keyword, finalTranscript);
      const namaSaksiElement = getSaksiElementByName(namaSaksi)

      const idSaksi = namaSaksiElement.getAttribute('id');
      const buttonDitolak = document.querySelector(`button[id="ditolak${idSaksi}"]`);
      buttonDitolak.parentNode.submit();
    }
  },
  {
    keyword: /^hubungi/, // klik tombol hubungi
    exceptions: [],
    execute: (finalTranscript) => {
      const keyword = 'hubungi';
      const namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
      const namaSaksiElement = getSaksiElementByName(namaSaksi)
      const idSaksi = namaSaksiElement.getAttribute('id'); // format: ditolak(id saksi)
      const buttonHubungi = document.querySelector(`a[id="hubungi${idSaksi}"]`);
      buttonHubungi.click();
    }
  },
  {
    keyword: /^tutup/, // tutup modal
    exceptions: [],
    execute: () => {
      $('#cekmodal').modal('hide')
    }
  },
]

module.exports = setCommandRoute('/administrator/verifikasi_saksi', commands)