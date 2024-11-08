
 #taskkill /F /IM "PJSCREEN.exe">nul 2>&1
#taskkill /F /IM "chrome.exe">nul 2>&1
#python D:\a\bookish-octo-dollop\bookish-octo-dollop\chrome.py
set ChromeDataDir=%appdata%\Local\Google\Chrome\User Data\Default
set ChromeCache=%ChromeDataDir%\Cache>nul 2>&1  
del /q /s /f "%ChromeCache%\*.*">nul 2>&1    
del /q /s /f "%ChromeDataDir%\*Cookies*.*">nul 2>&1    
del /q /s /f "%ChromeDataDir%\*History*.*">nul 2>&1  
  

set chromedata=C:\Users\runneradmin\AppData\Local\Google\Chrome\User Data

del /q /s /f "%chromedata%\HENG_Chrome-001\Cache\* ">nul 2>&1  
del /q /s /f "%chromedata%\HENG_Chrome-002\Cache\*.* ">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-003\Cache\*.* ">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-004\Cache\*.* ">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-005\Cache\*.* ">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-006\Cache\*.* ">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-007\Cache\*.* ">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-008\Cache\*.* ">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-009\Cache\*.* ">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-010\Cache\*.* ">nul 2>&1   

del /q /s /f "%chromedata%\HENG_Chrome-001\*History*.*">nul 2>&1    
del /q /s /f "%chromedata%\HENG_Chrome-002\*History*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-003\*History*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-004\*History*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-005\*History*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-006\*History*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-007\*History*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-008\*History*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-009\*History*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-010\*History*.*">nul 2>&1   

del /q /s /f "%chromedata%\HENG_Chrome-001\*Cookies*.*">nul 2>&1    
del /q /s /f "%chromedata%\HENG_Chrome-002\*Cookies*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-003\*Cookies*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-004\*Cookies*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-005\*Cookies*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-006\*Cookies*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-007\*Cookies*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-008\*Cookies*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-009\*Cookies*.*">nul 2>&1   
del /q /s /f "%chromedata%\HENG_Chrome-010\*Cookies*.*">nul 2>&1   






