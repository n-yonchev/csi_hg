<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2budg.tpl */ ?>
				<?php if ($this->_tpl_vars['FLBUDG'] == 0): ?>
				<?php elseif ($this->_tpl_vars['FLBUDG'] == 1 || $this->_tpl_vars['FLBUDG'] == 5): ?>
					<?php if ($this->_tpl_vars['VARI'] == 'head'): ?>
<td>бюдж<br>прев
					<?php elseif ($this->_tpl_vars['VARI'] == 'cont'): ?>
						<?php if (isset ( $this->_tpl_vars['elem']['editbudg'] )): ?>
							<?php $this->assign('myindx', $this->_tpl_vars['elem']['idtranbudget']); ?>
							<?php $this->assign('ARDATA', $this->_tpl_vars['ARBUDATA'][$this->_tpl_vars['myindx']]); ?>
							<?php if ($this->_tpl_vars['ARDATA']['isempty'] || ! isset ( $this->_tpl_vars['ARDATA'] )): ?>
								<?php $this->assign('bgco', 'salmon'); ?>
							<?php else: ?>
								<?php $this->assign('bgco', ""); ?>
							<?php endif; ?>
<td align=center class="budg" rel="#budg<?php echo $this->_tpl_vars['myid']; ?>
" title="доп.данни за превод към бюджета" bgcolor="<?php echo $this->_tpl_vars['bgco']; ?>
">
									<?php if ($this->_tpl_vars['FLBUDG'] == 1): ?>
<a href="<?php echo $this->_tpl_vars['elem']['editbudg']; ?>
" class="nyroModal" target="_blank">
<img src="images/correct.gif" title="корегирай данните">
</a>
									<?php else: ?>
<img src="images/correct.gif" style="cursor:help;">
									<?php endif; ?>
<span id="budg<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tranbudg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</span>
						<?php else: ?>
<td>&nbsp;
						<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>