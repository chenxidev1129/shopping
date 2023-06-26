<?
/* ============================================================================== */
/* =   PAGE : ���� ��û PAGE                                             = */
/* = -------------------------------------------------------------------------- = */
/* =   �Ʒ��� �� �ʼ�, �� �ɼ� �κа� �Ŵ����� �����ϼż� ������   = */
/* =   �����Ͽ� �ֽñ� �ٶ��ϴ�.                                         = */
/* = -------------------------------------------------------------------------- = */
/* =   ������ ������ �߻��ϴ� ��� �Ʒ��� �ּҷ� �����ϼż� Ȯ���Ͻñ� �ٶ��ϴ�.= */
/* =   ���� �ּ� : http://kcp.co.kr/technique.requestcode.do                    = */
/* = -------------------------------------------------------------------------- = */
/* =   Copyright (c)  2016  NHN KCP Inc.   All Rights Reserverd.                = */
/* ============================================================================== */
?>
<?
/* ============================================================================== */
/* =   ȯ�� ���� ���� Include                                                   = */
/* = -------------------------------------------------------------------------- = */
/* =   �� �ʼ�                                                                  = */
/* =   �׽�Ʈ �� �ǰ��� ������ site_conf_inc.php ������ �����Ͻñ� �ٶ��ϴ�.    = */
/* = -------------------------------------------------------------------------- = */

include "../cfg/site_conf_inc.php";       // ȯ�漳�� ���� include

?>
<?
/* = -------------------------------------------------------------------------- = */
/* =   ȯ�� ���� ���� Include END                                               = */
/* ============================================================================== */
?>
<?
/* kcp�� ����� kcp �������� ���۵Ǵ� ���� ��û ���� */
$req_tx          = $_POST["req_tx"]; // ��û ����         
$res_cd          = $_POST["res_cd"]; // ���� �ڵ�         
$tran_cd         = $_POST["tran_cd"]; // Ʈ����� �ڵ�     
$ordr_idxx       = $_POST["ordr_idxx"]; // ���θ� �ֹ���ȣ   
$good_name       = $_POST["good_name"]; // ��ǰ��            
$good_mny        = $_POST["good_mny"]; // ���� �ѱݾ�       
$buyr_name       = $_POST["buyr_name"]; // �ֹ��ڸ�          
$buyr_tel1       = $_POST["buyr_tel1"]; // �ֹ��� ��ȭ��ȣ   
$buyr_tel2       = $_POST["buyr_tel2"]; // �ֹ��� �ڵ��� ��ȣ
$buyr_mail       = $_POST["buyr_mail"]; // �ֹ��� E-mail �ּ�
$use_pay_method  = $_POST["use_pay_method"]; // ���� ���          
$enc_info        = $_POST["enc_info"]; // ��ȣȭ ����       
$enc_data        = $_POST["enc_data"]; // ��ȣȭ ������     
$cash_yn         = $_POST["cash_yn"];
$cash_tr_code    = $_POST["cash_tr_code"];
/* ��Ÿ �Ķ���� �߰� �κ� - Start - */
$param_opt_1    = $_POST["param_opt_1"]; // ��Ÿ �Ķ���� �߰� �κ�
$param_opt_2    = $_POST["param_opt_2"]; // ��Ÿ �Ķ���� �߰� �κ�
$param_opt_3    = $_POST["param_opt_3"]; // ��Ÿ �Ķ���� �߰� �κ�
/* ��Ÿ �Ķ���� �߰� �κ� - End -   */

$tablet_size     = "1.0"; // ȭ�� ������ ����
$url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

