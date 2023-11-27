@ECHO OFF
@REM Imprimimos la ruta actual
echo %cd%
cd \xampp\htdocs\InsBC - M7\M7_UF2_AA2-CryptoWeb
php artisan migrate:refresh --seed
PAUSE