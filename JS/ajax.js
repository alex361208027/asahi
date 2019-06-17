
//////////////////////////////////////////////////////////////////////////////////2.php
function c_banngo(str){
			document.getElementById("ajasdiv").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="-450";
			document.getElementById("ajasdivout").style.right="-450";
			setTimeout("document.getElementById('ajasdivout').style.right='0'",500)
			
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv").innerHTML="";
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
					
					
					document.getElementById("ajasdiv").innerHTML= xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_banngo.php?"+str,true);
			xmlhttp.send();
}


function c_shdate(str){
			var xmlhttp;
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
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[11].innerHTML=xmlhttp.responseText;
					//alert(cells);
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_shdate.php?"+str,true);
			xmlhttp.send();
	
}
	

function c_quantity(str){
			var xmlhttp;
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
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[6].innerHTML=xmlhttp.responseText;;
					//alert(cells);
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_quantity.php?"+str,true);
			xmlhttp.send();
	
}	


function c_hopedate(str){
			var xmlhttp;
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
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[8].innerHTML=xmlhttp.responseText;
					//alert(cells);
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_hopedate.php?"+str,true);
			xmlhttp.send();
	
}

function c_invoice(str){
			var xmlhttp;
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
			  
			  if(document.getElementById('c_invouce').checked==true){
				str+="&checked=yes&thedate="+document.getElementById('SHdate').value;
				}
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[13].innerHTML=xmlhttp.responseText;
					//alert('work');
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_invoice.php?"+str,true);
			xmlhttp.send();
	
}
function c_yiruku(str){
			var xmlhttp;
			
			if (str.length==0)
			  { 
			  //document.getElementById("ajasdiv").innerHTML="";
			 return;
			  }
			 if(document.getElementById('checked0').color==''){
				 str+="&check=1";
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
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="<div class='classcp1' style='background-color:red'>要出荷</div>";
				}
			  }
			xmlhttp.open("GET","./ajax/c_yiruku.php?"+str,true);
			xmlhttp.send();
}

function c_complete(str){
			var xmlhttp;
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
			  
			  if(document.getElementById('c_complete').checked==true){
				str+="&checked=yes";
				}
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML=xmlhttp.responseText;
					//alert(cells);
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_complete.php?"+str,true);
			xmlhttp.send();
	
}
	
