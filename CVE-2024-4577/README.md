# CVE-2024-4577: PHP CGI Argument Injection (XAMPP) 💀

## Features ✨

- Multi-threaded scanning
- Single URL or bulk URL checks from a file
- Interactive exploitation shell

## Installation 💻

Get started by cloning the repository and installing dependencies:

```bash
git clone https://github.com/Chocapikk/CVE-2024-4577.git
cd CVE-2024-4577
pip install -r requirements.txt
```

## Usage 🔑

Run CVE-2024-4577 with these examples:

```bash
# Test a single URL
python exploit.py --url "http://example.com/"

# Test multiple URLs from a file
python exploit.py --file urls.txt

# Save vulnerable URLs
python exploit.py --file urls.txt --output vulnerable_urls.txt
```

https://en.fofa.info/result?qbase64=aWNvbl9oYXNoPSItMTI3NTIyNjgxNCI%3D
