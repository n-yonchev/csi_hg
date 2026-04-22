<?php /* Smarty version 2.6.9, created on 2020-02-27 15:08:06
         compiled from _filtvisu.tpl */ ?>
		<?php if (isset ( $this->_tpl_vars['FILTVISU'][$this->_tpl_vars['GROUP']] )): ?>
<td class="filtvisu" valign=top> 
<?php echo $this->_tpl_vars['TEXT']; ?>

<br>
	<?php $_from = $this->_tpl_vars['FILTVISU'][$this->_tpl_vars['GROUP']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['filtelem']):
?>
&nbsp;&nbsp;&nbsp;
<?php echo $this->_tpl_vars['filtelem'][0]; ?>

[<?php echo $this->_tpl_vars['filtelem'][1]; ?>
]
<br>
	<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<?php endif; ?>