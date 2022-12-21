<?php

class SLPO {

    var $StrConn = "";
    public $_site_ref = "";
    public $_vend_num = "";
    public $_po_num = "";
    public $site_ref = "";
    public $vend_num = "";
    public $po_num = "";
    public $order_date = "";
    public $po_cost = "";
    public $ship_code = "";
    public $terms_code = "";
    private $AllField = "site_ref,po_num,vend_num,order_date,po_cost,ship_code,terms_code,dist_date,inv_num,inv_date,stat,freight,fob,print_price,vend_order,misc_charges,sales_tax,type,eff_date,exp_date,ship_addr,whse";

    function setConn($c) {
        $this->StrConn = $c;
    }

    function GetAvailableGRN_HDR($vend_name) {
        $ret = "";
        $q = "SELECT vdr.name ,grn.vend_num , grn_num  , grn_hdr_date ,stat , whse FROM grn_hdr_mst grn ";
        $q = $q . " LEFT JOIN vendaddr_mst vdr ON grn.vend_num = vdr.vend_num ";
        $q = $q . " WHERE stat = 'I' AND name like '%$vend_name%' ";
        $cSql = new SqlSrv();
        $grn_hdr_date = "";
        $vend_num = "";
        $grn_num = "";
        $whse = "";
        $bgcolor = "";
        $rs0 = $cSql->SqlQuery($this->StrConn, $q);
        array_splice($rs0, count($rs0) - 1, 1);
        //  $arr = array() ;
        foreach ($rs0 as $index => $rows) {
            $index % 2 == 0 ? $bgcolor = "#ffffff" : $bgcolor = "#edeeef";
            //    $grn_hdr_date=date($rows["grn_hdr_date"] , "Y-m-d H:i:s");
            $grn_hdr_date = $rows["grn_hdr_date"]->format("Y-m-d H:i:s");
            $vend_num = $rows["vend_num"];
            $vend_name = $rows["name"];
            $grn_num = $rows["grn_num"];
            $whse = $rows["whse"];
            $ret = $ret . "<tr style='background-color:$bgcolor;'>" .
                    "<td align='left' >$grn_hdr_date</td>"
                    . "<td  align='left'>$grn_num</td> "
                    . "<td  align='left'>$vend_name</td> "
                    . "<td  align='left'>$whse</td>   "
                    . "<td><a href='#' id='" . $grn_num . "_" . $vend_num . "' class='btn btn-info' style='color:#FFFFFF;padding:3px 10px 3px 10px;' OnClick='SelectHdr(this.id);'><i class='fa fa-chevron-right'></a></td>"
                    . "<tr>";
        }

        return $ret;
    }

    function GetAvailableGRN_Barcode($grnbarcode) {
        $ret = "";
        $q = "SELECT vdr.name ,grn.vend_num , grn_num  , grn_hdr_date ,stat , whse FROM grn_hdr_mst grn ";
        $q = $q . " LEFT JOIN vendaddr_mst vdr ON grn.vend_num = vdr.vend_num ";
        $q = $q . " WHERE stat = 'I' AND grn_num like '%$grnbarcode%' ";
        $cSql = new SqlSrv();
        $grn_hdr_date = "";
        $vend_num = "";
        $grn_num = "";
        $whse = "";
        $bgcolor = "";
        $rs0 = $cSql->SqlQuery($this->StrConn, $q);
        array_splice($rs0, count($rs0) - 1, 1);
        //  $arr = array() ;
        foreach ($rs0 as $index => $rows) {
            $index % 2 == 0 ? $bgcolor = "#ffffff" : $bgcolor = "#edeeef";
            //    $grn_hdr_date=date($rows["grn_hdr_date"] , "Y-m-d H:i:s");
            $grn_hdr_date = $rows["grn_hdr_date"]->format("Y-m-d H:i:s");
            $vend_num = $rows["vend_num"];
            $vend_name = $rows["name"];
            $grn_num = $rows["grn_num"];
            $whse = $rows["whse"];
            $ret = $ret . "<tr style='background-color:$bgcolor;'>" .
                    "<td align='left' >$grn_hdr_date</td>"
                    . "<td  align='left'>$grn_num</td> "
                    . "<td  align='left'>$vend_name</td> "
                    . "<td  align='left'>$whse</td>   "
                    . "<td><a href='#' id='" . $grn_num . "_" . $vend_num . "' class='btn btn-info' style='color:#FFFFFF;padding:3px 10px 3px 10px;' OnClick='SelectHdr(this.id);'><i class='fa fa-chevron-right'></a></td>"
                    . "<tr>";
        }

        return $ret;
    }

