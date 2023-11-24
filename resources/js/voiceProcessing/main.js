const navbarCommands = require('./pages/navbar');
const commonCommands = require('./pages/common');
const verifikasiC1Commands = require('./pages/verifikasiC1');

const ALL_COMMANDS = [
  ...navbarCommands,
  ...commonCommands,
  ...verifikasiC1Commands,
];

const {
  getSpeechStatus,
  setSpeechStatus,
  showImage
} = require('./helper');

try {
  $(document).ready(function () {
    const recognition = new (webkitSpeechRecognition || SpeechRecognition)();
    recognition.lang = 'id-ID';
    recognition.continuous = true;
    recognition.interimResults = true;

    recognition.start();
    console.log('Speech status:', getSpeechStatus());

    if (getSpeechStatus() === null) setSpeechStatus(false)
    if (getSpeechStatus() === 'true') {
      showImage();
    }

    recognition.onresult = function (event) {
      for (let i = event.resultIndex; i < event.results.length; i++) {
        if (event.results[i].isFinal) {
          let finalTranscript = event.results[i][0].transcript.trim().toLowerCase();

          const command = findMatchingCommand(finalTranscript)
          console.log(command);
          const isTheCommandHaiSila = command.keyword.test('hai sila')

          if (getSpeechStatus() === 'true' || isTheCommandHaiSila) {
            command.execute(finalTranscript)
          }
        }
      }
    };

    let speechGotError = false;

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
        dontEndTheSpeech()
      }
    };

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
