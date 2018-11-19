<?php
require_once("./src/PHPMailer.php"); 
require_once("./src/SMTP.php");
	
	use PHPMailer\PHPMailer;
 
/*发送邮件方法
 *@param $to：接收者 $title：标题 $content：邮件内容
 *@return bool true:发送成功 false:发送失败
 */
 
function sendMail($to,$tocc,$title,$content){
	
 
    //实例化PHPMailer核心类
    $mail = new PHPMailer\PHPMailer();
 
    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 1;
 
    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();
 
    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth=true;
 
    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.exmail.qq.com';
 
    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
 
    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 465;
 
    //设置smtp的helo消息头 这个可有可无 内容任意
    //$mail->Helo = 'Hello smtp.qq.com Server';
 
    //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
    //$mail->Hostname = 'http://zhaozhXXXxg.cn';
 
    //设置发送的邮件的编码 可选GB2312  据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';
 
    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = 'Licy';
 
    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username ='licy@asahi-rubber.com.cn';
 
    //smtp登录的密码 使用生成的授权码
    $mail->Password = 'n2EYzFz6xsGCrDT5';
 
    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = 'licy@asahi-rubber.com.cn';
 
    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true); 
 
	$to=explode(";",$to);
	foreach($to as $to){
    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
	$mail->addAddress($to,'');
	}
	
	if($tocc){
		$tocc=explode(";",$tocc);
		foreach($tocc as $tocc){
		$mail->addCC($tocc,''); 
		}
	}
	
 
    //添加该邮件的主题
    $mail->Subject = $title;
 
    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $content;
 
    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    
	//$mail->addAttachment('./55.jpg','head.jpg');

	
	
	
    $status = $mail->send();
 
    //简单的判断与提示信息
    if($status) {
        return true;
    }else{
        return false;
    }
}

$post_to=$_POST['to'];
$post_tocc=$_POST['tocc'];
$post_title=$_POST['title'];
$post_content=$_POST['content'];
//echo $post_to.$post_tocc.$post_title.$post_content;

$flag = sendMail($post_to,$post_tocc,$post_title,$post_content);
//$flag = sendMail('361208027@qq.com','licy@asahi-rubber','title','content');
if($flag){
    echo "成功！";
}else{
    echo "发送失败！";
}

?>