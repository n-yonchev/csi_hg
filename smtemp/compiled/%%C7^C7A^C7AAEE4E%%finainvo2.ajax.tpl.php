<?php /* Smarty version 2.6.9, created on 2026-01-05 12:29:02
         compiled from finainvo2.ajax.tpl */ ?>
<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>
			<table>
			<tr>
<td class="head"> описание
<td class="head"> мярка
<td class="head"> колич
<td class="head"> ед.цена
									<?php if ($this->_tpl_vars['NOSERI']): ?>
<td class="head" align=center> 
<a href="<?php echo $this->_tpl_vars['ADDNEW']; ?>
" class="nyroModal" target="_blank"><img src="images/clone.gif" title="добави ред"></a>
									<?php else: ?>
									<?php endif; ?>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
			<tr>
<td class="cell"> <?php echo $this->_tpl_vars['elem']['descrip']; ?>

<td class="cell"> <?php echo $this->_tpl_vars['elem']['meas']; ?>

<td class="cell" align=right> <?php echo $this->_tpl_vars['elem']['quan']; ?>

<td class="cell" align=right> <?php echo $this->_tpl_vars['elem']['price']; ?>

									<?php if ($this->_tpl_vars['NOSERI']): ?>
<td class="cell"> 
<nobr>
<a href="<?php echo $this->_tpl_vars['elem']['rowedit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай реда"></a>
<a href="#" onclick="dele2('<?php echo $this->_tpl_vars['elem']['id']; ?>
','<?php echo $this->_tpl_vars['elem']['idbill']; ?>
'  ,'<?php echo $this->_tpl_vars['elem']['descrip']; ?>
','<?php echo $this->_tpl_vars['elem']['quan']; ?>
','<?php echo $this->_tpl_vars['elem']['meas']; ?>
','<?php echo $this->_tpl_vars['elem']['price']; ?>
'); return false;">
<img src="images/free.gif" title="изтрий реда"></a>
</nobr>
									<?php else: ?>
									<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
			</table>

<script>
function dele2(pid,pinvo  ,pdes,pqua,pmea,pice){
	if(confirm('потвърди изтриването на реда'+String.fromCharCode(10)+String.fromCharCode(10)+pdes
	+String.fromCharCode(10)+pqua+' '+pmea+' по '+pice+' €'))
	jQuery.ajax({
		url: "finainvoelemdele.ajax.php?p="+pid+"&i="+pinvo
		,success: succ5
		});
}
function succ5(data){
	var arre= data.split("^");
	var ok= arre[0];
	var idinvo= arre[1];
	if (ok=="ok"){
		refresh(idinvo);
		refrow(idinvo);
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>