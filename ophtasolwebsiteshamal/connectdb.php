
<?php

   
        $servername = 'localhost';
		$dbname    = 'u381546397_ophtasol';
        $dbuser    = 'u381546397_bestun';
	    $dbpass    = 'el@F77B@stun';
    $dbh = new PDO("mysql:host=localhost;dbname=".$dbname, $dbuser , $dbpass, 
	array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 



?>