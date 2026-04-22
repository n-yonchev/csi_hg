<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2debt.tpl */ ?>
				<?php if ($this->_tpl_vars['FLDEBT'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLDEBT'] == 1): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>длъж<br>ник
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
						<?php if (empty ( $this->_tpl_vars['elem']['debtname'] )): ?>
<td> няма
						<?php else: ?>
							<?php if ($this->_tpl_vars['elem']['idclaimer'] <= 0 && $this->_tpl_vars['elem']['idclaimer'] <> -1): ?>
<td><font color=red>ОК</font>
							<?php else: ?>
<td style="cursor:help;" bgcolor="#dddddd" title="<?php echo $this->_tpl_vars['elem']['debtname']; ?>
"> виж
							<?php endif; ?>
						<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php elseif ($this->_tpl_vars['FLDEBT'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>длъж<br>ник
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
<td bgcolor="#dddddd" title="<?php echo $this->_tpl_vars['elem']['debtname']; ?>
"> 
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>