function convertEncode($string)
{
    if (mb_detect_encoding($string, 'UTF-8', true) !== false) {
        return iconv('UTF-8', 'EUC-KR', $string);
    } else {
        return $string;
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>������ ���� ����������</title>

    <!-- ����: font preload -->
    <link rel="preload" href="https://cdn.kcp.co.kr/font/NotoSansCJKkr-Regular.woff" type="font/woff" as="font" crossorigin>
    <link rel="preload" href="https://cdn.kcp.co.kr/font/NotoSansCJKkr-Medium.woff" type="font/woff" as="font" crossorigin>
    <link rel="preload" href="https://cdn.kcp.co.kr/font/NotoSansCJKkr-Bold.woff" type="font/woff" as="font" crossorigin>
    <!-- //����: font preload -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi">
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <link href="../static/css/style.css" rel="stylesheet" type="text/css" id="cssLink" />

    <!-- �ŷ���� �ϴ� kcp ������ ����� ���� ��ũ��Ʈ-->
    <script type="text/javascript" src="js/approval_key.js"></script>

    <script type="text/javascript">
        /* �ֹ���ȣ ���� ���� */
        function init_orderid() {
            var today = new Date();
            var year = today.getFullYear();
            var month = today.getMonth() + 1;
            var date = today.getDate();
            var time = today.getTime();

            if (parseInt(month) < 10)
                month = "0" + month;

            if (parseInt(date) < 10)
                date = "0" + date;

            var order_idxx = "TEST" + year + "" + month + "" + date + "" + time;
            var ipgm_date = year + "" + month + "" + date;

            document.order_info.ordr_idxx.value = order_idxx;
            document.order_info.ipgm_date.value = ipgm_date;
        }

        /* kcp web ����â ȣ�� (����Ұ�) */
        function call_pay_form() {
            var v_frm = document.order_info;

            v_frm.action = PayUrl;

            if (v_frm.Ret_URL.value == "") {
                /* Ret_URL���� �� �������� URL �Դϴ�. */
                alert("������ Ret_URL�� �ݵ�� �����ϼž� �˴ϴ�.");
                return false;
            } else {
                v_frm.submit();
            }
        }

        /* kcp ����� ���� ���� ��ȣȭ ���� üũ �� ���� ��û (����Ұ�) */
        function chk_pay() {
            self.name = "tar_opener";
            var pay_form = document.pay_form;

            if (pay_form.res_cd.value == "3001") {
                alert("����ڰ� ����Ͽ����ϴ�.");
                pay_form.res_cd.value = "";
                return;
            }

            if (pay_form.enc_info.value) {
                pay_form.submit();
                return;
            }

            kcp_AJAX();
        }

        function jsf__chk_type() {
            if (document.order_info.ActionResult.value == "card") {
                document.order_info.pay_method.value = "CARD";
            } else if (document.order_info.ActionResult.value == "acnt") {
                document.order_info.pay_method.value = "BANK";
            } else if (document.order_info.ActionResult.value == "vcnt") {
                document.order_info.pay_method.value = "VCNT";
            } else if (document.order_info.ActionResult.value == "mobx") {
                document.order_info.pay_method.value = "MOBX";
            } else if (document.order_info.ActionResult.value == "ocb") {
                document.order_info.pay_method.value = "TPNT";
                document.order_info.van_code.value = "SCSK";
            } else if (document.order_info.ActionResult.value == "tpnt") {
                document.order_info.pay_method.value = "TPNT";
                document.order_info.van_code.value = "SCWB";
            } else if (document.order_info.ActionResult.value == "scbl") {
                document.order_info.pay_method.value = "GIFT";
                document.order_info.van_code.value = "SCBL";
            } else if (document.order_info.ActionResult.value == "sccl") {
                document.order_info.pay_method.value = "GIFT";
                document.order_info.van_code.value = "SCCL";
            } else if (document.order_info.ActionResult.value == "schm") {
                document.order_info.pay_method.value = "GIFT";
                document.order_info.van_code.value = "SCHM";
            }
        }
    </script>
</head>

<body onload="jsf__chk_type();chk_pay();">
    <div class="wrap">

        <!-- �ֹ����� �Է� form : order_info -->
        <form name="order_info" method="post" action="pp_cli_hub.php">

            <?
            /* ============================================================================== */
            /* =   1. �ֹ� ���� �Է�                                                        = */
            /* = -------------------------------------------------------------------------- = */
            /* =   ������ �ʿ��� �ֹ� ������ �Է� �� �����մϴ�.                            = */
            /* = -------------------------------------------------------------------------- = */
            ?>
            <!-- header -->
            <div class="header">
                <a href="../index.html" class="btn-back"><span>�ڷΰ���</span></a>
                <h1 class="title">�ֹ�/���� SAMPLE</h1>
            </div>
            <!-- //header -->
            <!-- contents -->
            <div id="skipCont" class="contents">
                <p class="txt-type-1">�� �������� ������ ��û�ϴ� ���� �������Դϴ�.</p>
                <p class="txt-type-2">�ҽ� ���� �� [�� �ʼ�] �Ǵ� [�� �ɼ�] ǥ�ð� ���Ե� ������ �������� ��Ȳ�� �°� ������ ���� �����Ͻñ� �ٶ��ϴ�.</p>
                <!-- �ֹ����� -->
                <h2 class="title-type-3">�ֹ�����</h2>
                <ul class="list-type-1">
                    <!-- �ֹ���ȣ(ordr_idxx) -->
                    <li>
                        <div class="left">
                            <p class="title">�ֹ���ȣ</p>
                        </div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="ordr_idxx" value="<?= $_POST['ordr_idxx'] ?: '' ?>" maxlength="40" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>
                    <!-- ��ǰ��(good_name) -->
                    <li>
                        <div class="left">
                            <p class="title">��ǰ��</p>
                        </div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="good_name" value="<?= convertEncode($_POST['good_name']) ?>" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>
                    <!-- �����ݾ�(good_mny) - �� �ʼ� : �� ������ ,(�޸�)�� ������ ���ڸ� �Է��Ͽ� �ֽʽÿ�. -->
                    <li>
                        <div class="left">
                            <p class="title">��ǰ�ݾ�</p>
                        </div>
                        <div class="right">
                            <div class="ipt-type-1 gap-2 pc-wd-2">
                                <input type="text" name="good_mny" value="<?= $_POST['good_mny'] ?: '0' ?>" maxlength="9" />
                                <a href="#none" class="btn-clear"></a>
                                <span class="txt-price">��</span>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="line-type-1"></div>
                <!-- �ֹ����� -->
                <h2 class="title-type-3">�ֹ�����</h2>
                <ul class="list-type-1">
                    <!-- �ֹ��ڸ�(buyr_name) -->
                    <li>
                        <div class="left">
                            <p class="title">�ֹ��ڸ�</p>
                        </div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="buyr_name" value="<?= convertEncode($_POST['buyr_name']) ?>" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>
                    <!-- �ֹ��� ����ó1(buyr_tel1) -->
                    <li>
                        <div class="left">
                            <p class="title">��ȭ��ȣ</p>
                        </div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="buyr_tel1" value="<?= $_REQUEST['buyr_tel1'] ?: '' ?>" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>
                    <!-- �޴�����ȣ(buyr_tel2) -->
                    <li>
                        <div class="left">
                            <p class="title">�޴�����ȣ</p>
                        </div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="buyr_tel2" value="<?= $_POST['buyr_tel2'] ?: '' ?>" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>
                    <!-- �ֹ��� E-mail(buyr_mail) -->
                    <li>
                        <div class="left">
                            <p class="title">�̸���</p>
                        </div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="buyr_mail" value="<?= $_POST['buyr_mail'] ?: '' ?>" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="line-type-1"></div>
                <?
                /* ============================================================================== */
                /* =   ���� ���� ���� ����                                                             = */
                /* = -------------------------------------------------------------------------- = */
                /* =   ������ �ʿ��� ���� ���� ������ �����մϴ�.                                               = */
                /* =                                                                            = */
                /* =  �ſ�ī�� : CARD, ������ü : BANK, ������� : VCNT = */
                /* =  ����Ʈ   : TPNT, �޴���   : MOBX, ��ǰ��   : GIFT = */
                /* =                                                                            = */
                /* =  ���� ���� ������ ��� ǥ�������� ������ ���������� ǥ�õ˴ϴ�.                                    = */
                /* =                                                                            = */
                /* = �� �ʼ�                                                                      = */
                /* =  KCP�� ��û�� �����������θ� ������ �����մϴ�.                                             = */
                /* = -------------------------------------------------------------------------- = */
                ?>
                <h2 class="title-type-3">��������</h2>
                <ul class="list-type-1">
                    <!-- �������� -->
                    <li>
                        <div class="left">
                            <p class="title">��������</p>
                        </div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <select name="ActionResult" onchange="jsf__chk_type();" style="width:100%;height:35px;">
                                    <option value="" selected>�����Ͻʽÿ�</option>
                                    <option value="card" <?= $_POST['card_type'] == '1' ? 'selected' : '' ?>>�ſ�ī��</option>
                                    <option value="acnt" <?= $_POST['card_type'] == '2' ? 'selected' : '' ?>>������ü</option>
                                    <option value="vcnt">�������</option>
                                    <option value="mobx">�޴���</option>
                                    <option value="ocb">OKĳ����</option>
                                    <option value="tpnt">��������Ʈ</option>
                                    <option value="scbl">������ǰ��</option>
                                    <option value="sccl">��ȭ��ǰ��</option>
                                    <option value="schm">���ǸӴ�</option>
                                </select>
                            </div>
                        </div>
                    </li>
                </ul>
                <Div Class="Line-Type-1"></Div>
                <ul class="list-btn-2">
                    <li class="pc-only-show"><a href="../index.html" class="btn-type-3 pc-wd-2">�ڷ�</a></li>
                    <li><a href="#none" onclick="kcp_AJAX();" class="btn-type-2 pc-wd-3">������û</a></li>
                </ul>
            </div>
            <!-- //contents -->

            <!-- footer -->
            <div class="grid-footer">
                <div class="inner">
                    <div class="footer">
                        �� NHN KCP Corp.
                    </div>
                </div>
            </div>
            <!--//footer-->


            <!-- ����: js -->
            <script type="text/javascript" src="../static/js/jquery-1.12.4.min.js"></script>
            <script type="text/javascript" src="../static/js/front.js"></script>
            <!-- //����: js -->


            <!-- �������� -->
            <input type="hidden" name="req_tx" value="pay"> <!-- ��û ���� -->
            <input type="hidden" name="shop_name" value="<?= $g_conf_site_name ?>"> <!-- ����Ʈ �̸� -->
            <input type="hidden" name="site_cd" value="<?= $g_conf_site_cd   ?>"> <!-- ����Ʈ Ű -->
            <input type="hidden" name="currency" value="410" /> <!-- ��ȭ �ڵ� -->
            <!-- ������� Ű -->
            <input type="hidden" name="approval_key" id="approval">
            <!-- ������ �ʿ��� �Ķ����(����Ұ�)-->
            <input type="hidden" name="escw_used" value="N">
            <input type="hidden" name="pay_method" value="">
            <input type="hidden" name="van_code" value="">
            <!-- �ſ�ī�� ���� -->
            <input type="hidden" name="quotaopt" value="12" /> <!-- �ִ� �Һΰ����� -->
            <!-- ������� ���� -->
            <input type="hidden" name="ipgm_date" value="" />

            <!-- ���� URL (kcp�� ����� ������ ��û�� �� �ִ� ��ȣȭ �����͸� ���� ���� �������� �ֹ������� URL) -->
            <input type="hidden" name="Ret_URL" value="<?= $url ?>">
            <!-- ȭ�� ũ������ -->
            <input type="hidden" name="tablet_size" value="<?= $tablet_size ?>">

            <!-- �߰� �Ķ���� ( ���������� ������ �����޽� param_opt �� ����Ͽ� �� ���� ) -->
            <input type="hidden" name="param_opt_1" value="<?= $_REQUEST['int_cart'] ?: '' ?>">
            <input type="hidden" name="param_opt_2" value="<?= $_REQUEST['int_coupon'] ?: '' ?>">
            <input type="hidden" name="param_opt_3" value="">

            <!-- ���� ���� ��Ͻ� ���� Ÿ�� ( �ʵ尡 ���ų� ���� '' �ϰ�� TEXT, ���� XML �Ǵ� JSON ���� -->
            <input type="hidden" name="response_type" value="TEXT" />
            <input type="hidden" name="PayUrl" id="PayUrl" value="" />
            <input type="hidden" name="traceNo" id="traceNo" value="" />

            <?
            /* ============================================================================== */
            /* =   �ɼ� ����                                                                = */
            /* = -------------------------------------------------------------------------- = */
            /* =   �� �ɼ� - ������ �ʿ��� �߰� �ɼ� ������ �Է� �� �����մϴ�.             = */
            /* = -------------------------------------------------------------------------- = */
            /* ī��� ����Ʈ ����
    ��) ��ī��� ����ī�� ��� ������
    <input type="hidden" name='used_card'    value="CCBC:CCLG">

    /*  ������ �ɼ�
            �� �����Һ�    (������ ������ �������� ���� �� ������ ������ ������)                             - "" �� ����
            �� �Ϲ��Һ�    (KCP �̺�Ʈ �̿ܿ� ���� �� ��� ������ ������ �����Ѵ�)                           - "N" �� ����
            �� ������ �Һ� (������ ������ �������� ���� �� ������ �̺�Ʈ �� ���ϴ� ������ ������ �����Ѵ�)   - "Y" �� ����
    <input type="hidden" name="kcp_noint"       value=""/> */

            /*  ������ ����
            �� ���� 1 : �Һδ� �����ݾ��� 50,000 �� �̻��� ��쿡�� ����
            �� ���� 2 : ������ �������� ������ �ɼ��� Y�� ��쿡�� ���� â�� ����
            ��) BC 2,3,6����, ���� 3,6����, �Ｚ 6,9���� ������ : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:04
    <input type="hidden" name="kcp_noint_quota" value="CCBC-02:03:06,CCKM-03:06,CCSS-03:06:09"/> */

            /* KCP�� ������ǰ�� �������ǰ�� ���ÿ� �Ǹ��ϴ� ��ü���� ���������� ���� ���Ǽ��� �����ص帮����, 
        ���հ��� ���� ����Ʈ�ڵ带 ������ �帮�� �� �ݾ׿� ���� ���հ��� ó���� �����ϵ��� �����ϰ� �ֽ��ϴ�
        ���հ��� ���� ����Ʈ �ڵ�� ����Ͻ� ���������� �ش��� �˴ϴ�
        ��ǰ���� �ƴ϶� �ݾ����� �����Ͽ� ��û�ϼž� �մϴ�
        �Ѱ��� �ݾ��� �����ݾ� + �ΰ��� + ������ݾ��� �հ� ���ƾ� �մϴ�. 
        (good_mny = comm_tax_mny + comm_vat_mny + comm_free_mny)
    
        <input type="hidden" name="tax_flag"       value="TG03">  <!-- ����Ұ�	   -->
        <input type="hidden" name="comm_tax_mny"   value=""    >  <!-- �����ݾ�	   --> 
        <input type="hidden" name="comm_vat_mny"   value=""    >  <!-- �ΰ���	   -->
        <input type="hidden" name="comm_free_mny"  value=""    >  <!-- ����� �ݾ� --> */

            /* ����â �ѱ���/���� ���� �ɼ� (Y : ����)
	    <input type="hidden" name="eng_flag"        value="Y"/> */

            /* ���������� �����ϴ� �� ���̵� ������ �ؾ� �մϴ�. ��ǰ�� ���� �� �ݵ�� �Է��Ͻñ� �ٶ��ϴ�.
        <input type="hidden" name="shop_user_id"    value=""/> */

            /* ��������Ʈ ������ �������� �Ҵ�Ǿ��� �ڵ� ���� �Է��ؾ��մϴ�.
        <input type="hidden" name="pt_memcorp_cd"   value=""/> */

            /* ����â ���ݿ����� ���� ���� �ɼ� (Y : ����)
        <input type="hidden" name="disp_tax_yn"     value="Y"/> */
            /* = -------------------------------------------------------------------------- = */
            /* =   �ɼ� ���� END                                                            = */
            /* ============================================================================== */
            ?>

        </form>
    </div>
    <form name="pay_form" method="post" action="pp_cli_hub.php">
        <input type="hidden" name="req_tx" value="<?= $req_tx ?>"> <!-- ��û ����          -->
        <input type="hidden" name="res_cd" value="<?= $res_cd ?>"> <!-- ��� �ڵ�          -->
        <input type="hidden" name="tran_cd" value="<?= $tran_cd ?>"> <!-- Ʈ����� �ڵ�      -->
        <input type="hidden" name="ordr_idxx" value="<?= $ordr_idxx ?>"> <!-- �ֹ���ȣ           -->
        <input type="hidden" name="good_mny" value="<?= $good_mny ?>"> <!-- �޴��� �����ݾ�    -->
        <input type="hidden" name="good_name" value="<?= $good_name ?>"> <!-- ��ǰ��             -->
        <input type="hidden" name="buyr_name" value="<?= $buyr_name ?>"> <!-- �ֹ��ڸ�           -->
        <input type="hidden" name="buyr_tel1" value="<?= $buyr_tel1 ?>"> <!-- �ֹ��� ��ȭ��ȣ    -->
        <input type="hidden" name="buyr_tel2" value="<?= $buyr_tel2 ?>"> <!-- �ֹ��� �޴�����ȣ  -->
        <input type="hidden" name="buyr_mail" value="<?= $buyr_mail ?>"> <!-- �ֹ��� E-mail      -->
        <input type="hidden" name="cash_yn" value="<?= $cash_yn ?>"> <!-- ���ݿ����� ��Ͽ���-->
        <input type="hidden" name="enc_info" value="<?= $enc_info ?>">
        <input type="hidden" name="enc_data" value="<?= $enc_data ?>">
        <input type="hidden" name="use_pay_method" value="<?= $use_pay_method ?>">
        <input type="hidden" name="cash_tr_code" value="<?= $cash_tr_code ?>">

        <!-- �߰� �Ķ���� -->
        <input type="hidden" name="param_opt_1" value="<?= $param_opt_1 ?>">
        <input type="hidden" name="param_opt_2" value="<?= $param_opt_2 ?>">
        <input type="hidden" name="param_opt_3" value="<?= $param_opt_3 ?>">
    </form>
</body>

</html>