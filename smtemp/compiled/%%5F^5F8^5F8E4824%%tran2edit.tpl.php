<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2edit.tpl */ ?>
				<?php if ($this->_tpl_vars['FLEDIT'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLEDIT'] == 1): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td> &nbsp;
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
						<?php if ($this->_tpl_vars['elem']['trancode'] == 'nop' || $this->_tpl_vars['elem']['trancode'] == 't26'): ?>
<td> &nbsp;
						<?php else: ?>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['editiban']; ?>
" class="nyroModal" target="_blank">
<img src="images/edit.png" title="корегирай сметката">
</a>
						<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>