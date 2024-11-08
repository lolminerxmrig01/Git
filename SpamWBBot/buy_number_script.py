from selenium import webdriver
import time


chrome_options = webdriver.ChromeOptions()
chrome_options.add_argument("--incognito")


driver = webdriver.Chrome(chrome_options=chrome_options)


driver.get("https://sms-activate.ru/ru")
cookies = [{'name':'PHPSESSID','value':"2h9lc7rs0r6t3hj3lq2n04ahei"},
          {'name':'userid','value':"1441886"},
          {'name':'session','value':"d6b3ffd5ebc6270a31a3cca10b172f2f"}]


for cookie in cookies: 
    driver.add_cookie(cookie)
    
driver.get(f"https://sms-activate.ru/ru")


search_input = driver.find_element_by_id("servicesSearch").send_keys("wild")

driver.execute_script("window.scrollTo(0, 50);")
time.sleep(2)

driver.find_element_by_id('count_uu_0').click()

driver.execute_script("window.scrollTo(0, 50);")