    function GetAvailablePO($vend_num,$item) {
//        $q = "SELECT DISTINCT po.order_date  ,itm.description, poi.item_cost_conv, poi.po_num,poi.po_line,po.vend_num,vdr.name,poi.item , poi.qty_ordered,poi.item_cost  FROM poitem_mst poi ";
//        $q = $q . " LEFT JOIN po_mst po ON poi.po_num = po.po_num ";
//        $q = $q . " LEFT JOIN item_mst itm  ON poi.item = itm.item ";
//        $q = $q . " LEFT JOIN vendor_mst vd ON po.vend_num = vd.vend_num ";
//        $q = $q . " LEFT JOIN vendaddr_mst vdr ON vd.vend_num = vdr.vend_num ";
//        $q = $q . " WHERE poi.stat = 'O' AND  po.stat ='O'   AND REPLACE(po.vend_num,' ','') = '$vend_num' ";

        $q = "SELECT *  FROM  V_WebApp_GetAvailablePO_For_HotrollReceive WHERE REPLACE(vend_num,' ','') = '$vend_num' and item = '$item' ";


        $cSql = new SqlSrv();

        //echo $q ;
        $rs0 = $cSql->SqlQuery($this->StrConn, $q);
        array_splice($rs0, count($rs0) - 1, 1);
        $arr = array();
        $ret = "";
        $PoNum = "";
        $PoLine = "";
        $VendNum = "";
        $item = "";
        $cost = "";
        $VendName = "";
        $qty = "";
        $item_desc = "";
        $cost = 0;
        $vendName = "";
        $po_date = "";
        //$bgColor = "" ;
        //$x = 0 ;
        $x = 0;
        foreach ($rs0 as $index => $rows) {
            $index % 2 == 0 ? $bgcolor = "#ffffff" : $bgcolor = "#edeeef";
            $PoNum = $rows["po_num"];
            $x++;
            $vendName = $rows["name"];
            $po_date = $rows["order_date"]->format("Y-m-d H:i:s");
            $PoLine = $rows["po_line"];
            $VendNum = $rows["vend_num"];
            $item = $rows["item"];
            $item_desc = $rows["description"];
            $qty = number_format($rows["qty_ordered"], 4);
            $VendName = $rows["name"];
            $cost = number_format($rows["item_cost_conv"], 4);

            $item_thick = $rows["item_thick"];
            $item_width = $rows["item_width"];

            $item_uf_grade = $rows["Uf_Grade"];

            $ret = $ret . "<tr style='background-color:$bgcolor;'>"
                    . "<td width='10%' style='font-size:12px;' align='left' >$po_date</td>"
                    . "<td width='10%' style='font-size:12px;' align='left'>$PoNum</td> "
                    . "<td width='2%' style='font-size:12px;width:10%;'  align='left'>$PoLine</td> "
                    . "<td width='30%' style='font-size:12px;' style='font-size:10px;' align='left'><h6>$item</h6><h6>$item_desc</h6></td>   "
                    // . "<td width='20%' style='display:box;font-size:12px;' align='left'>$item_desc</td>   "
                    . "<td width='15%'  style='font-size:12px;text-align:right;'  align='left'>$qty</td>   "
                    . "<td width='10%'  style='font-size:12px;' align='left'>$cost</td>"
                    . "<td width='5%' ><a style='text-align:center;border:solid 1px #666;background-color:#FFFFFF;width:30px;height:30px;'  "
                    . "id='selPO_$x' "
                    . "OnClick='SelectPO(this.id);''  "
                    . "data-po-num='$PoNum' "
                    . "data-po-line='$PoLine' "
                    . "data-vend-num='" . trim($VendNum) . "' data-item_thick='$item_thick'  data-item_width='$item_width' data-item_uf_grade ='$item_uf_grade'  ><i class='fa fa-check'></a></td>"
                    . "<tr>";
        }
        return $ret;
    }

