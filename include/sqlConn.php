<?php
ini_set('display_errors', 1);
error_reporting(~0);

//$conn_mysql= mysqli_connect($var['mysql']['host'],$var['mysql']['user'], $var['mysql']['password'], $var['mysql']['db']);
$MySqlHost = $var['mysql']['host'] ;
$MySqlUser = $var['mysql']['user'] ;
$MySqlPass= $var['mysql']['pass'] ;
$MySqlDB = $var['mysql']['db'] ;
//
//$localHost = $var['mssql_local']['host'];
//$localUserName = $var['mssql_local']['user'];
//$localUserPass =  $var['mssql_local']['pass'];
//$localDB =  $var['mssql_local']['db'];
//
$slHost = $var['mssql_sl']['host'];
$slUsername  =$var['mssql_sl']['user'];
$slUserPass = $var['mssql_sl']['pass'];
$slDB = $var['mssql_sl']['db_sl'];
//
$dbName_tag = $var['mssql_sl']['db_tag'];

//$connectionInfo = array("Database"=>$localDB, "UID"=>$localUserName, "PWD"=>$localUserPass, "MultipleActiveResultSets"=>true, "CharacterSet"  => 'utf-8');
$connectionInfo_sl = array("Database"=>$slDB, "UID"=>$slUsername, "PWD"=>$slUserPass, "MultipleActiveResultSets"=>true, "CharacterSet"  => 'utf-8');
$connectionInfo_tag = array("Database"=>$dbName_tag, "UID"=>$slUsername, "PWD"=>$slUserPass, "MultipleActiveResultSets"=>true, "CharacterSet"  => 'utf-8');
//$conn = sqlsrv_connect( $localHost, $connectionInfo);
$conn_sl = sqlsrv_connect( $slHost, $connectionInfo_sl);
$conn_tag = sqlsrv_connect( $slHost, $connectionInfo_tag);
//if(!$conn){
	//echo "<pre>";
//	die( print_r( sqlsrv_errors(), true));
//}
if(!$conn_sl){
	echo "<pre>";
	die( print_r( sqlsrv_errors(), true));
}

?>
