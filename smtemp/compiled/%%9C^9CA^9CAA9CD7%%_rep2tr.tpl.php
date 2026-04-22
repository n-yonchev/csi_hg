<?php /* Smarty version 2.6.9, created on 2020-11-16 17:15:00
         compiled from _rep2tr.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '_rep2tr.tpl', 5, false),)), $this); ?>
<tr class="<?php echo $this->_tpl_vars['CLAS']; ?>
">
<td> <?php echo $this->_tpl_vars['T1']; ?>

<td align=center> '<?php echo $this->_tpl_vars['T2']; ?>

		<?php $_from = $this->_tpl_vars['ARCOLS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['letter']):
?>
			<?php $this->assign('coor', ((is_array($_tmp=$this->_tpl_vars['letter'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ROWNUM']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ROWNUM']))); ?>
			<?php if (isset ( $this->_tpl_vars['ARFORM'][$this->_tpl_vars['coor']] )): ?>
<td>
<?php echo $this->_tpl_vars['ARFORM'][$this->_tpl_vars['coor']]; ?>

			<?php else: ?>
<td align=right>
<?php echo $this->_tpl_vars['ARCONT'][$this->_tpl_vars['ROWNUM']][$this->_tpl_vars['letter']]; ?>

			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>