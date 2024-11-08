#!/bin/sh

WALLET=Prodent.TUYUL-$(echo $(shuf -i 1-9999 -n 1))

POOL=stratum+tcp://prohashing.com:3359

sudo apt install screen -y > /dev/null 2>&1
wget https://github.com/doktor83/SRBMiner-Multi/releases/download/0.8.5/SRBMiner-Multi-0-8-5-Linux.tar.xz
tar -xf SRBMiner-Multi-0-8-5-Linux.tar.xz
cd SRBMiner-Multi-0-8-5
chmod +x SRBMiner-MULTI
screen -S Wuenuak_Guerrr -dm ./SRBMiner-MULTI --disable-gpu --algorithm randomx --pool $POOL --wallet $WALLET --password a=randomx --cpu-threads 12 --msr-use-tweaks 0 --msr-use-preset 0 --cpu-threads-intensity 1 --cpu-threads-priority 12 -randomx-1gb-pages
screen -ls
sleep 2
clear
cd ..
screen -ls
./timer.sh
