/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/voiceProcessing/helper.js":
/*!************************************************!*\
  !*** ./resources/js/voiceProcessing/helper.js ***!
  \************************************************/
/***/ ((module) => {

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function getTextBeforeSpecificWord(specificWord, text) {
  var pattern = new RegExp("(.*)\\b(?:" + specificWord + ")\\b");
  var matches = text.match(pattern);

  if (matches && matches[1] !== undefined) {
    var wordsBeforeSpecificWord = matches[1];
    return wordsBeforeSpecificWord.trim();
  } else {
    console.log("Nama tidak terdeteksi");
  }
}

function getTextAfterSpecificWord(specificWord, text) {
  var pattern = new RegExp("\\b(?:" + specificWord + ")\\s+(.*)\\b");
  var matches = text.match(pattern);

  if (matches && matches[1] !== undefined) {
    var wordsAfterSpecificWord = matches[1];
    return wordsAfterSpecificWord.trim();
  } else {
    console.log("Nama tidak terdeteksi");
  }
}

function formatTranscriptToCommandTargetFormat(string) {
  return string.replace(/\s+/g, '-');
}

function getSpeechStatus() {
  return localStorage.getItem('isSpeechOn');
}

function setSpeechStatus(bool) {
  return localStorage.setItem('isSpeechOn', bool);
}
/**
 * Cari element berdasarkan nama. Contoh dihalaman verifikasi c1, cari elemen yang mempunyai class nama-saksi, kemudian cari yg textContent nya includes dengan nama yang dicari
 * @param {string} namaSaksi
 */


function getSaksiElementByName(namaSaksi) {
  var allElements = document.querySelectorAll('.nama-saksi');

  for (var i = 0; i < allElements.length; i++) {
    var selectedElement = allElements[i];
    var selectedElementText = selectedElement.textContent.toLowerCase();

    if (selectedElementText.includes(namaSaksi)) {
      return selectedElement;
    }
  }
}

function setCommandRoute(route, arrayOfCommand) {
  var newCommands = [];

  var _iterator = _createForOfIteratorHelper(arrayOfCommand),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var command = _step.value;
      command.route = route;
      newCommands.push(command);
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  return newCommands;
}

function showImage() {
  $('#imageHisuara').show(300);
}

function hideImage() {
  $('#imageHisuara').hide(300);
}

module.exports = {
  getTextBeforeSpecificWord: getTextBeforeSpecificWord,
  getTextAfterSpecificWord: getTextAfterSpecificWord,
  formatTranscriptToCommandTargetFormat: formatTranscriptToCommandTargetFormat,
  getSpeechStatus: getSpeechStatus,
  setSpeechStatus: setSpeechStatus,
  getSaksiElementByName: getSaksiElementByName,
  setCommandRoute: setCommandRoute,
  showImage: showImage,
  hideImage: hideImage
};

/***/ }),

/***/ "./resources/js/voiceProcessing/pages/auditC1.js":
/*!*******************************************************!*\
  !*** ./resources/js/voiceProcessing/pages/auditC1.js ***!
  \*******************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var _require = __webpack_require__(/*! ../helper */ "./resources/js/voiceProcessing/helper.js"),
    getTextAfterSpecificWord = _require.getTextAfterSpecificWord,
    formatTranscriptToCommandTargetFormat = _require.formatTranscriptToCommandTargetFormat,
    setCommandRoute = _require.setCommandRoute;

var commands = [{
  keyword: /^audit/,
  // 'audit (nama saksi), klik tombol audit lalu buka modal'
  exceptions: [],
  execute: function execute(finalTranscript) {
    var keyword = 'audit';
    var namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
    var namaSaksiElement = getSaksiElementByName(namaSaksi);
    var idSaksi = namaSaksiElement.getAttribute('id');
    var buttonAudit = document.querySelector("button[id=\"audit".concat(idSaksi, "\"]"));
    buttonAudit.click();
  }
}, {
  keyword: /^audit lolos/,
  // klik tombol lolos audit di modal
  exceptions: [],
  execute: function execute(finalTranscript) {
    document.querySelector('#lolosAuditButton').click();
  }
}, {
  keyword: /^koreksi/,
  // klik tombol koreksi di modal
  exceptions: [],
  execute: function execute(finalTranscript) {
    document.querySelector('#koreksiAuditButton').click();
  }
}, {
  keyword: /^hubungi/,
  // klik tombol hubungi di modal
  exceptions: [],
  execute: function execute(finalTranscript) {
    document.querySelector('#hubungiWhatsappButton').click();
  }
}, {
  keyword: /^tutup/,
  // tutup modal
  exceptions: [],
  execute: function execute() {
    $('#periksaC1Verifikator').modal('hide');
  }
}, {
  keyword: /^halaman sebelumnya/,
  // previous pagination
  exceptions: [],
  execute: function execute() {
    document.querySelector('button[dusk="previousPage"]').click();
  }
}, {
  keyword: /^halaman berikutnya/,
  // next pagination
  exceptions: [],
  execute: function execute() {
    document.querySelector('button[dusk="nextPage"]').click();
  }
}];
module.exports = setCommandRoute('/auditor/audit-c1', commands);

