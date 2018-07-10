<?php 
 echo "1";
// Pear Mail 扩展 
require_once('PHPMailer.php'); 
//require_once('Mail/mime.php'); 
require_once('SMTP.php'); 
 
$smtpinfo = array(); 
$smtpinfo["host"] = "smtp.126.com";//SMTP服务器 
$smtpinfo["port"] = "465"; //SMTP服务器端口 
$smtpinfo["username"] = "xn361208027@126.com"; //发件人邮箱 
$smtpinfo["password"] = "a361208027";//发件人邮箱密码 
$smtpinfo["timeout"] = 10;//网络超时时间，秒 
$smtpinfo["auth"] = true;//登录验证 
//$smtpinfo["debug"] = true;//调试模式 
  echo "2";
// 收件人列表 
$mailAddr = array('licy@asahi-rubber.com.cn'); 
 
// 发件人显示信息 
$from = "Name <xn361208027@126.com>"; 
 
// 收件人显示信息 
$to = implode(',',$mailAddr); 
 
// 邮件标题 
$subject = "这是一封测试邮件"; 
 
// 邮件正文 
$content = "<h3>随便写点什么</h3>"; 
 
// 邮件正文类型，格式和编码 
$contentType = "text/html; charset=utf-8"; 
 
//换行符号 Linux: \n Windows: \r\n 
$crlf = "\n";  echo "3";
$mime = new PHPMailer($crlf); 
$mime->setHTMLBody($content); 
  echo "4";
$param['text_charset'] = 'utf-8'; 
$param['html_charset'] = 'utf-8'; 
$param['head_charset'] = 'utf-8'; 
$body = $mime->get($param); 
  echo "5";
$headers = array(); 
$headers["From"] = $from; 
$headers["To"] = $to; 
$headers["Subject"] = $subject; 
$headers["Content-Type"] = $contentType; 
$headers = $mime->headers($headers); 
 
$smtp =& Mail::factory("smtp", $smtpinfo); 
 
  echo "6";
$mail = $smtp->send($mailAddr, $headers, $body); 
$smtp->disconnect(); 
  echo "7";
if (PEAR::isError($mail)) { 
  //发送失败 
  echo 'Email sending failed: ' . $mail->getMessage()."\n"; 
} 
else{ 
  //发送成功 
  echo "success!\n"; 
}

?>