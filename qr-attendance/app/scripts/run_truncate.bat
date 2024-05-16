@echo off
REM Get current time
for /f "tokens=1 delims=:" %%H in ("%time%") do set /a "current_hour=%%H"

REM Check if it's midnight (00:00)
if %current_hour% equ 0 (
    REM Echo message into index file
    echo "Good morning! It's a new day." >> C:/xampp/htdocs/WEBA-FINALS-PROJECT-BSIS3D/qr-attendance/app/views/home
)