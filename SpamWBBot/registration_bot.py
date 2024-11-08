from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
import httplib2
import urllib.request
import time
from  captha_script import captha_detect
from buy_number import buy_number
from get_status_number import get_status
import datetime
import pickle



def registration(driver,buy_numb=False):
    if buy_numb:
        # покупаем номер
        
        buy_number()



    driver.get("https://kz.wildberries.ru/")
    time.sleep(3)
    
    # Прокрутка до конца вниз
    driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
    
    # кнопка перехода на мобильную версию
    mobile_button = driver.find_element_by_class_name("j-li-go-to-mobile-site")
    mobile_button.click()
    
    # кнопка перехода в личный кабинет
    start = time.time()
    stop = time.time()
    while True:
        if stop - start > 90 :
            break
        try:
            lk_button = driver.find_element_by_class_name("menu-item_profile__PrvZ_")
            lk_button.click()
            break
        except:
            time.sleep(5)
            stop = time.time()
    
    
    time.sleep(10)
    # кнопка зарегестрироваться
    register_button = driver.find_element_by_class_name("button_ripple__2lHyb")
    register_button.click()
    
    time.sleep(15)
    
    # переключаем телефон на российский
    all_phone = driver.find_element_by_class_name("phone-input-select_code__2SBQi")
    all_phone.click()
    
    ru_phone = driver.find_elements_by_class_name("phone-input-select_value__3DhGc")[3] 
    ru_phone.click()
    
    # получаем номер телефона
    file = open("../phone/phone.txt")
    out_file = file.read()
    phone_number = out_file.split("/")[0].split(":")[1][1:]
    
    time.sleep(10)
    
    # вводим номер
    div_phone = driver.find_elements_by_class_name("phone-input-select_number__2rbS-")[0]
    input_phone = div_phone.find_element_by_xpath("//input")
    input_phone.send_keys(phone_number)
    time.sleep(10)
    
    # нажимаем получить код
    give_code = driver.find_element_by_xpath("//button[@data-qa='button-get-push']")
    give_code.click()
    
    time.sleep(4)
    
    # Качаем капчу
    img = driver.find_element_by_xpath('//div[@class="captcha-form_imageBox__2lvVg"]/img')
    src = img.get_attribute('src')
    
    urllib.request.urlretrieve(src,'../captha/captha.jpg')
    
    time.sleep(3)
    
    # детектим капчу
    captha_script = captha_detect()['code']
    
    # вводим капчу
    captha_div = driver.find_element_by_class_name("text-input_input__6HB_U")
    captha_div.send_keys(captha_script)
    
    time.sleep(4)
    
    # нажимаем кнопку подтвердить
    captha_ok = driver.find_elements_by_class_name("button_ripple__2lHyb")[3]
    captha_ok.click()
    
    time.sleep(2)
    
    # вводим код
    
    div_code = driver.find_elements_by_class_name("text-input_textBlock__26O6p")[0]
    input_code = div_code.find_element_by_xpath("//input")
    time.sleep(3)
    
    
    # сравниваем приход кода по дате 
    this_data = datetime.datetime.today()
    
    
    # # проверяем код
    start = time.time()
    stop = time.time()
    while True:
        if stop - start > 90 :
                break
        if get_status()["status"] == 'success':
            if stop - start > 90 :
                break
            stop = time.time()
            date_status = get_status()['values']['0']['date']
            year = int(date_status.split(" ")[0].split("-")[0])
            month = int(date_status.split(" ")[0].split("-")[1])
            day = int(date_status.split(" ")[0].split("-")[2])
            hour = int(date_status.split(" ")[1].split(":")[0])
            minute = int(date_status.split(" ")[1].split(":")[1])
            second = int(date_status.split(" ")[1].split(":")[2])
            date_sms = datetime.datetime(year, month, day,hour,minute,second)
            # print("status success")
            if date_sms > this_data:
                code = get_status()['values']['0']['text'].split(" ")[2].replace(".","")
                # print("code")
                input_code.send_keys("0"+code)
                break
        else:
            time.sleep(5)
            stop = time.time()
    time.sleep(10)
# сохраняем куки
# pickle.dump( driver.get_cookies() , open("cookies.pkl","wb"))


# time.sleep(10)
# пишем сообщение

















