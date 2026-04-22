<?php /* Smarty version 2.6.9, created on 2020-02-28 11:03:22
         compiled from tranfiedit.ajax.tpl */ ?>
<?php $this->assign('myheadcode', "
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array('HEADCODE' => $this->_tpl_vars['myheadcode'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "корегирай сметка на взискател",'WIDTH' => 360)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

										<table>
										<tr>
										<td>
<b><?php echo $this->_tpl_vars['CLAINAME']; ?>
</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ЕИК=<b><?php echo $this->_tpl_vars['EIK']; ?>
</b>
<br>
<br>
IBAN
<br>
<input type="text" name="iban" id="iban" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'iban','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
банка
<br>
<input disabled type="text" name="bankname" id="bankname" size=100 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'bankname','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
										</table>

<script>
function bic2(data){
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){
$('#bankname').attr("value",arre[1]);
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>

<style>
.iban {;float:left;width:180px;font:normal 7pt verdana;}
.bankname {;float:left;width:280px;font:normal 7pt verdana;}
.case {;float:left;width:60px;font:normal 7pt verdana;}
</style>
<script>
							<?php if ($this->_tpl_vars['FROMLISTTOPAYM']): ?>
$(document).ready(function(){
	$("div.wclose_normal").bind("click",function(){
		jQuery.ajax({
			url: "tranfiunlocase.ajax.php"
			,success: function(data){
					if (data=="ok"){
parent.$.nyroModalRemove();
parent.location.reload();
					}else{
alert("ERROR"+String.fromCharCode(10)+data);
					}
			}
		});
	});
});
							<?php else: ?>
							<?php endif; ?>
$('#iban').autocomplete('tranclaiiban.ajax.php?eik=<?php echo $this->_tpl_vars['EIK']; ?>
',{matchContains:false, cacheLength:4, selectFirst:false
						, width:540, formatItem:formrow});
$('#iban').result(function(event, data, formatted){
	$("#bankname").attr("value",data[1]);
//	$("#bic").attr("value",data[1]);
//	bicbank($("#bic").attr("value"));
});
function formrow(data,i,total){
	return "<div class='iban'>"+data[0]+"&nbsp;</div><div class='bankname'>"+data[1]+"&nbsp;</div><div class='case'>"+data[2]+"&nbsp;</div>";
}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>