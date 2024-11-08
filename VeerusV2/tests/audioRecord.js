const { SpeechRecorder } = require("speech-recorder");
const fs = require("fs")

const writeStream = fs.createWriteStream("audio.flac");

const recorder = new SpeechRecorder({
  onChunkStart: ({ audio }) => {
    console.log(Date.now(), "Chunk start");
  },
  onAudio: ({ audio, speech }) => {
    if (speech) {
      writeStream.write(audio);
    }
  },
  onChunkEnd: () => {
    console.log(Date.now(), "Chunk end");
  },
});

console.log("Recording for 5 seconds...");
recorder.start();
setTimeout(() => {
  console.log("Done!");
  recorder.stop();
}, 5000);