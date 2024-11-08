@echo off
cd C:\Users\runneradmin\Desktop

goto check1
:check1
set CHROME="%ProgramFiles%\Google\Chrome\Application\chrome.exe"
set COMMON=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-001" --window-size=500,500 --window-position=1400,100 
set COMMON1=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-002" --window-size=500,500 --window-position=1000,90 
set COMMON2=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-003" --window-size=500,500 --window-position=600,300  
set COMMON3=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-004" --window-size=500,500 --window-position=700,400  
set COMMON4=--user-data-dir="%appdata%\Local\Google\Chrome\User Data\HENG_Chrome-005" --window-size=500,500 --window-position=200,500 

start "" %CHROME% %COMMON% file:///C:/Users/Public/Desktop/videos.html
timeout /t 5 /nobreak
start "" %CHROME% %COMMON% https://www.youtube.com/watch?v=h_LitQX8O_I&list=TLGGaJZ8haMJ_asyNjA4MjAyMg&t=1s
timeout /t 5 /nobreak
start "" %CHROME% %COMMON1% file:///C:/Users/Public/Desktop/videos1.html
timeout /t 6 /nobreak
start "" %CHROME% %COMMON1% https://www.youtube.com/watch?v=-dw8nhuVXIU&list=TLGGvpfeAjTV9AMyNjA4MjAyMg&t=1s
timeout /t 5 /nobreak
start "" %CHROME% %COMMON3% file:///C:/Users/Public/Desktop/videos3.html
timeout /t 6 /nobreak
start "" %CHROME% %COMMON3% https://www.youtube.com/watch?v=oESB8EB3ynA&list=TLGGmRLXxVtVJqwyNjA4MjAyMg&t=1s
timeout /t 5 /nobreak
start "" %CHROME% %COMMON4% file:///C:/Users/Public/Desktop/videos4.html
timeout /t 6 /nobreak
start "" %CHROME% %COMMON4% https://www.youtube.com/watch?v=s9TUoTiGfa4&list=TLGGynG23MynxEYyNjA4MjAyMg&t=1s

goto check2
:check2
tasklist | find /i "ngrok.exe" >Nul && goto check || echo "Unable to get the NGROK tunnel, make sure the NGROK_AUTH_TOKEN is correct in Settings> Secrets> Repository secret. Maybe your previous VM is still running: https://dashboard.ngrok.com/status/tunnels" & ping 127.0.0.1 >Nul & exit
:check3

ping 127.0.0.1 > nul
cls
goto check3
