<?php
echo file_get_contents("templates/header.html");
date_default_timezone_set('PRC');

//$servername = "localhost";
//$username = "root";
//$password = "root";
//$dbname = "asahi";
//$conn = new mysqli($servername, $username, $password, $dbname);
//mysqli_set_charset ($conn,utf8);



?>
<style>
.indexother{
	overflow:hidden;padding-left:10px;height:auto;color:#3C2F41;
}
</style>
<body height="100%" >

<datalist id="kehulist">
<?php
$campany_list=explode(",",file_get_contents("ajax/write_data/campany.html"));
foreach($campany_list as $campany_lists){
	echo "<option value='".$campany_lists."'>";
}
?>	
</datalist>


<a name="hometop"></a>
<div class="indexother">
	<table height="100%" width="100%" cellpadding="10" cellspacing="0"><tr>
	<td><font size="5"><b>朝日科技（上海）有限公司</b></font></td>
	<td valign="top" align="right"><font color="#999999"><a href="user.php?theuser=<?php echo $_COOKIE['asahiuser']; ?>" target="_blank"><?php echo $_COOKIE['loged']; ?>，您好！今天是<?php echo date('Y'.'年'.'m'.'月'.'d'.'日') ?><?php if(file_exists("upload/user_touxiang/".$_COOKIE['asahiuser'].".png")){echo "<img src='upload/user_touxiang/".$_COOKIE['asahiuser'].".png' height='60px'>";} ?></a></font></td>
	</tr></table>
</div>


<a name="findme_kehusousuo2"></a>
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td>
<form action="4.php" method="post" target="xiabu">
  客户关键字:<input list="kehulist" class="inputlist" name="ddt2" size="10" maxlength="" />
  订单日期:<input type="date" name="t3" size="10" maxlength="" value="2017-01-01"/>
  日期范围:<input type="date" name="t4" size="10" maxlength="" value="<?php echo date('Y-m-d'); ?>" />
  <input type="submit" value="搜索" />
  </form>
</td></tr></table>  
</div>  

<a name="findme_xinjian1"></a>
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td>
  <form action="1.php" method="post" target="xiabu">
  客户名称:<input list="kehulist" class="inputlist" name="t1" size="10" maxlength="" />
  订单编号:<input type="text" name="t2" size="10" maxlength="" />
  订单日期:<input type="date" name="t3" size="10" maxlength="" value="<?php echo date('Y-m-d'); ?>"/>
  <input type="submit" style="background-color:#FF4469" value="新 建 订 单" onclick="buttons(this);"/>
  <input type="text" name="asahiorder" size="10" value="" placeholder="同时创建朝日订单" /><input type="button" value="生成朝日单号" onclick="newponum(1);buttons(this);"/><input type="button" value="Reset" onclick="location.reload();"/>
 
  </form>
</td></tr></table>
</div>
<script>
function newponum(str){
		var xmlhttp;
			if(str==1){
			today=document.getElementsByName("t3")[1].value;
			}else if(str==2){
			today=document.getElementsByName("t2")[1].value;
			}
		
			if (str.length==0)
			  { 
			  //document.getElementById("ajasdiv").innerHTML="";
			  return;
			  }
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					if(str==1){
					document.getElementsByName("asahiorder")[0].value= xmlhttp.responseText;
					}else if(str==2){
					document.getElementsByName("t1")[1].value= xmlhttp.responseText;	
					}
				}
			  }
			xmlhttp.open("GET","ajax/newponum.php?today="+today,true);
			xmlhttp.send();
}
</script>
<a name="findme_xinjian2"></a>
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td>
  <form action="7.php" method="post" target="xiabu">
  朝日订单:<input type="text" name="t1" size="10" maxlength="" value=""/><input type="button" value="生成朝日单号" onclick="newponum(2);buttons(this)"/>
  订单日期:<input type="date" name="t2" size="10" maxlength="" value="<?php echo date('Y-m-d'); ?>"/>
  对应客户:<input list="kehulist" class="inputlist" name="t4" size="10" maxlength="" />
  <input type="submit" value="新建朝日订单" style="background-color:#FF4469" onclick="buttons(this)"/>
  </form>
</td></tr></table>
</div>

