<?php /* Smarty version 2.6.9, created on 2025-04-11 16:19:06
         compiled from _percent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', '_percent.tpl', 8, false),)), $this); ?>
<?php if ($this->_tpl_vars['P2'] == 0): ?>
	<?php $this->assign('resu', "");  else: ?>
	<?php echo smarty_function_math(array('equation' => "round(x/y*100,0)",'x' => $this->_tpl_vars['P1']+0,'y' => $this->_tpl_vars['P2'],'assign' => 'resu'), $this);?>

<?php endif; ?>
<font color=red>
										<?php if ($this->_tpl_vars['FLPRIN']):  echo $this->_tpl_vars['resu']; ?>

										<?php else:  echo $this->_tpl_vars['resu']; ?>
&nbsp;
										<?php endif; ?>
</font>