function c_remark(str){
			if(str==""){
				str=" ";
			}
			var xmlhttp;
			if (str.length==0)
			  { 
			  //document.getElementById("ajasdiv").innerHTML="";
			  return;
			  }
			  
			if (window.XMLHttpRequest){
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  

			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML=xmlhttp.responseText;
					
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_remark.php?"+str,true);
			xmlhttp.send();
	
}


function c_chuku(str){
			document.getElementById("ajasdivout2").style.right="345";
			str=str.replace("+","%2B");
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv2").innerHTML="";
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
					
					
					document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_chuku.php?"+str,true);
			xmlhttp.send();
}

function c_chuku_checkbox(){
	
	var str="&_id="+document.getElementById('c_banngo_id').value+"&t1="+document.getElementById('c_banngo_campany').value+"&t2="+document.getElementById('c_banngo_ordernum').value+"&t4="+document.getElementById('c_banngo_quantity').value+"&chukudate="+document.getElementById('c_chuku_date').value+"&expressnum="+document.getElementById('c_chuku_express').value;
	var ss=document.getElementsByName('c_chuku_checkbox');
	for(i=0;i<ss.length;i++){
		if(ss[i].checked){
		str+="&checkbox[]="+ss[i].value;
		}
	}
	str=str.replace("+","%2B");
	var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv2").innerHTML="";
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

					if(xmlhttp.responseText.length==0){
						document.getElementById("ajasdiv2").innerHTML="出货操作失败！<br>数量不正确，你可能需要先拆分某些货物。<br><a href='in.php?search_banngo="+document.getElementById("c_banngo_thebanngo").value+"&in=in'><button>去拆分</button></a>";
					}else{
						document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
						cells=document.getElementById('cells').value;
						document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="<div class='classcp1' style='background-color:blue'>完成</div>";
						document.getElementById('checked1').color='';
						document.getElementById('c_complete').checked=true;
						setTimeout("document.getElementById('ajasdivout2').style.right='-450px'",1000);
					}
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_chuku_checkbox.php?"+str,true);
			xmlhttp.send();
			
	
}
	
	

function c_pi_invoice(str){
	
	
	if(confirm("确认于此日期["+document.getElementById('SHdate').value+"]开具发票")){
	
			str="";
			var checkbox=document.getElementsByName('checkboxsum');
			str+="invoice=已开具&thedate="+document.getElementById('SHdate').value;
			for(i=0;i<checkbox.length;i++){
				if(checkbox[i].checked){
				str+="&checkbox[]="+checkbox[i].getAttribute('_id');
				}
			}
			
			
			var xmlhttp;
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
					alert(xmlhttp.responseText);
					for(i=0;i<checkbox.length;i++){
						if(checkbox[i].checked){
							cells=document.getElementsByName('checkboxsum')[i].getAttribute('cells');
							document.getElementById('tableExcel').rows[cells].cells[13].innerHTML="已开票";
						}
					}
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_pi_invoice.php?"+str,true);
			xmlhttp.send();
			
	}		
	
}

function c_pi_chuku(str){
	
shdate=document.getElementById('SHdate').value;
expressnum=prompt("请输入运单号（后三位）：");


if(shdate&&expressnum){
	
	if(confirm("确认是否执行出库? 出库日期："+shdate+"，运单号："+expressnum)){
	
			str="";
			var checkbox=document.getElementsByName('checkboxsum');
			str+="chukudate="+shdate+"&expressnum="+expressnum;
			for(i=0;i<checkbox.length;i++){
				if(checkbox[i].checked){
				str+="&checkbox[]="+checkbox[i].getAttribute('_id');
				}
			}
			//alert(str);
			
			var xmlhttp;
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
					alert(xmlhttp.responseText);
					//alert("批量出库操作完成，请检查是否有未出库的项目，则可能需要手动出库");
					location.reload();
					//for(i=0;i<checkbox.length;i++){
					//	if(checkbox[i].checked){
					//		cells=document.getElementsByName('checkboxsum')[i].getAttribute('cells');
					//		document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="<div class='classcp1' style='background-color:blue'>完成</div>";
					//	}
					//}
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_pi_chuku.php?"+str,true);
			xmlhttp.send();
			
	}	
}else{
alert("日期或运单号错误");
}	
	
}


function c_pi_zaikuduizhao(str){
	
			str="";
			var checkbox=document.getElementsByName('checkboxsum');
			str+="data=1";
			for(i=0;i<checkbox.length;i++){
				if(checkbox[i].checked){
				str+="&checkbox[]="+checkbox[i].getAttribute('_id');
				}
			}
			//alert(str);
			
			//var xmlhttp;
			//if (str.length==0)
			//  { 
			  //document.getElementById("ajasdiv").innerHTML="";
			//  return;
			//  }
			//if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			//  xmlhttp=new XMLHttpRequest();
			//  }else{// code for IE6, IE5
			//  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			//  }
			  
			//xmlhttp.onreadystatechange=function()
			//  {
			//  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			//	{	
			//		alert(xmlhttp.responseText);
			//		
			//	}
			//  }
			//xmlhttp.open("GET","./ajax/c_pi_zaikuduizhao.php?"+str,true);
			//xmlhttp.send();
			
			window.open("ajax/c_pi_zaikuduizhao.php?"+str,"_BLANK");
}

function c_pi_qrcode(num){
			
			campany=prompt("请输入客户编号：【1】SIIX;【2】Hytera");
			if(campany==1){
				campany="siix";
				title=prompt("是否添加公司抬头？请输入...");
			}else if(campany==2){
				campany="hytera";
			}else{
				campany="";
			}
			
			if(campany){
			str="";
			var checkbox=document.getElementsByName('checkboxsum');
			str+="data="+num;
				if(title){
					str+="&title="+title;
				}
			for(i=0;i<checkbox.length;i++){
				if(checkbox[i].checked){
				str+="&checkbox[]="+checkbox[i].getAttribute('_id');
				}
			}
			window.open("other/qrcode/qrcode_"+campany+".php?"+str,"_BLANK"); 
			
			}
}

function c_fastest_date(mode){

	$(function(){
		if(mode==1){
			dateplus=prompt("请输入需要设定的最快发货的天数(默认5天)");
		}else{
			dateplus=5;
		}

		var i=0;var get_id=new Array();
		$("input[name='checkboxsum']").each(function(){
			if($(this).prop('checked')==true){
				get_id[i]=$(this).attr('_id');
				i++;
			}
		});
		$.post("ajax/c_fastest_date.php",{id:get_id,dateplus:dateplus,mode:mode},function(data){
			if(confirm(data+"，是否现在刷新页面？")){
				location.reload();
			}
			
		});

	});	
}



function c_pi_shdate(str){
	shdate=document.getElementById('SHdate').value
	if(shdate){
	
	
	if(confirm('请确认更改出货日期为：'+shdate)){
		
			str="";
			var checkbox=document.getElementsByName('checkboxsum');
			str+="SHdate="+shdate;
			for(i=0;i<checkbox.length;i++){
				if(checkbox[i].checked){
				str+="&checkbox[]="+checkbox[i].getAttribute('_id');
				}
			}
			
			
			var xmlhttp;
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
					alert(xmlhttp.responseText);
					if(document.getElementById('SHdate').value){
					for(i=0;i<checkbox.length;i++){
						if(checkbox[i].checked){
							cells=document.getElementsByName('checkboxsum')[i].getAttribute('cells');
							document.getElementById('tableExcel').rows[cells].cells[11].innerHTML=document.getElementById('SHdate').value;
						}
					}
					}
				}
			  }
			xmlhttp.open("GET","./ajax/c_pi_shdate.php?"+str,true);
			xmlhttp.send();
	
	}
	}else{
		alert("请输入日期");
	}	
	
}

