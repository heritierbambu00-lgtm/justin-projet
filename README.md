# Gestion du centre de santé

Application PHP avec base de données MySQL.

## Installation

1. Créez une base de données MySQL.
2. Importez `database.sql` dans cette base. Le script recrée ses tables et ne
   contient pas de comptes ni de dossiers patients préremplis.
3. Configurez les variables d'environnement `DB_HOST`, `DB_NAME`, `DB_USER` et
   `DB_PASS` dans l'environnement du serveur PHP. `.env.example` donne un
   exemple de configuration locale ; le projet ne charge pas automatiquement
   les fichiers `.env`.
4. Lancez le projet depuis un serveur PHP configuré avec ces variables.

Les identifiants des utilisateurs doivent être créés dans la base de données
avant la première connexion.
