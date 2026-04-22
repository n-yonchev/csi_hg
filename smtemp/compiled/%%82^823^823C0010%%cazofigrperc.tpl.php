<?php /* Smarty version 2.6.9, created on 2020-02-27 14:00:08
         compiled from cazofigrperc.tpl */ ?>
				<?php if ($this->_tpl_vars['PERC'] > 100 || $this->_tpl_vars['PERC'] < 0): ?>
<font color=red><?php echo $this->_tpl_vars['PERC']; ?>
 %</font>
				<?php else:  echo $this->_tpl_vars['PERC']; ?>
 %
				<?php endif; ?>