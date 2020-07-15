<?php
if($_COOKIE['loged']){

echo file_get_contents("templates/header.html");

	
//$servername = "localhost";
//$username = "root";
//$password = "root";
//$dbname = "asahi";

date_default_timezone_set('PRC');

if($_GET["date"]){
	$moon=$_GET["date"]."-01";
}else{
$_GET["date"]=date('Y-m');
$moon=date('Y-m')."-01";
}
$time=file_get_contents("upload/calendar/user.html");

//$conn = new mysqli($servername, $username, $password, $dbname);
//mysqli_set_charset ($conn,utf8);


?>
<style>

table{
	border-collapse:collapse;
	width:100%;
	
}
tr{
	width:100%;
}
td{
	width:14%;
}
.mytd{
	height:80px;border:1px solid #DDDDDD;padding:0;margin:0;overflow-y:scroll;
}
.mytd:hover{
	border:1px solid blue;
}

button{
	background:#EEEEEE;color:black;display:none;padding:0 4px;width:;
}

td:hover > button{
	display:inline-block;
}

button:hover{
	background:#F781BE;color:white;
}
.ms{
	background:#F5F6CE;margin:0;border-left:3px solid black;padding:2px 0 2px 4px;margin-bottom:2px;
	font-size:12px;min-height:10px;
	
}
.ms:hover{
	font-weight:bold;
}
.msmark{
	font-size:14px;
	background-color:rgb(255, 129, 159);
}
.msdown{
	color:#BDBDBD;background-color:white;font-size:12px;
}
.mytd::-webkit-scrollbar {display:none}


.chose{
	display:inline-block;font-size:22px;cursor:pointer;
}
.placeholder{
	border:1px dashed red;min-height:20px;background:#EEEEEE;
}
textarea{
	width:250px;height:50px;font-size:14px;background:white;padding:0;margin:4px 0;color:#2e2e2e;
}
hr{
	border-color:white;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
<script>
$(function(){
	
	$("#note").draggable();


		
	function note_show(shit){
		$("#note").fadeIn().css({"left":(event.pageX-60),"top":(event.pageY-20)});
			if(shit){
			$("#note_text").val(shit.text());
			$("#edit2").fadeIn();
			$("#note_title").val(shit.attr("title"));
			}else{
			$("#note_text").val("");
			}
		$("#note_text").select();
		
	}
		
	function note_hide(){
		$("#note").fadeOut();
		$("#edit").fadeOut();
		$("#edit2").fadeOut();
		$("#note_text").val("");
		$("#note_title").val("");
	}
	
	
	
	$("#yes").click(function(){
		
		if(str.text()=="+new Message"){
		str.next(".mytd").append("<div class='ms' title=''>"+$("#note_text").val()+"</div>");
		}else{
			str.text($("#note_text").val());
			
			str.attr("title",$("#note_title").val());
		}
		note_hide();
		calendarread();
	});
	
	$("#no").click(function(){
		note_hide();
	});
	
	$("button").click(function(){
		str=$(this);
		note_show();
		$("#edit").fadeOut();
		$("#edit2").fadeOut();
	});
	
	$(".mytd").on("dblclick",".ms",function(){
		
		$("#edit").fadeIn();
		str=$(this);
		note_show($(this));
		
	});
	
	$("#mark").click(function(){
		if(str.attr("class")=="ms"){
				str.removeClass("");
				str.addClass("ms");
				str.addClass("msmark");
			}else{
				str.removeClass();
				str.addClass("ms");
			}
			 note_hide();
			calendarread();
	});
	$("#down").click(function(){
		if(str.attr("class")=="ms"){
				str.removeClass("");
				str.addClass("ms");
				str.addClass("msdown");
			}else{
				str.removeClass();
				str.addClass("ms");
			}
			calendarread();
			note_hide();
	});
	$("#delete").click(function(){
		if(confirm("确认删除？")){
			str.remove();
			calendarread();
			}else{
				return false;
			}
			note_hide();
	});
	
	$( ".mytd" ).sortable({
		items:".ms",
		connectWith: ".mytd",
		placeholder:"placeholder",
		stop:function(){calendarread();}
	}).disableSelection();
	
	
	
	user=<? echo "'".$time."'"; ?>;
	
	setInterval(()=>{calendarcheck()},10000);
	
	function calendarcheck(){
		
		$.post("upload/calendar/calendar_check.php",{},function(data){
			if(data==user){
			
			}else{
	
				if(confirm("其他用户对日历正在做更改，请刷新。")){
					//alert(00);
					window.location.reload();
				}else{
					window.location.reload();
				}
				
			}
			
			
		});
		
	}
	
	function calendarcheck_alert(){
		alert("其他用户有对日历正在做更改，请刷新后重试。");
		
	}
	$("#check_result").click(function(){
		//alert(0);
		calendarcheck();
	});
	
		
	function calendarread(){
	$("#autosave").empty().append("Saving...");	
	setTimeout(()=>{
		calendar=$("#calendar").html();
		date=$("#save").text();
		$.post("upload/calendar/calendar_ajax.php",{
			calendar:calendar,
			date:date,
			
		},function(data){

			user=data;
		});
		
	},300);
	setTimeout(()=>{$("#autosave").empty();	},1500);
	}
	
	$("#save").click(function(){
	
		yy=prompt("Year",<? echo "'".date('Y')."'";  ?>);
		if(!yy){
			return false;
		}
		mm=prompt("Month","01");
		if(isNaN(yy) || isNaN(mm)){
				alert("It's not a Number");
			return false;
		}
		
		if(yy.length!=4){
			alert("Year is wrong!")
			return false;
		}
		
		if(mm.length==1 && mm<=12 && mm>=1){
			mm="0"+mm;
		}else if(mm.length==2 && mm<=12 && mm>=1){
			mm=mm;
		}else{
			alert("month is wrong!")
			return false;
		}
		
		window.location.href="calendar.php?date="+yy+"-"+mm;
		
	});
	
	
	$("input").click(function(){
		$("input").not(this).removeAttr("checked");
	});
	
});
</script>
<body style="padding:5px;">
<div style="background:;color:#BDBDBD;">
<a href="indexxiabu.php">[Back To HomePage]</a>
<div id="autosave" style="float:right;" onclick="if(confirm('确定重置日历内容？')){window.location.href='calendar.php?date=<? echo date('Y-m',strtotime($_GET['date'])); ?>&reset=1'}">RESET</div>
</div>
<div id="calendar"><?
if(file_exists("upload/calendar/month/".$_GET['date'].".html") && !$_GET['reset']){
	echo file_get_contents("upload/calendar/month/".$_GET['date'].".html");
}else{

?><div class="chose" title="prev month" onclick="window.location.href='calendar.php?date=<? echo date('Y-m',strtotime("-1 month",strtotime($_GET['date']))); ?>'"><<</div>
<div class="chose" id="save" title="chose date"><? echo $_GET['date']; ?></div>
<div class="chose" title="next month" onclick="window.location.href='calendar.php?date=<? echo date('Y-m',strtotime("+1 month",strtotime($_GET['date']))); ?>'">>></div>
<table cellpadding="0" cellspacing="0">
<tr style="background:black;color:white;height:40px;font-size:20px;font-weight:bold;">
<td>Sunday 日</td><td>Monday 月</td><td>Tuesday 火</td><td>Wednesday 水</td><td>Thursday 木</td><td>Friday 金</td><td>Saturday 土</td>
</tr>
<?
$tr=0;
$td=0;
$plus=0;

while($tr<6){
	
	
echo "<tr>";

	while($td<7){
		
		if(date('Y-m-d',strtotime("+".$plus." days",strtotime($moon))) < date('Y-m-d',strtotime("+1 months",strtotime($moon)))){
		$goon=1;
		}else{
		$goon=0;
		$tr=7;
		}	
		
	echo "<td>";
	if($goon){
		
		$check_week=date("w",strtotime(date('Y-m-d',strtotime($moon))));
		$pick_date=date('Y-m-d',strtotime("+".$plus." days",strtotime($moon)));
		$check_week=date("w",strtotime($pick_date));
		
		if($check_week==$td){
			echo date('m-d',strtotime($pick_date));
			$plus++;
			echo "<button>+new Message</button><div class='mytd' value='".$pick_date."' "; 
			if($td==6 || $td==0){
				echo "style='background:#FBEFF2' ";
			}
			echo "value=".$pick_date.">";
			
			echo "</div>";
		}
    }
	echo "</td>";
	$td++;
	}
	
echo "</tr>";
$tr++;
$td=0;
}

?>


</table>
<?
}
?>
</div>

<div id="note" style="border:2px solid red;position:absolute;height:auto;width:auto;background:#FBEFEF;padding:14px 4px 8px 8px;display:none;border-radius:6px;">
	<form onsubmit="return false;">
	<input type="text" id="note_text" value="" style="font-size:15px;min-width:250px;" placeholder="请输入内容"/>
	<input type="submit" id="yes" value="确定" style="background:black;color:white;"/><input type="button" id="no" value="取消"/></form>

	<div id="edit2" style="display:none;"><hr>备注/报告/内容:<br>
	<textarea id="note_title"></textarea>
	</div>

	
	<div id="edit" style="display:none;">
	<hr>
	<input type="button" id="mark" value="标记为重要"/><input type="button" id="down" value="标记为不重要"/><input type="button" id="delete" value="删除"/>
	</div>
	
</div>
</body>

<style>


div[value=<? echo "'".date('Y-m-d')."'"; ?>]{
	border:2px solid #F78181;
}
div[value=<? echo "'".date('Y-m-d')."'"; ?>]:hover{
	border:2px solid blue;
}

</style>

<?
// $conn->close();
//echo file_get_contents("templates/footer.html");

}else{
	echo $_COOKIE['loged']." login?";
} 
?>