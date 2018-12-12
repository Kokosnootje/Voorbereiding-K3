# TCR Kerntaak 3

TCR Kerntaak 3 2018

Download the git installation

Setup an own database (name, user and password)
Edit the file in /lib/DatabaseSettings.php
add the name/user/password

Open the database in an application of your choice (phpmyadmin/ sequel pro or e.d.)
Open the file /sql/database_init.sql 
copy and paste the information into the database to have a first set ready.

Point your webserver/ programm to the /public/index.php file and check if things work.

# Folder and information
/controllers
This folder contains all the Controllers of the system. 

/lib
This folder contains helper and Database class files

/model
This folder contains the models (references to database tables)

/mustache
Do not touch this folder, it is an external library for layout/setup. 

/public
This folder holds all publicly accessable files (index.php, images, css, js, etc.)

/sql
Do not touch this folder, it holds the initial mysql-database file

/views
This folder holds the layout files (rendered with mustache)


