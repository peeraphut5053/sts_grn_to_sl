<?php

class PO_QC {

    var $StrConn = "";
    public $_sts_no = "";
    public $_sno = "";
    public $_reference = "";
    public $_qa = "";
    public $_udate = "";
    public $_user = "";
    public $_po_date = 0;
    public $_cno = "";
    public $_idate = "";
    public $_po_num = "";
    public $_po_line = "";
    public $_grn_num = "";
    public $_sl_lot = "";
    public $_sl_tag_id = "";
    public $_sl_tag_status = "";
    public $_sl_trans = "";
    public $sts_no = "";
    public $sno = "";
    public $reference = "";
    public $qa = "";
    public $udate = "";
    public $user = "";
    public $po_date = 0;
    public $cno = "";
    public $VarConn = array();
    public $idate = "";
    Private $MySql_Host = "";
    Private $MySql_User = "";
    Private $MySql_Db = "";
    Private $MySql_Pass = "";
    private $QuerySelect = "SELECT "
            . "sl_lot,upload_po,upload_po_line,upload_grn_num,"
            . "upload_status,sts_no,sno,pass,reference,"
            . "qa,grade,u_date,user,po_date,weight,realweight,"
            . "c_no,i_date,h_no,c_no,thick,thicks,"
            . "width,widths,sl_tag_id FROM po_qc  ";

    function setConn($var) {
        $this->MySql_Host = $var['mysql']['host'];
        $this->MySql_User = $var['mysql']['user'];
        $this->MySql_Pass = $var['mysql']['pass'];
        $this->MySql_Db = $var['mysql']['db'];
    }

    function UpdateTag() {
        $mysqli = new mysqli($this->MySql_Host, $this->MySql_User, $this->MySql_Pass, $this->MySql_Db);
        $TmpArray = array();
        $q = "UPDATE po_qc SET sl_tag_id = '" . $this->_sl_tag_id . "'  "
                . "WHERE sts_no = '" . $this->_sts_no . "' ";
        if ($result = $mysqli->query($q)) {
            // $result->free();
            $mysqli->close();
            return count($result);
        } else {
            return $this->GetError('in ' . __FILE__ . ' / ' . __FUNCTION__ . "()  " . $mysqli->error);
        }
    }

    function ClearBarcode($sno) {
        $mysqli = new mysqli($this->MySql_Host, $this->MySql_User, $this->MySql_Pass, $this->MySql_Db);
        $TmpArray = array();
        $q = "update po_qc "
                . "set upload_status = null "
                . ", upload_grn_num =null"
                . ", upload_po =null "
                . ", upload_po_line =0 "
                . ", sl_lot=null "
                . ", sl_tag_status = null "
                . ", sl_trans =null "
                . ", sl_tag_id =null "
                . ", transfer = 0 "
                . ", thick_sl = null  "
                . "where sno ='$sno' ";
        if ($result = $mysqli->query($q)) {
            //  $result->free();
            $mysqli->close();
            return count($result);
        } else {
            return $this->GetError('in ' . __FILE__ . ' / ' . __FUNCTION__ . "()  " . $mysqli->error);
        }
    }

    function Uploaded() {
        $mysqli = new mysqli($this->MySql_Host, $this->MySql_User, $this->MySql_Pass, $this->MySql_Db);
        $TmpArray = array();
        $q = "UPDATE po_qc SET "
                . "upload_status = 'Y' "
                . ",upload_po =  '" . $this->_po_num . "'  "
                . ",upload_grn_num =  '" . $this->_grn_num . "' "
                . ",upload_po_line=  '" . $this->_po_line . "'  "
                . ",sl_lot = '" . $this->_sl_lot . "'  "
                . ",sl_tag_status = '0'  "
                . ",sl_trans= '" . $this->_sl_trans . "'  "
                . "WHERE sts_no = '" . $this->_sts_no . "' ";
        if ($result = $mysqli->query($q)) {
            //  $result->free();
            $mysqli->close();
            return count($result);
        } else {
            return $this->GetError('in ' . __FILE__ . ' / ' . __FUNCTION__ . "()  " . $mysqli->error);
        }
    }

