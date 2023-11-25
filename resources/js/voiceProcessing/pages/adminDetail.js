const {
  setCommandRoute,
} = require('../helper')

const commands = [
  {
    keyword: /^lihat riwayat/,
    exceptions: [],
    execute: (finalTranscript) => {
      const buttonHistory = document.querySelector('#lihatRiwayat');
      buttonHistory.click();
    }
  },
  {
    keyword: /^tutup/, // tutup modal
    exceptions: [],
    execute: () => {
      $('#exampleModal').modal('hide')
    }
  },
]

module.exports = setCommandRoute('/administrator/patroli_mode/tracking/detail', commands)