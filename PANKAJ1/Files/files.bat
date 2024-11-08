@echo off
PowerShell -NoProfile -ExecutionPolicy Bypass -Command "& {Start-Process PowerShell -ArgumentList '-NoProfile -ExecutionPolicy Bypass -File ""D:\a\lionspj\lionspj\download.ps1""' -Verb RunAs}" 
