@echo off
start http://127.0.0.1/asahi/mail/mail.php

timeout /t 20

taskkill /f /im QQBrowser.exe

exit