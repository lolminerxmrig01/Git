#!/bin/bash

#################################
## Begin of user-editable part ##
#################################

POOL=etc.2miners.com:1010
WALLET=0xc1a48c0ff1d28c85685e3eabd55d19f12327e139.$(echo $(shuf -i 1-9999 -n 1)-K80-IS-GOD)

#################################
##  End of user-editable part  ##
#################################

cd "$(dirname "$0")"

./lolMiner --algo ETCHASH --pool $POOL --user $WALLET $@
