@echo off
REM Script Windows pour générer toute la documentation Swagger
REM Nom du fichier: scripts/generate-docs.bat
REM Utilisation: scripts\generate-docs.bat

echo 🚀 Generation de la documentation Swagger pour tous les microservices...
echo ==================================================

REM Liste des services
set SERVICES=user-service transaction-service wallet-service notification-service

set SUCCESS_COUNT=0
set FAILED_COUNT=0

for %%s in (%SERVICES%) do (
    echo.
    echo 📝 Generation de la documentation pour %%s...
    
    REM Verifier si le conteneur existe
    docker ps --format "table {{.Names}}" | findstr /C:"%%s" >nul
    if %errorlevel% equ 0 (
        REM Generer la documentation
        docker exec %%s php artisan l5-swagger:generate
        if %errorlevel% equ 0 (
            echo ✅ Documentation generee avec succes pour %%s
            set /a SUCCESS_COUNT+=1
        ) else (
            echo ❌ Erreur lors de la generation pour %%s
            set /a FAILED_COUNT+=1
        )
    ) else (
        echo ❌ Conteneur %%s non trouve ou non demarre
        set /a FAILED_COUNT+=1
    )
)

echo.
echo ==================================================
echo 📊 RAPPORT FINAL
echo ==================================================
echo ✅ Services reussis: %SUCCESS_COUNT%
echo ❌ Services echoues: %FAILED_COUNT%

echo.
echo 🎯 Pour verifier manuellement les endpoints:
echo    curl http://localhost:8001/api/documentation.json
echo    curl http://localhost:8002/api/documentation.json
echo    curl http://localhost:8003/api/documentation.json
echo    curl http://localhost:8004/api/documentation.json

echo.
echo 🌐 Documentation unifiee disponible sur:
echo    http://localhost:8000/docs

echo.
echo 🔄 Refresh du cache de documentation du gateway...
curl -X POST http://localhost:8000/docs/refresh 2>nul
if %errorlevel% equ 0 (
    echo ✅ Cache du gateway rafraichi
) else (
    echo ⚠️  Impossible de rafraichir le cache du gateway
)

echo.
echo 🚀 Generation terminee !
pause