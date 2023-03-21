rem path to mysql server bin folder
cd "C:\xampp\mysql\bin"

rem credentials to connect to mysql server
set mysql_user=root
set mysql_password=

rem backup file name generation
set backup_path=C:\xampp\htdocs\pdv\backup_db
set backup_name=bd_pdv_bkp_16032023

rem backup creation
mysqldump --user=%mysql_user% --password=%mysql_password% --all-databases --routines --events --result-file="%backup_path%\%backup_name%.sql"
if %ERRORLEVEL% neq 0 (
    (echo Backup failed: error during dump creation) >> "%backup_path%\mysql_backup_log.txt"
) else (echo Backup successful) >> "%backup_path%\mysql_backup_log.txt"