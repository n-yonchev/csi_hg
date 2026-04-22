<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2iban.tpl */ ?>
				<?php if ($this->_tpl_vars['FLIBAN'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLIBAN'] == 1 || $this->_tpl_vars['FLIBAN'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>IBAN
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
				<?php $this->assign('bgco', 'salmon'); ?>
				<?php if (empty ( $this->_tpl_vars['elem']['iban'] )): ?>
		<?php $this->assign('mysu', "липсва сметка, корегирай"); ?>
				<?php elseif ($this->_tpl_vars['elem']['iban'] == str_repeat ( '0' , 22 )): ?>
		<?php $this->assign('mysu', "грешна сметка, корегирай"); ?>
				<?php elseif (strlen ( $this->_tpl_vars['elem']['iban'] ) <> 22): ?>
		<?php $this->assign('mysu', "дължината не е 22 симв, корегирай"); ?>
				<?php elseif (strlen ( $this->_tpl_vars['elem']['ibaniser'] <> 0 )): ?>
		<?php $this->assign('mysu', "грешен IBAN, корегирай"); ?>
				<?php else: ?>
											<?php if ($this->_tpl_vars['elem']['idbank'] == $this->_tpl_vars['INDXBANKPOST'] && empty ( $this->_tpl_vars['elem']['bankname'] )): ?>
		<?php $this->assign('mysu', "липсва име на банка, корегирай"); ?>
						<?php else: ?>
		<?php $this->assign('mysu', "ляв клик - корегирай сметката"); ?>
		<?php $this->assign('bgco', "#dddddd"); ?>
						<?php endif; ?>
									<?php endif; ?>
<td class="ibac" rel="#ibac<?php echo $this->_tpl_vars['myid']; ?>
" bgcolor="<?php echo $this->_tpl_vars['bgco']; ?>
" title="информация за сметката" 
							<?php if ($this->_tpl_vars['FLIBAN'] == 1): ?>
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['elem']['editiban']; ?>
'});"
><?php echo $this->_tpl_vars['elem']['iban']; ?>

							<?php else: ?>
><?php echo $this->_tpl_vars['elem']['iban']; ?>

							<?php endif; ?>
<span id="ibac<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
	<table>
	<tr>
<td> IBAN
<td> <b><?php echo $this->_tpl_vars['elem']['iban']; ?>
</b>
	<tr>
<td> банка
<td> <b><?php echo $this->_tpl_vars['elem']['bankname']; ?>
</b>
	</table>
<hr>
<font color=blue><?php echo $this->_tpl_vars['mysu']; ?>
</font>
</span>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>