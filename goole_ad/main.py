from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.wait import WebDriverWait
from tkinter import *
from tkinter.ttk import *
from tkinter.filedialog import askopenfilename
import time
import random
from datetime import datetime
import zipfile
##------------------------------------------  Creating Bot-----------------------------------------------------##


def set_proxy_values_and_get_chromedriver(proxy, user_agent=None):

    print("proxy: "+proxy)

    PROXY_HOST = proxy.split(":")[0]
    PROXY_PORT = int(proxy.split(":")[1])
    PROXY_USER = proxy.split(":")[2]
    PROXY_PASS = proxy.split(":")[3]

    manifest_json = """
    {
        "version": "1.0.0",
        "manifest_version": 2,
        "name": "Chrome Proxy",
        "permissions": [
            "proxy",
            "tabs",
            "unlimitedStorage",
            "storage",
            "<all_urls>",
            "webRequest",
            "webRequestBlocking"
        ],
        "background": {
            "scripts": ["background.js"]
        },
        "minimum_chrome_version":"22.0.0"
    }
    """

    background_js = """
    var config = {
            mode: "fixed_servers",
            rules: {
            singleProxy: {
                scheme: "http",
                host: "%s",
                port: parseInt(%s)
            },
            bypassList: ["localhost"]
            }
        };
    chrome.proxy.settings.set({value: config, scope: "regular"}, function() {});
    function callbackFn(details) {
        return {
            authCredentials: {
                username: "%s",
                password: "%s"
            }
        };
    }
    chrome.webRequest.onAuthRequired.addListener(
                callbackFn,
                {urls: ["<all_urls>"]},
                ['blocking']
    );
    """ % (PROXY_HOST, PROXY_PORT, PROXY_USER, PROXY_PASS)

    def get_chromedriver(user_agent=None):
        options = Options()
        options.add_argument("--lang=en-GB")
        options.add_argument("--start-maximized")
        options.add_extension("buster_extension.crx")
        options.add_extension("not_a_bot extension.crx")
        pluginfile = 'proxy_auth_plugin.zip'

        with zipfile.ZipFile(pluginfile, 'w') as zp:
            zp.writestr("manifest.json", manifest_json)
            zp.writestr("background.js", background_js)
        options.add_extension(pluginfile)
        options.add_experimental_option("excludeSwitches", ["enable-automation"])
        options.add_experimental_option('useAutomationExtension', False)
        options.add_argument("--disable-blink-features")
        options.add_argument("--disable-blink-features=AutomationControlled")

        if user_agent:
            options.add_argument('--user-agent=%s' % user_agent)

        driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=options)
        return driver

    return get_chromedriver(user_agent)

report_number = -1

