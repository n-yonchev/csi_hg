<?php /* Smarty version 2.6.9, created on 2025-04-11 16:18:16
         compiled from _styearlist.tpl */ ?>
<?php $_from = $this->_tpl_vars['YEARLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<a class="<?php if ($this->_tpl_vars['ekey'] == $this->_tpl_vars['YEAR']): ?>curr<?php else:  endif; ?>" href="<?php echo $this->_tpl_vars['elem']; ?>
">
	<?php echo $this->_tpl_vars['ekey']; ?>

	</a>
<?php endforeach; endif; unset($_from); ?>