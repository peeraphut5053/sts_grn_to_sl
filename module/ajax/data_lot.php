<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";

if ($action == "NewLot") {
    $Lot = new Lot();
//    $Lot->setConn($conn_sl);
    $ret = "";
    $NewLot = $Lot->GenNewLotNum();
    echo $NewLot;
     sqlsrv_close($conn_sl);
}


