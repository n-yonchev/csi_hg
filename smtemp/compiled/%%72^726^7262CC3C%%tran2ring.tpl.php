<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2ring.tpl */ ?>
				<?php if ($this->_tpl_vars['FLRING'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLRING'] == 1): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>rin<br>gs
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
<td align=center title="<?php if ($this->_tpl_vars['elem']['isring'] == 1): ?>включен RINGS, клик за изключване<?php else: ?>клик за включване на RINGS<?php endif; ?>" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['ring'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<?php if ($this->_tpl_vars['elem']['isring'] == 1): ?>ri<?php else: ?>&nbsp;<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php elseif ($this->_tpl_vars['FLRING'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>rin<br>gs
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
<td align=center>
<?php if ($this->_tpl_vars['elem']['isring'] == 1): ?>ri<?php else: ?>&nbsp;<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>