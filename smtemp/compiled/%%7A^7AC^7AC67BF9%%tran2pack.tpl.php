<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2pack.tpl */ ?>
				<?php if ($this->_tpl_vars['FLPACK'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLPACK'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>пакет
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
						<?php if ($this->_tpl_vars['elem']['idinve'] == 0): ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elem']['idpackstat']]; ?>
"> 
		<?php if ($this->_tpl_vars['elem']['idpack'] == 0): ?>
&nbsp;
		<?php else: ?>
<?php echo $this->_tpl_vars['elem']['idpack']; ?>

		<?php endif; ?>
						<?php else: ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elem']['idinvepackstat']]; ?>
"> 
		<?php if ($this->_tpl_vars['elem']['idinvepack'] == 0): ?>
&nbsp;
		<?php else: ?>
<?php echo $this->_tpl_vars['elem']['idinvepack']; ?>

		<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>