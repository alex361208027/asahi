<?php
echo file_get_contents("templates/header.html");

$customer=$_POST["customer"];

if($customer){
$name=$_POST["name"];
$car=$_POST["car"];
$parts=$_POST["parts"];$parts=implode(",",$parts);
$led=$_POST["led"];$led=implode(",",$led);
$quantity=$_POST["quantity"];$quantity=implode(",",$quantity);
$other=$_POST["other"];$other = str_replace("\r\n","<br>",$other);

date_default_timezone_set('PRC');
$today=date('Y-m-d');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$sql="INSERT INTO `t_anjian`(`name`, `car`, `parts`, `customer`, `led`, `quantity`, `other`, `time`) VALUES ('$name','$car','$parts','$customer','$led','$quantity','$other','$today')";
mysqli_query($conn,$sql);



echo "录入成功：<br>".$customer."<br>".$name."<br>".$car."<br>".$parts."<br>".$led."<br>".$quantity."<br>".$other."<br>".$time;
//echo "<a href='anjian_edit.php?_id=1'>重新编辑</a>";
$conn->close();
}else{


?>
<style>
.inputstyle{
	min-width:250px;
	background:white;
	border:1px solid #6F6F6F;
}
.inputled{
	min-width:50px;
	background:white;
	border:1px solid #6F6F6F;
}
input[type="number"]{
	width:50px;
	background:white;
	border:1px solid #6F6F6F;
}

</style>
<script>
$(document).ready(function(){
	$("#plus").click(function(){
		html=$("#led").html();
		html=html.replace("xxx","");
		html="<tr>"+html+"</tr>";
		$(this).parent().parent().before(html);
		$(".delete").css("display","inline-block");
	});
	
	
	$("#led").on("click",".delete",function(){
		ledlength=document.getElementsByName('led[]').length;
		if(ledlength>1){
		if(confirm("删除一个多余LED?")==true){
		$("#led").next().remove();
		}
		}else{
			alert("删除多余LED【没有多余LED】");
		}
	});
	
});


function myform(){
		ledlength=document.getElementsByName('led[]').length;
		//alert(ledlength);
		 for(i=0;i<ledlength;i++){
			 if(document.getElementsByName('led[]')[i].value==""){
				 submit=0;
				 break;
			 }else{
				 submit=1;
			 }
		 }
				
		if(submit==1){
			//alert("ok");
			document.getElementById('myform').submit();
		}else{
			alert("LED为空");
		}
	}
</script>
<body>
<datalist id="kehulist">
<?php
$campany_list=explode(",",file_get_contents("ajax/write_data/campany.html"));
foreach($campany_list as $campany_list){
	echo "<option value='".$campany_list."'>";
}
?>	
</datalist>
<form action="anjian_new.php" method="post" id="myform">
<table>
<tr>
<td>客户名*</td><td><input list="kehulist" class="inputstyle" type="text" name="customer" value="" /></td>
</tr>
<tr>
<td>项目名</td><td><input type="text" class="inputstyle" name="name" value="" /></td>
</tr>
<tr>
<td>车种</td><td><input type="text" class="inputstyle" name="car" value="" /></td>
</tr>
<tr id="led">
<td>部位(部番)</td><td><input type="text" class="inputstyle" name="parts[]" value="" />LED*<input type="text" class="inputled" name="led[]" value="" />员数<input type="number" name="quantity[]" value="1" /> <a class="delete" style="display:none">xxx</a></td>
</tr>
<tr>
<td><a id="plus">+</a></td><td></td>
</tr>
<tr>
<td>其他</td><td><textarea name="other" style="margin-left:8px;width:450px;height:200px"></textarea></td>
</tr>
<tr>
<td></td><td><input type="button" value="提交" onclick="myform()"/></td>
</tr>
</table>
</form>
</body>
<?php

}
?>