function c_chaifen(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<input type='text' id='chaifenquantity' placeholder='输入要拆分出的数量'><br><button onclick=\"c_chaifen_complete(document.getElementById('chaifenquantity').value+'"+str+"');buttons(this)\">确认拆分</button>";
			
}
function c_chaifen_complete(str){
			confirm_result=1;
			if(document.getElementsByName('t12')[0].checked==true){
				if(confirm("该品番已在库，请先拆分在库！(如在库已拆分，请点击【确定】；否则点击【取消】前往在库拆分)")){
					confirm_result=1;
				}else{
					confirm_result=0;
					window.open("in.php?in=in&search_banngo="+document.getElementById('c_banngo_thebanngo').value,"xiabu");
				}
			}
			
			if(confirm_result){
			str="quantity="+str;
			
			
			var xmlhttp;
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
					document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
					setTimeout("location.reload()",2000);
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="已拆分";
				}
			  }
			xmlhttp.open("GET","./ajax/c_chaifen_complete.php?"+str,true);
			xmlhttp.send();
			
			}
}

function c_delete(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<button onclick=\"c_delete_complete('"+str+"')\">仅删除</button><br>"+"<button onclick=\"c_delete_complete('"+str+"&po_delete=1"+"')\">同时删除已匹配的PO订单</button>";

			
}
function c_delete_complete(str){
			var xmlhttp;
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
					document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
					setTimeout("document.getElementById('ajasdivout2').style.right='-445'",1000);
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="已删除";
				}
			  }
			xmlhttp.open("GET","./ajax/c_delete_complete.php?"+str,true);
			xmlhttp.send();
}

function c_pipei_cancel(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<button onclick=\"c_pipei_cancel_complete('"+str+"')\">确认取消匹配</button>";
			
}
function c_pipei_cancel_complete(str){
			confirm_result=1;
			if(document.getElementsByName('t12')[0].checked){
				if(confirm("该品番已在库，请先将在库的客户名进行修改！(如已更改，请点击【确定】；否则点击【取消】前往在库更改)")){
					confirm_result=1;
				}else{
					confirm_result=0;
					window.open("in.php?in=in&search_banngo="+document.getElementById('c_banngo_thebanngo').value,"xiabu");
				}
			}
			
			if(confirm_result){
			
			
			var xmlhttp;
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
					document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
					setTimeout("document.getElementById('ajasdivout2').style.right='-445'",1000);
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="<div class='classcp1' style='background-color:yellow'>取消匹配</div>";
					//document.getElementById('tableExcel').rows[cells].cells[9].innerHTML="";
					//document.getElementById('tableExcel').rows[cells].cells[10].innerHTML="";
					//document.getElementById('tableExcel').rows[cells].cells[11].innerHTML="";
				}
			  }
			xmlhttp.open("GET","./ajax/c_pipei_cancel_complete.php?"+str,true);
			xmlhttp.send();
			
			}
}



