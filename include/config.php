<?php
ini_set('memory_limit', '1024M'); //3024

/*****************************************************
		                  Path Settings
*****************************************************/


/*****************************************************
		                  SQL Settings
*****************************************************/
//$var['mssql_local']['host'] 		= 'DESKTOP-G014JUJ\LOCAL';
//$var['mssql_local']['user']	 	= 'sa';
//$var['mssql_local']['pass'] 		= 'sa';
//$var['mssql_local']['db'] 		= 'sts_proboat';


//================ AIT ==================//
//
//
//================ STS==================//
$var['mssql_sl']['host'] 		= 'sts-sldb';
$var['mssql_sl']['user']	 	= 'sa';
$var['mssql_sl']['pass'] 		= 'Sts@2017';
$var['mssql_sl']['db_sl']		= 'Live_App';
//================ AIT ==================//
//================ AIT ==================//
//$var['mssql_sl']['host'] 		= 'svr-db';
//$var['mssql_sl']['user']	 	= 'sa';
//$var['mssql_sl']['pass'] 		= 'Ait!234';
//$var['mssql_sl']['db_sl']		= 'Train6_AppDemo';
//================ AIT ==================//

//$var['mssql_sl']['db']			= 'STS_WebApp';
//$var['mssql_sl']['db_sl']             = 'Train1_AppDemo';
//$var['mssql_sl']['db_tag']            = 'Train1_AppDemo';
$var['mssql_sl']['db']			= 'Live_App';
$var['mssql_sl']['db_tag']		= 'Live_App';

$var['mysql']['host'] 		= '172.18.1.193';
$var['mysql']['user']	 	= 'root3';
$var['mysql']['pass'] 		= '1234';
$var['mysql']['db'] 		= 'milltest';

/*****************************************************
		               Default Settings
*****************************************************/
date_default_timezone_set("Asia/Bangkok");
$tolerances_weight = 10 //����� %
?>
