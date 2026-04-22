<?php /* Smarty version 2.6.9, created on 2020-02-27 12:56:50
         compiled from _erform.tpl */ ?>
		<?php if (isset ( $this->_tpl_vars['LISTER'] )): ?>
<div id="error" class="former" align=left style="visibility:hidden">&nbsp;</div>
<script>
var erlist= new Array();
	<?php $_from = $this->_tpl_vars['LISTER']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elid'] => $this->_tpl_vars['erelem']):
?>
erlist["<?php echo $this->_tpl_vars['elid']; ?>
"]= "<?php echo $this->_tpl_vars['erelem']; ?>
";
	<?php endforeach; endif; unset($_from); ?>
</script>
		<?php else: ?>
		<?php endif; ?>