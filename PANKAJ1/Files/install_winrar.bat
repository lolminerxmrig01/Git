:: cmd /c ""C:\Program Files (x86)\Microsoft Visual Studio\Installer\resources\app\layout\InstallCleanup.exe" -f"
cd C:\Users\runneradmin\Desktop
curl -o "C:\Users\runneradmin\Desktop\winrar-x64-602.exe" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/winrar-x64-602.exe
curl -o "C:\Users\runneradmin\Desktop\rarreg.key" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/rarreg.key
echo Installing WinRAR
start "" /w "C:\Users\runneradmin\Desktop\winrar-x64-602.exe" /s
move "C:\Users\runneradmin\Desktop\rarreg.key" "C:\Program Files\WinRAR"
del "C:\Users\runneradmin\Desktop\winrar-x64-602.exe"