<a name="findme_chanpin0">
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td>
<a name="findme1"></a>
<form action="4-1.php" method="post" target="xiabu">
  朝日订单号:<input type="text" name="asahit1" size="10" maxlength="" />
  <input type="submit" value="搜索" />
  </form>
  </td></tr></table>
 </div> 

 
 
<style>
.checkedboxword{
	display:inline-block;color:white;font-size:14px;background-color:#81C7D4;padding:5px 8px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	transition: all 0.4s;
-moz-transition: all 0.4s;	/* Firefox 4 */
-webkit-transition: all 0.4s;	/* Safari 和 Chrome */
-o-transition: all 0.4s;
}

</style>
 
<a name="findme_chanpin2"></a>
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td>
<form action="2.php" method="post" target="xiabu" id="kehujiansuo">
<input type="text" name="t1" id="plus_t1" value="" placeholder="取引先"/><div style="margin-left:-40px;display:inline-block;font-size:12px;z-index:99;padding:2px;background-color:white;cursor:pointer;" onclick="qingkong()">清空</div>
<input list="kehulist" class="inputlist" style="width:22px" value="" oninput="plus_campany(this)"/>
<input type="text" name="t6" value="" placeholder="取引PO"/>
<input type="text" name="t3" value="" placeholder="品番(多个品番用;隔开)"/>
<input type="text" name="t4" value="" placeholder="数量"/>
<input type="hidden" id="newdate" value="<?php echo date('Y-m-d',strtotime('-1 month')) ?>"/>
<script>
$(document).ready(function(){
	$(".checkedboxword").click(function(){
		$(":checkbox").next().css({"background-color":"#81C7D4"});
		setTimeout(()=>{$(":checked").next().css({"background-color":"#562E37"});},100);
	});
	
});

function qingkong(){
	document.getElementById("plus_t1").value="";
}

function plus_campany(str){
	if(document.getElementById("plus_t1").value){
	document.getElementById("plus_t1").value+=";"+str.value;
	str.value="";
	}else{
	document.getElementById("plus_t1").value=str.value;
	str.value="";
	}
}

function changedate(str){
	if(!str){
		str=0;
	}
	t7=document.getElementsByName('t7')[str].value;
	t77=document.getElementsByName('t77')[str].value;
	
	if(t7 && t77 && t7>t77){
		document.getElementsByName('t7')[str].value=t77;
		document.getElementsByName('t77')[str].value=t7;
	}
}




d1=document.getElementById('newdate').value;
//asahi_po=document.getElementById('new_asahi_po').value;



</script>
<label><input type="checkbox" name="t5" value="checked" style="display:none" onclick="document.getElementsByName('t11')[0].checked=false;document.getElementsByName('t9')[0].checked=true;"/><div class="checkedboxword">未发票</div></label>
<label><input type="checkbox" name="t9" value="checked" style="display:none" onclick="if(this.checked && document.getElementsByName('t7')[0].value==''){document.getElementsByName('t7')[0].value=d1;}else if(this.checked==false && document.getElementsByName('t7')[0].value==d1){document.getElementsByName('t7')[0].value='';}"/><div class="checkedboxword">含完成</div></label>
<label><input type="checkbox" name="t10" value="checked" style="display:none"/><div class="checkedboxword">未分配</div></label>
<label><input type="checkbox" name="t11" value="checked" style="display:none"/><div class="checkedboxword">納期待つ除き</div></label>
<label><input type="checkbox" name="t12" value="checked" style="display:none"/><div class="checkedboxword">在库のみ</div></label>

<br>
<select name="selectdate" class="inputlist">
<option value="SHdate">上海发货日期</option>
<option value="JPdate">日本发货日期</option>
<option value="invoice">开票日期</option>
</select>:
<input type="date" name="t7" value="" onchange="changedate(0)"/>~
<input type="date" name="t77" value="" onchange="changedate(0)"/>
<input type="submit" style="background-color:#CCCCFF" value="(お客PO) 検索"/><input type="button" value="Reset" onclick="location.reload();"/>
</form>
</td></tr></table>
</div>



  <a name="findme_chanpin3"></a>
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td>
<a name="findme3"></a>
  <form action="2.php" method="post" target="xiabu">
  (选填)公司名：<input list="kehulist" class="inputlist" name="campany" />
  <input type="hidden" name="wancheng" value="完成"/>
  <input type="hidden" name="yikaiju" value="已开具"/>
  <input type="submit" value="完成/未开票的订单搜索" />
  </form>
  </td></tr></table>
