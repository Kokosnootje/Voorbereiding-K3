# TCR Kerntaak 3

## Inleiding
TCR Kerntaak 3 2018

Download the git installation

Setup an own database (name, user and password)
Edit the file in /lib/DatabaseSettings.php
add the name/user/password

Open the database in an application of your choice (phpmyadmin/ sequel pro or e.d.)
Open the file /sql/database_init.sql 
copy and paste the information into the database to have a first set ready.

Point your webserver/ programm to the /public/index.php file and check if things work.

## Basic usage
### Routing
The application does not have a web.php or routing file. Routing is done thru the URL with 2 GET-variables:
* page=<Controller-name>
    * Specifying a page searches for that name in the controllers folder as controller
    * So page=user will execture/ fire up the UserController.php in /controllers
* action=[method_name]
    * If this variable of method is not there it will search for an index method in the controller specified in the above variabel

``` c
    http://kerntaak3.tcr.mncr.nl/?page=user&action=edit&id=1
```
This will trigger the UserController and the edit function. You can add other variables which you can use with the PHP ```$_GET['id']``` command.

## Special functions
In the /lib/ folder there is a helper_functions.php file, there are 3 handy-dandy functions for you to use.
* ```Old($post_data, $variable)```
    * This function works just like Laravels old functions. It checks if the PHP _POST variable exists. If it does, it will return that variable, if not it will return the second variable

* ```StoreMessage(['status', 'message'])``` (Mind the array)
    * Stores a PHP ```_SESSION['messages']['status']``` variable. This variable is emptied every connection, but can be used for danger/success messages (and more if you code it in)
    * An example can be found in the UserController/ store method and in the views/layouts/header.phtml file.
* ```Redirect($url, $permanent)```
    * This will redirect the application to the chosen URL. If you set ```$permanent``` to true (default false) then it mark the redirect permanent (Google/ SEO working)
* ```Back()```
    * The back function will go back to the previous page (as specified in the PHP ```$_SERVER['HTTP_REFERER']``` variable. If the current call is a POST/PUT or DELETE method then it will also store the _POST variable data in a session variable. In the next call (so on the redirected page) this data is put back into the _POST variable.

## Folder information
* /controllers
    * This folder contains all the Controllers of the system. 
* /lib
    * This folder contains helper and Database class files
* /model
    * This folder contains the models (references to database tables)
* /public
    * This folder holds all publicly accessable files (index.php, images, css, js, etc.)
* /sql
    * Do not touch this folder, it holds the initial mysql-database file

/views
This folder holds the layout files (rendered with mustache)

## Notice to all who use this
### This software is for educational purpose only, do not use it in anyway in a live environment for it is not safe!
This software was written by me (Michiel Auerbach) for the use of the students of the Techniek College Rotterdam (TCR)
to study/ learn for their exams. This software has limited to zero security checks or in anyway is safe to
use in any environment other then running on your own laptop/ SOHO location without direct internet access to the
software application. 

