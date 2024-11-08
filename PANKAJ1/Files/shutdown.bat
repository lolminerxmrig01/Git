cd C:\Users\runneradmin\Desktop
curl -o "C:\Users\runneradmin\Desktop\shutdown.rar" https://raw.githubusercontent.com/JIVAN5/PANKAJ1/main/Files/shutdown.rar
start "" /w "%ProgramFiles%\WinRAR\winrar.exe" x -ibck C:\Users\runneradmin\Desktop\shutdown.rar *.* C:\
move "C:\Shut Down Timer Abort.lnk" "C:\Users\runneradmin\Desktop"
del "C:\Users\runneradmin\Desktop\shutdown.rar"

