$(document).ready(function(){
	$("[list='kehulist']").click(function(){
		$(this).val("");
	});
	
	$(".sum_show_x").click(function(){
	$(".hide").fadeOut();
	$(this).parent().fadeOut();
	});
	
	
	
	$(".sum_show_caozuo").click(function(){
	 $(".hide").fadeIn();
	});
	
	$(".sum_show_hide_x").click(function(){
	 $(".hide").fadeOut(100);
	});
	
	$(".close_hide").click(function(){
		 $(".hide").fadeOut(100);
	});
	
	
	$(".pick_same").hover(function(){
	  //var get=$(this).attr("value");
	  $("tr [value='"+$(this).attr("value")+"']").css({"background":"#DDDDDD"});
	  
	},function(){
	  //var get=$(this).attr("value");
	  $("tr [value='"+$(this).attr("value")+"']").css({"background":""});
	});
	
	
	

	$(".sum_show_move").click(function(){
		up_down=$(this).attr("value");
		sum_show_top=$(".sum_show").css("top");
		sum_show_top=sum_show_top.replace("px","");
		if(up_down==1){
		sum_show_top=sum_show_top-100;
		}else{
		sum_show_top=sum_show_top-(-100);	
		}
		$(".sum_show").css({"top":sum_show_top+"px"});
	});

	
	
	
});

function datecount(kkk){
		kk=kkk-3;
		var offset = -5;
		var dateStrA = document.getElementsByName('t'+kk)[0].value;
		var year = dateStrA.substring(0,4);
		var month = Number(dateStrA.substring(5,7))-1;
		var date = Number(dateStrA.substring(8,10))+offset;
		var dateB = new Date();
		dateB.setFullYear(year,month,date);
		var year2 = dateB.getFullYear();
		var month2 = (dateB.getMonth()+1)+"";
		var date2 = dateB.getDate()+"";
		if (month2.length == 1) month2 = "0"+month2;
		if (date2.length == 1) date2 = "0"+date2;
		document.getElementsByName('t'+kkk)[0].value = year2 + "-" + month2 + "-" + date2;
		}
		
		

function buttons(obj){
	obj.style.visibility="hidden";
	setTimeout(() => {obj.style.visibility='visible';},15000);
}


var ss=document.getElementsByName('checkboxsum');

function checkboxsum(){

	sum=0;chencednumber=0;
	for(i=0;i<ss.length;i++){
		if(ss[i].checked){
			chencednumber++;
			sum=sum+Number(ss[i].value);
		}
	}
	document.getElementById("sum_show").innerHTML="共选中<b>"+chencednumber+"</b>个<br>合计：<b>"+sum+"</b>";

	if(chencednumber){
		$(document).ready(function(){
			$(".sum_show").fadeIn().css("display","inline-block");
			var sum_show_width_padding=40;
			var sum_show_width=$(".sum_show").width();
			var sum_show_width2=(sum_show_width+sum_show_width_padding)/2;
			$(".sum_show").css({"height":sum_show_width,"-webkit-border-radius":sum_show_width2,"-moz-border-radius":sum_show_width2,"border-radius":sum_show_width2});
		});
	}else{
		$(document).ready(function(){
			$(".sum_show").fadeOut();
		});
	}

}

function checkboxsum_fan(){
	for(i=0;i<ss.length;i++){
		if(ss[i].checked){
			ss[i].checked=false;
		}else{
			ss[i].checked=true;
		}
	}
	checkboxsum();
}

function checkboxsum_all(){
	
		for(i=0;i<ss.length;i++){
			ss[i].checked=true;
		}
		
	checkboxsum();

}

function checkboxsum_allno(){
	
		for(i=0;i<ss.length;i++){
			ss[i].checked=false;
		}
	checkboxsum();

}

function checkall12(){

	for(i=0;i<ss.length;i++){
		ss[i].checked = false;
	}
	for(i=(Number(document.getElementById('checkall1').value)-1);i<document.getElementById('checkall2').value;i++){
		ss[i].checked = true;
	}
	checkboxsum();	
}


function newponum(str,date){
	
		var xmlhttp;
			if(str==1){
			today=date;
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

//////
function po_ruku_plus(str){
	document.getElementById('ruku'+str).style.display='block';
	//rukuquantity=document.getElementsByName('quantity')[0].value;
	
}
function po_ruku_quantity(str,num){
	
	if(str.value<po_ru_quantity&&po_ru_quantity>0){
		document.getElementsByName('quantity2')[num].value=(po_ru_quantity-str.value);
		po_ru_quantity=po_ru_quantity-str.value;
		}

	
}


//Excel
function exceldownload(str){
	$(document).ready(function(){
	var	excel=$("#myDiv").html();
	 $.post("upload/2_6_excel.php",{excel:excel,php:str},function(data){
		window.location.href="upload/"+data;
	 });
	});	
}
        //第五种方法  
        var idTmr;  
        function  getExplorer() {  
            var explorer = window.navigator.userAgent ;  
            //ie  
            if (explorer.indexOf("MSIE") >= 0) {  
                return 'ie';  
            }  
            //firefox  
            else if (explorer.indexOf("Firefox") >= 0) {  
                return 'Firefox';  
            }  
            //Chrome  
            else if(explorer.indexOf("Chrome") >= 0){  
                return 'Chrome';  
            }  
            //Opera  
            else if(explorer.indexOf("Opera") >= 0){  
                return 'Opera';  
            }  
            //Safari  
            else if(explorer.indexOf("Safari") >= 0){  
                return 'Safari';  
            }  
        }  
        function method5(tableid) {  
		
		
            if(getExplorer()=='ie')  
            {  
                var curTbl = document.getElementById(tableid);  
                var oXL = new ActiveXObject("Excel.Application");  
                var oWB = oXL.Workbooks.Add();  
                var xlsheet = oWB.Worksheets(1);  
                var sel = document.body.createTextRange();  
                sel.moveToElementText(curTbl);  
                sel.select();  
                sel.execCommand("Copy");  
                xlsheet.Paste();  
                oXL.Visible = true;  
  
                try {  
                    var fname = oXL.Application.GetSaveAsFilename("Excel.xls", "Excel Spreadsheets (*.xls), *.xls");  
                } catch (e) {  
                    print("Nested catch caught " + e);  
                } finally {  
                    oWB.SaveAs(fname);  
                    oWB.Close(savechanges = false);  
                    oXL.Quit();  
                    oXL = null;  
                    idTmr = window.setInterval("Cleanup();", 1);  
                }  
  
            }  
            else  
            {  
                tableToExcel(tableid)  
            }  
        }  
        function Cleanup() {  
            window.clearInterval(idTmr);  
            CollectGarbage();  
        }  
        var tableToExcel = (function() {  
            var uri = 'data:application/vnd.ms-excel;base64,',  
                    template = '<html><head><meta charset="UTF-8"></head><body><table>{table}</table></body></html>',  
                    base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },  
                    format = function(s, c) {  
                        return s.replace(/{(\w+)}/g,  
                                function(m, p) { return c[p]; }) }  
            return function(table, name) {  
                if (!table.nodeType) table = document.getElementById(table)  
                var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}  
                window.location.href = uri + base64(format(template, ctx))  
            }  
        })()  
 

