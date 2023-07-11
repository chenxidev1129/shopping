<?
/* ============================================================================== */
/* =   PAGE : ��� ó�� PAGE                                                    = */
/* ============================================================================== */
/* =   ���� ��û ������� ����ϴ� �������Դϴ�.                                = */
/* = -------------------------------------------------------------------------- = */
/* =   ������ ������ �߻��ϴ� ��� �Ʒ��� �ּҷ� �����ϼż� Ȯ���Ͻñ� �ٶ��ϴ�.              =*/
/* =   ���� �ּ� : https://kcp.co.kr/technique.requestcode.do                    = */
/* ============================================================================== */
/* =   Copyright (c)  2021   KCP Inc.   All Rights Reserverd.                   = */
/* = -------------------------------------------------------------------------- = */

function convertEncode($string)
{
    if (mb_detect_encoding($string, 'EUC-KR', true) !== false) {
        return iconv('EUC-KR', 'UTF-8', $string);
    } else {
        return $string;
    }
}
?>
<?
/* ============================================================================== */
/* =   01. ���� ���                                                            = */
/* = -------------------------------------------------------------------------- = */
$res_cd      = $_POST["res_cd"];                // ��� �ڵ�
$res_msg     = convertEncode($_POST["res_msg"]);                // ��� �޽���
/* = -------------------------------------------------------------------------- = */
$ordr_idxx   = $_POST["ordr_idxx"];                // �ֹ���ȣ
$buyr_name   = convertEncode($_POST["buyr_name"]);                // ��û�� �̸�
$card_cd     = $_POST["card_cd"];                // ī�� �ڵ�
$batch_key   = $_POST["batch_key"];                // ��ġ ����Ű
/* ============================================================================== */

$card_mask_no          = $_POST["card_mask_no"];      // ī���ȣ
/* ============================================================================== */
/* =   02. ��������� �� ����                                                   = */
/* ============================================================================== */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http:'www.w3.org/1999/xhtml">

<head>
    <title>*** KCP Payment System ***</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
    <link href="css/style.css" rel="stylesheet" type="text/css" id="cssLink" />
    <script>
        function sendResult() {
            document.resultForm.submit();
        }
    </script>
</head>

<body onload="sendResult();">
    <form name="resultForm" method="post" action="/m/mine/payment/result_proc.php">
        <input type="hidden" name="res_cd" value="<?= $res_cd ?>">
        <input type="hidden" name="res_msg" value="<?= $res_msg ?>">
        <input type="hidden" name="ordr_idxx" value="<?= $ordr_idxx ?>">
        <input type="hidden" name="card_cd" value="<?= $card_cd ?>">
        <input type="hidden" name="card_name" value="">
        <input type="hidden" name="batch_key" value="<?= $batch_key ?>">
        <input type="hidden" name="card_mask_no" value="<?= $card_mask_no ?>">
        <input type="hidden" name="str_userid" value="">
    </form>
</body>

</html>