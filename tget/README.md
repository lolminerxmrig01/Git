# tget

fofa zoomeye shodan censys 目标采集器

# how to use

1.download

```bash
git clone https://github.com/lolminerxmrig/tget/ && cd tget
python3 -m pip install -r requirements.txt
```

2.写`config/__init__.py`配置文件

3.search语句

```bash

# zoomeye
python3 tget.py zoomeye -d "iconhash:-1250474341" -v --limit 10 --type host -o result.txt
```
