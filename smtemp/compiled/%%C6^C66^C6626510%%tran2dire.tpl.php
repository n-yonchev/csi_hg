<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2dire.tpl */ ?>
				<?php if ($this->_tpl_vars['FLDIRE'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLDIRE'] == 1 || $this->_tpl_vars['FLDIRE'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>ръ<br>чен
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
						<?php if ($this->_tpl_vars['elem']['idstat'] == 9): ?>
							<?php $this->assign('mytext', "П"); ?>
							<?php $this->assign('mytit1', "ръчно преведен"); ?>
							<?php $this->assign('mytit2', ", клик за отложен"); ?>
						<?php elseif ($this->_tpl_vars['elem']['idstat'] == 6): ?>
							<?php $this->assign('mytext', "отложен"); ?>
							<?php $this->assign('mytit1', "отложен"); ?>
							<?php $this->assign('mytit2', ", клик за ръчно преведен"); ?>
						<?php else: ?>
							<?php $this->assign('mytext', "ГРЕШКА"); ?>
							<?php $this->assign('mytit1', ""); ?>
							<?php $this->assign('mytit2', ""); ?>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['FLDIRE'] == 1): ?>
<td align=center title="<?php echo $this->_tpl_vars['mytit1'];  echo $this->_tpl_vars['mytit2']; ?>
"
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['dire'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
> <?php echo $this->_tpl_vars['mytext']; ?>

						<?php else: ?>
<td align=center title="<?php echo $this->_tpl_vars['mytit1']; ?>
"> <?php echo $this->_tpl_vars['mytext']; ?>

						<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>