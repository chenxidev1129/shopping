<? 
function SMail($From,$Mail_from_name,$To,$Subject,$Text) { 
$Headers .= "Content-Type: text/html; charset=UTF-8"; 
$fp = popen("/home/bin/sendmail -t -f $From","w"); // �����Ͻ� �κ� if(!$fp) return false; 
fputs($fp,"from: =?utf-8?B?".base64_encode($Mail_from_name)."?=  <$From> 
"); // from �� : �� �ٿ��ּ��� => from: 
fputs($fp, "to: <$To> 
"); 
fputs($fp, "subject: $Subject 
"); 
fputs($fp, "$Headers 
"); 
fputs($fp, "$Text"); 
fputs($fp, " 
"); 
pclose($fp); 
return true; 
} 


$mail_from = "LEMONKENYA@lemonkenya.cafe24.com"; // ������ ��������ּ� 
$mail_to = "joilya@hanmail.net"; // �޴»�� �����ּ� 
$mail_from_name = "������ ����"; // ������ ��� �̸� 
$subject = \'=?UTF-8?B?\'.base64_encode("������ ����").\'?=\'; 
$contents = 
" 
<html> 
<body><br><br> 
<table border=1 cellpadding=5 align=center> 
<tr align=center bgcolor=#C0E0FF>! ;<td>ī��24 ȣ���� ������ ����</td></! tr> < br /><tr align=center bgcolor=#E0F0FF height=100>�� ���̺��� ���̸�, HTML ���ĸ����Դϴ�.</td></tr> 
</table> 
</body> 
</html> 

"; 

SMail($mail_from,$mail_from_name, $mail_to,$subject,$contents); 
echo "Sendmail mail()"; 
?> 
