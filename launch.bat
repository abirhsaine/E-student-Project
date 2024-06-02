:: %~dp0 = Chemin vers le dossier qui contient ce script
:: Installation des dépendances Composer
docker run --rm --interactive --tty --volume %~dp0/php:/app composer install

:: Installation des dépendances Node.js et construction
docker run --rm --interactive --tty -w="/app" --volume %~dp0/php:/app node:18-alpine3.14 sh -c "npm install && npm run build"

:: Lancement du projet
docker-compose up -d