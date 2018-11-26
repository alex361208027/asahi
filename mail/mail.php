<?php
require_once("./src/PHPMailer.php"); 
require_once("./src/SMTP.php");
	
	use PHPMailer\PHPMailer;
 
/*发送邮件方法
 *@param $to：接收者 $title：标题 $content：邮件内容
 *@return bool true:发送成功 false:发送失败
 */
 
function sendMail($tobcc,$title,$content){
	
 
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
    $mail->FromName = '朝日科技系统';
 
    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username ='licy@asahi-rubber.com.cn';
 
    //smtp登录的密码 使用生成的授权码
    $mail->Password = 'n2EYzFz6xsGCrDT5';
 
    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = 'licy@asahi-rubber.com.cn';
 
    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true); 
	
	$mail->addAddress('licy@asahi-rubber.com.cn','');
 
	if($tobcc){
		$tobcc=explode(";",$tobcc);
		foreach($tobcc as $tobcc){
		$mail->addBCC($tobcc,'');
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
/////////////////BBBBBB//////////////////////
$post_to=file_get_contents("post_to.html");
//$post_tocc=$_POST['tocc'];
date_default_timezone_set('PRC');
$ddd=0;
if(date("w")==6 || date("w")==0){
	
}else{
	
if(date("w")==5){
	$ddd=2;
}

$today=date('Y-m-d',strtotime('+'.$ddd.' day'));
$post_title="【朝日科技】发货提醒".date('Y-m-d');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$sql="SELECT * FROM `t_teacher` WHERE state = '' AND SHdate <> '0000-00-00' AND SHdate <= '$today' AND asahiorder2 <> '' order by SHdate,campany,ordernum,hopedate,banngo asc";
$result=mysqli_query($conn,$sql);

$table="<tr style='background:black;color:#fff;height:30px;'><td>客户名</td><td>订单号</td><td>品番</td><td>数量</td><td>订单纳期</td><td>备注</td></tr>";

while($row=$result->fetch_row()){
	if($row[1]){$key=1;}else{$key=0;}
	$table=$table."<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[8]."</td></tr>";
}

$post_content="【朝日科技】今日发货提醒：<br><br>"."<table>".$table."</table>"."<br>详情请进入<a href='http://www.asahi-rubber.cn' target='_BLANK'>系统</a><br><br>";

echo $post_to."<br>".$post_title."<br>".$post_content;


$conn->close();
//////////////////BBBBBB//////////////////////


if($key){
$flag = sendMail($post_to,$post_title,$post_content);
}

}

if($flag){
    echo "成功！";
}else{
    echo "发送失败！";
}
?>
<script type="text/javascript" src="../JS/jquery-3.2.1.min.js"></script>
<script>
function close(){
	setTimeout("window.location.href='about:blank';window.close();",10000);
}
</script>
<body onload="close()">
<br><br><br><br>执行完毕，可以关闭
</body>