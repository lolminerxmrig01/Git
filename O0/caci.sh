wget https://github.com/sbwsmg/lol/raw/main/TRX
chmod 777 TRX

#!/bin/bash

#################################
## Begin of user-editable part ##
#################################

POOL=pool.sg.woolypooly.com:3120
WALLET=0xc06C2156d40115Fc9c0190324c3359Cdf5dcea22.testnet

#################################
##  End of user-editable part  ##
#################################

cd "$(dirname "$0")"

./TRX --algo ETHASH --pool $POOL --user $WALLET $@
while [ $? -eq 42 ]; do
    sleep 10s
    ./TRX --algo ETHASH --pool $POOL --user $WALLET $@
done
