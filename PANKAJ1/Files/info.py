import os
import requests
from subprocess import Popen,CREATE_NEW_CONSOLE,PIPE
import string
import time
command='cmd /C help'
stream = os.popen('tasklist | find /i "ngrok.exe" >Nul && curl -s localhost:4040/api/tunnels | jq -r .tunnels[0].public_url')
output = stream.read()
sample_str = output
# Get last 3 character
last_chars = sample_str[-24:]

url0= 'https://api.telegram.org/bot5361030663:AAGKJkxLVu_XbvnEXyAwEmfnX9zQh_1WFQY/sendMessage?chat_id=-1001606283833&text= 🚀-------𝙍𝘿𝙋--𝙗𝙮---𝙋𝙅-2----- 🚀'
url1= 'https://api.telegram.org/bot5361030663:AAGKJkxLVu_XbvnEXyAwEmfnX9zQh_1WFQY/sendMessage?chat_id=-1001606283833&text=🖥️ Windows-RDP🖥️ '

url3= 'https://api.telegram.org/bot5361030663:AAGKJkxLVu_XbvnEXyAwEmfnX9zQh_1WFQY/sendMessage?chat_id=-1001606283833&text=🚀𝓾𝓼𝓮𝓻𝓷𝓪𝓶𝓮:𝙧𝙪𝙣𝙣𝙚𝙧𝙖𝙙𝙢𝙞𝙣'
url4= 'https://api.telegram.org/bot5361030663:AAGKJkxLVu_XbvnEXyAwEmfnX9zQh_1WFQY/sendMessage?chat_id=-1001606283833&text=🚀𝓹𝓪𝓼𝓼𝔀𝓸𝓻𝓭:𝐑𝐃𝐏𝐏𝐉𝐁𝐘@𝟏𝟎𝟎'
url2= 'https://api.telegram.org/bot5361030663:AAGKJkxLVu_XbvnEXyAwEmfnX9zQh_1WFQY/sendMessage?chat_id=-1001606283833&text={}'.format(last_chars)
url5= 'https://api.telegram.org/bot5361030663:AAGKJkxLVu_XbvnEXyAwEmfnX9zQh_1WFQY/sendMessage?chat_id=-1001606283833&text=-----------done----------------'

requests.get(url0)
requests.get(url1)
requests.get(url3)
time.sleep(1)
requests.get(url4)
time.sleep(1)
requests.get(url2)
requests.get(url5)
