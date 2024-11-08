@echo off
del /f "C:\Users\Public\Desktop\Epic Games Launcher.lnk" > out.txt 2>&1
net config server /srvcomment:"Windows Azure VM" > out.txt 2>&1
REG ADD "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Explorer" /V EnableAutoTray /T REG_DWORD /D 0 /F > out.txt 2>&1
REG ADD HKLM\SYSTEM\CurrentControlSet\Control\ComputerName\ComputerName /v ComputerName /t REG_SZ /d PJRDP /f
REG ADD HKLM\SYSTEM\CurrentControlSet\Control\ComputerName\ActiveComputerName\ /v ComputerName /t REG_SZ /d DJRDP /f
REG ADD HKLM\SYSTEM\CurrentControlSet\Services\Tcpip\Parameters\ /v Hostname /t REG_SZ /d PJRDP /f
REG ADD HKLM\SYSTEM\CurrentControlSet\Services\Tcpip\Parameters\ /v "AD Host" /t REG_SZ /d PJRDP /f
REG ADD HKLM\SOFTWARE\Microsoft\Windows\CurrentVersion\OEMInformation /v Manufacturer /t REG_SZ /d "DJ" /f
REG ADD HKLM\SOFTWARE\Microsoft\Windows\CurrentVersion\OEMInformation /v Model /t REG_SZ /d "PJ Virtual Machine" /f
REG ADD "HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\Explorer\Advanced" /v TaskbarSmallIcons /t REG_DWORD /d 1 /f
REG ADD "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Run" /f /v Wallpaper /t REG_SZ /d D:\a\wallpaper.bat
REG ADD "HKLM\Software\Microsoft\Windows\CurrentVersion\Run" /f /v AutoRun /t REG_SZ /d D:\a\wallpaper.bat >nul
net user runneradmin RDPPJBY@100
net localgroup administrators runneradmin /add >nul
net user runneradmin /active:yes >nul
net user installer /delete
echo All done! Connect your VM using RDP. When RDP expired and VM shutdown, Re-run jobs to get a new RDP.
echo IP AVAILBLE TELEGRAM GROUP MUST JION FREE RDP #https://t.me/FREERDPBYPJ
echo User: runneradmin
echo Pass: RDPPJBY@100
curl -O https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/DisablePasswordComplexity.ps1 > out.txt 2>&1
#curl -o "C:\Users\Public\Desktop\Fast Config VPS.exe" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/FastConfigVPS_v5.1.exe > out.txt 2>&1
#curl -o "C:\Users\Public\Desktop\Everything.exe" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/Everything.exe > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\Windows-User.bat" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/Windows-User.bat > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\videos.html" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos.html > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\videos1.html" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos1.html > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\videos2.html" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos2.html > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\videos3.html" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos3.html > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\videos4.html" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos4.html > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\videos5.html" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos5.html > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\videos6.html" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos6.html > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\videos7.html" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos7.html > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\reg.bat" https://raw.githubusercontent.com/JIVAN5//PANKAJ1/main/Files/reg.bat  > out.txt 2>&1
curl -o "C:\Users\Public\Desktop\reg.ps1" https://raw.githubusercontent.com/JIVAN5//PANKAJ1/main/Files/reg.ps1  > out.txt 2>&1
cd C:\Users\runneradmin\Desktop
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5//PANKAJ1/main/Files/reg.bat -OutFile reg.bat}"
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5//PANKAJ1/main/Files/reg.ps1 -OutFile reg.ps1}"
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos.html -OutFile videos.html}"
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos1.html -OutFile videos1.html}"
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos2.html -OutFile videos2.html}"
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos3.html -OutFile videos3.html}"
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos4.html -OutFile videos4.html}"
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos5.html -OutFile videos5.html}"
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos6.html -OutFile videos6.html}"
powershell -Command "& {Invoke-WebRequest https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/videos7.html -OutFile videos7.html}"
PowerShell -NoProfile -ExecutionPolicy Bypass -Command "& './DisablePasswordComplexity.ps1'" > out.txt 2>&1
PowerShell -NoProfile -ExecutionPolicy Bypass -Command "& {Start-Process PowerShell -ArgumentList '-NoProfile -ExecutionPolicy Bypass -File ""C:\Users\Public\Desktop\reg.ps1""' -Verb RunAs}"
diskperf -Y >nul
sc start audiosrv >nul
sc config Audiosrv start= auto >nul
ICACLS C:\Windows\Temp /grant runneradmin:F >nul
ICACLS C:\Windows\installer /grant runneradmin:F >nul
#start msedge -inprivate "https://drive.google.com/uc?id=1vPiG4dvswjfPQ3tWI1sLy0IQIBMCtcJx&export=download&confirm=eb569842-c282-434f-a311-ad0e76e696bc"
#powershell -Command "& {start msedge -inprivate "https://drive.google.com/uc?id=1vPiG4dvswjfPQ3tWI1sLy0IQIBMCtcJx&export=download&confirm=eb569842-c282-434f-a311-ad0e76e696bc"}"
#powershell -Command "& {Invoke-WebRequest https://drive.google.com/uc?id=1IaZosGYaMFYc6IITpCIaZeu-fF0FApgJ -OutFile files.zip; Expand-Archive files.zip}"
#timeout /t 35 /nobreak
#move "C:\Users\%USERNAME%\Downloads\files.zip" "D:\a\lionspj\lionspj\"
#powershell -Command "Invoke-WebRequest https://drive.google.com/uc?export=download&confirm=359d98b2-0fa8-44b0-a9dc-22b5f1de2e48&id=1dZ156St6QBGaLnY0ZAC7WCBbPse2k-4E -Outfile files.zip"
#PowerShell -NoProfile -ExecutionPolicy Bypass -Command "& {Start-Process PowerShell -ArgumentList '-NoProfile -ExecutionPolicy Bypass -File ""D:\a\lionspj\lionspj\download.ps1""' -Verb RunAs}"
timeout /t 20 /nobreak
ping -n 10 127.0.0.1 >nul
