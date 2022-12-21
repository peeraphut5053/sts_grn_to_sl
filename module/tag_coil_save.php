<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}
include "./initial.php";


if (!isset($_POST["grndata"])) {
    echo "2";
    exit;
}

$cSql = new SqlSrv();
$dd = null;
$gdn = count($_POST["grndata"]);
$V = new V_MV_GRN();
$po_num = "";
$grn_num = "";
$lot = "";
$V->setConn($conn_tag);

$POQC = new PO_QC();
$POQC->setConn($var);
$GRN = new SLGRN();
$GRN->setConn($conn_sl);
$TempVendNameSave = "";
$TempDate = "";
$Td ="" ;
for ($t = 0; $t < $gdn; $t++) {
    $data = explode("!!", $_POST["grndata"][$t]);
    $id = $_POST["ids"][$t];
    $print_day = date("Y-m-d H:i:s");
    $lot = $data[2];
    $grn_num = $data[0];
    $po_num = $data[1];
    $V->_grn_num = $grn_num;
    $V->_lot = $lot;
    $V->_po_num = $po_num;
    $V->GetProperties();
    $UF_manu = $V->UF_manu;
    $TempVendNameSave = str_replace("'", "_", $data[9]);

//    if (trim($data[11]) == "")
//        $data[11] = 0;
    $Td=$data[11] ;
    $TempDate = substr($Td, 6, 10) . "-" . substr($Td, 3, 2) . "-" . substr($Td, 0, 2);
    $sql = "insert into Mv_Bc_tag ("
            . "id, item, lot, qty1, mfg_date,"
            . " print_date, ship_stat, active, grn_num, um1, "
            . "uf_grade, grn_line, Uf_manu, uf_name, uf_coil_no, "
            . "uf_Tickness, po_num, uf_width, uf_spec, qty2, "
            . "receipt,sts_no"
            . ") "
            . "values ("
            . "'" . $id . "', '" . $data[3] . "', '$lot', " . $data[14] . ", '$TempDate', "
            . "'" . $print_day . "', 0, 1, '$grn_num', '" . $data[5] . "', "
            . "'A', " . $data[7] . ", '$UF_manu', '$TempVendNameSave' , '" . $data[10] . "', "
            . "" . $data[12] . ", '" . $data[1] . "', " . $data[13] . ", '" . $data[6] . "', 1, "
            . "1,'" . $data[15] . "');";
    $rs1 = $cSql->IsUpDel($conn_tag, $sql);

    //\\/\/\/\\\\\/\\\///\\\ Disable Trigger \\\////\\\\////\\\\////\\\///\\\
    $DisableTriggerIns = sqlsrv_query($conn_sl, "DISABLE Trigger lot_mst.lot_mstIup ON lot_mst ");
    $DisableTriggerDel = sqlsrv_query($conn_sl, "DISABLE Trigger lot_mst.lot_mstDel ON lot_mst ");
    ////\\\\////\\\\////\\\\\/////\\\\\/\\/\/\/\/\/////\\\\////\\\////\\\///\
    $LotSL = new Lot();
    $LotSL->UpdateSts_CoilNo($lot, $data[15], $data[10], $data[3], $data[16], $data[17], $data[18]);
    ////\\/\/\/\\\\\/\\\///\\\ ENABLE Trigger \\\////\\\\////\\\\////\\\///\\\
    $DisableTriggerIns = sqlsrv_query($conn_sl, "ENABLE Trigger lot_mst.lot_mstIup ON lot_mst ");
    $DisableTriggerDel = sqlsrv_query($conn_sl, "ENABLE Trigger lot_mst.lot_mstDel ON lot_mst ");
    ////\\\\////\\\\////\\\\\/////\\\\\/\\/\/\/\/\/////\\\\////\\\////\\\///\
    //
    //======================== Update tag_id back to PO_QC
    $POQC->_sts_no = $_POST["sts_no"][$t];
    $POQC->_sl_tag_id = $id;
    $POQC->UpdateTag();
//===================UPDATE Uf_tag_status = 1 By grn_num and grn_line ===============
    $GRN->UpdateGrnLineByTagPrint($grn_num, $data[7]);
}
echo $rs1;
sqlsrv_close($conn_tag);
?>
