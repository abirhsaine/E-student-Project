# Installation des dépendances Composer
docker run --rm --interactive --tty --volume $PWD/php:/app composer install

# Installation des dépendances Node.js et construction
docker run --rm --interactive --tty -w="/app" --volume $PWD/php:/app node:18-alpine3.14 sh -c "npm install && npm run build"

# Lancement du projet
docker-compose up -d