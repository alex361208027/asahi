<?
echo "二维码内容【";
echo $qrcode=$_POST['qrcode'];
echo "】";
$qrcode_api=file_get_contents("qrcode_api.html");




?>
<script>
$("#button").click(function(){
	$("#qrcode").append($("#qrcode").html());
});
</script>
<style>
img{
	padding:5px;
}
</style>
<br>
<button id="button" class="printclass">复制二维码</button><br>
<div id="qrcode">
<img src="<? echo $qrcode_api.$qrcode; ?>" style="width:2cm;height:2cm">
</div>