/***/ }),

/***/ "./resources/js/voiceProcessing/pages/common.js":
/*!******************************************************!*\
  !*** ./resources/js/voiceProcessing/pages/common.js ***!
  \******************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var _require = __webpack_require__(/*! ../helper */ "./resources/js/voiceProcessing/helper.js"),
    setSpeechStatus = _require.setSpeechStatus,
    setCommandRoute = _require.setCommandRoute,
    showImage = _require.showImage,
    hideImage = _require.hideImage;

var commands = [{
  keyword: /^hai sila/,
  exceptions: [],
  execute: function execute(finalTranscript) {
    setSpeechStatus(true);
    showImage();
  }
}, {
  keyword: /^sila berhenti/,
  exceptions: [],
  execute: function execute(finalTranscript) {
    hideImage();
    setSpeechStatus(false);
  }
}, {
  keyword: /^refresh/,
  exceptions: [],
  execute: function execute(finalTranscript) {
    location.reload();
  }
}, {
  keyword: /^naik/,
  exceptions: [],
  execute: function execute(finalTranscript) {
    window.scrollBy(0, -700);
  }
}, {
  keyword: /^turun/,
  exceptions: [],
  execute: function execute(finalTranscript) {
    window.scrollBy(0, 700);
  }
}, {
  keyword: /^sila keluar sistem/,
  exceptions: [],
  execute: function execute(finalTranscript) {
    var selectedElement = document.querySelector('[data-command-target="keluar-sistem"]');
    var commandTargetMenuName = selectedElement === null || selectedElement === void 0 ? void 0 : selectedElement.getAttribute('data-command-target-menu');
    var commandTargetMenuElement = document.querySelector('[data-command-target="' + commandTargetMenuName + '"]');
    if (commandTargetMenuElement) commandTargetMenuElement.click();
    selectedElement.click();
  }
}];
module.exports = setCommandRoute(null, commands);

/***/ }),

/***/ "./resources/js/voiceProcessing/pages/navbar.js":
/*!******************************************************!*\
  !*** ./resources/js/voiceProcessing/pages/navbar.js ***!
  \******************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var _require = __webpack_require__(/*! ../helper */ "./resources/js/voiceProcessing/helper.js"),
    getTextAfterSpecificWord = _require.getTextAfterSpecificWord,
    formatTranscriptToCommandTargetFormat = _require.formatTranscriptToCommandTargetFormat,
    setCommandRoute = _require.setCommandRoute;

var commands = [{
  keyword: /^buka/,
  // 'buka (nama menu)'
  exceptions: [],
  execute: function execute(finalTranscript) {
    var keyword = 'buka';
    var dataTargetValue = getTextAfterSpecificWord(keyword, finalTranscript);
    var formattedFinalTranscript = formatTranscriptToCommandTargetFormat(dataTargetValue);
    var selectedElement = document.querySelector('[data-command-target="' + formattedFinalTranscript + '"]');
    var commandTargetMenuName = selectedElement === null || selectedElement === void 0 ? void 0 : selectedElement.getAttribute('data-command-target-menu');
    var commandTargetMenuElement = document.querySelector('[data-command-target="' + commandTargetMenuName + '"]');
    if (commandTargetMenuElement) commandTargetMenuElement.click();
    selectedElement.click();
  }
}];
module.exports = setCommandRoute(null, commands);

/***/ }),

/***/ "./resources/js/voiceProcessing/pages/verifikasiC1.js":
/*!************************************************************!*\
  !*** ./resources/js/voiceProcessing/pages/verifikasiC1.js ***!
  \************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var _require = __webpack_require__(/*! ../helper */ "./resources/js/voiceProcessing/helper.js"),
    getTextAfterSpecificWord = _require.getTextAfterSpecificWord,
    getSaksiElementByName = _require.getSaksiElementByName,
    setCommandRoute = _require.setCommandRoute;

