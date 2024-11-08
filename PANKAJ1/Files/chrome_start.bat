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

 #taskkill /F /IM "PJSCREEN.exe">nul 2>&1
#taskkill /F /IM "chrome.exe">nul 2>&1
#python D:\a\bookish-octo-dollop\bookish-octo-dollop\chrome.py
set ChromeDataDir=%appdata%\Local\Google\Chrome\User Data\Default
set ChromeCache=%ChromeDataDir%\Cache>nul 2>&1  
del /q /s /f "%ChromeCache%\*.*">nul 2>&1    
del /q /s /f "%ChromeDataDir%\*Cookies*.*">nul 2>&1    
del /q /s /f "%ChromeDataDir%\*History*.*">nul 2>&1  
  

set chromedata=C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data

del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-001\Cache\* ">nul 2>&1  
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-002\Cache\*.* ">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-003\Cache\*.* ">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-004\Cache\*.* ">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-005\Cache\*.* ">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-006\Cache\*.* ">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-007\Cache\*.* ">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-008\Cache\*.* ">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-009\Cache\*.* ">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-010\Cache\*.* ">nul 2>&1   

del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-001\*History*.*">nul 2>&1    
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-002\*History*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-003\*History*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-004\*History*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-005\*History*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-006\*History*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-007\*History*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-008\*History*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-009\*History*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-010\*History*.*">nul 2>&1   

del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-001\*Cookies*.*">nul 2>&1    
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-002\*Cookies*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-003\*Cookies*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-004\*Cookies*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-005\*Cookies*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-006\*Cookies*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-007\*Cookies*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-008\*Cookies*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-009\*Cookies*.*">nul 2>&1   
del /q /s /f "C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data\HENG_Chrome-010\*Cookies*.*">nul 2>&1   

timeout /t 2 /nobreak
set CHROME1="C:\Users\runneradmin\Desktop\Chrome-001.lnk"
set CHROME2="C:\Users\runneradmin\Desktop\Chrome-002.lnk"
set CHROME3="C:\Users\runneradmin\Desktop\Chrome-003.lnk"
set CHROME4="C:\Users\runneradmin\Desktop\Chrome-004.lnk"
set CHROME5="C:\Users\runneradmin\Desktop\Chrome-005.lnk"
set CHROME6="C:\Users\runneradmin\Desktop\Chrome-006.lnk"
set CHROME7="C:\Users\runneradmin\Desktop\Chrome-007.lnk"
set CHROME8="C:\Users\runneradmin\Desktop\Chrome-008.lnk"
set CHROME9="C:\Users\runneradmin\Desktop\Chrome-009.lnk"
set CHROME10="C:\Users\runneradmin\Desktop\Chrome-010.lnk"

set COMMON1=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-001" --window-size=500,500 --window-position=1400,90 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system  
set COMMON2=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-002" --window-size=500,500 --window-position=600,90 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system  
set COMMON3=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-003" --window-size=500,500 --window-position=100,90 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system   
set COMMON4=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-004" --window-size=500,500 --window-position=1400,500 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system 
set COMMON5=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-005" --window-size=500,500 --window-position=600,500 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system 
set COMMON6=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-006" --window-size=500,500 --window-position=100,500 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system 
set COMMON7=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-007" --window-size=500,500 --window-position=800,250 --no-first-run --disable-plugins --disable-default-apps --disable-extensions --disable-notifications --disable-file-system  


start "Chrome-001" %CHROME1% %COMMON1%  --disable-extensions --disable-notifications --disable-file-system
timeout /t 7 /nobreak
start "Chrome-001" %CHROME1% %COMMON1%  https://www.youtube.com/watch?v=h_LitQX8O_I&list=TLGGaJZ8haMJ_asyNjA7MjAyMg&t=0s&loop=0
timeout /t 7 /nobreak
start "Chrome-002" %CHROME2% %COMMON2%  --disable-extensions --disable-notifications --disable-file-system
timeout /t 7 /nobreak
start "Chrome-002" %CHROME2% %COMMON2%  https://www.youtube.com/watch?v=-dw8nhuVXIU&list=TLGGvpfeAjTV9AMyNjA7MjAyMg&t=0s&loop=0
timeout /t 7 /nobreak
start "Chrome-003" %CHROME3% %COMMON3%  --disable-extensions --disable-notifications --disable-file-system
timeout /t 7 /nobreak
start "Chrome-003" %CHROME3% %COMMON3%  https://www.youtube.com/watch?v=oESB8EB3ynA&list=TLGGmRLXxVtVJqwyNjA4MjAyMg&t=0s&loop=0
timeout /t 7 /nobreak
start "Chrome-004" %CHROME4% %COMMON4%  --disable-extensions --disable-notifications --disable-file-system
timeout /t 7 /nobreak
start "Chrome-004" %CHROME4% %COMMON4%  https://www.youtube.com/watch?v=s9TUoTiGfa4&list=TLGGynG23MynxEYyNjA4MjAyMg&t=0s&loop=0
timeout /t 7 /nobreak
start "Chrome-005" %CHROME5% %COMMON5%  --disable-extensions --disable-notifications --disable-file-system
timeout /t 7 /nobreak
start "Chrome-005" %CHROME5% %COMMON5%  https://www.youtube.com/watch?v=pF2Chs2yzEw&list=TLGGynG23MynxEYyNjA4MjAyMg
timeout /t 7 /nobreak
start "Chrome-006" %CHROME6% %COMMON6%  --disable-extensions --disable-notifications --disable-file-system
timeout /t 7 /nobreak
start "Chrome-006" %CHROME6% %COMMON6%  https://www.youtube.com/watch?v=66pGTdiRUyg&list=TLGGynG27MynxEYyNjA7MjAyMg&t=0s&loop=0
timeout /t 7 /nobreak
start "Chrome-007" %CHROME7% %COMMON7%  --disable-extensions --disable-notifications --disable-file-system
timeout /t 7 /nobreak
start "Chrome-007" %CHROME7% %COMMON7%  https://www.youtube.com/watch?v=TPPQz6YQBqc&list=TLGGynG27MynxEYyNjA7MjAyMg&t=0s&loop=0
timeout /t 7 /nobreak




#timeout /t 5 /nobreak
#TaskKill /F /IM provisioner.exe
#TaskKill /F /IM Runner.Listener.exe
#TaskKill /F /IM Runner.Worker.exe
#TaskKill /F /IM pwsh.exe
#python D:\a\bookish-octo-dollop\bookish-octo-dollop\chrome.py
#start "PJ" "D:\a\bookish-octo-dollop\bookish-octo-dollop\PJ.exe"
#start "PJ" "C:\Users\runneradmin\Desktop\PJ.exe"
timeout /t 2 /nobreak
