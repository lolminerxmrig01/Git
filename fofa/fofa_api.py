import requests
import time
import json
import traceback
import datetime
import logging
import base64
import re

session = requests.session()
# 请求头
headers = {
    'Upgrade-Insecure-Requests': '1',
    'User-Agent':'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36'
}
'''
请求中心，控制程序所有HTTP请求，如果请求发生错误进行尝试再次连接
@param url 请求连接
@return 请求响应结果
'''
def fofa_requests(url):
    # print(url)
    rs_content = ''
    count = 3
    while count != 0:
        try:
            rs = session.get(url, verify=False,headers=headers)
            rs_text = rs.text
            results = json.loads(rs_text)
            print(results)
            total_size = results['size']
            error = results
            if results['error'] and 'None' not in results['error']:
                info = u'fofa 错误:'+results['error']+u' 休眠10s'
                logging.error(info)
                time.sleep(10)
                count += -1
            else:
                rs_content = results
                break
            
        except Exception as e:
            # logging.error(u'fofa 错误:'+str(e.message)+u' 休眠10s')
            traceback.print_exc()
            time.sleep(10)
            count += -1
    return rs_content


def parse_result(fields, results, query, source):
    list_result = []
    list_fields = str(fields).split(',')
    len_fields = len(list_fields)
    for result in results:
        dic_row = {}
        for index in range(len_fields):
            dic_row[list_fields[index]] = result[index]
        dic_row['query_date'] =  re.search("\r\nDate: (.*?)\r\n", dic_row["header"]).group(1)
        dic_row['query_date'] = str(datetime.datetime.strptime(dic_row['query_date'], '%a, %d %b %Y %H:%M:%S GMT'))
        dic_row['query'] = query
        dic_row['source'] = source
        if "header" in dic_row.keys():
            del dic_row["header"]
        list_result.append(dic_row) 
        
    return list_result
        
'''
@param fofa_sql fofa查询语句
'''
def fofa_query(rule, time_select=True):
    query_str = add_time(rule, 1) if time_select ==  True else rule
    print(query_str)
    list_result = []
    # 参数定义
    #email = ''
    email = ''
    # key = ''
    key = ''
    qbase64 = base64.b64encode(query_str.encode('utf-8')).decode('utf-8')
    fields = 'host,title,ip,domain,port,country,city,header,server,as_number,as_organization'
    page = 1
    size=100
    api_url = 'http://fofa.so/api/v1/search/all?email={}&key={}&fields={}&page={}&size={}&qbase64={}&full=true'.format(email,key,fields,page,size,qbase64)
    
    # 获取第一次结果
    rs = fofa_requests(api_url)
    if rs == '':
        list_result
    total_size = rs['size']

    # 计算页数
    page_end = total_size / size + 1 if total_size > size else page

    # 获取结果
    list_result.extend(parse_result(fields, rs['results'], rule, 'fofa'))
    for page_no in range(page + 1 ,int(page_end)+1):
        api_url = 'http://fofa.so/api/v1/search/all?email=.com&key={}&fields={}&page={}&size={}&qbase64={}&full=true'.format(email,key,fields,page_no,size,qbase64)
        rs = fofa_requests(api_url)
        list_result.extend(parse_result(fields, rs['results'], rule, 'fofa'))
    
    return list_result


def add_time(query_str, daysago):
    after = datetime.date.today()- datetime.timedelta(days=daysago)
    return query_str + ' && after="{}"'.format(after)

if __name__ == '__main__':
    print(fofa_query('fid="G6XS9/fV1xXt51WgFSVkzA=="', False))
