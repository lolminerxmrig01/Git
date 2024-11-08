const screenshot = require('screenshot-desktop')
const delay = ms => new Promise(resolve => setTimeout(resolve, ms))

for(var i=0; i<=26;i++) {

  screenshot({ filename: 'shot.jpg' }).then((imgPath) => {
    // imgPath: absolute path to screenshot
    // created in current working directory named shot.png
  });

  delay(500)
}