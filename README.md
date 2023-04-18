# TakeHome
Take home assignment for E Capital 

Configuration Steps: 
* start by unzipping/cloning the repository to your root server folder (where you are running Apache or Nginx)
* open a connection to your root MySQL server and please copy and paste the dbConfig.sql into a query wizard on your MySQL client
* please take a moment to make sure the Database 'TakeHome' has been added, as well as the table 'TakeHome' with 4 populated entries
* Next, the project folder has an .htAcess file, that maps url to some project folders for cleanliness; please make sure that file has the chmod 644 permission so you have access locally (i.e $ chmod 644 .htAcess)
* please go to TakeHome/dbcontroller.php and add your local MySql server settings at the top of the class (i.e host, username, password), please leave the database name unchanged
*the dashboard should now be seen from http://localhost/TakeHome/index.php page


