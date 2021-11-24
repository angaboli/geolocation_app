# Geolocation App
This application is created to lists the registered users of the site via their geolocation.

Technical environment
---------------------
Language used for this application is created in PHP/Symfony

How to get started with the project?
---------------------------------
After cloning the project on local, make sure you have installed **PHP**, **Node.js**, **Composer**, **Symfony**.
- To install symfony dependencies by taping in command line `composer install`, after installing all symfony dependencies. 
- Modify .env file and add information about database and email DSN.
- After connecting the database to the app, start tne server by taping `symfony serve -d` in command line.
- Install **webpack encore** dependencies by using `npm install` or `yarn install`, after that you can start encore by taping `yarn encore dev-server`.

Now all things are ready to you can navigate through your navigator on [http://localhost:8000](http://localhost:8000/).