del "D:\a\_temp\_github_workflow\*event.json" /s /f /q 
@RD /S /Q D:\a\_temp
#python D:\a\lionspj\lionspj\chrome.py
@echo off
#explorer D:\a\lionspj\lionspj\Start_smart_VPN.lnk 
#explorer D:\a\lionspj\lionspj\Start_smart_VPN.lnk 
#timeout /t 6 /nobreak
cd C:\Users\runneradmin\Desktop
title PJ
start "psiphon3" "D:\a\lionspj\lionspj\psiphon3.exe"
timeout /t 15 /nobreak
taskkill /F /IM  msedge.exe
timeout /t 2 /nobreak
set CHROME="C:\Program Files\Google\Chrome\Application\chrome.exe"
set COMMON=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-001" --window-size=500,500 --window-position=1400,90 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system  
set COMMON1=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-002" --window-size=500,500 --window-position=600,90 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system  
set COMMON2=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-003" --window-size=500,500 --window-position=100,90 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system   
set COMMON3=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-004" --window-size=500,500 --window-position=1400,500 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system 
set COMMON4=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-005" --window-size=500,500 --window-position=600,500 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system 
set COMMON5=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-006" --window-size=500,500 --window-position=100,500 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system 
set COMMON6=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-007" --window-size=500,500 --window-position=800,250 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system  


start "" %CHROME% %COMMON% file:///C:/Users/Public/Desktop/videos.html
taskkill /F /IM  msedge.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON% https://www.youtube.com/watch?v=h_LitQX8O_I&list=TLGGaJZ8haMJ_asyNjA4MjAyMg&t=0s&loop=0
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON1% file:///C:/Users/Public/Desktop/videos1.html
taskkill /F /IM  msedge.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON1% https://www.youtube.com/watch?v=-dw8nhuVXIU&list=TLGGvpfeAjTV9AMyNjA4MjAyMg&t=0s&loop=0
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON2% file:///C:/Users/Public/Desktop/videos3.html
taskkill /F /IM  msedge.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON2% https://www.youtube.com/watch?v=oESB8EB3ynA&list=TLGGmRLXxVtVJqwyNjA4MjAyMg&t=0s&loop=0
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON3% file:///C:/Users/Public/Desktop/videos4.html
taskkill /F /IM  msedge.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON3% https://www.youtube.com/watch?v=s9TUoTiGfa4&list=TLGGynG23MynxEYyNjA4MjAyMg&t=0s&loop=0
timeout /t 7 /nobreak
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON4% file:///C:/Users/Public/Desktop/videos5.html
taskkill /F /IM  msedge.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON4% https://www.youtube.com/watch?v=pF2Chs2yzEw&list=TLGGynG23MynxEYyNjA4MjAyMg&t=0s&loop=0
timeout /t 7 /nobreak
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON5% file:///C:/Users/Public/Desktop/videos6.html
taskkill /F /IM  msedge.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON5% https://www.youtube.com/watch?v=66pGTdiRUyg&list=TLGGynG23MynxEYyNjA4MjAyMg&t=0s&loop=0
timeout /t 8 /nobreak
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 7 /nobreak
start "" %CHROME% %COMMON6% file:///C:/Users/Public/Desktop/videos7.html
taskkill /F /IM  msedge.exe
timeout /t 8 /nobreak
start "" %CHROME% %COMMON6% https://www.youtube.com/watch?v=TPPQz6YQBqc&list=TLGGynG23MynxEYyNjA4MjAyMg&t=0s&loop=0
timeout /t 7 /nobreak
taskkill /F /IM  msedge.exe
EXIT
