from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time



def send_message(driver):
    messages = pd.read_csv("messages.csv")

    message = messages[messages['was_in'] == 0 ].loc[1,'text']
    ind = int(message.index[0])

    driver.execute_script("window.scrollTo(0, 2000);")
    
    time.sleep(10)
    # нажимаем на вопрос
    div_questions = driver.find_element_by_xpath("//div[@data-qa='questions-tab']")
    div_questions.click()
    time.sleep(3)
    
    count_questions = div_questions.text
    if count_questions == "Вопросы (0)":
        # нажимаем кнопку отправить сообщение
        div_send = driver.find_elements_by_class_name("button_ripple__2lHyb")[0]
        div_send.click()
        
        time.sleep(30)
        # вводим сообщение
        div_message = driver.find_element_by_class_name("text-input_textBlock__26O6p")
        input_message = div_message.find_element_by_xpath("//textarea")
        input_message.send_keys(message)
        
        time.sleep(2)
        # отправляем сообщение
        button_send = driver.find_element_by_class_name("button_root__fl6-7")
        button_send.click()
        
        time.sleep(5)
        
    elif count_questions == "Вопросы (1)":
        # driver.execute_script("window.scrollTo(2000, 2150);")
        # нажимаем кнопку отправить сообщение
        div_send = driver.find_elements_by_class_name("button_ripple__2lHyb")[1]
        div_send.click()
        
        time.sleep(30)
        # вводим сообщение
        div_message = driver.find_element_by_class_name("text-input_textBlock__26O6p")
        input_message = div_message.find_element_by_xpath("//textarea")
        input_message.send_keys(message)
        
        time.sleep(2)
        # отправляем сообщение
        button_send = driver.find_element_by_class_name("button_root__fl6-7")
        button_send.click()
        
        time.sleep(5)
        
    elif count_questions == "Вопросы (2)":
        driver.execute_script("window.scrollTo(2000, 2150);")
        # нажимаем кнопку отправить сообщение
        div_send = driver.find_elements_by_class_name("button_ripple__2lHyb")[1]
        div_send.click()
        
        time.sleep(30)
        # вводим сообщение
        div_message = driver.find_element_by_class_name("text-input_textBlock__26O6p")
        input_message = div_message.find_element_by_xpath("//textarea")
        input_message.send_keys(message)
        
        time.sleep(2)
        # отправляем сообщение
        button_send = driver.find_element_by_class_name("button_root__fl6-7")
        button_send.click()
        
        time.sleep(5)
    else:
        driver.execute_script("window.scrollTo(2000, 2200);")
        # нажимаем кнопку отправить сообщение
        div_send = driver.find_elements_by_class_name("button_ripple__2lHyb")[1]
        div_send.click()
        
        time.sleep(20)
        # вводим сообщение
        div_message = driver.find_element_by_class_name("text-input_textBlock__26O6p")
        input_message = div_message.find_element_by_xpath("//textarea")
        input_message.send_keys(message)
        
        time.sleep(2)
        # отправляем сообщение
        button_send = driver.find_element_by_class_name("button_root__fl6-7")
        button_send.click()
        
        time.sleep(5)

    messages.loc[ind,"was_in"] = 1
    messages.to_csv("messages.csv",index=None)


