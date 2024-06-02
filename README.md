# E-Student

Création d’un outil support à la gestion par parcours étudiants dans un cursus universitaire à base de majeures/mineures.

## Installation et mise en place du projet

Ce projet requiert Docker et Docker Compose. Vous pouvez ensuite lancer le projet facilement avec la commande :

```bash
./launch.sh
# Ou avec PowerShell ./launch.bat
```

### Composants du projet

Les différents composants du projet se lancent sur les adresses suivantes :

| Composant | Adresse |
| --- | --- |
| Serveur web | [localhost:8080](http://localhost:8080) |
| PgAdmin4 | [localhost:5050](http://localhost:5050) |
| Maildev | [localhost:1080](http://localhost:1080) |

### Arrêter le projet

Exécutez la commande `docker-compose down`.

### Connexion à PgAdmin4

Pour se connecter à PgAdmin4, vous pouvez utiliser les identifiants suivants :

- Email : `admin@admin.com`
- Mot de passe : `root`

Cliquez sur Servers dans le menu à gauche, une popup s'affichera la première fois. Entrez le mot de passe `root` et cocher **Save Password**. Vous aurez ensuite accès à la base de données `app`.

