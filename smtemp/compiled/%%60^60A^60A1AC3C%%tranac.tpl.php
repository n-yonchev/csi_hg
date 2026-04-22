<?php /* Smarty version 2.6.9, created on 2020-03-01 14:49:43
         compiled from tranac.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'> списък на специалните сметки за превод
<div style="float:right">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
							<?php if (empty ( $this->_tpl_vars['ARMESS'] )): ?>
							<?php else: ?>
<?php $_from = $this->_tpl_vars['ARMESS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
<br>
<span class="ermess" style="padding-left:20px;"> липсва сметка <?php echo $this->_tpl_vars['ARACCOTYPE'][$this->_tpl_vars['elem']]; ?>

<?php endforeach; endif; unset($_from); ?>
							<?php endif; ?>
				<tr class='head2'>
<td> IBAN
<td> BIC
<td> тип
<td> описание
<td> &nbsp;

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo $this->_tpl_vars['elem']['iban']; ?>

<td> <?php echo $this->_tpl_vars['elem']['bic']; ?>

<td> <?php echo $this->_tpl_vars['ARACCOTYPE'][$this->_tpl_vars['elem']['code']]; ?>

<td> <?php echo $this->_tpl_vars['elem']['desc']; ?>

<td>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="#" onclick="dele2('<?php echo $this->_tpl_vars['elem']['id']; ?>
','<?php echo $this->_tpl_vars['elem']['iban']; ?>
','<?php echo $this->_tpl_vars['ARACCOTYPE'][$this->_tpl_vars['elem']['code']]; ?>
'); return false;">
<img src="images/free.gif" title="изтрий"></a>
<?php endforeach; endif; unset($_from); ?>

				</table>

<script>
function dele2(pid,piban,ptype){
	if(confirm('потвърди изтриването на сметка'+String.fromCharCode(10)+piban
	+String.fromCharCode(10)+ptype))
	jQuery.ajax({
		url: "tranacdele.ajax.php?p="+pid
		,success: succ2
		});
}
function succ2(data){
	if (data=="ok"){
parent.location.href= "<?php echo $this->_tpl_vars['RELURL']; ?>
";
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>