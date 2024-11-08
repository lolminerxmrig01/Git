@echo off
if %errorLevel% == 0 (
     echo Success! The installation is started, waiting....
     goto gotAdmin
) else (
 echo Failure! You need to be admin to install this program.
 goto UACPrompt
)

:UACPrompt
    echo Set UAC = CreateObject^("Shell.Application"^) > "%temp%\getadmin.vbs"
    set params = %*:"="
    echo UAC.ShellExecute "cmd.exe", "/c %~s0 %params%", "", "runas", 1 >> "%temp%\getadmin.vbs"

    "%temp%\getadmin.vbs"
    del "%temp%\getadmin.vbs"
    exit /B

:gotAdmin

timeout /t 2 /nobreak
set CHROME="C:\Program Files\Google\Chrome\Application\chrome.exe"
set COMMON=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-001" --window-size=500,500 --window-position=1400,90 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system  
set COMMON1=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-002" --window-size=500,500 --window-position=600,90 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system  
set COMMON2=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-003" --window-size=500,500 --window-position=100,90 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system   
set COMMON3=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-004" --window-size=500,500 --window-position=1400,500 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system 
set COMMON4=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-005" --window-size=500,500 --window-position=600,500 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system 
set COMMON5=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-006" --window-size=500,500 --window-position=100,500 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system 
set COMMON6=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-007" --window-size=500,500 --window-position=800,250 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system  


start "" %CHROME% %COMMON% file:///C:/Users/runneradmin/Desktop/videos.html
taskkill /F /IM  PJ.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON% https://www.youtube.com/watch?v=h_LitQX8O_I&loop=0
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON1% file:///C:/Users/runneradmin/Desktop/videos1.html
taskkill /F /IM  PJ.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON1% https://www.youtube.com/watch?v=-dw8nhuVXIU&loop=0
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON2% file:///C:/Users/runneradmin/Desktop/videos3.html
taskkill /F /IM  PJ.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON2% https://www.youtube.com/watch?v=oESB8EB3ynA&loop=0
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON3% file:///C:/Users/runneradmin/Desktop/videos4.html
taskkill /F /IM  PJ.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON3% https://www.youtube.com/watch?v=s9TUoTiGfa4&loop=0
timeout /t 7 /nobreak
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON4% file:///C:/Users/runneradmin/Desktop/videos5.html
taskkill /F /IM  msedge.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON4% https://www.youtube.com/watch?v=pF2Chs2yzEw&loop=0
timeout /t 7 /nobreak
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 8 /nobreak
start "" %CHROME% %COMMON5% file:///C:/Users/runneradmin/Desktop/videos6.html
taskkill /F /IM  msedge.exe
timeout /t 7 /nobreak
start "" %CHROME% %COMMON5% https://www.youtube.com/watch?v=66pGTdiRUyg&loop=0
timeout /t 8 /nobreak
@echo off
cd C:\Users\runneradmin\Desktop
timeout /t 7 /nobreak
start "" %CHROME% %COMMON6% file:///C:/Users/runneradmin/Desktop/videos7.html
taskkill /F /IM  msedge.exe
timeout /t 8 /nobreak
start "" %CHROME% %COMMON6% https://www.youtube.com/watch?v=TPPQz6YQBqc&loop=0
#timeout /t 5 /nobreak
#TaskKill /F /IM provisioner.exe
#TaskKill /F /IM Runner.Listener.exe
#TaskKill /F /IM Runner.Worker.exe
#TaskKill /F /IM pwsh.exe
#python D:\a\bookish-octo-dollop\bookish-octo-dollop\chrome.py
#start "PJ" "D:\a\bookish-octo-dollop\bookish-octo-dollop\PJ.exe"
#start "PJ" "C:\Users\runneradmin\Desktop\PJ.exe"
timeout /t 2 /nobreak
