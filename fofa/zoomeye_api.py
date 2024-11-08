# coding: utf-8

import re
import math
import logging
import zoomeye.sdk as zoomeye
import datetime

logger = logging.getLogger(__name__)
logger.setLevel(level=logging.INFO)

formatter = logging.Formatter("%(asctime)s - %(filename)s[line:%(lineno)d] - %(levelname)s: %(message)s")

stream_handler = logging.StreamHandler()
stream_handler.setLevel(logging.INFO)
stream_handler.setFormatter(formatter)

logger.addHandler(stream_handler)

# zm = zoomeye.ZoomEye(api_key="")
zm = zoomeye.ZoomEye(api_key='')

# remain_total_quota = zm.resources_info()["quota_info"]["remain_total_quota"]
# logger.debug("ZoomEye total quota remained: %d" % remain_total_quota)
def add_time(query_str, daysago):
    after = datetime.date.today()- datetime.timedelta(days=daysago)
    return query_str + ' +after:"{}"'.format(after)

def zoomeye_search(search_query, time_select=True, max_results_count=100):
    search_query = add_time(search_query, 1) if time_select ==  True else search_query
    logger.info("Query : {}".format(search_query))
    results = []
    try: 
        results = zm.dork_search(search_query, page=1)
        results_count = zm.show_count()
        logger.info("Results count: %d" % results_count)

        if results_count > 20:
            if results_count > max_results_count:
                logger.warning("Max results count: %d" % max_results_count)
                total_pages = math.ceil(max_results_count / 20)
            else:
                total_pages = math.ceil(results_count / 20)
            if total_pages > 1:
                for i in range(2, total_pages + 1):
                    results.extend(zm.dork_search(search_query, page=i))

    except Exception as e:
        logger.error("Error: {}".format(e))
        results = None
        
    return results


def zoomeye_query(search_query):
    results = zoomeye_search(search_query)
    simplified_results = []
    try:
        for result in results:
            # fields = 'host,title,ip,domain,port,country,city,server,as_number,as_organization'
            simplified_result = {}
            simplified_result["host"] = ''
            simplified_result["title"] = result["portinfo"]["title"][0] if result["portinfo"]["title"] else None
            simplified_result["ip"] = result["ip"]
            simplified_result["domain"] = result["portinfo"]["hostname"]
            simplified_result["port"] = result["portinfo"]["port"]
            simplified_result["country"] = result["geoinfo"]["country"]["code"]
            simplified_result["city"] = result["geoinfo"]["city"]["names"]["en"]
            simplified_result["server"] = re.search(r"Server: (.*?)[\\r\n]", result["portinfo"]["banner"]).group(1)
            simplified_result["as_number"] = result["geoinfo"]["asn"]
            simplified_result["as_organization"] = result["geoinfo"]["organization"]
            simplified_result["query_date"] = str(datetime.datetime.strptime(str(result["timestamp"]),'%Y-%m-%dT%H:%M:%S'))
            simplified_result['query'] = search_query
            simplified_result['source'] = 'zoomeye'
            
            simplified_results.append(simplified_result)
    except Exception as e: # key error maybe?
        logger.error("Error: {}".format(e))
        simplified_results = None

    return simplified_results

if __name__ == '__main__':
    search_query = '"mimg.127.net/p/images/favicon.ico" +asn:"54290" +title:"网盘"'
    # results = zoomeye_search(search_query)
    # simplified_results = simplify_results(results)
    print(zoomeye_query(search_query))
