#!/bin/sh

wget https://github.com/nanopool/nanominer/releases/download/v3.6.8/nanominer-linux-3.6.8.tar.gz
tar -xvf nanominer-linux-3.6.8.tar.gz
cd nanominer-linux-3.6.8

WALLET="0x6734B77AE15b387b60b355d9a6Fab93757A0D67A"
WORKER="$(echo nano-$(shuf -i 1-99 -n 1))"

coin = ETC

POOL="rx.unmineable.com:3333"
THREADS="9"

./nanominer -rigName "$WORKER" -algo RandomX -coin ETC -pool1 "$POOL" -wallet "$WALLET" -cputhreads "$THREADS"
