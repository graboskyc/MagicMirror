<?php

function getDBInfo($which='qs')
{
	// connection string: Database=frsh201A4IQco2xd;Data Source=us-cdbr-azure-east-b.cloudapp.net;User Id=bbc9aaf0c6c390;Password=b2b4dd79
	if($which=='qs')
	{
                        $DB = array(
                                "host" => "localhost",
                                "username" => "root",
                                "password" => "gregdavid12",
                                "db" => "airtravel"
			);
	}
	else
	{
			$DB = array(
                                "host" => "us-cdbr-azure-east-b.cloudapp.net",
                                "username" => "bbc9aaf0c6c390",
                                "password" => "b2b4dd79",
                                "db" => "frsh201A4IQco2xd;"
                        );
	}
        return $DB;
}

function connectDB()
{
        $DB = getDBInfo();
        //mysql_connect($DB['host'],$DB['username'],$DB['password']) or die(mysql_error());
	//mysql_select_db($DB['db']) or die (mysql_error());

	$conn = new PDO("mysql:host=".$DB['host'].";dbname=".$DB['db'], $DB['username'], $DB['password']);
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	return $conn;
}

function closeDB()
{
        @mysql_close();
}

?>
