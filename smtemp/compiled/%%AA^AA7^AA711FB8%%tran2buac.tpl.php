<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2buac.tpl */ ?>
				<?php if ($this->_tpl_vars['FLBUAC'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLBUAC'] == 1): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>бс
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
				<?php if (empty ( $this->_tpl_vars['elem']['iban'] )): ?>
<td align=center> &nbsp;
				<?php elseif ($this->_tpl_vars['elem']['iban'] == str_repeat ( '0' , 22 )): ?>
<td align=center> &nbsp;
				<?php elseif (strlen ( $this->_tpl_vars['elem']['iban'] ) <> 22): ?>
<td align=center> &nbsp;
				<?php else: ?>
<td align=center class="buac" rel="#buac<?php echo $this->_tpl_vars['myid']; ?>
" title="състояние на сметка" onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['elem']['accobudg']; ?>
'});">
<?php if (isset ( $this->_tpl_vars['elem']['editbudg'] )): ?>бс<?php else: ?>&nbsp;<?php endif; ?>
<span id="buac<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
<?php echo $this->_tpl_vars['elem']['iban']; ?>
 <?php if (isset ( $this->_tpl_vars['elem']['editbudg'] )): ?>е<?php else: ?>НЕ Е<?php endif; ?> бюджетна сметка
<hr>
<font color=blue>ляв клик - направи я <?php if (isset ( $this->_tpl_vars['elem']['editbudg'] )): ?>НЕбюджетна<?php else: ?>бюджетна<?php endif; ?> </font>
</span>
				<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>