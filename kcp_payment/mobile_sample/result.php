<?
    /* ============================================================================== */
    /* =   PAGE : ���� ��� ��� PAGE                                               = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ���� ��û ������� ����ϴ� �������Դϴ�.                                = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ������ ������ �߻��ϴ� ��� �Ʒ��� �ּҷ� �����ϼż� Ȯ���Ͻñ� �ٶ��ϴ�.= */
    /* =   ���� �ּ� : http://kcp.co.kr/technique.requestcode.do                    = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2016   NHN KCP Inc.   All Rights Reserverd.               = */
    /* ============================================================================== */
?>

<?
  // ���� ����
  $site_cd          = $_POST[ "site_cd"        ];      // ����Ʈ �ڵ�
  $req_tx           = $_POST[ "req_tx"         ];      // ��û ����(����/���)
  $use_pay_method   = $_POST[ "use_pay_method" ];      // ��� ���� ����
  $bSucc            = $_POST[ "bSucc"          ];      // ��ü DB ����ó�� �Ϸ� ����
  // �ֹ� ����
  $amount           = $_POST[ "amount"         ];      // KCP ���� �ŷ� �ݾ�
  $tno              = $_POST[ "tno"            ];      // KCP �ŷ���ȣ
  $ordr_idxx        = $_POST[ "ordr_idxx"      ];      // �ֹ���ȣ
  $good_name        = $_POST[ "good_name"      ];      // ��ǰ��
  $buyr_name        = $_POST[ "buyr_name"      ];      // �����ڸ�
  $buyr_tel1        = $_POST[ "buyr_tel1"      ];      // ������ ��ȭ��ȣ
  $buyr_tel2        = $_POST[ "buyr_tel2"      ];      // ������ �޴�����ȣ
  $buyr_mail        = $_POST[ "buyr_mail"      ];      // ������ E-Mail
  // ��� �ڵ�
  $res_cd           = $_POST[ "res_cd"         ];      // ��� �ڵ�
  $res_msg          = $_POST[ "res_msg"        ];      // ��� �޽���
  $res_msg_bsucc    = "";
  // ����
  $app_time         = $_POST[ "app_time"       ];      // ���νð� (����)
  $pnt_issue        = $_POST[ "pnt_issue"      ];      // ����Ʈ ���񽺻�
  // �ſ�ī��
  $card_cd          = $_POST[ "card_cd"        ];      // ī�� �ڵ�
  $card_name        = $_POST[ "card_name"      ];      // ī���
  $app_no           = $_POST[ "app_no"         ];      // ���ι�ȣ
  $noinf            = $_POST[ "noinf"          ];      // ������ ����
  $quota            = $_POST[ "quota"          ];      // �Һΰ���
  $partcanc_yn      = $_POST[ "partcanc_yn"    ];      // �κ���� ����
  // ������ü
  $bank_name        = $_POST[ "bank_name"      ];      // �����
  $bank_code        = $_POST[ "bank_code"      ];      // �����ڵ�
  // �������
  $bankname         = $_POST[ "bankname"       ];      // �Ա��� ����
  $depositor        = $_POST[ "depositor"      ];      // �Ա��� ���� ������
  $account          = $_POST[ "account"        ];      // �Ա��� ���� ��ȣ
  $va_date          = $_POST[ "va_date"        ];      // �Աݸ����ð�
  // ����Ʈ
  $add_pnt          = $_POST[ "add_pnt"        ];      // �߻� ����Ʈ
  $use_pnt          = $_POST[ "use_pnt"        ];      // ��밡�� ����Ʈ
  $rsv_pnt          = $_POST[ "rsv_pnt"        ];      // ���� ����Ʈ
  $pnt_app_time     = $_POST[ "pnt_app_time"   ];      // ���νð�
  $pnt_app_no       = $_POST[ "pnt_app_no"     ];      // ���ι�ȣ
  $pnt_amount       = $_POST[ "pnt_amount"     ];      // �����ݾ� or ���ݾ�
  // �޴���
  $commid           = $_POST[ "commid"         ];      // ��Ż� �ڵ�
  $mobile_no        = $_POST[ "mobile_no"      ];      // �޴��� ��ȣ
  // ��ǰ��
  $tk_van_code      = $_POST[ "tk_van_code"    ];      // �߱޻� �ڵ�
  $tk_app_no        = $_POST[ "tk_app_no"      ];      // ���� ��ȣ
  // ���ݿ�����
  $cash_yn          = $_POST[ "cash_yn"        ];      // ���� ������ ��� ����
  $cash_authno      = $_POST[ "cash_authno"    ];      // ���� ������ ���� ��ȣ
  $cash_tr_code     = $_POST[ "cash_tr_code"   ];      // ���� ������ ���� ����
  $cash_id_info     = $_POST[ "cash_id_info"   ];      // ���� ������ ��� ��ȣ
  $cash_no          = $_POST[ "cash_no"        ];      //���ݿ����� �ŷ� ��ȣ 
    
  /* ��Ÿ �Ķ���� �߰� �κ� - Start - */
  $param_opt_1     = $_POST[ "param_opt_1"     ];      // ��Ÿ �Ķ���� �߰� �κ�
  $param_opt_2     = $_POST[ "param_opt_2"     ];      // ��Ÿ �Ķ���� �߰� �κ�
  $param_opt_3     = $_POST[ "param_opt_3"     ];      // ��Ÿ �Ķ���� �߰� �κ�
  /* ��Ÿ �Ķ���� �߰� �κ� - End -   */

  $req_tx_name     = "";

  if ( $req_tx == "pay" )
  {
    $req_tx_name = "����" ;
  }
  else if ( $req_tx == "mod" )
  {
    $req_tx_name = "���/����" ;
  }

    /* ============================================================================== */
    /* =   ������ �� DB ó�� ���н� �� ��� �޽��� ����                           = */
    /* = -------------------------------------------------------------------------- = */

    if ( $req_tx == "pay" )
    {
        // ��ü DB ó�� ����
        if ( $bSucc == "false" )
        {
            if ( $res_cd == "0000" )
            {
                $res_msg_bsucc = "������ ���������� �̷�������� ���θ����� ���� ����� ó���ϴ� �� ������ �߻��Ͽ� �ý��ۿ��� �ڵ����� ��� ��û�� �Ͽ����ϴ�. <br> ���θ��� ��ȭ�Ͽ� Ȯ���Ͻñ� �ٶ��ϴ�." ;
            }
            else
            {
                $res_msg_bsucc = "������ ���������� �̷�������� ���θ����� ���� ����� ó���ϴ� �� ������ �߻��Ͽ� �ý��ۿ��� �ڵ����� ��� ��û�� �Ͽ�����, <br> <b>��Ұ� ���� �Ǿ����ϴ�.</b><br> ���θ��� ��ȭ�Ͽ� Ȯ���Ͻñ� �ٶ��ϴ�" ;
            }
        }
    }

    /* = -------------------------------------------------------------------------- = */
    /* =   ������ �� DB ó�� ���н� �� ��� �޽��� ���� ��                        = */
    /* ============================================================================== */
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
  
  <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
  <meta http-equiv="Pragma" content="no-cache"> 
  <meta http-equiv="Expires" content="-1">
  <link href="../static/css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>
  <script type="text/javascript">
        /* �ſ�ī�� ������ */ 
        /* �ǰ����� : "https://admin8.kcp.co.kr/assist/bill.BillActionNew.do?cmd=card_bill&tno=" */ 
        /* �׽�Ʈ�� : "https://testadmin8.kcp.co.kr/assist/bill.BillActionNew.do?cmd=card_bill&tno=" */ 
         function receiptView( tno, ordr_idxx, amount ) 
        {
            receiptWin = "https://testadmin8.kcp.co.kr/assist/bill.BillActionNew.do?cmd=card_bill&tno=";
            receiptWin += tno + "&";
            receiptWin += "order_no=" + ordr_idxx + "&"; 
            receiptWin += "trade_mony=" + amount ;

            window.open(receiptWin, "", "width=455, height=815"); 
        }

        /* ���� ������ */ 
        /* �ǰ����� : "https://admin8.kcp.co.kr/assist/bill.BillActionNew.do" */ 
        /* �׽�Ʈ�� : "https://testadmin8.kcp.co.kr/assist/bill.BillActionNew.do" */   
        function receiptView2( cash_no, ordr_idxx, amount ) 
        {
            receiptWin2 = "https://testadmin8.kcp.co.kr/assist/bill.BillActionNew.do?cmd=cash_bill&cash_no=";
            receiptWin2 += cash_no + "&";             
            receiptWin2 += "order_id="     + ordr_idxx + "&";
            receiptWin2 += "trade_mony="  + amount ;

            window.open(receiptWin2, "", "width=370, height=625"); 
        }

        /* ���� ���� �����Ա� ������ ȣ�� */
        /* �׽�Ʈ�ÿ��� ��밡�� */
        /* �ǰ����� �ش� ��ũ��Ʈ �ּ�ó�� */
        function receiptView3() 
        {
            receiptWin3 = "http://devadmin.kcp.co.kr/Modules/Noti/TEST_Vcnt_Noti.jsp"; 
            window.open(receiptWin3, "", "width=520, height=300"); 
        }
    </script>
