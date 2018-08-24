<?php
echo file_get_contents("templates/header.html");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$customer=$_POST['customer'];
$delete=$_GET['delete'];

if($customer){
$name=$_POST["name"];
$car=$_POST["car"];
$parts=$_POST["parts"];$parts=implode(",",$parts);
$led=$_POST["led"];$led=implode(",",$led);
$quantity=$_POST["quantity"];$quantity=implode(",",$quantity);
$other=$_POST["other"];$other = str_replace("\r\n","<br>",$other);
$_id=$_POST["edit_id"];
date_default_timezone_set('PRC');
$today=date('Y-m-d');
$sql="UPDATE `t_anjian` SET `name`='$name',`car`='$car',`parts`='$parts',`customer`='$customer',`led`='$led',`quantity`='$quantity',`other`='$other',`time`='$today' WHERE _id='$_id'";
mysqli_query($conn,$sql);
echo "更新完成";
}elseif($delete){
$sql="DELETE FROM `t_anjian` WHERE _id='$delete'";
mysqli_query($conn,$sql);
echo "删除完成";

}else{

$_id=$_GET['_id'];

$sql="SELECT * FROM `t_anjian` WHERE _id='$_id'";
$result=mysqli_query($conn,$sql);
$row=$result->fetch_row();

$parts=explode(",",$row[3]);
foreach($parts as $parts){
	$arry_parts[]=$parts;
}

$led=explode(",",$row[5]);
foreach($led as $led){
	$arry_led[]=$led;
}
$quantity=explode(",",$row[6]);
foreach($quantity as $quantity){
	$arry_quantity[]=$quantity;
}

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
		//alert(00);
		html='<tr><td><input type="text" class="inputstyle" name="parts[]" value=""/></td><td><input type="text" class="inputled" name="led[]" value=""/></td><td><input type="number" name="quantity[]" value="1"/></td></tr>';
		$(this).parent().parent().before(html);
	
	});
	
	$(".delete").click(function(){
		$(this).parent().parent().remove();
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
	
function shanchu(str,id){	
 if(confirm("确认删除")==true){
 str.href="anjian_edit.php?delete="+id;
 }else{
	str.href=""; 
 }
}
</script>
</script>
<form action="anjian_edit.php" method="post" id="myform">
<table width="600px">

<tr>
<td colspan="3"><input type="text" class="inputstyle" name="customer" value="<?php echo $row[4]; ?>"/></td>
</tr>
<tr>
<td colspan="3"><input type="text" class="inputstyle" name="name" value="<?php echo $row[1]; ?>"/></td>
</tr>
<tr>
<td colspan="3"><input type="text" class="inputstyle" name="car" value="<?php echo $row[2]; ?>"/></td>
</tr>
<tr>
<td colspan="3"><hr></td>
</tr>
<tr>
<td>【部位】</td><td>【LED】</td><td>【员数】</td>
</tr>
<?php for($i=0;$i<count($arry_led);$i++){ ?>
<tr>
<td><input type="text" class="inputstyle" name="parts[]" value="<?php echo $arry_parts[$i]; ?>"/></td><td><input type="text" class="inputled" name="led[]" value="<?php echo $arry_led[$i] ?>"/></td><td><input type="number" name="quantity[]" value="<?php echo $arry_quantity[$i] ?>"/> <a class="delete">X<a/></td>
</tr>
<?php } ?>
<tr>
<td colspan="3"><a id="plus">+</a></td>
</tr>
<tr>
<td colspan="3"><hr></td>
</tr>
<tr>
<td colspan="3"><textarea name="other" style="margin-left:8px;width:600px;height:200px"><?php $row[7] = str_replace("<br>","\r\n",$row[7]); echo $row[7]; ?></textarea></td>
</tr>
<tr>
<td colspan="3" align="right"><br><input type="hidden" name="edit_id" value="<?php echo $_id ?>"><a onclick="shanchu(this,<?php echo $row[0]; ?>)" href="">删除</a> <input type="button" value="确认编辑" onclick="myform()"/></td>
</tr>
</table>
</form>

<?php
}
$conn->close();

?>
