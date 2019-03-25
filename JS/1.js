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
   //第一种方法  
        function method1(tableid) {  
  
            var curTbl = document.getElementById(tableid);  
            var oXL = new ActiveXObject("Excel.Application");  
            var oWB = oXL.Workbooks.Add();  
            var oSheet = oWB.ActiveSheet;  
            var sel = document.body.createTextRange();  
            sel.moveToElementText(curTbl);  
            sel.select();  
            sel.execCommand("Copy");  
            oSheet.Paste();  
            oXL.Visible = true;  
  
        }  
        //第二种方法  
        function method2(tableid)  
        {  
  
            var curTbl = document.getElementById(tableid);  
            var oXL = new ActiveXObject("Excel.Application");  
            var oWB = oXL.Workbooks.Add();  
            var oSheet = oWB.ActiveSheet;  
            var Lenr = curTbl.rows.length;  
            for (i = 0; i < Lenr; i++)  
            {        var Lenc = curTbl.rows(i).cells.length;  
                for (j = 0; j < Lenc; j++)  
                {  
                    oSheet.Cells(i + 1, j + 1).value = curTbl.rows(i).cells(j).innerText;  
  
                }  
  
            }  
            oXL.Visible = true;  
        }  
        //第三种方法  
        function getXlsFromTbl(inTblId, inWindow){  
  
            try {  
                var allStr = "";  
                var curStr = "";  
                if (inTblId != null && inTblId != "" && inTblId != "null") {  
  
                    curStr = getTblData(inTblId, inWindow);  
  
                }  
                if (curStr != null) {  
                    allStr += curStr;  
                }  
  
                else {  
  
                    alert("你要导出的表不存在");  
                    return;  
                }  
                var fileName = getExcelFileName();  
                doFileExport(fileName, allStr);  
  
            }  
  
            catch(e) {  
  
                alert("导出发生异常:" + e.name + "->" + e.description + "!");  
  
            }  
  
        }  
  
        function getTblData(inTbl, inWindow) {  
  
            var rows = 0;  
            var tblDocument = document;  
            if (!!inWindow && inWindow != "") {  
  
                if (!document.all(inWindow)) {  
                    return null;  
                }  
  
                else {  
                    tblDocument = eval(inWindow).document;  
                }  
  
            }  
  
            var curTbl = tblDocument.getElementById(inTbl);  
            var outStr = "";  
            if (curTbl != null) {  
                for (var j = 0; j < curTbl.rows.length; j++) {  
                    for (var i = 0; i < curTbl.rows[j].cells.length; i++) {  
  
                        if (i == 0 && rows > 0) {  
                            outStr += " t";  
                            rows -= 1;  
                        }  
  
                        outStr += curTbl.rows[j].cells[i].innerText + "t";  
                        if (curTbl.rows[j].cells[i].colSpan > 1) {  
                            for (var k = 0; k < curTbl.rows[j].cells[i].colSpan - 1; k++) {  
                                outStr += " t";  
                            }  
                        }  
                        if (i == 0) {  
                            if (rows == 0 && curTbl.rows[j].cells[i].rowSpan > 1) {  
                                rows = curTbl.rows[j].cells[i].rowSpan - 1;  
                            }  
                        }  
                    }  
                    outStr += "rn";  
                }  
            }  
  
            else {  
                outStr = null;  
                alert(inTbl + "不存在 !");  
            }  
            return outStr;  
        }  
  
        function getExcelFileName() {  
            var d = new Date();  
            var curYear = d.getYear();  
            var curMonth = "" + (d.getMonth() + 1);  
            var curDate = "" + d.getDate();  
            var curHour = "" + d.getHours();  
            var curMinute = "" + d.getMinutes();  
            var curSecond = "" + d.getSeconds();  
            if (curMonth.length == 1) {  
                curMonth = "0" + curMonth;  
            }  
  
            if (curDate.length == 1) {  
                curDate = "0" + curDate;  
            }  
  
            if (curHour.length == 1) {  
                curHour = "0" + curHour;  
            }  
  
            if (curMinute.length == 1) {  
                curMinute = "0" + curMinute;  
            }  
  
            if (curSecond.length == 1) {  
                curSecond = "0" + curSecond;  
            }  
            var fileName = "table" + "_" + curYear + curMonth + curDate + "_"  
                    + curHour + curMinute + curSecond + ".csv";  
            return fileName;  
  
        }  
  
        function doFileExport(inName, inStr) {  
            var xlsWin = null;  
            if (!!document.all("glbHideFrm")) {  
                xlsWin = glbHideFrm;  
            }  
            else {  
                var width = 6;  
                var height = 4;  
                var openPara = "left=" + (window.screen.width / 2 - width / 2)  
                        + ",top=" + (window.screen.height / 2 - height / 2)  
                        + ",scrollbars=no,width=" + width + ",height=" + height;  
                xlsWin = window.open("", "_blank", openPara);  
            }  
            xlsWin.document.write(inStr);  
            xlsWin.document.close();  
            xlsWin.document.execCommand('Saveas', true, inName);  
            xlsWin.close();  
  
        }  
  
        //第四种  
        function method4(tableid){  
  
            var curTbl = document.getElementById(tableid);  
            var oXL;  
            try{  
                oXL = new ActiveXObject("Excel.Application"); //创建AX对象excel  
            }catch(e){  
                alert("无法启动Excel!\n\n如果您确信您的电脑中已经安装了Excel，"+"那么请调整IE的安全级别。\n\n具体操作：\n\n"+"工具 → Internet选项 → 安全 → 自定义级别 → 对没有标记为安全的ActiveX进行初始化和脚本运行 → 启用");  
                return false;  
            }  
            var oWB = oXL.Workbooks.Add(); //获取workbook对象  
            var oSheet = oWB.ActiveSheet;//激活当前sheet  
            var sel = document.body.createTextRange();  
            sel.moveToElementText(curTbl); //把表格中的内容移到TextRange中  
            sel.select(); //全选TextRange中内容  
            sel.execCommand("Copy");//复制TextRange中内容  
            oSheet.Paste();//粘贴到活动的EXCEL中  
            oXL.Visible = true; //设置excel可见属性  
            var fname = oXL.Application.GetSaveAsFilename("将table导出到excel.xls", "Excel Spreadsheets (*.xls), *.xls");  
            oWB.SaveAs(fname);  
            oWB.Close();  
            oXL.Quit();  
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
 