function c_order(str){
			document.getElementById("ajasdiv").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="-450";
			document.getElementById("ajasdivout").style.right="-450";
			setTimeout("document.getElementById('ajasdivout').style.right='0'",500)
			
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv").innerHTML="";
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
					
					
					document.getElementById("ajasdiv").innerHTML=xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_order.php?"+str,true);
			xmlhttp.send();
}

function c_order_complete(str){
			str="";
			str="t1="+document.getElementById("c_order_t1").value+"&t2="+document.getElementById("c_order_t2").value+"&t3="+document.getElementById("c_order_t3").value+"&t5="+document.getElementById("c_order_t5").value+"&_id="+document.getElementById("c_order_id").value+"&ot1="+document.getElementById("c_order_ot1").value+"&ot2="+document.getElementById("c_order_ot2").value;
			
			
			
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv").innerHTML="";
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
					
					document.getElementById("ajasdiv").innerHTML="更新完成 刷新即可";
			setTimeout("location.reload()",2000)
					
					
				}
			  }
			xmlhttp.open("GET","./ajax/c_order_complete.php?"+str,true);
			xmlhttp.send();
}

function c_order_delete(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<button onclick=\"c_order_delete_complete('"+str+"')\">确认删除</button>";
}
function c_order_delete_complete(str){
			var xmlhttp;
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
					
					document.getElementById("ajasdiv2").innerHTML="删除完成 2秒后刷新";
			//setTimeout("location.reload()",2000);
				setTimeout(()=>{window.open("indexxiabu.php","xiabu")},2000); 
				}
			  }
			xmlhttp.open("GET","./ajax/c_order_delete_complete.php?"+str,true);
			xmlhttp.send();
}

//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////6.php
function po_banngo(str){
			document.getElementById("ajasdiv").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="-450";
			document.getElementById("ajasdivout").style.right="-450";
			setTimeout("document.getElementById('ajasdivout').style.right='0'",500)
			
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv").innerHTML="";
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
					
					
					document.getElementById("ajasdiv").innerHTML= xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/po_banngo.php?"+str,true);
			xmlhttp.send();
}


function po_quantity(str){
			var xmlhttp;
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
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[6].innerHTML=xmlhttp.responseText;
					//alert(cells);
					
				}
			  }
			xmlhttp.open("GET","./ajax/po_quantity.php?"+str,true);
			xmlhttp.send();
	
}	

function po_JPdate(str){
			var xmlhttp;
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
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[9].innerHTML=xmlhttp.responseText;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="<div class='classcp1' style='background-color:#00DDB1'>生産中</div>";
					//alert(cells);
					
				}
			  }
			xmlhttp.open("GET","./ajax/po_JPdate.php?"+str,true);
			xmlhttp.send();
	
}

function po_remark(str){
			if(str==""){
				str=" ";
			}
			var xmlhttp;
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
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[11].innerHTML=xmlhttp.responseText;
					//alert(cells);
					
				}
			  }
			xmlhttp.open("GET","./ajax/po_remark.php?"+str,true);
			xmlhttp.send();
	
}

function po_complete(str){
			var xmlhttp;
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
			  
			  if(document.getElementById('po_complete').checked==true){
				str+="&checked=yes";
				}
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML=xmlhttp.responseText;
					//alert(cells);
					
				}
			  }
			xmlhttp.open("GET","./ajax/po_complete.php?"+str,true);
			xmlhttp.send();
	
}

function po_ruku(str){
			document.getElementById("ajasdivout2").style.right="200";
			swing=1;
			str=str.replace("+","%2B");
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv2").innerHTML="";
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
					
					
					document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
					setTimeout("document.getElementsByName('lotnum')[0].focus();",800);
					
				}
			  }
			xmlhttp.open("GET","./ajax/po_ruku.php?"+str,true);
			xmlhttp.send();
}




