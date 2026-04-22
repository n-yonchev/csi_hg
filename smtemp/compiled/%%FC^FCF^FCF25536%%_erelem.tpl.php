<?php /* Smarty version 2.6.9, created on 2020-02-27 12:56:50
         compiled from _erelem.tpl */ ?>
		<?php if (isset ( $this->_tpl_vars['LISTER'][$this->_tpl_vars['ID']] )): ?>
class="<?php echo $this->_tpl_vars['C2']; ?>
" onmouseover="viewer('<?php echo $this->_tpl_vars['ID']; ?>
');" onmouseout="viewer('');"
		<?php else: ?>
class="<?php echo $this->_tpl_vars['C1']; ?>
"
		<?php endif; ?>
		<?php $this->assign('elmeta', $this->_tpl_vars['FILIST'][$this->_tpl_vars['ID']]); ?>
		<?php if (isset ( $this->_tpl_vars['elmeta'] )): ?>
meta:validator="<?php echo $this->_tpl_vars['elmeta']['validator']; ?>
"
		<?php else: ?>
		<?php endif; ?>
		
		
		