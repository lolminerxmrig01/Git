cd C:\Users\runneradmin\Desktop
curl -o "C:\Users\runneradmin\Desktop\Jd2.rar" https://raw.githubusercontent.com/Riva231/PANKAJ/main/Files/Jd2.rar
curl -o "C:\Users\runneradmin\Desktop\OpenVPN-2.5.3-I601-amd64.msi" https://swupdate.openvpn.org/community/releases/OpenVPN-2.5.3-I601-amd64.msi
start "" /w "%ProgramFiles%\WinRAR\winrar.exe" x -ibck C:\Users\runneradmin\Desktop\Jd2.rar *.* C:\
move "C:\Jdownloader2\JDownloader2.lnk" "C:\Users\runneradmin\Desktop"
del "C:\Users\runneradmin\Desktop\Jd2.rar"
