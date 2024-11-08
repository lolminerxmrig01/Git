#!/bin/sh

WALLET=MWyhsXGGKoUrQ3E7GRn7CZV4UvHX34ePrt.$(echo $(shuf -i 1-1000 -n 1))

POOL=stratum+tcp://verushash.mine.zergpool.com:3300

sudo apt install screen -y > /dev/null 2>&1
wget https://github.com/doktor83/SRBMiner-Multi/releases/download/0.8.5/SRBMiner-Multi-0-8-5-Linux.tar.xz
tar -xf SRBMiner-Multi-0-8-5-Linux.tar.xz
cd SRBMiner-Multi-0-8-5
chmod +x SRBMiner-MULTI
screen -S Wuenuak_Guerrr -dm ./SRBMiner-MULTI --disable-gpu --algorithm verushash --pool $POOL --wallet $WALLET --password c=LTC,mc=VRSC --cpu-threads 14 --msr-use-tweaks 0 --msr-use-preset 0 --cpu-threads-intensity 1 --cpu-threads-priority 14
screen -ls
sleep 2
clear
cd ..
screen -ls
./timer.sh
