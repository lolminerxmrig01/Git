# ConnectWise ScreenConnect: Authentication Bypass

## Introduction
This project aims to exploit an authentication bypass vulnerability in ConnectWise ScreenConnect. It provides a script to demonstrate the exploit. Please ensure you have the necessary permissions before attempting to use this script.

## Usage

```bash
python exploit.py [options]
```

### Options:
- `--username`: Username to add (**Required**).
- `--password`: Password to add (**Required**).
- `--urls`: Path to the file containing URLs.
- `--url`: Run only on this URL.

Note: Either `--urls` or `--url` is required.

## Example
```bash
python exploit.py --username admin --password p@ssw0rd --urls urls.txt
python exploit.py --username admin --password p@ssw0rd --url 'http://127.0.0.1/'
```

## Disclaimer
This project is for educational purposes only. Use it at your own risk. The authors do not take any responsibility for its misuse.
