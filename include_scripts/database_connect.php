<?php

	@$db = mysql_connect('localhost','root','');
		
		if(!$db){
			echo "ERROR: Could not connect to database. Please try again later.";
			exit;
		}
	

	$db_selected = mysql_select_db('megashop', $db);
		if (!$db_selected){
        echo "Cannot connect to the database.";
        exit;
		}

?>