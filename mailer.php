 <p>收件人邮箱：<input type="text" name="toemail" id="mail" value="licy@asahi-rubber.com.cn"/></p>  
    <p>标  题：<input type="text" name="title" id="sub"/></p>  
    <p>内  容：<textarea name="content" cols="50" id="con" rows="3"></textarea></p>  
    <p><input type="button" value="发送" onclick="sendMail()"/></p>  
</form>  
<script>  
  //  function sendMail() {  
  //      mail=$('#mail').val();  
  //      sub=$('#sub').val();  
  //      con=$('#con').val();  
  //      $.post('mailersent.php',{mail:mail,sub:sub,con:con},function (data) {  
  //          if (data=='Message has been sent.'){  
  //              alert('发送成功');  
  //          }else{  
  //              alert('发送失败');  
  //          }  
  //      });  
  //  }  
	
	function sendMail(){
		
			mail=document.getElementById("mail").value;
			sub=document.getElementById("sub").value;
			con=document.getElementById("con").value;
			str="mail="+mail+"&sub="+sub+"&con="+con;
			alert(str);
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

					alert(xmlhttp.responseText);				
				}
			  }
			xmlhttp.open("GET","libs/mailer/mailersent2.php?"+str,true);
			xmlhttp.send();
}
</script>  