function po_ruku_complete(str){
	if(document.getElementsByName('checkboxdiejia')[0].checked==false)
	{
		document.getElementsByName('checkboxdiejia')[0].value="";
	}
	
	str+="&lotnum="+document.getElementsByName('lotnum')[0].value+"&banngo="+document.getElementsByName('banngo')[0].value+"&quantity="+document.getElementsByName('quantity')[0].value+"&intime="+document.getElementsByName('intime')[0].value+"&checkbox="+document.getElementsByName('checkboxdiejia')[0].value+"&asahipo="+document.getElementById('asahipo').value;
	
	for(i=0;i<8;i++){
		if(document.getElementsByName('lotnum2')[i].value){
		str+="&lotnum2[]="+document.getElementsByName('lotnum2')[i].value+"&quantity2[]="+document.getElementsByName('quantity2')[i].value;
		}else{
			break;
		}
	}
	//alert(str);
	str=str.replace("+","%2B");
	var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv2").innerHTML="";
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
					if(xmlhttp.responseText==0){
					alert("数量不正确 或者 输入有误");
					}else{
						
						document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
						if(xmlhttp.responseText==404){
							
							alert('该批次号已经存在！');
						
						}else{
						
						
						if(document.getElementById('cells')){				
						document.getElementById('po_complete').checked=true;
						cells=document.getElementById('cells').value;
						document.getElementById('checked1').color='black';
						
						}else{
						
						cells=document.getElementById('cellss').value;	
						}
						
						
						document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="<div class='classcp1' style='background-color:blue'>入荷済み</div>";
						
						
						parent.document.getElementById("shangbu").contentWindow.document.getElementsByName("t3")[3].select();
						
						swing=0;
						}
						
						
						setTimeout(()=>{if(swing==0){document.getElementById('ajasdivout2').style.right='-450';}},3000);
						
					}
					
				}
			  }
			xmlhttp.open("GET","./ajax/po_ruku_complete.php?"+str,true);
			xmlhttp.send();
	
}


function po_pi_JPdate(str){
	if(document.getElementById('JPdate').value){
	if(confirm('请确认更改出货日期为：'+document.getElementById('JPdate').value)){
	
	
			str="";
			var checkbox=document.getElementsByName('checkboxsum');
			str+="JPdate="+document.getElementById('JPdate').value;
			for(i=0;i<checkbox.length;i++){
				if(checkbox[i].checked){
				str+="&checkbox[]="+checkbox[i].getAttribute('_id');
				}
			}
			
			
			var xmlhttp;
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
					//alert(xmlhttp.responseText);
					if(document.getElementById('JPdate').value){
					for(i=0;i<checkbox.length;i++){
						if(checkbox[i].checked){
							cells=document.getElementsByName('checkboxsum')[i].getAttribute('cells');
							document.getElementById('tableExcel').rows[cells].cells[9].innerHTML=document.getElementById('JPdate').value;
							document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="<div class='classcp1' style='background-color:#00DDB1'>生産中</div>";
						}
					}
					}
				}
			  }
			xmlhttp.open("GET","./ajax/po_pi_JPdate.php?"+str,true);
			xmlhttp.send();
			
	}
	}else{
		alert("日期不正确");
	}	
	
}



function po_chaifen(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<input type='text' id='chaifenquantity' placeholder='输入要拆分出的数量'><br><button onclick=\"po_chaifen_complete(document.getElementById('chaifenquantity').value+'"+str+"');buttons(this)\">确认拆分</button>";
			
}


function po_chaifen_complete(str){
			confirm_result=1;
			if(document.getElementById('po_complete').checked==true){
				if(confirm("该品番已在库，请先拆分在库！(如在库已拆分，请点击【确定】；否则点击【取消】前往在库拆分)")){
					confirm_result=1;
				}else{
					confirm_result=0;
					window.open("in.php?in=in&search_banngo="+document.getElementById('po_banngo_thebanngo').value,"xiabu");
				}
			}
			
			
			if(confirm_result){
			
			str="quantity="+str;
			
			
			var xmlhttp;
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
					document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
					setTimeout("location.reload()",2000);
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="已拆分";
				}
			  }
			xmlhttp.open("GET","./ajax/po_chaifen_complete.php?"+str,true);
			xmlhttp.send();
			}
}