</head>


<body>
<div class="wrap">
    <form name="cancel" method="post">
    <!-- header -->
        <div class="header">
            <a href="../index.html" class="btn-back"><span>�ڷΰ���</span></a>
            <h1 class="title">��� ���</h1>
        </div>
        <!-- //header -->
        <!-- contents -->
        <div id="skipCont" class="contents">
            <p class="txt-type-1">�� �������� ���� ����� ����ϴ� ����(����) �������Դϴ�.</p>
            <p class="txt-type-2">��û ����� ����ϴ� ������ �Դϴ�.<br />��û�� ���������� ó���� ��� ����ڵ�(res_cd)���� 0000���� ǥ�õ˴ϴ�.</p>
            <h2 class="title-type-3">ó�����</h2>
<?
    /* ============================================================================== */
    /* =   ���� ��� �ڵ� �� �޽��� ���(����������� �ݵ�� ������ֽñ� �ٶ��ϴ�.)= */
    /* = -------------------------------------------------------------------------- = */
    /* =   ���� ���� : res_cd���� 0000���� �����˴ϴ�.                              = */
    /* =   ���� ���� : res_cd���� 0000�̿��� ������ �����˴ϴ�.                     = */
    /* = -------------------------------------------------------------------------- = */
?>
          <ul class="list-type-1">
                <!-- ��� �ڵ� -->
                <li>
                    <div class="left"><p class="title">����ڵ�</p></div>
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?= $res_cd ?></div></div>
                </li>
                <!-- ��� �ڵ� -->
                <li>
                    <div class="left"><p class="title">����޼���</p></div>
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?= $res_msg ?></div></div>
                </li>
