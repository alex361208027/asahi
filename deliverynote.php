<?php
echo file_get_contents("templates/header.html");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$deliverynotecampany = $_POST['deliverynotecampany'];
$deliverynoteordernum = $_POST['deliverynoteordernum'];

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
?>
<body style="background-color:#D5D5D5" align="center">
<div style="position:relative;width:1040px;height:715px;background-color:white;">
<div style="position:absolute;top:33px;left:33%;font-size:25px;">朝日科技（上海）有限公司</div>
<div style="position:absolute;top:73px;left:15%;font-size:15px;">地址：<u>上海长宁区延安西路1088号长峰中心516室</u> &nbsp; &nbsp; &nbsp; &nbsp; 电话：<u>021-62126466</u> &nbsp; &nbsp; &nbsp; &nbsp; 传真：<u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </u></div>


</div>
</body>
<?php
$conn->close();  
?>