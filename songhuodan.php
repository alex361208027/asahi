<?php


date_default_timezone_set('PRC');
$today=date('Y'.年.'m'.月.'d'.日);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$iii=1;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="CSS/1.css" type="text/css" rel="stylesheet" charset=utf-8 >
<script type="text/javascript" src="JS/1.js"></script>
<script type="text/javascript" src="JS/jquery-3.2.1.min.js"></script>
<link href='//imgcache.qq.com/qcloud/app/resource/ac/favicon.ico' rel='icon' type='image/x-icon'/>
</head>
<style>
.songhuodan > input[type="date"],input[type="text"],.inputlist{
	width:100%;
	height:100%;
    line-height: 16px;
    margin:0px;
    padding:0px;
    border: none;
    color:#4D4D4D;
    cursor: pointer;
    resize: none;
    /**border-bottom:1px solid #AAAAAA;**/
    background:none;
	text-align:center;
	margin-top:0px;
	margin-left:0px;
	font-family: ;
	font-size:15px;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}
hr{
	height:0px;border:none;border-top:3px ridge #EEEEEE;
	
}
</style>
<body style="background-color:">
<div style="width:1200px;height:820px;background-color:white;position:relative">

	<div style="position:absolute;top:20px;left:50px;font-size:25px;">朝日科技(上海)有限公司</div>
		<div style="position:absolute;top:60px;right:50px;font-size:30px;width:1100px;text-align:center" onclick="plus()">送 &nbsp; 货 &nbsp; 单</div>
		<div class="printclass" style="position:absolute;top:80px;right:50px;width:;font-size:15px;text-align:right;border:2px solid red;cursor:pointer;color:red;padding:3px" onclick="window.print()">点击打印</div>
	<div style="position:absolute;top:60px;left:50px;font-size:;">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
				<tr>
				<td width="auto">地址：<input type="text" style="text-align:left;width:500px;" value="上海市长宁区延安西路1088号长峰中心818室"/></td>
				</tr>
				<tr>
				<td width="auto">电话：<input type="text" style="text-align:left;width:500px;" value="021-62126466"/></td>
				</tr>
		</table>
	</div>
	<div style="position:absolute;top:110px;left:50px;width:1100px;height:10px;"><hr></div>
	
	<div style="position:absolute;top:170px;right:50px;font-size:;text-align:right">
	<table cellpadding="0" cellspacing="0" width="100%" border="0" >
				<tr>
				<td width="auto" align="right">送货日期：<input type="text" style="text-align:left;width:120px;" value="<?php echo $today; ?>" onchange="titlechange(this)"/></td>
				</tr>
		</table>
	</div>
	<script>
	function titlechange(str){
		var otitle=document.title;
		otitledate=otitle.substring(otitle.length-8,otitle.length);
		otitle=otitle.replace(otitledate,"");
		date=str.value;
		date=date.replace("年","");date=date.replace("月","");date=date.replace("日","");
		document.title=otitle+date;
	}
	</script>
	<div style="position:absolute;top:210px;left:50px;width:1100px;height:480px;background-color:" class="songhuodan">
		<table cellspacing="0" width="100%" border="1" cellpadding="1" cellspacing="0" id="table">
			<tr align="center" bgcolor="">
			<td width="50px;">序号</td>
			<td><a href="###" onclick="hebing()">注文番号</a></td>
			<td width="80px">产品名称</td>
			<td>规格型号</td>
			<td width="200px">数量</td>
			<td width="60px">单位</td>
			<td width="150px">备注</td>
			</tr>
