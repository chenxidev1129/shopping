<?php
    //**************************************************************************************************************
    //NICE������ Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
    
    //���񽺸� :  üũ�÷��� - �Ƚɺ������� ����
    //�������� :  üũ�÷��� - ��� ������
    
    //������ ���� �����ص帮�� ������������ ���� ���� �� �������� ������ �ֽñ� �ٶ��ϴ�. 
    //**************************************************************************************************************
    
	session_start();
	
		/*****************************
	  //����ġ���� ��� �ε尡 ���� �ʾ������ �������� ����� �ε��մϴ�.
	
		if(!extension_loaded('CPClient')) {
			dl('CPClient.' . PHP_SHLIB_SUFFIX);
		}
		$module = 'CPClient';
		*****************************/
	
    $sitecode = "";					// NICE�κ��� �ο����� ����Ʈ �ڵ�
    $sitepasswd = "";				// NICE�κ��� �ο����� ����Ʈ �н�����
    
    
    $enc_data = $_POST["EncodeData"];		// ��ȣȭ�� ��� ����Ÿ
    $sReserved1 = $_POST['param_r1'];		
		$sReserved2 = $_POST['param_r2'];
		$sReserved3 = $_POST['param_r3'];

		//////////////////////////////////////////////// ���ڿ� ����///////////////////////////////////////////////
    if(preg_match('~[^0-9a-zA-Z+/=]~', $enc_data, $match)) {echo "�Է� �� Ȯ���� �ʿ��մϴ� : ".$match[0]; exit;} // ���ڿ� ���� �߰�. 
    if(base64_encode(base64_decode($enc_data))!=$enc_data) {echo "�Է� �� Ȯ���� �ʿ��մϴ�"; exit;}
    
    if(preg_match("/[#\&\\+\-%@=\/\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sReserved1, $match)) {echo "���ڿ� ���� : ".$match[0]; exit;}
    if(preg_match("/[#\&\\+\-%@=\/\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sReserved2, $match)) {echo "���ڿ� ���� : ".$match[0]; exit;}
    if(preg_match("/[#\&\\+\-%@=\/\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sReserved3, $match)) {echo "���ڿ� ���� : ".$match[0]; exit;}
		///////////////////////////////////////////////////////////////////////////////////////////////////////////
		
    if ($enc_data != "") {

				//if (extension_loaded($module)) {// �������� ��� �ε� �������
					$plaindata = get_decode_data($sitecode, $sitepasswd, $enc_data);// ��ȣȭ�� ��� �������� ��ȣȭ
				//} else {
				//	$plaindata = "Module get_response_data is not compiled into PHP";
				//}
        
        echo "[plaindata]  " . $plaindata . "<br>";

        if ($plaindata == -1){
            $returnMsg  = "��/��ȣȭ �ý��� ����";
        }else if ($plaindata == -4){
            $returnMsg  = "��ȣȭ ó�� ����";
        }else if ($plaindata == -5){
            $returnMsg  = "HASH�� ����ġ - ��ȣȭ �����ʹ� ���ϵ�";
        }else if ($plaindata == -6){
            $returnMsg  = "��ȣȭ ������ ����";
        }else if ($plaindata == -9){
            $returnMsg  = "�Է°� ����";
        }else if ($plaindata == -12){
            $returnMsg  = "����Ʈ ��й�ȣ ����";
        }else{
            // ��ȣȭ�� �������� ��� �����͸� �Ľ��մϴ�.
              
            $requestnumber = GetValue($plaindata , "REQ_SEQ");
            $responsenumber = GetValue($plaindata , "RES_SEQ");
            $authtype = GetValue($plaindata , "AUTH_TYPE");
            $name = GetValue($plaindata , "NAME");
            $birthdate = GetValue($plaindata , "BIRTHDATE");
            $gender = GetValue($plaindata , "GENDER");
            $nationalinfo = GetValue($plaindata , "NATIONALINFO");	//��/�ܱ�������(����� �Ŵ��� ����)
            $dupinfo = GetValue($plaindata , "DI");
            $conninfo = GetValue($plaindata , "CI");

            if(strcmp($_SESSION["REQ_SEQ"], $requestnumber) != 0)
            {
            	echo "���ǰ��� �ٸ��ϴ�. �ùٸ� ��η� �����Ͻñ� �ٶ��ϴ�.<br>";
                $requestnumber = "";
                $responsenumber = "";
                $authtype = "";
                $name = "";
            		$birthdate = "";
            		$gender = "";
            		$nationalinfo = "";
            		$dupinfo = "";
            		$conninfo = "";
            }
        }
    }
?>

<?
    function GetValue($str , $name)
    {
        $pos1 = 0;  //length�� ���� ��ġ
        $pos2 = 0;  //:�� ��ġ

        while( $pos1 <= strlen($str) )
        {
            $pos2 = strpos( $str , ":" , $pos1);
            $len = substr($str , $pos1 , $pos2 - $pos1);
            $key = substr($str , $pos2 + 1 , $len);
            $pos1 = $pos2 + $len + 1;
            if( $key == $name )
            {
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $value = substr($str , $pos2 + 1 , $len);
                return $value;
            }
            else
            {
                // �ٸ��� ��ŵ�Ѵ�.
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $pos1 = $pos2 + $len + 1;
            }            
        }
    }
?>

<html>
<head>
    <title>NICE������ - CheckPlus �������� �׽�Ʈ</title>
</head>
<body>
    <center>
    <p><p><p><p>
    ���������� �Ϸ� �Ǿ����ϴ�.<br>
    <table border=1>

        <tr>
            <td>��û ��ȣ</td>
            <td><?= $requestnumber ?></td>
        </tr>            
        <tr>
            <td>���������� ��ȣ</td>
            <td><?= $responsenumber ?></td>
        </tr>            
        <tr>
            <td>��������</td>
            <td><?= $authtype ?></td>
        </tr>
                <tr>
            <td>����</td>
            <td><?= $name ?></td>
        </tr>
                <tr>
            <td>�������</td>
            <td><?= $birthdate ?></td>
        </tr>
                <tr>
            <td>����</td>
            <td><?= $gender ?></td>
        </tr>
                <tr>
            <td>��/�ܱ�������</td>
            <td><?= $nationalinfo ?></td>
        </tr>
                <tr>
            <td>DI(64 byte)</td>
            <td><?= $dupinfo ?></td>
        </tr>
                <tr>
            <td>CI(88 byte)</td>
            <td><?= $conninfo ?></td>
        </tr>
        <tr>
          <td>RESERVED1</td>
          <td><?= $sReserved1 ?></td>
	      </tr>
	      <tr>
	          <td>RESERVED2</td>
	          <td><?= $sReserved2 ?></td>
	      </tr>
	      <tr>
	          <td>RESERVED3</td>
	          <td><?= $sReserved3 ?></td>
	      </tr>
    </table>
    </center>
</body>
</html>
