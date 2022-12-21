<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
$toDay = date('Y-m-d');
$Last30Days = date('Y-m-d', strtotime('-30 days', strtotime($toDay)));
//$td = "16/12/1984" ; 
//$testdate = substr($td,6,10)."-".substr($td,3,2)."-".substr($td,0,2)  ;
$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", "Lists");
$temp->setReplace("{content}", $temp->getTemplate("./template/load_wl_to_grn.html"));
$temp->setReplace("{StartDate}", $Last30Days);
$temp->setReplace("{EndDate}", $toDay);
//$temp->setReplace("{EndDate}", $testdate);
// $temp->setReplace("{ConSlVal}", $conn_sl);
