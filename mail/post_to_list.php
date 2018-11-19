<?
if($_POST['getlist']){
	$getlist=$_POST['getlist'];
	$count=0;
	foreach($getlist as $getlist){
		if($getlist){
			if($count==0){
			$write=$getlist;
			$count=1;
			}else{
			$write=$write.";".$getlist;
			}
		}
	}
	//echo $write;
	fwrite(fopen("post_to.html","w"),$write);
	echo "已更新<br>";
}

?>
<script type="text/javascript" src="../JS/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
	$("#button").click(function(){
		$("#list").append('<input type="text" name="getlist[]" value=""/><br>');
	});
	
	$(".delete").click(function(){
		if(confirm("确认删除？")==true){
		$(this).prev().remove();
		$(this).remove();
		}
	});
	
});
</script>
<style>
input[type='text']{
	width:auto;
	min-width:300px;
}
</style>
<form action="post_to_list.php" method="post" onsubmit="return:false;">
<div id="list">
<?

$list=file_get_contents("post_to.html");

$list=explode(";",$list);

foreach($list as $list){
?>
	<input type="text" name="getlist[]" value="<? echo $list; ?>"/><input type="button" value="Delete" class="delete"><br>
<?
}
?>
</div>
<input type="button" value="添加" id="button"/><input type="submit" value="确认修改"/>
</form>