<?php


$countnum=count($_GET['w0']);
if($countnum>1){
	for($i=0;$i<($countnum-1);$i++){
	if($_GET['w6'][$i]==$_GET['w6'][($i+1)]){
		$ok=1;
	}else{
		$ok="";
	}
	}
}else{
	$ok=1;
}


if($ok){
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="CSS/1.css" type="text/css" rel="stylesheet" charset=utf-8 >
<script type="text/javascript" src="JS/1.js"></script>
<script type="text/javascript" src="JS/jquery-3.2.1.min.js"></script>
<link href='//imgcache.qq.com/qcloud/app/resource/ac/favicon.ico' rel='icon' type='image/x-icon'/>
</head>
<style>
body{
	margin:0;
	padding:0;
}
input{
	width:100%;
	height:25px;
    line-height:12px;
    margin:0px;
    padding:0px;
    border:0px solid black;
    color:black;
    cursor: pointer;
    resize: none;
    background:none;
	text-align:left;
	margin-top:0px;
	margin-left:0px;
	font-family: ;
	font-size:14px;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}
hr{
	border:none;border-top:1px solid black;width:80%
	
}
td{
	height:40px; font-size:14px;
}

</style>
<script>
$(document).ready(function(){	
	
})
</script>
<body style="background-color:">
<div style="width:1200px;height:820px;background-color:white;position:relative;background:">
	<div style="position:absolute;top:30px;width:100%;text-align:center;font-size:35px;">HYTERA送货单<hr></div>
	<div style="position:absolute;top:110px;width:100%;" align="center">
		<table width="95%" cellspacing="10" cellpadding="0">
			<tr>
				<td width="30%" valign="bottom">供 应 商: 朝日科技（上海）有限公司</td><td width="30%" valign="bottom">送货单号: <input type="text" value="<?php echo date('Ymd'); ?>" style="width:75px;"/></td><td><img src="http://barcode.cnaidc.com/html/cnaidc.php?filetype=PNG&dpi=72&scale=2&rotation=0&font_family=Arial.ttf&font_size=13&text=<?php echo $_GET['w6'][0]; ?>&thickness=30&start=NULL&code=BCGcode128"/></td>
			</tr>
			<tr>
				<td width="30%">结算单位: 深圳市诺萨特科技有限公司</td><td width="30%">收货单位:深圳市诺萨特科技有限公司</td><td>日 期: <input type="text" value="<?php echo date('Y-m-d'); ?>" style="width:75px;"/></td>
			</tr>
			<tr>
				<td width="30%" valign="top">联 系 人: 彭海茂</td><td width="30%" valign="top">联系电话: 0755-89788999-55013</td><td valign="top">交货地点: 深圳市龙岗区宝龙工业城宝龙四路3号海能达科技园<br> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; C栋收货平台</td>
			</tr>
		<table>
	</div>
	<div style="position:absolute;top:450px;width:100%;" align="center">
		<table width="99%" cellspacing="0" cellpadding="3" border="1">
			<tr align="center" bgcolor="#FFAAFF">
				<td><b>物料编码</b></td>
				<td><b>物料说明</b></td>
				<td><b>PO编号</b></td>
				<td><b>Po行号</b></td>
				<td><b>单位</b></td>
				<td><b>到货日期</b></td>
				<td><b>LPN号</b></td>
				<td><b>批次号/序列号</b></td>
				<td><b>批次<br>数量</b></td>
				<td><b>实收数量</b></td>
				<td><b>DATECODE</b></td>
				<td><b>供应商批次</b></td>
			</tr>
			<?php for($i=0;$i<$countnum;$i++){ ?>
			<tr>
				<td><input type="text" value="<?php echo $_GET['w0'][$i]; ?>" style="width:130px;"/></td>
				<td>【T1专用】(<input type="text" value="<?php echo $_GET['w1'][$i]; ?>" style="width:55px;text-align:center"/>)LED 白色<br>【多供应商】</td>
				<td><input type="text" value="<?php echo $_GET['w6'][$i]; ?>" style="width:90px;"/></td>
				<td></td>
				<td>PCS</td>
				<td><input type="text" value="<?php echo date('Y-m-d',(strtotime('+2 days', strtotime(date('Y-m-d'))))); ?>" style="width:75px;"/></td>
				<td></td>
				<td><input type="text" value="<?php echo $_GET['w4'][$i]; ?>" style="width:65px;"/></td>
				<td><input type="text" value="1" style="width:25px;"/></td>
				<td><input type="text" value="<?php echo $_GET['w5'][$i]; ?>" style="width:55px;"/></td>
				<td><input type="text" value="<?php echo $_GET['w3'][$i]; ?>" style="width:75px;"/></td>
				<td><input type="text" value="<?php echo $_GET['w4'][$i]; ?>" style="width:65px;"/></td>
			</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
	<div style="position:absolute;bottom:<?php echo 330-($countnum*40); ?>px;width:100%;" align="center">
		<table width="84%" cellspacing="0" cellpadding="3">
			<tr>
				<td width="25%">送货人：<input type="text" value="<?php echo $_COOKIE['loged']; ?>" style="width:75px;"/></td>
				<td width="25%">送日期（盖章）：<input type="text" value="<?php echo date('Y-m-d'); ?>" style="width:75px;"/></td>
				<td width="25%">收货人：</td>
				<td width="25%">收货日期（盖章）</td>
			</tr>
		</table>
	</div>
</div>	
</body>
<head>
<title>Hytera送货单(订单<?php echo $_GET['w6'][0]; ?>)</title>
</head>
<?php 
}else{
	for($i=0;$i<$countnum;$i++){
		echo $_GET['w1'][$i]."【".$_GET['w6'][$i]."】<br>";
	}
	echo "订单号码不一致";
}
?>