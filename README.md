 * @package PHPmongoDB
 * @version 1.0.0
 * @link http://www.phpmongodb.org
==============================================================================================================
 Introduction
==============================================================================================================
 A Tool available for administrative work of MongoDB over Web. It is PHPmongoDB. Available here link.
 For any support and suggestions, You can write us to phpmongodb@gmail.com. Freely available!!! 

==============================================================================================================
Installation
==============================================================================================================
1. Install PHP Webserver like APACHE, NGINX, HTTPD if you don't have one
2. Install MongoDB PHP driver (http://us.php.net/manual/en/mongo.installation.php)
3. Download the package from https://github.com/phpmongodb/phpmongodb or git clone https://github.com/phpmongodb/phpmongodb.git
4. Unzip the files where you want to Run your Project.
5. Open the config.php with your editor, change host, port, admins and so on As per your system. Default given below:
   -Server Setting
     'name' => "Localhost",
     'server'=>false,
     'host' => "127.0.0.1",
     'port'=>"27017",
     'timeout'=>0,
   - Make authentication = TRUE for using your MongoDB user and password.
   - Make authorization['readonly'] = TRUE for making your MongoDb readonly.
6. Visit the index.php in your browser, for example: http://localhost/phpmongodb
7. Login with admin username and password, which is set "admin" and "admin" as default
8. Start Playing with your MongoDBs!

==============================================================================================================
Upgradation 
==============================================================================================================
1.Copy all files excluding config.php to your old version directory
2.Done!

For any help, suggesstions Please submit your Queries to : phpmongodb@gmail.com,nanhe.kumar@gmail.com
