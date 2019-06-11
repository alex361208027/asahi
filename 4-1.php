<?php
if($_COOKIE['loged']){
echo file_get_contents("templates/header.html");
	
if($_GET['asahit1']){
	$asahit1 = $_GET['asahit1'];
}else{
$asahit1 = $_POST['asahit1'];
}
$asahit22= $_GET['asahit22'];
if(empty($asahit1)&&!empty($asahit22)){
$asahit1=$asahit22;
}

$oordernum = $_POST['oordernum'];
$dd5 = $_POST['dd5'];
$_id =$_POST['_id'];


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";



date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');
$jjj=1;
$ccc=240;$mmm=1;
$nowpage=$_POST['nowpage'];
if(empty($nowpage)){
$nowpage=0;
}
$nowpagestart=$nowpage+1;
$nowpageend=$nowpage+10;
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

if($asahit1){
	$sql = "SELECT * FROM `t_postudent` WHERE asahiorder like '%$asahit1%' or remark like '%$asahit1%' order by orderdate desc limit $nowpage,10";
}else{
	$sql = "SELECT * FROM `t_postudent` WHERE 1 order by orderdate desc, _id desc limit $nowpage,10";
}
$result = $conn->query($sql);
$rowsnum=$result->num_rows;
 ?>
 <body style="padding:2%;font-size:12px;">
 <br> <br>

<style>
.class00{
	position:relative;
	overflow:hidden;max-height:120px;background-color:;width:600px;color:#555555;margin-bottom:-1px;
	/**-webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius:5px;**/
  -webkit-box-shadow: 0px 0px 10px #BBBBBB;
  -moz-box-shadow: 0px 0px 10px #BBBBBB;
  box-shadow: 0px 0px 10px #BBBBBB;
	transition:max-height 0.8s;
-moz-transition:max-height 0.8s; 
-webkit-transition:max-height 0.8s; 
-o-transition:max-height 0.8s; 
}

.class0{
	position:relative;
	width:100%;min-width:600px;margin-bottom:10px;overflow:hidden;height:120px;
}
.classlogo{
	position:absolute;background-color:white;padding-top:16px;
	top:30px;left:30px;
	text-align:center;font-size:20px;color:#FF9999;
	width:60px;height:40px;overflow:hidden;
	-webkit-border-radius: 30px;
  -moz-border-radius: 30px;
  border-radius: 30px;
  -webkit-box-shadow: 0px 3px 5px #BBBBBB;
  -moz-box-shadow: 0px 3px 5px #BBBBBB;
  box-shadow: 0px 3px 5px #BBBBBB;
}
.classcampany{
	position:absolute;
	top:48px;left:112px;
	font-size:18px;
}
.classordernum{
	position:absolute;
	top:30px;left:112px;
	font-size:16px;
}
.classtotle{
	position:absolute;
	top:-15px;right:-10px;
	font-size:65px;
	color:#CCCCCC;
}
.classremark{
	position:absolute;width:150px;background-color:;color:#A2A2A2;
	top:73px;left:112px;padding:;height:auto;text-align:left;
}
.classpreson{
	position:absolute;
	bottom:25px;right:3px;color:#CCCCCC;
}
.classdate{
	position:absolute;
	bottom:10px;right:3px;color:#CCCCCC;
}
.classcplb{
 padding:10px;background-color:;position:relative;min-height:100px;padding-bottom:50px;
}
.classcomplete{
	position:absolute;
	top:30px;left:360px;
}
.classcp{
	width:92%;background-color:;padding:5px;color:;margin-bottom:5px;

}
.classcaozuo{
	position:absolute;top:48px;right:200px;
}

</style>
<div align="center">
<?php while($row=$result->fetch_row()){ 
	$sql2 =  "SELECT * FROM `t_poteacher` WHERE asahiorder = '$row[0]'";
	$result2 = mysqli_query($conn,$sql2);
	$totle2=$result2->num_rows;
	$sql3 =  "SELECT * FROM `t_poteacher` WHERE asahiorder = '$row[0]' AND state = '已入库'";
	$result3 = mysqli_query($conn,$sql3);
	$totle3=$result3->num_rows;
if($totle2 == $totle3){
		$bgcolor='#FFFFCC';
	}else{
		$bgcolor='';
	}
	?>
            <div class="class00" style="background-color:rgb(<?php echo '255'; ?>,<?php echo $ccc; ?>,<?php echo $ccc;if($ccc<231){$ccc=240;}else{$ccc=$ccc-5;} ?>);background-color:<?php echo $bgcolor; ?>" >
		
			<div class="class0" >
				<div class="classlogo" align="center"><b>朝日</b></div>
                <div class="classcampany">朝日科技</div>
				<div class="classordernum"><a href="6.php?php4-1ordernum=<?php echo $row[0] ?>"><?php echo $row[0]; ?></a></div>
				<div class="classtotle"><font size="55px" color="#DDDDDD"><?php echo $totle3."/</font><b>".$totle2;?></b></div>
				<div class="classremark"><!--<marquee scrolldelay="300">--><?php echo $row[3] ?><!--</marquee>--></div>
				<div class="classcaozuo">
					<div onclick="po_order('_id=<?php echo $row[5] ?>&t1=<?php echo $row[0] ?>&t2=<?php echo $row[1] ?>&t4=<?php echo $row[3] ?>')" class="classcp1">修改订单</div>
					<a href="7-2.php?t1=<?php echo $row[0] ?>&t6=<?php echo $row[3] ?>"><div class="classcp1">添加产品</div></a><br>
					<div class="classcp1" >内容概要</div>
				</div>
				<?php 
				if($totle2 == $totle3&&$totle2<>0){
				echo "<div class='classcomplete'><img src='img/wancheng.png'/></div>";
				}
				?>
			</div>	
			<div class="classcplb" align="center">
			<?php
				while($row2=$result2->fetch_row()){
							if($row2[8] == '已入库'){
								$bgimg='#BBBBFF';$states='已到货';
							}elseif($row2[3] == 0){
								$bgimg='#000000';$states='等待纳期';
							}elseif($row2[3] > date('Y-m-d')){
								$bgimg='#00DDB1';$states='生产中';
							}elseif($row2[3] == date('Y-m-d')){
								$bgimg='#FF7792';$states='日本发货';
							}elseif(date('Y-m-d',(strtotime('+4 days',strtotime($row2[3])))) >= date('Y-m-d')){
								$bgimg='#FF7792';$states='通关中';
							}else{
								$bgimg='#999999';$states='等待入库';
							}
			?>
			<a href="6.php?php4-1ordernum=<?php echo $row[0] ?>"><div class="classcp" align="left">
			<div class="classcp1" style="background-color:<?php echo $bgimg; ?>"><?php echo $states; ?></div><?php echo $row2[1]." &nbsp; <b>".$row2[2]."</b>pcs &nbsp<".$row2[5].">&nbsp";if(empty($row2[10])){echo "<font color='red'>未匹配</font>&nbsp";} if($row2[3]==0||empty($row2[3])){echo "希望交期:<b>".$row2[4];}else{echo "日本出荷:<b>".$row2[3];} ?></b>
			</div></a>
			<?php }	?>
			</div>
			<div class="classdate"><?php echo $row[1] ?></div>
			<div class="classpreson">Created By <?php echo $row[4] ?></div>
		</div>
<?php } ?>

<div class="message" >
<?php $nowpages=$nowpageend/10;echo "本页显示数：(".$rowsnum.") / 第".$nowpages."页"; ?>
</div>
<br>
<form action="4-1.php" method="post">
<?php $nowpage=$nowpage+10; ?>
<input type="hidden" name="nowpage" value="<?php echo $nowpage ?>"/>
<input type="hidden" name="t1" value="<?php echo $t1 ?>"/><input type="hidden" name="t3" value="<?php echo $t3 ?>"/><input type="hidden" name="t4" value="<?php echo $t4 ?>"/>
<?php if($rowsnum>=10){ ?><input type="submit" value=" &nbsp; " style="background:url('img/next.png') no-repeat; width:46px; height:32px;"><?php } ?>
</form>
</div>
<div class="tishi">朝日订单页面</div>
  <br><br><br><br>
    <!--ajas-->
<style>

.ajasdivout{
	position:fixed;right:0px;top:18px;min-height:400px;width:350px;background-color:white;
	-webkit-box-shadow: -8px 4px 18px #BBBBBB;
  -moz-box-shadow: -8px 4px 18px #BBBBBB;
  box-shadow: -8px 4px 18px #BBBBBB;
	transition: all 1s;
-moz-transition: all 1s;	/* Firefox 4 */
-webkit-transition: all 1s;	/* Safari 和 Chrome */
-o-transition: all 1s;
}
.ajasdivout2{
	position:fixed;right:0px;top:18px;min-height:400px;max-height:500px;overflow-x:hidden;overflow-y:scroll;width:400px;background-color:white;
	-webkit-box-shadow: -8px 4px 18px #BBBBBB;
  -moz-box-shadow: -8px 4px 18px #BBBBBB;
  box-shadow: -8px 4px 18px #BBBBBB;
	transition: all 1s;
-moz-transition: all 1s;	/* Firefox 4 */
-webkit-transition: all 1s;	/* Safari 和 Chrome */
-o-transition: all 1s;
}
.ajasdivx{
	position:absolute;right:0px;top:0px;background-color:;font-size:20px
}
input[type="date"],
input[type="text"],
input[type="button"],
input[type="password"],
input[type="email"],
input[type="submit"],
input[type="tel"],
.inputlist{
	width:auto;
    height: auto;
    line-height: 16px;
    margin: 0;
    padding: 0;
    border: none;
    color:#666666 ;
    cursor: pointer;
    resize: none;
    /**border-bottom:1px solid #AAAAAA;**/
    background:none;
	text-align:left;
	margin-top:0px;
	margin-left:0px;
	font-family: Arial;
	font-size:12px;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}
</style>

  
  
  
  
  
  </body>
  <?php

 $conn->close();
 echo file_get_contents("templates/footer.html"); 
}else{
	echo $_COOKIE['loged']." login?";
} 
?>