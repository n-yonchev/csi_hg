<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2inve.tpl */ ?>
				<?php if ($this->_tpl_vars['FLINVE'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLINVE'] == 1): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>за<br>опис
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
					<?php if ($this->_tpl_vars['elem']['islist'] == 1): ?>
						<?php if ($this->_tpl_vars['elem']['isnolist'] == 0): ?>
<td align=center title="може да се включи в опис &quot;<?php echo $this->_tpl_vars['elem']['trandesc']; ?>
&quot;, клик за забрана"
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['noli'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
да
						<?php else: ?>
<td align=center title="НЯМА да се включва в опис &quot;<?php echo $this->_tpl_vars['elem']['trandesc']; ?>
&quot;, клик за разрешение"
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['noli'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<font color=red>не</font>
						<?php endif; ?>
					<?php else: ?>
<td align=center>
&nbsp;
					<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php elseif ($this->_tpl_vars['FLINVE'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>опис
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
						<?php if ($this->_tpl_vars['elem']['idinve'] == 0): ?>
<td>&nbsp;
						<?php else: ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elem']['idinvestat']]; ?>
"> 
<?php echo $this->_tpl_vars['elem']['idinve']; ?>

						<?php endif; ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>