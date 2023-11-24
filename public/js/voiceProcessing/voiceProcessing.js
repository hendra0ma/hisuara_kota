const navbarCommands = require('./pages/navbar');
const verifikasiC1Commands = require('./pages/verifikasiC1');

const ALL_COMMANDS = [
  ...navbarCommands,
  ...verifikasiC1Commands,
];

const {
  getSpeechStatus,
  setSpeechStatus
} = require('./helper');

const ROUTE_HALAMAN_VERIFIKASI_SAKSI = 'administrator/verifikasi_saksi';
const ROUTE_HALAMAN_VERIFIKASI_C1 = 'verifikator/verifikasi-c1';
const ROUTE_HALAMAN_AUDIT_C1 = 'auditor/audit-c1';

try {
  $(document).ready(function () {
    const recognition = new (webkitSpeechRecognition || SpeechRecognition)();
    recognition.lang = 'id-ID';
    recognition.continuous = true;
    recognition.interimResults = true;

    recognition.start();
    const isSpeechOn = getSpeechStatus();

    if (isSpeechOn === 'true') {
      showImage();
      let speechGotError = false;

      function dontEndTheSpeech() {
        if (getSpeechStatus() === 'true') {
          recognition.start();
        }
        console.log('Speech still listening...');
      }

      recognition.onerror = function (event) {
        console.error('Speech recognition error:', event.error);
        if (event.error === 'not-allowed') {
          // Handle the case where microphone access was denied
          console.warn('Microphone access denied.');
          recognition.stop();
          speechGotError = true;
        }
      };

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
    }

    recognition.onresult = function (event) {
      for (let i = event.resultIndex; i < event.results.length; i++) {
        if (event.results[i].isFinal) {
          let finalTranscript = event.results[i][0].transcript.trim().toLowerCase();

          handleSpeechRecognitionStatus(finalTranscript);

          if (getSpeechStatus() === 'false') {
            return;
          }

          const command = findMatchingCommand(finalTranscript)
          console.log(command);
          command.execute(finalTranscript)
        }
      }
    };

    function handleSpeechRecognitionStatus(finalTranscript) {
      if (finalTranscript.includes(startSpeech)) {
        setSpeechStatus(true);
        $('#imageHisuara').show(300)
      }

      if (finalTranscript.includes(endSpeech)) {
        setSpeechStatus(false);
        $('#imageHisuara').hide(300)
      }

      console.log('Speech status:', getSpeechStatus());
    }

    function findMatchingCommand(finalTranscript) {
      const currentRoute = window.location.pathname

      const relatedCommands = ALL_COMMANDS.filter((command) => {
        const { route, keyword, exceptions } = command;
        const isTheTranscriptContainsKeyword = keyword.test(finalTranscript)
        const isTheTranscriptNotContainsException = exceptions.includes(finalTranscript) === false
        const isTheCommandForCurrentRoute = route == null || route.includes(currentRoute)

        return isTheTranscriptContainsKeyword
          && isTheTranscriptNotContainsException
          && isTheCommandForCurrentRoute
      })

      // ambil last command karena return dari relatedCommands elemen pertama pasti berupa command untuk navbar. Contoh, coba cari command dengan finalTranscript 'buka verifikasi c1'
      const lastCommand = relatedCommands[relatedCommands.length - 1]
      return lastCommand
    }
  });
} catch (error) {
  console.error('Speech recognition has failed:', error);
}