def start():

    for list_entry in main_list:
        try:

            REPORT_TIMES = int(list_entry["No. of reports"])

            for num in range(0, (REPORT_TIMES)):

                global report_number
                report_number += 1

                try:
                    with open(proxy_file_path) as f:
                        proxy_list = f.read().strip().split("\n")

                    driver = set_proxy_values_and_get_chromedriver((proxy_list[report_number % (len(proxy_list))]))

                    with open (email_file_path,mode="r") as email_file:
                        split_email_contents = email_file.read().split(";")
                        chosen_mail_address = random.choice(split_email_contents)

                    with open (text_file_path,mode="r") as text_file:
                        split_text_contents = text_file.read().split(";")
                        chosen_text = random.choice(split_text_contents)

                    EMAIL = chosen_mail_address
                    PROVIDE_ADDITIONAL_DETAILS = chosen_text
                    KEYWORD = list_entry["Keyword"]
                    DOMAIN = list_entry["Domain"]

                    driver.get("http://www.google.com/")
                    ##click on accept cookies##
                    time.sleep(5)
                    WebDriverWait(driver, 60).until(EC.presence_of_element_located((By.XPATH, '/html/body/div[2]/div[2]/div[3]/span/div/div/div/div[3]/div[1]/button[2]/div')))
                    driver.find_element(by=By.XPATH, value='/html/body/div[2]/div[2]/div[3]/span/div/div/div/div[3]/div[1]/button[2]/div').click()

                    ##Search keyword##
                    time.sleep(5)
                    search_button = driver.find_element(By.NAME,"q")
                    search_button.send_keys(KEYWORD)
                    search_button.send_keys(Keys.ENTER)
                    time.sleep(10)

                    ##click on down arrow##
                    def down_arrow_click():
                        path1 = '//*[@id="tads"]/div[1]/div/div/div/div[1]/div/span[3]'
                        WebDriverWait(driver, 60).until(EC.presence_of_element_located((By.XPATH, path1)))
                        driver.find_element(by=By.XPATH, value= path1).click()
                        time.sleep(3)

                    ##click on report ad##
                    def report_ad_click():
                        time.sleep(3)
                        class1 = "WpHeLc"
                        WebDriverWait(driver, 60).until(EC.presence_of_element_located((By.CLASS_NAME, class1)))
                        driver.find_element(By.CLASS_NAME, class1).click()
                        time.sleep(5)

                    ##click on 3rd option##
                    def thrid_option_click():
                        driver.switch_to.window(driver.window_handles[1])
                        time.sleep(10)
                        path2 = '/html/body/div[2]/div/section/div/div[1]/article/section/div/div[2]/div[1]/label[3]/span'
                        WebDriverWait(driver, 60).until(EC.presence_of_element_located((By.XPATH, path2)))
                        driver.find_element(by=By.XPATH, value= path2).click()
                        time.sleep(3)

                    ##Solve Captcha##
                    def Solver():
                        enter_email = driver.find_element(By.NAME, "email_field")
                        action = ActionChains(driver)
                        time.sleep(3)
                        if random_radio_path_index == 0:
                            time.sleep(3)
                            action.move_to_element_with_offset(enter_email, 20, 528).click().perform()
                        else:
                            time.sleep(3)
                            action.move_to_element_with_offset(enter_email, 20, 433).click().perform()

                    ##click on radio button##
                    def radio_button_click():
                        global random_radio_path_index
                        misleading_scam = '/html/body/div[2]/div/section/div/div[1]/article/section/div/div[2]/div[5]/div/div[1]/section/div/div[2]/div[1]/form/div[2]/fieldset/div[1]/div/label/div[1]'
                        violent_abusive_content = '/html/body/div[2]/div/section/div/div[1]/article/section/div/div[2]/div[5]/div/div[1]/section/div/div[2]/div[1]/form/div[2]/fieldset/div[2]/div/label/div[1]'
                        sexually_inappropriate = '/html/body/div[2]/div/section/div/div[1]/article/section/div/div[2]/div[5]/div/div[1]/section/div/div[2]/div[1]/form/div[2]/fieldset/div[3]/div/label/div[1]'
                        illegal_promotion = '/html/body/div[2]/div/section/div/div[1]/article/section/div/div[2]/div[5]/div/div[1]/section/div/div[2]/div[1]/form/div[2]/fieldset/div[4]/div/label/div[1]'

                        radio_buttons_path_list = [misleading_scam,violent_abusive_content,sexually_inappropriate,illegal_promotion]

                        random_radio_path = random.choice(radio_buttons_path_list)
                        random_radio_path_index = radio_buttons_path_list.index(random_radio_path)
                        driver.execute_script("window.scrollTo(0,400)")
                        time.sleep(10)
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
                            time.sleep(3)
                            try:
                                submit_button.click()
                                with open("Final Report.txt", mode="a") as final_report_file:
                                    final_report_file.write(f"Keyword: {KEYWORD}, Domain: {DOMAIN}, Timestamp:{datetime.now()}\n")
                            except:
                                pass
                        else:
                            enter_email = driver.find_element(By.NAME, "email_field")
                            enter_email.send_keys(EMAIL)
                            time.sleep(3)
                            submit_button = driver.find_element(By.CLASS_NAME, "buttons")
                            submit_button.click()
                            Solver()
                            time.sleep(3)
                            try:
                                submit_button.click()
                                with open("Final Report.txt", mode="a") as final_report_file:
                                    final_report_file.write(f"Keyword: {KEYWORD}, Domain: {DOMAIN}, Timestamp:{datetime.now()}\n")
                            except:
                                pass
                                time.sleep(120)

                    random_radio_path_index = 0
                    ads_label = driver.find_elements(By.CLASS_NAME,"CnP9N")
                    sites = driver.find_elements(By.CLASS_NAME,"x2VHCd")
                    index = -1

                    for ad in ads_label:
                        try:
                            if ad.text == "Ad·" or ad.text == "Anzeige·":
                                index += 1
                                if DOMAIN in sites[index].text:
                                    down_arrow_click()
                                    report_ad_click()
                                    thrid_option_click()
                                    radio_button_click()
                                    time.sleep(30)
                                    driver.switch_to.window(driver.window_handles[0])
                        except Exception as e:
                            print("Exception: " + str(e))
                            driver.switch_to.window(driver.window_handles[0])
                            continue
                    driver.close()
                    time.sleep(10)

                except Exception as e:
                    print("Exception: " + str(e))
                    try:
                        driver.close()
                        time.sleep(10)
                    except:
                        continue
        except Exception as e:
            print("Exception: " + str(e))
            try:
                driver.close()
                time.sleep(10)
            except:
                continue
        time.sleep(10)

##----------------------------------------Creating GUI-------------------------------------------------------##

ws = Tk()
ws.title("Browser automation - Google ad reporting")
ws.geometry('653x600')
ws.config(pady=20)
text_file_path = ""
email_file_path = ""
proxy_file_path = ""
files_choosen = 0
main_list = []

def open_text_file():
    global files_choosen
    files_choosen += 1
    global text_file_path
    text_file_path = askopenfilename(filetypes=[('Text Files', '*txt')])
    if text_file_path is not None:
        pass