<?
    // ó�� ������(pp_cli_hub.php)���� ������ DBó�� �۾��� ������ ��� �󼼸޽����� ����մϴ�.
     if( !$res_msg_bsucc == "")
    {
?>
                <li>
                    <div class="left"><p class="title">��� �� �޼���</p></div>
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?= $res_msg_bsucc ?></div></div>
                </li>              
<?
    }
?>
            </ul>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   ���� ��� �ڵ� �� �޽��� ��� ��                                         = */
    /* ============================================================================== */
?>

<?
      /* ============================================================================== */
    /* =   01. ���� ��� ���                                                       = */
    /* = -------------------------------------------------------------------------- = */
  if ( $req_tx == "pay" )                           // �ŷ� ���� : ����
    {
        /* ============================================================================== */
        /* =  01-1. ��ü DB ó�� ���� (bSucc���� false�� �ƴ� ���)                     = */
        /* = -------------------------------------------------------------------------- = */
        if ( $bSucc != "false" )                      // ��ü DB ó�� ����
        {
            /* ============================================================================== */
            /* =  01-1-1. ���� ������ ���� ��� ��� (res_cd���� 0000�� ���)               = */
            /* = -------------------------------------------------------------------------- = */
            if ( $res_cd == "0000" )                  // ���� ����
            {
?>
                <div class="line-type-1"></div>
                <!-- �ֹ����� -->
                <h2 class="title-type-3">�ֹ�����</h2>
                <ul class="list-type-1">
                    <!-- �ֹ���ȣ(ordr_idxx) -->
                    <li>
                        <div class="left"><p class="title">�ֹ���ȣ</p></div>
                        <div class="right"><div class="ipt-type-1 pc-wd-2"><?= $ordr_idxx ?></div></div>
                    </li>
                    <!-- KCP �ŷ���ȣ(tno) -->
                    <li>
                        <div class="left"><p class="title">KCP �ŷ���ȣ</p></div>
                        <div class="right"><div class="ipt-type-1 pc-wd-2"><?= $tno ?></div></div>
                    </li>
                    <!-- ��ǰ��(good_name) -->
                    <li>
                        <div class="left"><p class="title">��ǰ��</p></div>
                        <div class="right"><?= $good_name ?></div>
                    </li>
                    <!-- �����ݾ�(amount) -->
                    <li>
                        <div class="left"><p class="title">�����ݾ�</p></div>
                        <div class="right"><?= $amount ?>��</div>
                    </li>
                    <!-- �ֹ��ڸ�(buyr_name) -->
                    <li>
                        <div class="left"><p class="title">�ֹ��ڸ�</p></div>
                        <div class="right"><?= $buyr_name ?></div>
                    </li>
                    <!-- �ֹ��� ����ó1(buyr_tel1) -->
                    <li>
                        <div class="left"><p class="title">��ȭ��ȣ</p></div>
                        <div class="right"><?= $buyr_tel1 ?></div>
                    </li>
                    <!-- �޴�����ȣ(buyr_tel2) -->
                    <li>
                        <div class="left"><p class="title">�޴�����ȣ</p></div>
                        <div class="right"><?= $buyr_tel2 ?></div>
                    </li>
                    <!-- �ֹ��� E-mail(buyr_mail) -->
                    <li>
                        <div class="left"><p class="title">E-mail</p></div>
                        <div class="right"><?= $buyr_mail ?></div>
                    </li>
                </ul>                
                <div class="line-type-1"></div>
            
<?
             /* ============================================================================== */
             /* =   �ſ�ī�� ���� ��� ���                                             = */
             /* = -------------------------------------------------------------------------- = */
               if ( $use_pay_method == "100000000000" )       // �ſ�ī��
                {
?>
            
                <div class="line-type-1"></div>
                <!-- �ֹ����� -->
                <h2 class="title-type-3">�ſ�ī�� ����</h2>
                <ul class="list-type-1">
                    <!-- �������� : �ſ�ī�� -->
                    <li>
                        <div class="left"><p class="title">���� ����</p></div>
                        <div class="right">�ſ�ī��</div>
                    </li>
                    <!-- ���� ī�� -->
                    <li>
                        <div class="left"><p class="title">���� ī��</p></div>
                        <div class="right"><?= $card_cd ?> / <?= $card_name ?></div>
                    </li>
                    <!-- ���νð� -->
                    <li>
                        <div class="left"><p class="title">���� �ð�</p></div>
                        <div class="right"><?= $app_time ?></div>
                    </li>
                    <!-- ���ι�ȣ -->
                    <li>
                        <div class="left"><p class="title">���� ��ȣ</p></div>
                        <div class="right"><?= $app_no ?></div>
                    </li>
                    <!-- �Һΰ��� -->
                    <li>
                        <div class="left"><p class="title">�Һ� ����</p></div>
                        <div class="right"><?= $quota ?></div>
                    </li>
                    <!-- ������ ���� -->
                    <li>
                        <div class="left"><p class="title">������ ����</p></div>
                        <div class="right"><?= $noinf ?></div>
                    </li>
<?                  
                    /* ============================================================================== */
                    /* =   �ſ�ī�� ������ ���                                                     = */
                    /* = -------------------------------------------------------------------------- = */
                    /* =   ���� �ŷ��ǿ� ���ؼ� �������� ����� �� �ֽ��ϴ�.                        = */
                    /* = -------------------------------------------------------------------------- = */
?>
                    <li>
                        <div class="left"><p class="title">������ Ȯ��</p></div>
                        <div class="right"><a href="javascript:receiptView('<?= $tno ?>','<?= $ordr_idxx ?>','<?= $amount ?>')">�������� Ȯ���մϴ�.</a></div>
                    </li>
				</ul>                
                <div class="line-type-1"></div>	
<?
                    /* = -------------------------------------------------------------- = */
                    /* =   ���հ���(����Ʈ+�ſ�ī��) ���� ��� ó��  (����Ʈ����)       = */
                    /* = -------------------------------------------------------------- = */
                    if ( $pnt_issue == "SCSK" || $pnt_issue == "SCWB" )
                    {
?>
                <div class="line-type-1"></div>
                <h2 class="title-type-3">����Ʈ ����</h2>
                <ul class="list-type-1">
                    <!-- ����Ʈ�� -->
                    <li>
                        <div class="left"><p class="title">����Ʈ��</p></div>
                        <div class="right"><?= $pnt_issue ?></div>
                    </li>
                    <!-- ����Ʈ ���νð� -->
                    <li>
                        <div class="left"><p class="title">����Ʈ ���νð�</p></div>
                        <div class="right"><?= $pnt_app_time ?></div>
                    </li>
                    <!-- ����Ʈ ���ι�ȣ -->
                    <li>
                        <div class="left"><p class="title">����Ʈ ���ι�ȣ</p></div>
                        <div class="right"><?= $pnt_app_no ?></div>
                    </li>
                    <!-- �����ݾ� or ���ݾ� -->
                    <li>
                        <div class="left"><p class="title">�����ݾ� or ���ݾ�</p></div>
                        <div class="right"><?= $pnt_amount ?></div>
                    </li>
                    <!-- �߻� ����Ʈ -->
                    <li>
                        <div class="left"><p class="title">�߻� ����Ʈ</p></div>
                        <div class="right"><?= $add_pnt ?></div>
                    </li>
                    <!-- ��밡�� ����Ʈ -->
                    <li>
                        <div class="left"><p class="title">��밡�� ����Ʈ</p></div>
                        <div class="right"><?= $use_pnt ?></div>
                    </li>
                    <!-- �� ���� ����Ʈ -->
                    <li>
                        <div class="left"><p class="title">�� ���� ����Ʈ</p></div>
                        <div class="right"><?= $rsv_pnt ?></div>
                    </li>
                </ul> 
                <div class="line-type-1"></div>
<?                  }
				}
                /* ============================================================================== */
                /* =   ������ü ���� ��� ���                                                  = */
                /* = -------------------------------------------------------------------------- = */
                  else if ( $use_pay_method == "010000000000" )       // ������ü
                {
?>
                <div class="line-type-1"></div>
                <h2 class="title-type-3">������ü ����</h2>
                <ul class="list-type-1">
                    <!-- �������� : ������ü -->
                    <li>
                        <div class="left"><p class="title">���� ����</p></div>
                        <div class="right">������ü</div>
                    </li>
                    <!-- ��ü ���� -->
                    <li>
                        <div class="left"><p class="title">��ü ����</p></div>
                        <div class="right"><?= $bank_name ?></div>
                    </li>
                    <!-- ��ü �����ڵ� -->
                    <li>
                        <div class="left"><p class="title">��ü �����ڵ�</p></div>
                        <div class="right"><?= $bank_code ?></div>
                    </li>
                    <!-- ���� �ð� -->
                    <li>
                        <div class="left"><p class="title">���� �ð�</p></div>
                        <div class="right"><?= $app_time ?></div>
                    </li>
                </ul>
                <div class="line-type-1"></div>
<?
                }
                /* ============================================================================== */
                /* =   ������� ���� ��� ���                                                  = */
                /* = -------------------------------------------------------------------------- = */
                else if ( $use_pay_method == "001000000000" )       // �������
                {
?>
                <div class="line-type-1"></div>
                <h2 class="title-type-3">������� ����</h2>
                <ul class="list-type-1">
                    <!-- �������� : ������� -->
                    <li>
                        <div class="left"><p class="title">���� ����</p></div>
                        <div class="right">�������</div>
                    </li>
                    <!-- �Ա����� -->
                    <li>
                        <div class="left"><p class="title">�Ա� ����</p></div>
                        <div class="right"><?= $bankname ?></div>
                    </li>
                    <!-- �Աݰ��� ������ -->
                    <li>
                        <div class="left"><p class="title">�Ա��� ���� ������</p></div>
                        <div class="right"><?= $depositor ?></div>
                    </li>
                    <!-- �Աݰ��� ��ȣ -->
                    <li>
                        <div class="left"><p class="title">�Ա��� ���� ��ȣ</p></div>
                        <div class="right"><?= $account ?></div>
                    </li>
                    <!-- ������� �Աݸ����ð� -->
                    <li>
                        <div class="left"><p class="title">������� �Աݸ����ð�</p></div>
                        <div class="right"><?= $va_date ?></div>
                    </li>
                    <!-- ������� �����Ա�(�׽�Ʈ��) -->
                    <li>
                        <div class="left"><p class="title">������� �����Ա�</br>(�׽�Ʈ�� ���)</p></div>
                        <div class="right"><a href="javascript:receiptView3()">�����Ա�<a/></div>
                    </li>
                </ul>
                <div class="line-type-1"></div>
<?
                }
                /* ============================================================================== */
                /* =   ����Ʈ ���� ��� ���                                                    = */
                /* = -------------------------------------------------------------------------- = */
                else if ( $use_pay_method == "000100000000" )         // ����Ʈ
                {
?>
                <div class="line-type-1"></div>
                <h2 class="title-type-3">����Ʈ ����</h2>
                <ul class="list-type-1">
                    <!-- �������� : ����Ʈ -->
                    <li>
                        <div class="left"><p class="title">���� ����</p></div>
                        <div class="right">����Ʈ</div>
                    </li>
                    <!-- ����Ʈ�� -->
                    <li>
                        <div class="left"><p class="title">����Ʈ��</p></div>
                        <div class="right"><?= $pnt_issue ?></div>
                    </li>
                    <!-- ����Ʈ ���νð� -->
                    <li>
                        <div class="left"><p class="title">����Ʈ ���νð�</p></div>
                        <div class="right"><?= $pnt_app_time ?></div>
                    </li>
                    <!-- ����Ʈ ���ι�ȣ -->
                    <li>
                        <div class="left"><p class="title">����Ʈ ���ι�ȣ</p></div>
                        <div class="right"><?= $pnt_app_no ?></div>
                    </li>
                    <!-- �����ݾ� or ���ݾ� -->
                    <li>
                        <div class="left"><p class="title">�����ݾ� or ���ݾ�</p></div>
                        <div class="right"><?= $pnt_amount ?></div>
                    </li>
                    <!-- �߻� ����Ʈ -->
                    <li>
                        <div class="left"><p class="title">�߻� ����Ʈ</p></div>
                        <div class="right"><?= $add_pnt ?></div>
                    </li>
                    <!-- ��밡�� ����Ʈ -->
                    <li>
                        <div class="left"><p class="title">��밡�� ����Ʈ</p></div>
                        <div class="right"><?= $use_pnt ?></div>
                    </li>
                    <!-- �� ���� ����Ʈ -->
                    <li>
                        <div class="left"><p class="title">�� ���� ����Ʈ</p></div>
                        <div class="right"><?= $rsv_pnt ?></div>
                    </li>
                </ul>
                <div class="line-type-1"></div>
                                    
<?
                }
                /* ============================================================================== */
                /* =   �޴��� ���� ��� ���                                                    = */
                /* = -------------------------------------------------------------------------- = */
                 else if ( $use_pay_method == "000010000000" )       // �޴���
                {
?>
                <div class="line-type-1"></div>
                <h2 class="title-type-3">�޴��� ����</h2>
                <ul class="list-type-1">
                    <!-- �������� : �޴��� -->
                    <li>
                        <div class="left"><p class="title">���� ����</p></div>
                        <div class="right">�޴���</div>
                    </li>
                    <!-- ���� �ð� -->
                    <li>
                        <div class="left"><p class="title">���� �ð�</p></div>
                        <div class="right"><?= $app_time ?></div>
                    </li>
                    <!-- ��Ż��ڵ� -->
                    <li>
                        <div class="left"><p class="title">��Ż� �ڵ�</p></div>
                        <div class="right"><?= $commid ?></div>
                    </li>
                    <!-- �޴��� ��ȣ -->
                    <li>
                        <div class="left"><p class="title">�޴��� ��ȣ</p></div>
                        <div class="right"><?= $mobile_no ?></div>
                    </li>
                </ul>
                <div class="line-type-1"></div>
                    
<?
                }
                /* ============================================================================== */
                /* =   ��ǰ�� ���� ��� ���                                                    = */
                /* = -------------------------------------------------------------------------- = */
                 else if ( $use_pay_method == "000000001000" )       // ��ǰ��
                {
?>
                <div class="line-type-1"></div>
                <h2 class="title-type-3">��ǰ�� ����</h2>
                <ul class="list-type-1">
                    <!-- �������� : ��ǰ�� -->
                    <li>
                        <div class="left"><p class="title">���� ����</p></div>
                        <div class="right">��ǰ��</div>
                    </li>
                    <!-- �߱޻� �ڵ� -->
                    <li>
                        <div class="left"><p class="title">�߱޻� �ڵ�</p></div>
                        <div class="right"><?= $tk_van_code ?></div>
                    </li>
                    <!-- ���� �ð� -->
                    <li>
                        <div class="left"><p class="title">���� �ð�</p></div>
                        <div class="right"><?= $app_time ?></div>
                    </li>
                    <!-- ���� ��ȣ -->
                    <li>
                        <div class="left"><p class="title">���� ��ȣ</p></div>
                        <div class="right"><?= $tk_app_no ?></div>
                    </li>
                </ul>
                <div class="line-type-1"></div>
<?
                }
                /* ============================================================================== */
                /* =   ���ݿ����� ���� ���                                                     = */
                /* = -------------------------------------------------------------------------- = */
                 if ( $cash_yn != "" )
                {
                    if ( $use_pay_method == "010000000000" | $use_pay_method =="001000000000"  )
                    {
?>
                <!-- ���ݿ����� ���� ���-->
                <div class="line-type-1"></div>
                <h2 class="title-type-3">���ݿ����� ����</h2>
                <ul class="list-type-1">
                    <!-- �������� : ��ǰ�� -->
                    <li>
                        <div class="left"><p class="title">���ݿ����� ��Ͽ���</p></div>
                        <div class="right"><?= $cash_yn ?></div>
                    </li>
<?
                    //���ݿ������� ��ϵ� ��� ���ι�ȣ ���� ����
                     if ($cash_authno != "")
                        {
?>
                    <!-- ���ݿ����� ���ι�ȣ -->
                    <li>
                        <div class="left"><p class="title">���ݿ����� ���ι�ȣ</p></div>
                        <div class="right"><?= $cash_authno ?></div>
                    </li>
                    <!-- ���� �ð� -->
                    <li>
                        <div class="left"><p class="title">���ݿ����� �ŷ���ȣ</p></div>
                        <div class="right"><?= $cash_no ?></div>
                    </li>
                    <!-- ������ Ȯ�� -->
                    <li>
                        <div class="left"><p class="title">���ݿ����� Ȯ��</p></div>
                        <div class="right"><a href="javascript:receiptView2('<?= $cash_no ?>','<?= $ordr_idxx ?>','<?= $amount ?>')">�������� Ȯ���մϴ�.</a></div>
                    </li>
<?
                    }
?>
                </ul>
                <div class="line-type-1"></div>
                                    
<?
                    }
                }
            }
            /* = -------------------------------------------------------------------------- = */
            /* =   01-1-1. ���� ������ ���� ��� ��� END                                   = */
            /* ============================================================================== */
        }
        /* = -------------------------------------------------------------------------- = */
        /* =   01-1. ��ü DB ó�� ���� END                                              = */
        /* ============================================================================== */
    }
    /* = -------------------------------------------------------------------------- = */
    /* =   01. ���� ��� ��� END                                                   = */
    /* ============================================================================== */
?>
        <div Class="Line-Type-1"></div>
            <ul class="list-btn-2">
                <li><a href="../index.html" class="btn-type-3 pc-wd-2">ó������</a></li>
            </ul>
        </div>
        <!-- //contents -->
        <div class="grid-footer">
            <div class="inner">
                <!-- footer -->
                <div class="footer">
                    �� NHN KCP Corp.
                </div>
                <!-- //footer -->
            </div>
        </div>
    </form>
</div>  
</body>
</html>