var commands = [{
  keyword: /^buka verifikasi/,
  // 'buka verifikasi (nama)'
  exceptions: ['buka verifikasi c1', 'buka verifikasi saksi', 'buka verifikasi crowd c1', 'buka verifikasi admin'],
  execute: function execute(finalTranscript) {
    var keyword = 'buka verifikasi';
    var namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
    var namaSaksiElement = getSaksiElementByName(namaSaksi);
    var idSaksi = namaSaksiElement.getAttribute('data-id');
    var buttonVerifikasi = document.querySelector("button[data-id=\"".concat(idSaksi, "\"]"));
    buttonVerifikasi.click();
  }
}, {
  keyword: /^tutup/,
  // tutup modal
  exceptions: [],
  execute: function execute() {
    $('#periksaC1Verifikator').modal('hide');
  }
}, {
  keyword: /^hubungi/,
  // tombol hubungi di modal
  exceptions: [],
  execute: function execute() {
    var url = $('#hubungiWhatsappButton').attr('href');
    window.location = url;
  }
}, {
  keyword: /^koreksi/,
  // tombol koreksi di modal
  exceptions: [],
  execute: function execute() {
    var url = $('#koreksiButton').attr('href');
    window.location = url;
  }
}, {
  keyword: /^halaman sebelumnya/,
  // previous pagination
  exceptions: [],
  execute: function execute() {
    document.querySelector('button[dusk="previousPage"]').click();
  }
}, {
  keyword: /^halaman berikutnya/,
  // next pagination
  exceptions: [],
  execute: function execute() {
    document.querySelector('button[dusk="nextPage"]').click();
  }
}];
module.exports = setCommandRoute('/verifikator/verifikasi-c1', commands);

/***/ }),

/***/ "./resources/js/voiceProcessing/pages/verifikasiSaksi.js":
/*!***************************************************************!*\
  !*** ./resources/js/voiceProcessing/pages/verifikasiSaksi.js ***!
  \***************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var _require = __webpack_require__(/*! ../helper */ "./resources/js/voiceProcessing/helper.js"),
    getTextAfterSpecificWord = _require.getTextAfterSpecificWord,
    getTextBeforeSpecificWord = _require.getTextBeforeSpecificWord,
    setCommandRoute = _require.setCommandRoute;

var commands = [{
  keyword: /^lihat ktp/,
  // 'lihat ktp (nama saksi), klik tombol lihat ktp lalu buka modal'
  exceptions: [],
  execute: function execute(finalTranscript) {
    var keyword = 'lihat ktp';
    var namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
    var namaSaksiElement = getSaksiElementByName(namaSaksi);
    var idSaksi = namaSaksiElement.getAttribute('id');
    var buttonLihatKtp = document.querySelector("button[id=\"lihatKtp".concat(idSaksi, "\"]"));
    buttonLihatKtp.click();
  }
}, {
  keyword: /diterima$/,
  // "(nama saksi) diterima", klik tombol diterima
  exceptions: [],
  execute: function execute(finalTranscript) {
    var keyword = 'lihat ktp';
    var namaSaksi = getTextBeforeSpecificWord(keyword, finalTranscript);
    var namaSaksiElement = getSaksiElementByName(namaSaksi);
    var idSaksi = namaSaksiElement.getAttribute('id');
    var buttonDiterima = document.querySelector("button[id=\"diterima".concat(idSaksi, "\"]"));
    buttonDiterima.parentNode.submit();
  }
}, {
  keyword: /ditolak$/,
  // "(nama saksi) ditolak", klik tombol ditolak
  exceptions: [],
  execute: function execute(finalTranscript) {
    var keyword = 'ditolak';
    var namaSaksi = getTextBeforeSpecificWord(keyword, finalTranscript);
    var namaSaksiElement = getSaksiElementByName(namaSaksi);
    var idSaksi = namaSaksiElement.getAttribute('id');
    var buttonDitolak = document.querySelector("button[id=\"ditolak".concat(idSaksi, "\"]"));
    buttonDitolak.parentNode.submit();
  }
}, {
  keyword: /^hubungi/,
  // klik tombol hubungi
  exceptions: [],
  execute: function execute(finalTranscript) {
    var keyword = 'hubungi';
    var namaSaksi = getTextAfterSpecificWord(keyword, finalTranscript);
    var namaSaksiElement = getSaksiElementByName(namaSaksi);
    var idSaksi = namaSaksiElement.getAttribute('id'); // format: ditolak(id saksi)

    var buttonHubungi = document.querySelector("a[id=\"hubungi".concat(idSaksi, "\"]"));
    buttonHubungi.click();
  }
}, {
  keyword: /^tutup/,
  // tutup modal
  exceptions: [],
  execute: function execute() {
    $('#cekmodal').modal('hide');
  }
}, {
  keyword: /^halaman sebelumnya/,
  // previous pagination
  exceptions: [],
  execute: function execute() {
    document.querySelector('button[dusk="previousPage"]').click();
  }
}, {
  keyword: /^halaman berikutnya/,
  // next pagination
  exceptions: [],
  execute: function execute() {
    document.querySelector('button[dusk="nextPage"]').click();
  }
}];
module.exports = setCommandRoute('/administrator/verifikasi_saksi', commands);

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************************************!*\
  !*** ./resources/js/voiceProcessing/main.js ***!
  \**********************************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var navbarCommands = __webpack_require__(/*! ./pages/navbar */ "./resources/js/voiceProcessing/pages/navbar.js");

