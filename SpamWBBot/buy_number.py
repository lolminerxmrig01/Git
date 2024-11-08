import requests
import ast

def buy_number():
    api_key = "9574eA41f494143d821ddbd6911771df"
    service = "uu"
    buy = requests.get(f'https://sms-activate.ru/stubs/handler_api.php?api_key={api_key}&action=getRentNumber&service={service}')
    bytes_buy = buy._content
    dict_str = bytes_buy.decode("UTF-8")
    mydata = ast.literal_eval(dict_str)
    number = mydata['phone']['number']
    id_number = int(mydata['phone']['id'])
    
    with open("../phone/phone.txt","w") as file:
        file.write(f"number:{number}/id:{id_number}")




