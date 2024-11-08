import sys
import os
from twocaptcha import TwoCaptcha

def captha_detect():
    api_key = os.getenv('APIKEY_2CAPTCHA', 'c3ecc2e47fba702208b6bb0b241a7dfe')
    
    solver = TwoCaptcha(api_key)
    
    try:
        result = solver.normal(r'../captha/captha.jpg')
        return result
    
    except Exception as e:
        return sys.exit(e)
    
    else:
        sys.exit('solved: ' + str(result))
        return result