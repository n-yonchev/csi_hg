<?php /* Smarty version 2.6.9, created on 2025-04-11 16:18:16
         compiled from _stdateform.tpl */ ?>
<form name="myform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
<br>
избери месец
				<?php $_from = $this->_tpl_vars['MONTLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['montid'] => $this->_tpl_vars['mont']):
?>
<a href="#"
onclick="window.location.href='<?php echo $this->_tpl_vars['LINKMONT'][$this->_tpl_vars['montid']]; ?>
';"
> <?php echo $this->_tpl_vars['mont']; ?>

</a>
				<?php endforeach; endif; unset($_from); ?>
<br>
<br>
или въведи период
					<?php if (empty ( $this->_tpl_vars['TXER'] )): ?>
						<?php $this->assign('bord', ""); ?>
						<?php $this->assign('tier', ""); ?>
					<?php else: ?>
						<?php $this->assign('bord', "border:1px solid red;"); ?>
						<?php $this->assign('tier', $this->_tpl_vars['TXER']); ?>
					<?php endif; ?>
<input style="font: normal 8pt verdana;<?php echo $this->_tpl_vars['bord']; ?>
" type=text name="period" id="period" size=26 onkeyup="autosubm(event);" title="<?php echo $this->_tpl_vars['tier']; ?>
">
+enter
</form>
<script>
function autosubm(event){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
document.forms['myform'].submit();
	}else{
return true;
	}
}
</script>