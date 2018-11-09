<?php
echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');
$today25=date('Y-m-d',strtotime('-6 months'));
$today35=date('Y-m-d',strtotime('-11 months'));

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$customer_id=$_GET['_id'];


$customerradio=$_POST['customerradio'];
$asahiradio=$_POST['asahiradio'];
if($customerradio&&$asahiradio){
	$customerradio_result = mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE _id='$customerradio'")->fetch_row();
	$asahiradio_result = mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$asahiradio'")->fetch_row();
	if($customerradio_result[3]==$asahiradio_result[2]){
		
		if($customerradio_result[13]){
			mysqli_query($conn,"UPDATE `t_poteacher` SET campanyorder='', hopedate='', customer_id='' WHERE _id='$customerradio_result[13]'");
		}
		if($asahiradio_result[10]){
			mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='', JPdate='',SHdate='',po_id='' WHERE _id = '$asahiradio_result[10]'");
		}
		
		$hopedate5 = date('Y-m-d',(strtotime('+5 days',strtotime($asahiradio_result[3]))));
		if($hopedate5<=$customerradio_result[4]){
		$SHdate= date('Y-m-d',(strtotime('-2 days',strtotime($customerradio_result[4]))));
		}else{
		$SHdate= $hopedate5;if($asahiradio_result[3]==0){$SHdate=0;}
		}
		
		mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='$asahiradio_result[0]', JPdate='$asahiradio_result[3]',SHdate='$SHdate',po_id='$asahiradio_result[9]',asahiorder2='$asahiradio_result[8]' WHERE _id = '$customerradio'");
		mysqli_query($conn,"UPDATE `t_poteacher` SET campany='$customerradio_result[0]', campanyorder='$customerradio_result[1]', hopedate='$customerradio_result[4]', customer_id='$customerradio_result[12]' WHERE _id='$asahiradio'");
		$echo=$customerradio_result[1]."<--匹配成功-->".$asahiradio_result[0];
	}else{
		$echo="数量不正确".$customerradio_result[3]."=?=".$asahiradio_result[2];
	}
}

if($_GET['c1']){
	$c1=$_GET['c1'];
}else{
	$c1=$_POST['c1'];
}
if($_GET['c2']){
	$c2=$_GET['c2'];
}else{
	$c2=$_POST['c2'];
}
if($_GET['po1']){
	$po1=$_GET['po1'];
}else{
	$po1=$_POST['po1'];
}
if($_GET['po2']){
	$po2=$_GET['po2'];
}else{
	$po2=$_POST['po2'];
}

if($c1){
	$select_c1="ordernum like '%$c1%' ";
}else{
	$select_c1="po_id='' AND state= '' ";
}
if($c2){
	$select_c2="AND banngo like '%$c2%'";
}else{
	$select_c2="";
}


if($po1){
	$select_po1="asahiorder like '%$po1%' AND ";
}else{
	$select_po1="customer_id='' AND ";
}
if($po2){
	$select_po2="banngo like '%$po2%' AND (JPdate = 0 OR JPdate >= '$today35')";
	$resultzaiku=mysqli_query($conn,"SELECT * FROM `t_inout` WHERE (outquantity = 0 OR outquantity is null) AND banngo like '%$po2%'");
}else{
	if($po1){
	$select_po2="banngo <> ''";
	}else{
	$select_po2="(JPdate = 0 OR JPdate >= '$today25')";
	}
}



$resultc=mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE $select_c1 $select_c2 order by hopedate asc");
$resultpo=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE $select_po1 $select_po2 order by JPdate asc");
if($customerradio){echo "【".$echo."】";}
?>
<body onload="document.getElementById('findme').click()">
<a id="findme" href="indexother.php#findme_pipei" target="shangbu"></a>
<form action="pipei.php" method="post" target="xiabu">
<div style="width:100%;text-align:center"><input style="width:300px;cursor:pointer;text-align:center;letter-spacing:10px;border: none;color:black;background-color:#FFFF00;padding:4px 6px 4px 6px;" type="submit" value="确认匹配"/></div>
<table id="tableExcel" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td width="49%" valign="top">
		<table cellpadding="0" cellspacing="0" width="100%" style="font-size:12px;background-color:#EEEEFF">
			<tr align="center" style="background-color:#8888FF;color:white;height:25px;">
				<td></td>
				<td>客户编号</td>
				<td>banngo</td>
				<td>quantity</td>
				<td>hope date</td>
				<td>asahi po</td>
			</tr>
			<?php while($rowc=$resultc->fetch_row()){ ?>
			<tr align="center">
				<td><input type="radio" name="customerradio" value="<?php echo $rowc[12] ?>"></td>
				<td><a href="4.php?ddt2=<?php echo $rowc[1] ?>"><?php echo $rowc[0]."<br>".$rowc[1] ?></a></td>
				<td><a href="###" onclick="c_banngo('_id=<?php echo $rowc[12] ?>')" ><?php echo $rowc[2] ?></a></td>
				<td><?php echo $rowc[3] ?></td>
				<td><?php echo $rowc[4] ?></td>
				<td><?php if($rowc[5]){echo $rowc[5];}else{echo $rowc[9];} ?></td>
			</tr>
			<?php } ?>
		</table>
	</td>
	<td width="49%" valign="top">
		<table cellpadding="0" cellspacing="0" width="100%" style="font-size:12px;background-color:#FFEEF1">
			<tr align="center" style="background-color:red;color:white;height:25px;">
				<td></td>
				<td>朝日编号</td>
				<td>banngo</td>
				<td>quantity</td>
				<td>JPdate</td>
				<td>customer po</td>
			</tr>
			<?php while($rowpo=$resultpo->fetch_row()){ ?>
			<tr align="center">
				<td><input type="radio" name="asahiradio" value="<?php echo $rowpo[9] ?>"></td>
				<td><a href="4-1.php?asahit1=<?php echo $rowpo[0]; ?>" ><?php echo $rowpo[0] ?><br>&nbsp;</a></td>
				<td><a href="###" onclick="po_banngo('_id=<?php echo $rowpo[9] ?>')"><?php echo $rowpo[1] ?></a></td>
				<td><?php echo $rowpo[2] ?></td>
				<td><?php echo $rowpo[3] ?></td>
				<td><?php if($rowpo[6]){echo $rowpo[6];}elseif($rowpo[8]){echo "【在库确认】";} ?></td>
			</tr>
			<?php } ?>
			<?php if($po2){ ?>
				<tr>
				<td colspan="6">在库信息:</td>
				</tr>
			<?php while($rowzaiku=$resultzaiku->fetch_row()){ ?>
			<tr align="center" style="background-color:black;color:white">
				<td>在库中</td>
				<td><?php echo $rowzaiku[0] ?><br>&nbsp;</a></td>
				<td><?php echo $rowzaiku[1] ?></td>
				<td><?php echo $rowzaiku[2] ?></td>
				<td><?php echo $rowzaiku[3] ?></td>
				<td><?php echo $rowzaiku[6] ?></td>
			</tr>
			<?php } ?>
		
				<?php } ?>
		</table>
	</td>
</tr>
</table>
</form>

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
font-size:12px;
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
font-size:12px;
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
?>