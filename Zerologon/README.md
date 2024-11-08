# Zerologon Exploitation


## Objective

The primary aim of the Zerologon Vulnerability (CVE-2020-1472) project was to examine the critical flaw in Microsoft's Netlogon Remote Protocol (MS-NRPC). My goal was to understand how this vulnerability allows attackers to gain administrative access to domain controllers without authentication, thereby compromising the entire Active Directory infrastructure. This project provided me with practical insights into the exploitation and mitigation of high-risk vulnerabilities in network security.

## Skills Learned

- Cryptographic Analysis: Gained an in-depth understanding of AES-CFB8 mode and its vulnerabilities.
- Exploit Development: Developed skills in modifying and executing scripts to exploit the Zerologon vulnerability.
- Network Security: Enhanced knowledge of Active Directory, Netlogon Remote Protocol, and their security mechanisms.
- Research and Documentation: Refined research skills by exploring various vulnerabilities and documenting findings comprehensively.
- Penetration Testing: Enhanced my skills in identifying and exploiting vulnerabilities within network systems.


## Tools Used
- Python Scripts: Utilized for creating exploits and resetting AD passwords.
- Network Scanning Tools: netdiscover and nmap used for reconnaissance and scanning.
- Credential Dumping Tools: secretsdump.py for extracting user credentials.
- Remote Access Tools: wmiexec.py for gaining remote access to domain controllers.
- Logging and Monitoring Tools: wevtutil for clearing event logs and maintaining access.
- Find script for your use at: https://github.com/risksense/zerologon/blob/master/set_empty_pw.py
- Zerologon Whitepaper https://www.secura.com/uploads/whitepapers/Zerologon.pdf


## Steps


### Data Collection and Initial Setup
- System Identification: Targeted a domain controller running Windows Server 2019 with the hostname AD and IP address 192.168.25.10.
- Reconnaissance: Used netdiscover and nmap to identify active hosts and open ports.
### Exploitation
- Exploit Development: Modified scripts (set_empty_pw.py, secretsdump.py, wmiexec.py) to reset passwords, dump credentials, and gain access.
- Access Confirmation: Verified control over the system using commands like systeminfo and net group /domain.
### Maintaining Access
- Persistence: Established persistent access by creating new administrative users and scheduled tasks.
- Clearing Tracks: Used wevtutil to clear event logs and delete temporary files.

  ## Visuals of Zerologon Exploitation
  
### Target System
- Hostame: AD
- Domain Name: PROJECT
- IP address: 192.168.25.10
- OS: Windows 2019 Server

![systemexp](https://github.com/user-attachments/assets/44dabcc3-993d-447a-a35d-d716a6b25a68)

Ref 1: Screenshot Of Target System Info



### Reconnaissance:

![rec](https://github.com/user-attachments/assets/9eed0f38-7819-404b-b5dc-c93358904e46)

![rec2](https://github.com/user-attachments/assets/067668a7-65fb-4dd4-8fea-22185e44fbb9)


### Scanning and Enumeration 

![Scan1](https://github.com/user-attachments/assets/418c19cd-f05d-4cc7-9518-8e39227fbe51)

### Gaining Access

![Gaining access 2](https://github.com/user-attachments/assets/9a008713-2b32-4b4e-b839-78df0af8c2c6)

![Gaining access 3](https://github.com/user-attachments/assets/b8766571-c7d3-4ce0-9502-5ea427effd77)

![Gaining access 4](https://github.com/user-attachments/assets/6a586f76-26f9-43a7-8aea-448ecd356fc3)

### Confirming Access
![confirm access 1](https://github.com/user-attachments/assets/020b68db-04ef-4241-a831-6bc5e62f636e)

![confirm access 2](https://github.com/user-attachments/assets/ed4757e3-8855-4638-acae-d05eabd77631)

![confirm access 3](https://github.com/user-attachments/assets/aa818d68-4371-4628-9acc-a94101ece06b)

![confirm access 4](https://github.com/user-attachments/assets/33bf35f2-d3ff-48ce-b7d8-b22c08990b58)

### Retaining Access

![Retaining access](https://github.com/user-attachments/assets/72ccdcae-2b9e-4490-8fbd-6d7038531f73)

### Clearing the Tracks

![Clearing footprints](https://github.com/user-attachments/assets/cd616a18-ba0a-4db0-99a3-ce9284e4f64c)

### Using Created Backdoor

![confirming backdoor](https://github.com/user-attachments/assets/dff6e775-54c0-4818-8743-a9194738cf65)