    function GetPOData($sWhere) {
        $q = "SELECT  " . $this->AllField . " "
                . " FROM po_mst  "
                . " WHERE po_num $sWhere";
        $cSql = new SqlSrv();

        $rs0 = $cSql->SqlQuery($this->StrConn, $q);
        array_splice($rs0, count($rs0) - 1, 1);
        $arr = array();
        $ret = "";
        foreach ($rs0 as $index => $rows) {
            $ret = $ret . "<div class='row row-data-ajax'>"
                    . "<div class='col-1 col-data-ajax'>"
                    . "<a id='sel_" . $rows["po_num"] . "' data-vend-num='" . $rows["vend_num"] . "'  href='#'><i class='fa fa-chevron-left'></i></a>"
                    . "</div>"
                    . "<div class='col-11 col-data-ajax'>" . $rows["vend_num"] . " - " . $rows["name"] . " </div>"
                    . "</div>";
        }
        return $ret;
    }

    function AjaxGetRowsWithCond($sWhere) {
        $q = "SELECT  " . $this->AllField . " "
                . " FROM po_mst vd "
                . " WHERE $sWhere";
        $cSql = new SqlSrv();

        $rs0 = $cSql->SqlQuery($this->StrConn, $q);
        array_splice($rs0, count($rs0) - 1, 1);
        $arr = array();
        $ret = "";
        foreach ($rs0 as $index => $rows) {
            $ret = $ret . "<div class='row row-data-ajax'>"
                    . "<div class='col-1 col-data-ajax'>"
                    . "<a id='sel_" . $rows["po_num"] . "' data-vend-num='" . $rows["vend_num"] . "'  href='#'><i class='fa fa-chevron-left'></i></a>"
                    . "</div>"
                    . "<div class='col-11 col-data-ajax'>" . $rows["vend_num"] . " - " . $rows["name"] . " </div>"
                    . "</div>";
        }
        return $ret;
    }

    function AjaxGetAvailablePO() {
        $q = "SELECT  " . $this->AllField . " "
                . " FROM po_mst vd "
                . " WHERE $sWhere";
        $cSql = new SqlSrv();

        $rs0 = $cSql->SqlQuery($this->StrConn, $q);
        array_splice($rs0, count($rs0) - 1, 1);
        $arr = array();
        $ret = "";
        foreach ($rs0 as $index => $rows) {
            $ret = $ret . "<div class='row row-data-ajax'>"
                    . "<div class='col-1 col-data-ajax'>"
                    . "<a id='sel_" . $rows["po_num"] . "' data-vend-num='" . $rows["vend_num"] . "'  href='#'><i class='fa fa-chevron-left'></i></a>"
                    . "</div>"
                    . "<div class='col-11 col-data-ajax'>" . $rows["vend_num"] . " - " . $rows["name"] . " </div>"
                    . "</div>";
        }
        return $ret;
    }

    function AjaxGetItemsDropdownWithCond($sWhere) {
        $q = "SELECT  " . $this->AllField . " "
                . " FROM po_mst vd "
                . " WHERE $sWhere";
        $cSql = new SqlSrv();

        $rs0 = $cSql->SqlQuery($this->StrConn, $q);
        array_splice($rs0, count($rs0) - 1, 1);
        $arr = array();

        foreach ($rs0 as $index => $rows) {
            array_push($arr, $rows["ven_num"]);
        }
        return $arr;
    }

}