function po_delete(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<button onclick=\"po_delete_complete('"+str+"')\">仅删除</button><br>"+"<button onclick=\"po_delete_complete('"+str+"&c_delete=1"+"')\">同时删除已匹配的客户订单</button>";
			
}
function po_delete_complete(str){
			
			
			var xmlhttp;
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
					document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
					setTimeout("document.getElementById('ajasdivout2').style.right='-445'",1000);
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="已删除";
				}
			  }
			xmlhttp.open("GET","./ajax/po_delete_complete.php?"+str,true);
			xmlhttp.send();
}

function po_order(str){
			document.getElementById("ajasdiv").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="-450";
			document.getElementById("ajasdivout").style.right="-450";
			setTimeout("document.getElementById('ajasdivout').style.right='0'",500)
			
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv").innerHTML="";
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
					
					
					document.getElementById("ajasdiv").innerHTML=xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/po_order.php?"+str,true);
			xmlhttp.send();
}

function po_order_complete(str){
			str="";
			str="t1="+document.getElementById("po_order_t1").value+"&t2="+document.getElementById("po_order_t2").value+"&t4="+document.getElementById("po_order_t4").value+"&_id="+document.getElementById("po_order_id").value+"&ot1="+document.getElementById("po_order_ot1").value;
			
			
			
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("ajasdiv").innerHTML="";
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
					
					document.getElementById("ajasdiv").innerHTML="更新完成 2秒后刷新";
			setTimeout("location.reload()",2000);
					
					
				}
			  }
			xmlhttp.open("GET","./ajax/po_order_complete.php?"+str,true);
			xmlhttp.send();
}

function po_order_delete(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<button onclick=\"po_order_delete_complete('"+str+"')\">确认删除</button>";
}
function po_order_delete_complete(str){
			var xmlhttp;
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
					
					document.getElementById("ajasdiv2").innerHTML="删除完成 2秒后刷新";
			//setTimeout("location.reload()",2000);
			setTimeout(()=>{window.open("indexxiabu.php","xiabu")},2000); 
				}
			  }
			xmlhttp.open("GET","./ajax/po_order_delete_complete.php?delete="+str,true);
			xmlhttp.send();
}

function po_pipei_cancel(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<button onclick=\"po_pipei_cancel_complete('"+str+"')\">确认取消匹配</button>";
			
}
function po_pipei_cancel_complete(str){
			
			var xmlhttp;
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
					document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;
					setTimeout("document.getElementById('ajasdivout2').style.right='-445'",1000);
					cells=document.getElementById('cells').value;
					document.getElementById('tableExcel').rows[cells].cells[2].innerHTML="<div class='classcp1' style='background-color:yellow'>取消匹配</div>";
					//document.getElementById('tableExcel').rows[cells].cells[9].innerHTML="";
					//document.getElementById('tableExcel').rows[cells].cells[10].innerHTML="";
					//document.getElementById('tableExcel').rows[cells].cells[11].innerHTML="";
				}
			  }
			xmlhttp.open("GET","./ajax/po_pipei_cancel_complete.php?"+str,true);
			xmlhttp.send();
}

		
		
		
////////////////////////////////
////////////////////////////////

//1.php 1-2.php
/////		
function findbanngo(str,str2){
			var xmlhttp;
			str=str.replace("+","%2B");
			
			if (str.length<30)
			  { 
			 
			  return;
			  }else{
				  
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					
					
					document.getElementById("findbanngo").style.display= "block";
					document.getElementById("findbanngo").innerHTML= xmlhttp.responseText;
					
					
				}
			  }
			xmlhttp.open("GET","./ajax/findbanngo.php?banngo="+str,true);
			xmlhttp.send();
			  }
}

function thispinfan(str, banngoname){
	document.getElementsByName('t'+banngoname)[0].value=str;
	document.getElementsByName('t5')[0].focus();
}

function findbanngo_display(){
	document.getElementById("findbanngo").style.display= "none";
}

function quantitychecktest(str){
	
	check=document.getElementById('quantitycheck').value;
	if((str % check)==0){
		
	}else{
		alert("请检查数量是否符合最小订单量");
	}
}

