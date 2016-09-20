<?php

function getDBInfo($which='qs')
{
	if($which=='qs')
	{
                        $DB = array(
                                "host" => "localhost",
                                "username" => "root",
                                "password" => "gregdavid12",
                                "db" => "airtravel"
			);
	}
        return $DB;
}

function connectDB()
{
        $DB = getDBInfo();

	$conn = new PDO("mysql:host=".$DB['host'].";dbname=".$DB['db'], $DB['username'], $DB['password']);
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	return $conn;
}

function closeDB()
{
        @mysql_close();
}

?>