    function GetError($txt) {
        $err = "<div class='alert alert-danger'><strong>Error ! </strong>$txt</alert></div>";
        return $err;
    }

    function CountRows() {
        $mysqli = new mysqli($this->MySql_Host, $this->MySql_User, $this->MySql_Pass, $this->MySql_Db);
        $TmpArray = array();
        if ($result = $mysqli->query($this->QuerySelect . " ORDER BY sts_no ASC  LIMIT $limit ")) {
            $result->free();
            $mysqli->close();
            return count($result);
        } else {
            return $this->GetError('in ' . __FILE__ . ' / ' . __FUNCTION__ . "()  " . $mysqli->error);
        }
    }

    function GetConnectionStatus() {
        $mysqli = new mysqli($this->MySql_Host, $this->MySql_User, $this->MySql_Pass, $this->MySql_Db);
        if (!$mysqli) {
            return "<font color='red'>DISCONNECT &nbsp;<i class='fa fa-circle'></i></font>";
        } else {
            return "<font color='lightgreen'>CONNECTED &nbsp;<i class='fa fa-circle-o-notch fa-spin'></i></font>";
        }
    }

    function Ajax_GetRowsAll_Limit($limit) {
        $mysqli = new mysqli($this->MySql_Host, $this->MySql_User, $this->MySql_Pass, $this->MySql_Db);
        $TmpArray = array();
        if ($result = $mysqli->query($this->QuerySelect . " ORDER BY po_date DESC LIMIT $limit ")) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                $TmpArray[$i] = $row;
            }
            $result->free();
            $mysqli->close();
            return $TmpArray;
        } else {
            return $this->GetError('in ' . __FILE__ . ' / ' . __FUNCTION__ . "()  " . $mysqli->error);
        }
    }

    function Ajax_GetRowsWithDate($startDate, $endDate, $st, $flt, $filterStsNo, $searchType) {
        $mysqli = new mysqli($this->MySql_Host, $this->MySql_User, $this->MySql_Pass, $this->MySql_Db);
        $TmpArray = array();
        $QsT = "";
        $QFlt = " AND reference LIKE '%$flt%' ";
        $qFlt2 = " AND sno LIKE '%$filterStsNo%' ";
        $fltType = "";

        if ($st == "A") {
            $QsT = "";
        } else if ($st == "Y") {
            $QsT = " AND upload_status ='Y' ";
        } else if ($st == "N") {
            $QsT = " AND ( upload_status ='' OR upload_status ='N' OR  upload_status is  null ) ";
        }
        $searchType == "normal" ? $fltType = "" : $fltType = " AND sl_tag_id is not  null ";
        if ($result = $mysqli->query($this->QuerySelect . " WHERE po_date BETWEEN  '$startDate' AND '$endDate'  $QsT   $QFlt $qFlt2 $fltType ORDER BY sts_no DESC ")) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $TmpArray[$i] = $row;
                $i++;
            }
            $result->free();
            $mysqli->close();
            return $TmpArray;
        } else {
            return $this->GetError('in ' . __FILE__ . ' / ' . __FUNCTION__ . "()  " . $mysqli->error);
        }
    }

    function GetRowsOnce() {
        $mysqli = new mysqli($this->MySql_Host, $this->MySql_User, $this->MySql_Pass, $this->MySql_Db);
        $TmpArray = array();
        if ($result = $mysqli->query($this->QuerySelect . " ORDER BY po_date DESC LIMIT 1 ")) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                $TmpArray[$i] = $row;
            }
            $result->free();
            $mysqli->close();
            return $TmpArray;
        } else {
            return $this->GetError('in ' . __FILE__ . ' / ' . __FUNCTION__ . "()  " . $mysqli->error);
        }
    }

}
