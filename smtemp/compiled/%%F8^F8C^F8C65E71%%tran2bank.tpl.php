<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2bank.tpl */ ?>
				<?php if ($this->_tpl_vars['FLBANK'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLBANK'] == 1): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>от банка
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
<td title="корегирай банката" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['bank'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']]; ?>

					<?php else: ?>
					<?php endif; ?>
				<?php elseif ($this->_tpl_vars['FLBANK'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>от банка
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
<td>
<?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']]; ?>

					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>