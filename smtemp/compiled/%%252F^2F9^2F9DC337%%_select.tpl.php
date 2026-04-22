<?php /* Smarty version 2.6.9, created on 2022-05-25 11:09:39
         compiled from _select.tpl */ ?>
<span 
		<?php if (isset ( $this->_tpl_vars['LISTER'][$this->_tpl_vars['ID']] )): ?>
 class="<?php echo $this->_tpl_vars['C2']; ?>
" onmouseover="viewer('<?php echo $this->_tpl_vars['ID']; ?>
');" onmouseout="viewer('');"
		<?php else: ?>
		<?php endif; ?>
style="padding:1px 1px 1px 1px"
>
<select name="<?php echo $this->_tpl_vars['ID']; ?>
" id="<?php echo $this->_tpl_vars['ID']; ?>
" class="<?php echo $this->_tpl_vars['C1']; ?>
"
		<?php $this->assign('elmeta', $this->_tpl_vars['FILIST'][$this->_tpl_vars['ID']]); ?>
		<?php if (isset ( $this->_tpl_vars['elmeta'] )): ?>
meta:validator="<?php echo $this->_tpl_vars['elmeta']['validator']; ?>
"
		<?php else: ?>
		<?php endif;  if (isset ( $this->_tpl_vars['SIZE'] )): ?> size=<?php echo $this->_tpl_vars['SIZE']; ?>
 <?php else:  endif;  if (isset ( $this->_tpl_vars['ONCH'] )): ?> onchange="<?php echo $this->_tpl_vars['ONCH']; ?>
" <?php else:  endif; ?>
>
<?php echo $this->_tpl_vars['FROM']; ?>
 </select></span>