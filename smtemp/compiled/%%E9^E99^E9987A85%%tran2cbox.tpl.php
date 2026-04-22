<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2cbox.tpl */ ?>
				<?php if ($this->_tpl_vars['FLCBOX'] == 0): ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td align=center>
						<?php if ($this->_tpl_vars['FLCBOX'] == 1): ?>
&nbsp;
						<?php elseif ($this->_tpl_vars['FLCBOX'] == 2): ?>
<a href="#" onclick="exdeinve(); return false;"> 
<img src="images/exclude.gif" title="изключи маркираните от описа">
</a>
						<?php elseif ($this->_tpl_vars['FLCBOX'] == 3): ?>
&nbsp;
						<?php elseif ($this->_tpl_vars['FLCBOX'] == 4): ?>
<a href="#" onclick="exdepack(); return false;"> 
<img src="images/exclude.gif" title="изключи маркираните от ПАКЕТА">
</a>
						<?php elseif ($this->_tpl_vars['FLCBOX'] == 5): ?>
<a href="#" onclick="inclmark(); return false;"> 
<img src="images/include.gif" title="превърни маркираните в отложени за ръчен превод">
</a>
						<?php elseif ($this->_tpl_vars['FLCBOX'] == 6): ?>
<a href="#" onclick="exdemark(); return false;"> 
<img src="images/exclude.gif" title="превърни маркираните обратно в чакащи">
</a>
						<?php else: ?>
&nbsp;
						<?php endif; ?>
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
<td align=center>
						<?php if ($this->_tpl_vars['FLCBOX'] == 6 && $this->_tpl_vars['elem']['idstat'] == 9): ?>
						<?php else: ?>
<input type=checkbox id="cb<?php echo $this->_tpl_vars['elem']['cbcode']; ?>
" bank="<?php echo $this->_tpl_vars['elem']['idbank']; ?>
">
						<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php endif; ?>