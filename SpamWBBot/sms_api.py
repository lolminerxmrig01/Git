import requests

token = 'eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2NjA5OTA0MjUsImlhdCI6MTYyOTQ1NDQyNSwicmF5IjoiZTM5MzhmMGU4YjcxNzliNjdjNGJjOWU3ZGI1Mjc2ZTgiLCJzdWIiOjcxNDIxNH0.hx8CqfSYsEy1Ti0iEW1vwOOqKKQBG6XDYBVCHjzCVFJ5su4wd2WK4R1zm26wuv8tEr9aSNMYsE6mnQ3nbJLujyz0x3ukVpr2JsoFZcXZ7G9L81Untb_ytpo03PavHvDczr2y53L__iRpNztdXyXMqfKpzH6_jxImQiK2Ig-aj0Oy8lqTzvxm4X9yauQ2xzOuqUwa-f3HPMa0Z-4yfTczD9XAXiJ_5SmXKcAWegPn8KON9z-H5_3CGjDWIyLAR00PDJzV4h5veEqEOwb1lV63F0vM_ABL1O93Aq8YGrLYetV2aXkbe1eaOberCynqqXG58nOjZPynJZg0pRNgdntrTw'

country = 'belarus'
operator = 'any'
product = 'wildberries'

headers = {
    'Authorization': 'Bearer ' + token,
    'Accept': 'application/json',
}

response = requests.get('https://5sim.net/v1/user/buy/activation/' + country + '/' + operator + '/' + product, headers=headers)