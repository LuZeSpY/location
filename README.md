Application de gestion locative pour évaluation STUDI Graduate Bachelor Developpeur d'application web
-- Développée sous le framework Symfony avec en BDD PostgreSQL.

Accès au Trello de gestion de projet : https://trello.com/invite/b/GZz39skP/ATTIcc5c1a11e49cf0ab8312c5522a87c92670729BF0/projet-infeco

Deploy the application in local environment :
1. Do git clone https://github.com/LuZeSpY/location.git 
2. Do cd/my-project or cd/location
3. Run composer install in order to install the project's dependencies into vendor/
4. Run npm install and run npm run build
4. Run symfony server:start to display the application on http://localhost:8000/

You'll need to setup the DB config.
The Application runs with PGSQL.
In order to have the save database as mine, you'll need to download the database.sql (available in the file) then restore your PostgreSQL application with this file.
