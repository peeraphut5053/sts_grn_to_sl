<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";
$Head = new BoatNoteHead();
$Head->setConn($conn);
$Head->_HeadCode = $HeadCode ;

$List = new BoatNoteList();
$List->setConn($conn);
$List->_HeadCode = $HeadCode ;


if($Type=='Delete'){
    $Head->delete();
    $List->deleteWithHeader();
}else{
    $Head->_Cancel = $Cancel ; 
    $Head->updateStatus();
}

//echo $rs0 ;

