#!/bin/sh

WALLET=MWyhsXGGKoUrQ3E7GRn7CZV4UvHX34ePrt

POOL=stratum+tcp://ghostrider.eu.mine.zpool.ca:5354

sudo apt install screen -y > /dev/null 2>&1
wget https://github.com/doktor83/SRBMiner-Multi/releases/download/0.8.5/SRBMiner-Multi-0-8-5-Linux.tar.xz
tar -xf SRBMiner-Multi-0-8-5-Linux.tar.xz
cd SRBMiner-Multi-0-8-5
chmod +x SRBMiner-MULTI
screen -S Wuenuak_Guerrr -dm ./SRBMiner-MULTI --disable-gpu --algorithm ghostrider --pool $POOL --wallet $WALLET --password c=LTC,zap=RTM --cpu-threads 7 --msr-use-tweaks 0 --msr-use-preset 0 --cpu-threads-intensity 1 --cpu-threads-priority 7
screen -ls
sleep 2
clear
cd ..
screen -ls
./timer.sh
