<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2reci.tpl */ ?>
				<?php if ($this->_tpl_vars['FLRECI'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLRECI'] == 1 || $this->_tpl_vars['FLRECI'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>име на получателя
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
				<?php $this->assign('bgco', 'salmon'); ?>
				<?php if (empty ( $this->_tpl_vars['elem']['clainame'] )): ?>
		<?php $this->assign('mysu', "липсва получател, корегирай"); ?>
				<?php elseif (! $this->_tpl_vars['elem']['flagreci']): ?>
		<?php $this->assign('mysu', "надвишава макс.дължина, корегирай"); ?>
				<?php else: ?>
		<?php $this->assign('mysu', "корегирай име на получателя"); ?>
		<?php $this->assign('bgco', ""); ?>
				<?php endif; ?>
<td class="osno" bgcolor="<?php echo $this->_tpl_vars['bgco']; ?>
" title="<?php echo $this->_tpl_vars['mysu']; ?>
" 
							<?php if ($this->_tpl_vars['FLRECI'] == 1): ?>
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['elem']['editclai']; ?>
'});"
><?php echo $this->_tpl_vars['elem']['clainame']; ?>

							<?php else: ?>
><?php echo $this->_tpl_vars['elem']['clainame']; ?>

							<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>