def open_email_file():
    global files_choosen
    files_choosen += 1
    global email_file_path
    email_file_path = askopenfilename(filetypes=[('Text Files', '*txt')])
    if email_file_path is not None:
        pass

def open_proxy_file():
    global files_choosen
    files_choosen += 1
    global proxy_file_path
    proxy_file_path = askopenfilename(filetypes=[('Text Files', '*txt')])
    if proxy_file_path is not None:
        pass

def uploadFiles():
    global files_choosen
    if files_choosen >= 3:
        pb1 = Progressbar(
            ws,
            orient=HORIZONTAL,
            length=595,
            mode='determinate'
        )
        pb1.grid(row=9, column=0, columnspan=6, pady=5)
        for i in range(3):
            ws.update_idletasks()
            pb1['value'] += 20
            time.sleep(1)
        pb1.destroy()
        Label(ws, text='File Uploaded Successfully!', foreground='green',width=79,justify=CENTER).place(x=270,y=430)
        spilt_textfilepath = text_file_path.split("/")
        text_file_name = spilt_textfilepath[len(spilt_textfilepath)-1]
        spilt_emailfilepath = email_file_path.split("/")
        email_file_name = spilt_emailfilepath[len(spilt_emailfilepath) - 1]
        spilt_proxyfilepath = proxy_file_path.split("/")
        proxy_file_name = spilt_proxyfilepath[len(spilt_proxyfilepath) - 1]
        Label(ws, text=text_file_name, foreground='black').place(x=385,y=304)
        Label(ws, text=email_file_name, foreground='black').place(x=385,y=336)
        Label(ws, text=proxy_file_name, foreground='black').place(x=385, y=368)
    else:
        Label(ws, text='Please upload all files!', foreground='red', width=79, justify=CENTER).place(x=270,y=432)

def add_to_list():
    global keyword_entry
    global domain_entry
    new_dictionary = {}
    keyword_entered = keyword_entry.get().title()
    new_dictionary["Keyword"] = keyword_entered
    domain_entered = domain_entry.get().lower()
    new_dictionary["Domain"] = domain_entered
    reports_entered = reports_entry.get()
    new_dictionary["No. of reports"] = reports_entered
    global main_list
    main_list.append(new_dictionary)
    keyword_entry.delete(0, END)
    domain_entry.delete(0, END)
    global textbox
    textbox.insert(END, f"{new_dictionary}\n")

def delete_list():
    global textbox
    global main_list
    textbox.delete('1.0', END)
    main_list.clear()

keywords_label = Label(text="Enter Keyword: ",anchor="w")
keywords_label.grid(column=0,row=0,pady=3)

keyword_entry = Entry(width=15)
keyword_entry.place(x=135,y=1)
keyword_entry.focus()

domain_label = Label(text="Enter Domain: ")
domain_label.grid(column=2,row=0,pady=3)

domain_entry = Entry(width=15)
domain_entry.place(x=350,y=1)
domain_entry.focus()

reports_label = Label(text="No. of times: ")
reports_label.grid(column=4, row=0, pady=3)

reports_entry = Entry(width=9)
reports_entry.place(x=561,y=1)

Ex_label = Label(text="Domain ex:")
Ex_label.grid(column=2, row=1, pady=3)

Ex2_label = Label(text="nationalexpress.com")
Ex2_label.place(x=342,y=28)

add_button = Button(text="Add",width=98,command=add_to_list)
add_button.grid(column=0,row=2,columnspan=6,padx=25,pady=3)

delete_button = Button(text="Delete All",width=25,command=delete_list)
delete_button.grid(column=4,row=4,padx=25,pady=3,columnspan=2)

textbox = Text(height=11,width=74)
textbox.grid(column=0,row=3,columnspan=6,padx=25,pady=3)

text_upload_label = Label(ws,text='Info file:',justify=LEFT)
text_upload_label.grid(row=5, column=0, padx=10,pady=3)

text_upload_button = Button(ws,text='Choose File',command=lambda: open_text_file(),width= 30)
text_upload_button.grid(row=5, column=1,columnspan=2,pady=3)

email_upload_label = Label(ws,text='Email file:',)
email_upload_label.grid(row=6, column=0,padx=20,pady=3)

email_upload_button = Button(ws,text='Choose File ',command=lambda: open_email_file(),width= 30)
email_upload_button.grid(row=6, column=1,columnspan=2,pady=3)

proxy_upload_label = Label(ws,text='Proxy file:',)
proxy_upload_label.grid(row=7, column=0,padx=20,pady=3)

proxy_upload_button = Button(ws,text='Choose File ',command=lambda: open_proxy_file(),width= 30)
proxy_upload_button.grid(row=7, column=1,columnspan=2,pady=3)

upload_files_button = Button(ws,text='Upload Files',command=uploadFiles,width=98)
upload_files_button.grid(row=8, column=0, columnspan=6,padx=25,pady=3)

start_button = Button(ws,text='Start Automation',command=start,width=98)
start_button.place(x=25, y=458)

ws.mainloop()

time.sleep(500)