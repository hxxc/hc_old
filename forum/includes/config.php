<?php
$config['Database']['dbtype'] = 'mysql';
$config['Database']['dbname'] = 'raulooo_huahvb';
$config['Database']['tableprefix'] = '';
$config['Database']['technicalemail'] = 'dbmaster@example.com';
$config['Database']['force_sql_mode'] = false;
$config['MasterServer']['servername'] = 'localhost';
$config['MasterServer']['port'] = 3306;
$config['MasterServer']['username'] = 'raulooo_appuser';
$config['MasterServer']['password'] = 'appuserpwd';
$config['MasterServer']['usepconnect'] = 0;
$config['SlaveServer']['servername'] = '';
$config['SlaveServer']['port'] = 3306;
$config['SlaveServer']['username'] = '';
$config['SlaveServer']['password'] = '';
$config['SlaveServer']['usepconnect'] = 0;
$config['Misc']['admincpdir'] = 'admincp';
$config['Misc']['modcpdir'] = 'modcp';
$config['Misc']['cookieprefix'] = 'bb';
$config['Misc']['forumpath'] = '';
$config['Misc']['cookie_security_hash'] = '';
$config['SpecialUsers']['canviewadminlog'] = '1';
$config['SpecialUsers']['canpruneadminlog'] = '1';
$config['SpecialUsers']['canrunqueries'] = '';
$config['SpecialUsers']['undeletableusers'] = '';
$config['SpecialUsers']['superadministrators'] = '1';
// $config['Datastore']['class'] = 'vB_Datastore_Filecache';
/*
$config['Datastore']['class'] = 'vB_Datastore_Memcached';
$i = 0;
// First Server
$i++;
$config['Misc']['memcacheserver'][$i]		= '127.0.0.1';
$config['Misc']['memcacheport'][$i]			= 11211;
$config['Misc']['memcachepersistent'][$i]	= true;
$config['Misc']['memcacheweight'][$i]		= 1;
$config['Misc']['memcachetimeout'][$i]		= 1;
$config['Misc']['memcacheretry_interval'][$i] = 15;
*/
// ****** The following options are only needed in special cases ******

	//	****** MySQLI OPTIONS *****
	// When using MySQL 4.1+, MySQLi should be used to connect to the database.
	// If you need to set the default connection charset because your database
	// is using a charset other than latin1, you can set the charset here.
	// If you don't set the charset to be the same as your database, you
	// may receive collation errors.  Ignore this setting unless you
	// are sure you need to use it.
// $config['Mysqli']['charset'] = 'utf8';

	//	Optionally, PHP can be instructed to set connection parameters by reading from the
	//	file named in 'ini_file'. Please use a full path to the file.
	//	Example:
	//	$config['Mysqli']['ini_file'] = 'c:\program files\MySQL\MySQL Server 4.1\my.ini';
$config['Mysqli']['ini_file'] = '';

// Image Processing Options
	// Images that exceed either dimension below will not be resized by vBulletin. If you need to resize larger images, alter these settings.
$config['Misc']['maxwidth'] = 2592;
$config['Misc']['maxheight'] = 1944;
?>