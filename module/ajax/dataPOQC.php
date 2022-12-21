<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";
//
$po_QC = new PO_QC();
$po_QC->setConn($var);
$ret = "";
$GetTable = $po_QC->Ajax_GetRowsWithDate($startDate, $endDate, $status, $filterRefNo,$filterStsNo,$searchType);
$arrReturn = array();
$btnPrintTag="";
echo json_encode($GetTable);
?>
