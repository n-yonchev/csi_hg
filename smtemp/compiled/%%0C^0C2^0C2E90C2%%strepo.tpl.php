<?php /* Smarty version 2.6.9, created on 2025-04-22 13:43:44
         compiled from strepo.tpl */ ?>
<?php $_from = $this->_tpl_vars['ARSUBM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<a class="<?php if ($this->_tpl_vars['ekey'] == $this->_tpl_vars['SUBM']): ?>curr<?php else:  endif; ?>" href="<?php echo $this->_tpl_vars['elem']['subm']; ?>
" style="font:bold 8pt verdana;">
	<nobr><?php echo $this->_tpl_vars['elem']['text']; ?>
</nobr>
	</a>
<?php endforeach; endif; unset($_from); ?>
<br>
<br>
<?php echo $this->_tpl_vars['REPOCONT']; ?>
