<?php
echo file_get_contents("templates/header.html");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


$search=$_GET['search'];
$page=$_GET['page'];

if(!$page){
	$page=0;
}

if($search){
	$sql="SELECT * FROM `t_anjian` WHERE (customer like '%$search%' OR name like '%$search%' OR parts like '%$search%' OR car like '%$search%' OR led like '%$search%' OR other like '%$search%') order by time desc limit $page,6";
}else{
$sql="SELECT * FROM `t_anjian` WHERE 1 order by time desc limit $page,6";
}
$result=mysqli_query($conn,$sql);

$page=$page+6

?>
<style>
marquee{
	max-width:200px;font-size:16px;color:black;
}
.anjian{
	display:inline-block;margin:20px;position:relative
}
.waikuan{
	overflow:hidden;background:#F7F7F7;cursor: pointer;
	width:200px;height:200px;
	-webkit-border-radius: 100px;
  -moz-border-radius: 100px;
  border-radius: 100px;
  transition: all 1s;
-moz-transition: all 1s;	/* Firefox 4 */
-webkit-transition: all 1s;	/* Safari 和 Chrome */
-o-transition: all 1s;

}
.waikuan:hover{
  background:#EEEEEE
}
.customer{
	font-size:25px;padding-top:20px;
}
.name{
	border:2px solid black;display:inline-block;padding:2px 4px;color:black;margin:3px;max-width:160px;height:auto;
	-webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.other{
	color:#999999;font-size:12px;
	transition: all 1s;
-moz-transition: all 1s;	/* Firefox 4 */
-webkit-transition: all 1s;	/* Safari 和 Chrome */
-o-transition: all 1s;
}
.waikuan:hover > .other{
	color:black;
}
hr{
	border:none;border-top:1px solid black;
}


</style>
<script>
$(document).ready(function(){
	$(".waikuan").click(function(){
		
		$(".waikuan").css("background","");
		$(this).css("background","#BBBBFF");
		
	});
	
	
});

function anjian_led(str){
			document.getElementById("detail").innerHTML="正在加载....";
			var xmlhttp;
			if (str.length==0)
			  { 
			  
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
					//xmlhttp.responseText;
					
					document.getElementById("detail").innerHTML=xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/anjian_led.php?_id="+str,true);
			xmlhttp.send();
	
}
function searchbutton(){
	document.getElementById("href").href="anjian.php?search="+document.getElementById("search").value;
	document.getElementById("href").click();
}

</script>
<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0"><tr>
<td width="500px" valign="top">
<a id="href" href=""></a>
<form onsubmit="return false;" style="display:inline-block;"><input type="text" id="search" value="<?php echo $search; ?>"/> <input type="submit" onclick="searchbutton()" value="Search" /></form> <a href="anjian_new.php" target="_BLANK"><button>New</button></a>
<br>


<?php $cc=0; 
while($row=$result->fetch_row()){ ?>
<div class="anjian" align="center" onclick="anjian_led(<?php echo $row[0]; ?>)">
<div class="waikuan">
<div class="customer"><?php echo $row[4]; ?></div>
<div class="name"><?php echo $row[1]; ?></div>
<marquee><?php echo $row[2]." 【".$row[5]."】"; ?></marquee>
<br><br>
<div class="other"><?php if($row[7]){echo $row[7];}else{echo $row[5];} ?></div>
</div> 

</div>
<?php $cc++; 
} ?>
<br>
<?php if($cc>5){ ?>
<a style="float:right" href="anjian.php?search=<?php echo $search; ?>&page=<?php echo $page; ?>">NEXT<a/>
<?php }elseif($cc==0){ ?>
没有更多记录
<?php } ?>
</td>
<td style="background:#FFDDE4;" valign="top">
<div style="position:fixed;width:100%;padding:20px;" id="detail">...</div>
</td>
</tr></table>
</body>
<?php 
$conn->close();
?>