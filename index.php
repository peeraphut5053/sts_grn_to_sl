<?php
include "./initial.php";

$temp = new ReplaceHtml("./template/tmp_main.html");
$temp->setReplace("{datebar}", date("d/m/Y"));
$uri = explode("?",trim($_SERVER['REQUEST_URI']));
if (!empty($uri[1])) {
	if ($uri[1]{0} == "/") {
		header("Location: .".$uri[1]."?".$uri[2]);
	}
	$uri_p = explode("&", trim($uri[1]));

	if (is_file("./module/".$uri_p[0].".php")) {
		include "./module/".$uri_p[0].".php";
	} else {
		include "./module/error.php";
	}
} else {
//	include "module/home.php";
    //$content =  file_get_html('http://www.google.com/'); ;
$content =file_get_contents('template/home.html') ;
    $temp->setReplace("{content}", $content);
}

echo $temp->getReplace();
sqlsrv_close($conn_sl);
?>