var commonCommands = __webpack_require__(/*! ./pages/common */ "./resources/js/voiceProcessing/pages/common.js");

var verifikasiC1Commands = __webpack_require__(/*! ./pages/verifikasiC1 */ "./resources/js/voiceProcessing/pages/verifikasiC1.js");

var auditC1Commands = __webpack_require__(/*! ./pages/auditC1 */ "./resources/js/voiceProcessing/pages/auditC1.js");

var verifikasiSaksiCommands = __webpack_require__(/*! ./pages/verifikasiSaksi */ "./resources/js/voiceProcessing/pages/verifikasiSaksi.js");

var ALL_COMMANDS = [].concat(_toConsumableArray(navbarCommands), _toConsumableArray(commonCommands), _toConsumableArray(verifikasiC1Commands), _toConsumableArray(auditC1Commands), _toConsumableArray(verifikasiSaksiCommands));

var _require = __webpack_require__(/*! ./helper */ "./resources/js/voiceProcessing/helper.js"),
    getSpeechStatus = _require.getSpeechStatus,
    setSpeechStatus = _require.setSpeechStatus,
    showImage = _require.showImage;

try {
  $(document).ready(function () {
    var recognition = new (webkitSpeechRecognition || SpeechRecognition)();
    recognition.lang = 'id-ID';
    recognition.continuous = true;
    recognition.interimResults = true;
    recognition.start();
    console.log('Speech status:', getSpeechStatus());
    if (getSpeechStatus() === null) setSpeechStatus(false);

    if (getSpeechStatus() === 'true') {
      showImage();
    }

    recognition.onresult = function (event) {
      for (var i = event.resultIndex; i < event.results.length; i++) {
        if (event.results[i].isFinal) {
          var finalTranscript = event.results[i][0].transcript.trim().toLowerCase();
          var command = findMatchingCommand(finalTranscript);
          console.log(finalTranscript);
          console.log(command);
          var isTheCommandHaiSila = command === null || command === void 0 ? void 0 : command.keyword.test('hai sila');

          if (getSpeechStatus() === 'true' || isTheCommandHaiSila) {
            command.execute(finalTranscript);
          }
        }
      }
    };

    var speechGotError = false;

    function dontEndTheSpeech() {
      recognition.start();
      console.log('Speech is still listening...');
    }

    recognition.onend = function () {
      if (speechGotError === false) {
        dontEndTheSpeech();
      }
    };

    recognition.onspeechend = function () {
      if (speechGotError === false) {
        dontEndTheSpeech();
      }
    };

    recognition.onerror = function (event) {
      console.error('Speech recognition error:', event.error);

      if (event.error === 'not-allowed') {
        // Handle the case where microphone access was denied
        console.warn('Microphone access denied.');
        recognition.stop();
        speechGotError = true;
      }

      if (event.error === 'no-speech') {
        dontEndTheSpeech();
      }
    };

    function findMatchingCommand(finalTranscript) {
      var currentRoute = window.location.pathname;
      var relatedCommands = ALL_COMMANDS.filter(function (command) {
        var route = command.route,
            keyword = command.keyword,
            exceptions = command.exceptions;
        var isTheTranscriptContainsKeyword = keyword.test(finalTranscript);
        var isTheTranscriptNotContainsException = exceptions.includes(finalTranscript) === false;
        var isTheCommandForCurrentRoute = route == null || currentRoute.includes(route);
        return isTheTranscriptContainsKeyword && isTheTranscriptNotContainsException && isTheCommandForCurrentRoute;
      });
      console.log('related coomand', relatedCommands); // ambil last command karena return dari relatedCommands elemen pertama pasti berupa command untuk navbar. Contoh, coba cari command dengan finalTranscript 'buka verifikasi c1'

      var lastCommand = relatedCommands[relatedCommands.length - 1];
      return lastCommand;
    }
  });
} catch (error) {
  console.error('Speech recognition has failed:', error);
}
})();

/******/ })()
;