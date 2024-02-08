# A lire attentivement avant de démarrer la mission
## Elements en PJ

Vous trouverez en pj 2 éléments :

- Un cahier des charges "Cahier des charges - Test technique - mission 0.pdf"
- Une clef SSH pour vous connecter au serveur

## Environnement de déploiements
### Le serveur

Un serveur de déploiements a été mis à disposition (Ubuntu 2204, apache2, PHP8, postgres12, composer et symfony-cli). 

L'ip du serveur est communiquée dans le mail avec l'objet **"mission0"**.

Vous devez vous connecter la manière suivante :

```sh
chmod 400 mission-0.pem
ssh -i mission-0.pem ubuntu@{ip-serveur}
```

### Configuration

- Le vhost apache2 pointe par défaut vers le dossier /var/www/mission0/
- La configuration d’accès à la base de données se trouve dans le fichier /var/www/.env.local
- Seuls les ports 22 (ssh), 80 (apache) et 5432 (postgre) sont ouverts.

## Procédure de déploiements

Pour déployer votre projet, vous pouvez :

- Soit remplacer le dossier /var/www/mission0/ avec votre projet
- Soit modifier le ficher de configuration apache2 /etc/apache2/sites-available/default.conf

Pour développer, vous pouvez donc travailler :

- Soit localement puis déployer par git ou copie de fichiers sur le serveur
- Soit développer directement sur l'instance de déploiments avec un plugin comme Remote-SSH Visual Studio Code


## Important

- **Cette instance sera supprimée à la fin du test.**
- Si vous avez un point de blocage merci de le faire remonter.



