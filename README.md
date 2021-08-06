# Gridlock 
---

> Gridlock is an open source, fully python ransomware PoC for Windows supported with C2 server in laravel. It is meant for educational purposes and not to be used for illegal purposes.


## Features

- Communication/Exfiltration of key back to C2.
- AES Encryption & RSA Encryption
- Added ransomware note pop up & Background Image change
- Ransom Payment Handling & Decryption from C2 server

## Installation

Gridlock requires [Python](https://python.org/) 3+, It hasn't been tested on python 2+.

Install  python dependencies.

```sh
pip install -r requirements.txt
```

## Standalone Executable
With Pyinstaller Only
```sh
pip3 install pyinstaller
pyinstaller -w -F --add-data hackedyou.jpg;. gridlock.py
```
Add Obfuscation with Pyarmor
```sh
pip3 install pyarmor
pyarmor pack -e "-w -F -add-data hackedyou.jpg;." gridlock.py
```

> Note: You can add an icon to executable using `-i icon.ico`

> Pyinstaller documentation can be found here [Documentation](https://pyinstaller.readthedocs.io/en/stable/)


## C2 Server

Setup [Lamp server](https://linuxhint.com/install-lamp-stack-ubuntu/) , composer

```sh
cd gridlock
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

> This project is solely meant for educational purposes.I take no reponsibility of any misuse or misconduct. If in any case suspect abuse i will take down the project at any time.

**Gridlock was named after a villain in Flash Season 5.**


