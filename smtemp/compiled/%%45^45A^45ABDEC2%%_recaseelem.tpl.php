<?php /* Smarty version 2.6.9, created on 2020-03-10 16:57:01
         compiled from _recaseelem.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '_recaseelem.tpl', 9, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['DATALIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['datael']):
?>
				<?php $this->assign('txtype', ""); ?>
				<?php $this->assign('txcode', ""); ?>
			<?php if ($this->_tpl_vars['datael']['idtype'] == 1): ?>
				<?php $this->assign('txtype', "þë"); ?>
				<?php $this->assign('txcode', ((is_array($_tmp="áóëñòàò ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['datael']['bulstat']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['datael']['bulstat']))); ?>
			<?php elseif ($this->_tpl_vars['datael']['idtype'] == 2): ?>
				<?php $this->assign('txtype', "ôë"); ?>
				<?php $this->assign('txcode', ((is_array($_tmp="ÅÃÍ ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['datael']['egn']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['datael']['egn']))); ?>
			<?php else: ?>
			<?php endif;  echo $this->_tpl_vars['txtype']; ?>
 <?php echo $this->_tpl_vars['datael']['name']; ?>
 <?php echo $this->_tpl_vars['txcode']; ?>

<br>
<?php echo $this->_tpl_vars['datael']['address']; ?>

<br>
<?php endforeach; endif; unset($_from); ?>