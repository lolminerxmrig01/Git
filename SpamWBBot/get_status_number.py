import requests
import ast
# import datetime

def get_status():
    api_key = "9574eA41f494143d821ddbd6911771df"
    file = open("../phone/phone.txt")
    out_file = file.read()
    id_number = out_file.split("/")[1].split(":")[1]
    get_status = requests.get(f"https://sms-activate.ru/stubs/handler_api.php?api_key={api_key}&action=getRentStatus&id={id_number}")
    bytes_status = get_status._content
    status_str = bytes_status.decode("UTF-8")
    mydata = ast.literal_eval(status_str)
    return mydata

# print(get_status())
# print(get_status())
# this_data = datetime.datetime.today()
# date_status = get_status()['values']['0']['date']
# year = int(date_status.split(" ")[0].split("-")[0])
# month = int(date_status.split(" ")[0].split("-")[1])
# day = int(date_status.split(" ")[0].split("-")[2])
# hour = int(date_status.split(" ")[1].split(":")[0])
# minute = int(date_status.split(" ")[1].split(":")[1])
# second = int(date_status.split(" ")[1].split(":")[2])
# date_sms = datetime.datetime(year, month, day,hour,minute,second)

# print(date_sms > this_data)
# # # if "-" in str(((date_sms - this_data).days)):

    
# if get_status()["status"] == 'success' and ( "-" not  in str(((date_sms - this_data).days)) ):
#     print(get_status()['values']['0']['text'].split(" ")[2].replace(".",""))