<? 
$mail_from = "LEMONKENYA@lemonkenya.cafe24.com"; // ������ ��������ּ� 
$from_name = "������ ����"; // �����»�� �̸� 
$mail_to = "joilya@nate.com"; // �޴»�� �����ּ� 


$Headers = "from: =?utf-8?B?".base64_encode($from_name)."?= <$mail_from>n"; // from �� : �� �ٿ��ּ��� => from: 
$Headers .= "Content-Type: text/html;"; 

#$subject = \'=?UTF-8?B?\'.base64_encode("?! ??���� ���� - mail").\'?=\'; 
$subject = '=?UTF-8?B?'.base64_encode("mail send check").'?='; 


$contents = 
" 
<html> 
<body><br><br> 
<table border=1 cellpadding=5 align=center> 
<tr align=center bgcolor=#C0E0FF><td>ī��24 ȣ���� ������ ����</td></tr> 
<tr align=center bgcolor=#E0F0FF height=100>�� ���̺��� ���̸�, HTML ���ĸ����Դϴ�.</td></tr> 
</table> 
</body> 
</html> 
"; 

mail($mail_to,$subject,$contents,$Headers); 
echo "PHP mail()"; 
?> 
