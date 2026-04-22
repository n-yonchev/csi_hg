<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2full.tpl */ ?>
				<?php if ($this->_tpl_vars['FLFULL'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLFULL'] == 1): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>пп
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
						<?php if ($this->_tpl_vars['elem']['idclaimer'] <= 0): ?>
<td>&nbsp;
						<?php else: ?>
<td align=center title="<?php if ($this->_tpl_vars['elem']['isfull'] == 1): ?>пълно погасяване, клик за промяна<?php else: ?>клик за пълно погасяване<?php endif; ?>" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['full'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<?php if ($this->_tpl_vars['elem']['isfull'] == 1): ?>пп<?php else: ?>&nbsp;<?php endif; ?>
						<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php elseif ($this->_tpl_vars['FLFULL'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>пп
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
<td align=center>
<?php if ($this->_tpl_vars['elem']['isfull'] == 1): ?>пп<?php else: ?>&nbsp;<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>