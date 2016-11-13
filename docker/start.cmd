@echo off
echo .....wylaczanie kontenerow Dockera
echo.
@docker-compose down
echo.
echo .....wlaczanie nowych kontenerow Dockera
echo.
@docker-compose up -d
echo.
echo .....proces tworzenia kontenerow przed wykonaniem migracji...
echo.
@timeout 30
echo.
echo .....instalacja migracji
echo.
@docker exec nuta_php7 bash -c "cd /home/www ; php artisan migrate:install"
echo.
echo .....wykonanie migracji
echo.
@docker exec nuta_php7 bash -c "cd /home/www ; php artisan migrate"
echo.
echo .....uruchomienie Supervisord
echo.
@docker exec -d nuta_php7 supervisord
echo.
echo .....proces startowania serwera Laravel Echo...
echo.
@timeout 40
echo.
echo !!! SERWER I APLIKACJA GOTOWE !!!
echo.