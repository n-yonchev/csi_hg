<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2clai.tpl */ ?>
				<?php if ($this->_tpl_vars['FLCLAI'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLIBAN'] == 1 || $this->_tpl_vars['FLIBAN'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>взискател
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
						<?php if ($this->_tpl_vars['elem']['idclaimer'] < 0 && $this->_tpl_vars['elem']['idclaimer'] <> -1): ?>
<td><font color=red> <?php echo $this->_tpl_vars['PSCLAI'][$this->_tpl_vars['elem']['idclaimer']]; ?>
 </font>
						<?php elseif ($this->_tpl_vars['elem']['idclaimer'] == -1): ?>
<td><font color=red> <?php echo $this->_tpl_vars['PSCLAI'][$this->_tpl_vars['elem']['idclaimer']]; ?>
 </font>
							<?php if ($this->_tpl_vars['elem']['coundebt'] > 1): ?>
<span style="background-color:lightgreen;cursor:pointer;"
onclick="$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['elem']['editdebt']; ?>
'});">
&nbsp; на <?php echo $this->_tpl_vars['elem']['clainame']; ?>
 &nbsp;
</span>
							<?php else: ?>
на <?php echo $this->_tpl_vars['elem']['clainame']; ?>

							<?php endif; ?>
						<?php else: ?>
<td><?php echo $this->_tpl_vars['elem']['clainame']; ?>

						<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>