</div>





<a name="findme_zaiku"></a>
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td>
<style>
.zaiku{
	display:inline-block;padding:0 0 0 20px;
	font-size:18px;
}
</style>
	<div class="zaiku">
		<a href="in.php?in=in" target="xiabu">
			<img src="img/in.png" /> &nbsp; 当前在库数
		</a>
	</div>
	<div class="zaiku">
		<a href="in.php" target="xiabu">
			<img src="img/out.png" /> &nbsp; 出库记录
		</a>
	</div>
	<div class="zaiku">
		<a href="putin.php" target="xiabu">
			<img src="img/putin.png" /> &nbsp; 手动入库
		</a>
	</div>
</td></tr></table>	
</div>


<a name="findme_namecard"></a>
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td>
  <div style="display:inline-block;"><form action="namecard.php" method="post" target="xiabu">
关键字:<input type="text" name="search" value="<?php if(!empty($search)){echo $search;} ?>" placeholder="点击搜素 随机换一批" onclick/><input type="submit" value="搜索" onclick="if(document.getElementsByName('search')[0].value==''){document.getElementsByName('search')[0].value='随机换一批';}"/>
</form></div>
<div style="display:inline-block;margin-left:10%;"><a href="namecardplus.php" target="xiabu">+++添加新名片</a> &nbsp;  &nbsp; <a href="upload.php" target="xiabu">+++模板导入</a></div>
</td></tr></table>
</div>

  <a name="findme_project"></a>
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td>
  <div style="display:inline-block;"><form action="project.php" method="post" target="xiabu">
名字搜索:<input type="text" name="search" value=""/><input type="submit" value="搜索"/>
</form></div>
<div style="display:inline-block;"><form action="projectx.php" method="post" target="xiabu">
/内容搜索:<input type="text" name="search" value=""/><input type="submit" value="搜索"/>
</form></div>
<div style="display:inline-block;margin-left:10%;"><a href="projectplus.php" target="xiabu">+++添加新项目</a></div>
</td></tr></table>
</div>



<a name="findme_chanpin5" ></a>
<div class="indexother">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td align="right">
<form action="6.php" method="post" target="xiabu">
<input type="text" name="t6" value="" placeholder="朝日PO"/>
<input list="kehulist" class="inputlist" name="t1" value="" placeholder="取引先"/>
<input type="text" name="t3" value="" placeholder="品番"/>
<!--<input type="text" name="t5" value="" placeholder="Due Date(start)"/>
<input type="text" name="t55" value="" placeholder="Due Date(end)"/>-->
<input type="text" name="t4" value="" placeholder="数量"/>

<label><input type="checkbox" name="t9" value="checked" style="display:none" onclick="if(this.checked && document.getElementsByName('t7')[1].value==''){document.getElementsByName('t7')[1].value=d1;}else if(this.checked==false && document.getElementsByName('t7')[1].value==d1){document.getElementsByName('t7')[1].value='';}"><div class="checkedboxword">含入荷済み</div></label>
<label><input type="checkbox" name="t10" value="checked" style="display:none"><div class="checkedboxword">未分配</div></label>
<label><input type="checkbox" name="t11" value="checked" style="display:none"><div class="checkedboxword">納期待つ除き</div></label>

<br>
<input type="submit" style="background-color:#FF7792" value="(朝日PO) 検索"/><input type="button" value="Reset" onclick="location.reload();"/>

日本出荷日:
<input type="date" name="t7" value="" onchange="changedate(1)"/>~
<input type="date" name="t77" value="" onchange="changedate(1)"/>
</form>
</td></tr></table>
</div>

<a name="findme_pipei"></a>
<div class="indexother">
<form action="pipei.php" method="post" target="xiabu">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><tr>
	<td width="40%" align="center">
		客户编号<input type="text" id="c1" name="c1" value="">番号<input type="text" name="c2" value="" onchange="document.getElementsByName('po2')[0].value=this.value">
	</td>
	<td width="20%" align="center">
		<input type="submit" value="匹配搜索"><input type="button" value="reset" onclick="location.reload();"/>
	</td>
	<td width="40%" align="center">
		朝日编号<input type="text" name="po1" value="">番号<input type="text" name="po2" value="" onchange="document.getElementsByName('c2')[0].value=this.value">
	</td>
</tr></table>
</form>
</div>


</body>
