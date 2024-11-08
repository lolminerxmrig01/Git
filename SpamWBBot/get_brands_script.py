from selenium import webdriver
from registration_bot import registration
from send_message import send_message
import pandas as pd
import time


chrome_options = webdriver.ChromeOptions()
# Режим инкогнито
chrome_options.add_argument("--incognito")

driver = webdriver.Chrome(chrome_options=chrome_options)
# Размер браузера
driver.set_window_size(500, 750)

registration(driver,buy_numb=False)


time.sleep(5)
# читаем бренды
df_brands = pd.read_csv("brands_test.csv",sep=";")

brands = df_brands[df_brands["was_in"] != 1]["brand"]

for brand in brands:
    # поиск бренда
    brand_name = brand
    URL  = f"https://www.wildberries.ru/catalog/0/search.aspx?xfilters=xsubject%3Bdlvr%3Bbrand%3Bprice%3Bkind%3Bcolor%3Bwbsize%3Bseason%3Bconsists&xparams=brand%3D178036&xshard=brands%2Fm&sort=popular&search={brand_name}"
    driver.execute_script(f"window.open('{URL}');")
    driver.switch_to.window(driver.window_handles[1])
    time.sleep(5)
    # заходим на первый товар
    div_card = driver.find_elements_by_class_name("catalog-product-card_rewrite__1g7eW")
    div_card[0].click()
    time.sleep(10)
    try:    
        send_message(driver)
    except:
        pass
    # записываем что зашли на этот бренд
    a = df_brands[df_brands["brand"] == brand_name]
    ind = int(a.index[0])
    df_brands.loc[ind,"was_in"] = 1
    df_brands.to_csv("brands_test.csv",sep=";",index=None)
    
    time.sleep(10)
    # закрываем вкладку
    driver.close()
    driver.switch_to.window(driver.window_handles[0])
    time.sleep(3)






