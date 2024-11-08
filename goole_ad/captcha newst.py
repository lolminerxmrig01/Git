from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.keys import Keys
import time
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.wait import WebDriverWait
import random
import os
from tkinter import *
from tkinter.ttk import *
from tkinter.filedialog import askopenfilename
import sys
import os
from twocaptcha import TwoCaptcha
from solveRecaptcha import solveRecaptcha
import requests, time

#os.popen('"C:\Program Files (x86)\Google\Chrome\Application\chrome.exe" --remote-debugging-port=9222 --user-data-dir="C:\localhost"')

options = Options()
#options.add_experimental_option("debuggerAddress","localhost:9222")
options.add_argument("--lang=en-GB")
options.add_argument("--start-maximized")

EMAIL = "dinithi.cima@gmail.com"
PROVIDE_ADDITIONAL_DETAILS = "NA"
KEYWORD = "semrush"
driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()),options=options)
driver.get("https://support.google.com/ads/troubleshooter/4578507?ai=DChcSEwiQ8fivxsn5AhVyGgYAHUhiAVAYABABGgJ3cw&hl=en_AE&visit_id=637961874928777913-3938102381&rd=1#ts=6006595")

API_KEY = "538d23d6ae5e1054f6256dbc36558528"
data_sitekey = "6LcN-4saAAAAAGOz10SCh-KHThAjGiUum6B9HVft"
# data_sitekey = '6LdZHQYTAAAAAFnofYfPjNlXpxWAqTwfLh9d0zL2'
page_url ="https://support.google.com/ads/troubleshooter/4578507?ai=DChcSEwiQ8fivxsn5AhVyGgYAHUhiAVAYABABGgJ3cw&hl=en_AE&visit_id=637961874928777913-3938102381&rd=1#ts=6006595"


def Solver():
    global API_KEY
    global data_sitekey
    global page_url
    url = f'http://2captcha.com/in.php?key={API_KEY}&method=userrecaptcha&googlekey={data_sitekey}&pageurl={page_url}'
    response = requests.get(url)
    print(response.text)
    captcha_id = response.text[3:]
    print(captcha_id)

    token_url = f"http://2captcha.com/res.php?key={API_KEY}&action=get&id={captcha_id}"

    while True:
        time.sleep(10)
        resp = requests.get(token_url)
        print(resp.text)
        if resp.text[0:2] == 'OK':
            print(resp.text)
            print(resp.text[3:])
            break

    captcha_results = resp.text[3:]
    paste = f'value="{captcha_results}"'
    print("recaptcha-token")
    print(paste)

    #text_areas = driver.find_elements(By.CLASS_NAME, 'g-recaptcha-response')

    driver.execute_script(f'document.getElementByXpath("/html/body/input").innerHTML = \'value="{captcha_results}"\'')
    #driver.execute_script(f'document.getElementById("g-recaptcha-response").innerHTML = \'value\'="{captcha_results}"')

    # text_area1 = driver.find_element(By.ID,'g-recaptcha-response')
    # driver.execute_script("arguments[0].style.display = 'block';", text_area1)
    #text_area2 = driver.find_element(By.XPATH,'//*[@id="g-recaptcha-response-1"]')
    #driver.execute_script("arguments[0].style.display = 'block';", text_area2)


    #driver.execute_script('document.getElementById("g-recaptcha-response")[0].removeAttribute("display: none")')
    #driver.execute_script('document.getElementById("g-recaptcha-response-1")[0].removeAttribute("display: none")')

def radio_button_click():
    misleading_scam = '/html/body/div[2]/div/section/div/div[1]/article/section/div/div[2]/div[5]/div/div[1]/section/div/div[2]/div[1]/form/div[2]/fieldset/div[1]/div/label/div[1]'
    violent_abusive_content = '/html/body/div[2]/div/section/div/div[1]/article/section/div/div[2]/div[5]/div/div[1]/section/div/div[2]/div[1]/form/div[2]/fieldset/div[2]/div/label/div[1]'
    sexually_inappropriate = '/html/body/div[2]/div/section/div/div[1]/article/section/div/div[2]/div[5]/div/div[1]/section/div/div[2]/div[1]/form/div[2]/fieldset/div[3]/div/label/div[1]'
    illegal_promotion = '/html/body/div[2]/div/section/div/div[1]/article/section/div/div[2]/div[5]/div/div[1]/section/div/div[2]/div[1]/form/div[2]/fieldset/div[4]/div/label/div[1]'

    radio_buttons_path_list = [misleading_scam, violent_abusive_content, sexually_inappropriate, illegal_promotion]

    random_radio_path = random.choice(radio_buttons_path_list)
    random_radio_path_index = radio_buttons_path_list.index(random_radio_path)
    driver.execute_script("window.scrollTo(0,400)")
    time.sleep(3)
    WebDriverWait(driver, 15).until(EC.presence_of_element_located((By.XPATH, random_radio_path)))
    clickable_radio_button = driver.find_element(by=By.XPATH, value=random_radio_path)
    driver.execute_script("arguments[0].click();", clickable_radio_button)
    time.sleep(3)

    if random_radio_path_index == 0:
        enter_email = driver.find_element(By.NAME, "email_field")
        enter_email.send_keys(EMAIL)
        time.sleep(3)
        additional_details = driver.find_element(By.NAME, "comments_mandetory")
        additional_details.send_keys(PROVIDE_ADDITIONAL_DETAILS)
        time.sleep(3)
        submit_button = driver.find_element(By.CLASS_NAME, "buttons")
        submit_button.click()
        Solver()
        submit_button = driver.find_element(By.CLASS_NAME, "buttons")
        submit_button.click()
    else:
        enter_email = driver.find_element(By.NAME, "email_field")
        enter_email.send_keys(EMAIL)
        time.sleep(3)
        submit_button = driver.find_element(By.CLASS_NAME, "buttons")
        submit_button.click()
        Solver()
        submit_button = driver.find_element(By.CLASS_NAME, "buttons")
        submit_button.click()

radio_button_click()