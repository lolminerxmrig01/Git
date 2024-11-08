# coding: utf-8

import math
import shodan
import logging
from datetime import datetime

logger = logging.getLogger(__name__)
logger.setLevel(level=logging.DEBUG)

formatter = logging.Formatter("%(asctime)s - %(filename)s[line:%(lineno)d] - %(levelname)s: %(message)s")

stream_handler = logging.StreamHandler()
stream_handler.setLevel(logging.DEBUG)
stream_handler.setFormatter(formatter)

logger.addHandler(stream_handler)

SHODAN_API_KEY = "eV1r2h3IrCfPKtQ7CiXsjEuxE5aGlQTH"
api = shodan.Shodan(SHODAN_API_KEY)

def shodan_search(search_query, max_results_count=100):
    results = []
    try:
        logger.info("Searching Shodan with query: %s" % search_query)
        results = api.search(search_query)
        results_count = results["total"]
        results = results["matches"]
        logger.info("Results count: {}".format(results_count))
        
        if results_count > 100:
            if results_count > max_results_count:
                logger.warning("Max results count reached: %d" % max_results_count)
                total_pages = math.ceil(max_results_count / 100)
            else:
                total_pages = math.ceil(results_count / 100)
            if total_pages > 1:
                for i in range(2, total_pages + 1):
                    results.extend(api.search(search_query, page=i)["matches"])

    except Exception as e:
        logger.error("Error: {}".format(e))
        return None

    return results


def shodan_query(search_query):
    results = shodan_search(search_query)
    formatted_results = []
    try:
        for result in results:
            formatted_result = {}
            formatted_result["host"] = result["http"]["host"] if "http" in result.keys() else None
            formatted_result["title"] = result["http"]["title"] if "http" in result.keys() else None
            formatted_result["ip"] = result["ip_str"]
            formatted_result["domain"] = result["domains"][0] if result["domains"] else None
            formatted_result["port"] = result["port"]
            formatted_result["country"] = result["location"]["country_code"]
            formatted_result["city"] = result["location"]["city"]
            formatted_result["server"] = result["http"]["server"] if "http" in result.keys() else None
            formatted_result["as_number"] = result["asn"][2:]
            formatted_result["as_organization"] = result["isp"]
            formatted_result["query_date"] = str(datetime.strptime(result["timestamp"][:-7], "%Y-%m-%dT%H:%M:%S"))
            formatted_result["query"] = search_query
            formatted_result["source"] = "shodan"
            
            formatted_results.append(formatted_result)

    except Exception as e: # key error maybe?
        logger.error("Error: {}".format(e))
        formatted_results = None

    return formatted_results


