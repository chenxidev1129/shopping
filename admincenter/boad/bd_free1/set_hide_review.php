<? include_once $_SERVER['DOCUMENT_ROOT'] . "/pub/inc/comm.php"; ?>
<?php
$bd_seq = Fnc_Om_Conv_Default($_REQUEST['seq'], 0);

$result = array(
    "status" => 200,
    "data" => 0
);

$SQL_QUERY =    'SELECT A.BD_HIDE FROM 
                    `' . $Tname . 'b_bd_data@01` AS A
                WHERE
                    A.BD_SEQ=' . $bd_seq;

$arr_Rlt_Data = mysql_query($SQL_QUERY);

if ($arr_Rlt_Data) {
    $arr_Data = mysql_fetch_assoc($arr_Rlt_Data);

    $bd_hide = $arr_Data['BD_HIDE'] == 0 ? 1 : 0;

    $SQL_QUERY = 'UPDATE `' . $Tname . 'b_bd_data@01` SET BD_HIDE=' . $bd_hide . ' WHERE BD_SEQ=' . $bd_seq;
    mysql_query($SQL_QUERY);

    $result["status"] = 200;
    $result["data"] = $bd_hide;
} else {
    $result["status"] = 500;
}



echo json_encode($result);
