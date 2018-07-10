<?php
date_default_timezone_set('PRC');
$today=date('Y-m-d');


$t2=$_GET['t2'];//banngo
$t3=$_GET['t3'];//quantity
$t6=$_GET['t6'];//campany
$asahipo=$_GET['asahipo'];
$_id=$_GET['_id'];
$customer_id=$_GET['customer_id'];


?>
<div class="php1"> 
<div style="display:block">
<hr>

<div class="php1word">番号 &nbsp; <input type="text" name="banngo" size="10" value="<?php echo $t2 ?>" readonly="readonly"></div>
<div class="php1word">入库时间 &nbsp; <input type="date" name="intime" size="10" value="<?php if($intime){echo $intime;}else{if($_COOKIE['rukudate']){echo $_COOKIE['rukudate'];}else{echo date('Y-m-d');}} ?>"></div>
<div class="php1word">客户 &nbsp; <input type="text" name="campany" size="10" value="<?php if(!empty($campany)){echo $campany;}elseif(!empty($t6)){echo $t6;} ?>"></div><br>
<div class="php1word"><input type="checkbox" name="checkboxdiejia" value="checked">叠加录入(当①Lot No已经存在时勾选)</div>
<div class="lotruku"><div class="php1word">①Lot No. &nbsp; <input type="text" name="lotnum" size="10" value="" placeholder="填写批次号"/></div><div class="php1word">数量 &nbsp; <input type="text" name="quantity" size="10" value="<?php echo $t3 ?>" onchange="po_ruku_quantity(this,0);"></div><!--<div class="php1word">备注 &nbsp; <input type="text" name="remark" size="10" value=""></div>--></div>
<input type="hidden" name="_id" value="<?php echo $_id ?>"/><input type="hidden" name="customer_id" value="<?php echo $customer_id ?>"/><input type="hidden" name="t3" value="<?php echo $t3; ?>"/>
<input type="hidden" id="asahipo" value="<?php echo $asahipo ?>"/>
</div>
<div style="display:none" id="ruku2" class="lotruku">
<hr>
<div class="php1word">②Lot No. &nbsp; <input type="text" name="lotnum2" size="10" value="" placeholder="填写批次号"></div>
<!--<input type="hidden" name="banngo2" size="10" value="<?php //echo $t2 ?>">-->
<div class="php1word">数量 &nbsp; <input type="text" name="quantity2" size="10" value="000" onchange="po_ruku_quantity(this,1);"></div>
<!--<div class="php1word">备注 &nbsp; <input type="text" name="remark2" size="10" value=""></div>-->
</div>
<div style="display:none" id="ruku3" class="lotruku">
<hr>
<div class="php1word">③Lot No. &nbsp; <input type="text" name="lotnum2" size="10" value="" placeholder="填写批次号"></div>
<div class="php1word">数量 &nbsp; <input type="text" name="quantity2" size="10" value="000" onchange="po_ruku_quantity(this,2);"></div>

</div>
<div style="display:none" id="ruku4" class="lotruku">
<hr>
<div class="php1word">④Lot No. &nbsp; <input type="text" name="lotnum2" size="10" value="" placeholder="填写批次号"></div>
<div class="php1word">数量 &nbsp; <input type="text" name="quantity2" size="10" value="000" onchange="po_ruku_quantity(this,3);"></div>

</div>
<div style="display:none" id="ruku5" class="lotruku">
<hr>
<div class="php1word">⑤Lot No. &nbsp; <input type="text" name="lotnum2" size="10" value="" placeholder="填写批次号"></div>
<div class="php1word">数量 &nbsp; <input type="text" name="quantity2" size="10" value="000" onchange="po_ruku_quantity(this,4);"></div>

</div>
<div style="display:none" id="ruku6" class="lotruku">
<hr>
<div class="php1word">⑥Lot No. &nbsp; <input type="text" name="lotnum2" size="10" value="" placeholder="填写批次号"></div>
<div class="php1word">数量 &nbsp; <input type="text" name="quantity2" size="10" value="000" onchange="po_ruku_quantity(this,5);"></div>

</div>
<div style="display:none" id="ruku7" class="lotruku">
<hr>
<div class="php1word">⑦Lot No. &nbsp; <input type="text" name="lotnum2" size="10" value="" placeholder="填写批次号"></div>
<div class="php1word">数量 &nbsp; <input type="text" name="quantity2" size="10" value="000" onchange="po_ruku_quantity(this,6);"></div>

</div>
<div style="display:none" id="ruku8" class="lotruku">
<hr>
<div class="php1word">⑧Lot No. &nbsp; <input type="text" name="lotnum2" size="10" value="" placeholder="填写批次号"></div>
<div class="php1word">数量 &nbsp; <input type="text" name="quantity2" size="10" value="000" onchange="po_ruku_quantity(this,7);"></div>

</div>
<div style="display:none" id="ruku9" class="lotruku">
<hr>
<div class="php1word">⑨Lot No. &nbsp; <input type="text" name="lotnum2" size="10" value="" placeholder="填写批次号"></div>
<div class="php1word">数量 &nbsp; <input type="text" name="quantity2" size="10" value="000" onchange="po_ruku_quantity(this,8);"></div>

</div>
<a href="###" onclick="eee++;po_ruku_plus(eee);" >+</a>
<br><br><a href="###" onclick="po_ruku_complete('t3=<?php echo $t3 ?>&t6=<?php echo $t6 ?>&_id=<?php echo $_id ?>&customer_id=<?php echo $customer_id ?>')"><button onclick="buttons(this)">入库确认</button></a>
</div>

<?php


 
?>

