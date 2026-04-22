<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2text.tpl */ ?>
				<?php if ($this->_tpl_vars['FLTEXT'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLTEXT'] == 1 || $this->_tpl_vars['FLTEXT'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>осн
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
				<?php $this->assign('bgco', 'salmon'); ?>
				<?php if (empty ( $this->_tpl_vars['elem']['text'] )): ?>
		<?php $this->assign('mysu', "липсва основание, корегирай"); ?>
				<?php elseif (! $this->_tpl_vars['elem']['flagtext']): ?>
		<?php $this->assign('mysu', "надвишава макс.дължина, корегирай"); ?>
				<?php else: ?>
		<?php $this->assign('mysu', "л€в клик - корегирай основанието"); ?>
		<?php $this->assign('bgco', "#dddddd"); ?>
				<?php endif; ?>
<td class="osno" rel="#osno<?php echo $this->_tpl_vars['myid']; ?>
" bgcolor="<?php echo $this->_tpl_vars['bgco']; ?>
" title="основание" 
							<?php if ($this->_tpl_vars['FLTEXT'] == 1): ?>
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['elem']['edittext']; ?>
'});"
>виж
							<?php else: ?>
>виж
							<?php endif; ?>
<span id="osno<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
			<?php if (count ( $this->_tpl_vars['elem']['artext'] ) <= 1): ?>
<?php echo $this->_tpl_vars['elem']['artext'][0]; ?>

			<?php else: ?>
	<table>
	<tr>
<td> основание за плащане
<td> <b><?php echo $this->_tpl_vars['elem']['artext'][0]; ?>
</b>
	<tr>
<td> още по€снени€
<td> <b><?php echo $this->_tpl_vars['elem']['artext'][1]; ?>
</b>
	</table>
			<?php endif; ?>
<hr>
<font color=blue><?php echo $this->_tpl_vars['mysu']; ?>
</font>
</span>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>