<?php		
function reel($quantity,$banngo){
		if($quantity%2000==0&&substr($banngo,4,3)=='064'){
			echo '2000';
		}elseif($quantity%6000==0&&substr($banngo,4,3)=='146'){
				echo '6000';
		}elseif($quantity%3000==0&&substr($banngo,4,3)=='046'){
				echo '3000';
		}else{
			global $conn;
			$rowreel=mysqli_query($conn,"SELECT * FROM `t_poprice` WHERE banngo='$banngo' order by _id desc")->fetch_row();
			echo $rowreel[3];
		}
}


			$checkbox=$_GET['checkbox'];
			foreach($checkbox as $checkboxid => $_id){
				
				$row=mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE _id='$_id' limit 1")->fetch_row();
				$row_id[]=$row[12];
				$ordernum[]=$row[1];
				$banngo[]=$row[2];
				$quantity[]=$row[3];
				
			}

			$go=0;
			while($go<111){
				if($banngo[$go]){
					$ed=1;$ii=0;
					while($ed<111){
						if($checked[$ed]){
							if($checked[$ed]==$go){
								$ed++;
								$ii++;
							}else{								
								$ed++;
							}
						}else{
							echo $checked[$ed];
							break;
						}							
					}
					
					if($ii==0){
								$el=0;$quantitytotel=0;
								while($el<111){
									if($banngo[$el]){
										if($banngo[$el]==$banngo[$go]&&$ordernum[$el]==$ordernum[$go]){
											$quantitytotel+=$quantity[$el];
												$eed=1;$iid=0;
												while($eed<111){
													if($checked[$eed]){
														if($checked[$eed]==$el){
															$iid++;
															break;
														}else{
															$eed++;
														}		
													}else{
														break;
													}
												}
												if($iid==0){
												$checked[]=$el;
												}
											$el++;
											
										}else{
											$el++;
										}
									}else{
										break;
									}
								}
								$rowfinal=mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE _id='$row_id[$go]' limit 1")->fetch_row();
								?>
								<tr align="center">
								<td width="50px"><input type="text" value="<?php echo $iii;$iii++; ?>"/></td>
								<td><input type="text" value="<?php echo $rowfinal[1] ?>"/></td>
								<td width="80px"><input type="text" value="LED"/></td>
								<td><input type="text" value="<?php echo $rowfinal[2] ?>"/></td>
								<td width="200px"><input type="text" value="<?php echo number_format($quantitytotel);$total+=$quantitytotel; ?>"/></td>
								<td width="60px"><input type="text" value="pcs"/></td>
								<td width="150px"><input type="text" value="<?php reel($rowfinal[3],$rowfinal[2]) ?>pcs/包"/></td>
								</tr>
								<?php
								
					}
					
					$go++;
				}else{
					break;
				}
			}
			$campany=$rowfinal[0];
			function campany($c,$num){
				Global $conn;
				$result=mysqli_query($conn,"SELECT campanyname,address,addresscampany FROM `t_campany` WHERE campany='$c'")->fetch_row();
				
				if($num==1){
					return $result[0];
				}elseif($num==2){
					return $result[1];
				}elseif($num==3){
					if($result[2]){
					return $result[2];
					}else{
					return $result[0];
					}
				}
			}
			?>

				
			
			<?php for($iiii=$iii;$iiii<=10;$iiii++){ ?>
				<tr align="center">
				<td width="50px"><input type="text" value="<?php echo $iiii; ?>"/></td>
				<td><input type="text" value=""/></td>
				<td width="80px"><input type="text" value=""/></td>
				<td><input type="text" value=""/></td>
				<td width="200px"><input type="text" value=""/></td>
				<td width="60px"><input type="text" value=""/></td>
				<td width="150px"><input type="text" value=""/></td>
				</tr>
			<?php } ?>
				<tr align="center">
				<td width="50px">合计</td>
				<td></td>
				<td width="80px"></td>
				<td></td>
				<td width="200px"><input type="text" style="font-weight:700;" value="<?php echo number_format($total) ?>"/></td>
				<td width="60px"><input type="text" value="pcs"/></td>
				<td width="150px"></td>
				</tr>
		</table>
		<br><br>
		<table cellpadding="0" cellspacing="0" width="100%" border="0" ><tr>
		<td width="65%">
	<table cellpadding="0" cellspacing="0" width="100%" border="0" >
				<tr>
				<td width="auto" align="left">收货单位：<input type="text" id="t3" style="text-align:left;width:300px;" value="<?php echo campany($campany,3) ?>"/></td>
				</tr>
				<tr>
				<td width="auto" align="left">&nbsp;</td>
				</tr>
				<tr>
				<td width="auto" align="left">签收人：</td>
				</tr>
				<tr>
				<td width="auto" align="left">&nbsp;</td>
				</tr>
				<tr>
				<td width="auto" align="left">签收日期：</td>
				</tr>
		</table>
		</td>
		<td>
	
	<table cellpadding="0" cellspacing="0" width="100%" border="0" >
				<tr>
				<td width="auto" align="left">发货单位：<input type="text" style="text-align:left;width:300px;" value="朝日科技(上海)有限公司" / ></td>
				</tr>
				<tr>
				<td width="auto" align="left">&nbsp;</td>
				</tr>
				<tr>
				<td width="auto" align="left">发货人：<input type="text" style="text-align:left;width:80px;" value="<?php echo $_COOKIE['loged']; ?>"/></td>
				</tr>
		</table>
		</td>
		</tr></table>
		
		
	</div>
	<div style="position:absolute;top:150px;left:50px;font-size:;">
	<table cellpadding="0" cellspacing="0" width="100%" border="0" >
				<tr>
				<td width="auto">客户名称：<input type="text" style="text-align:left;width:400px" value="<?php echo campany($campany,1) ?>" /></td>
				</tr>
				<tr>
				<td width="auto">收货地址：<input type="text" style="text-align:left;width:600px;" id="t2" value="<?php echo campany($campany,2) ?>"/></td>
				</tr>
		</table>
	</div>
	
</div>
</body>
<head>
<title><?php echo $campany ?>-朝日科技送货单<?php echo date('Ymd'); ?></title>
</head>
<?php
$conn->close();
?>