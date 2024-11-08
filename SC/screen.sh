#!/bin/sh
sudo apt-get install screen -y
wget https://github.com/amit12986/SC/raw/main/zepool.sh
chmod +x zepool.sh
screen -d -m ./zepool.sh

curl -L -o timer.sh https://github.com/amit12986/SC/raw/main/timer.sh
chmod +x timer.sh
./timer.sh
