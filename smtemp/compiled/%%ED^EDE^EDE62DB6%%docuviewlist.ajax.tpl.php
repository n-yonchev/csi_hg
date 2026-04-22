<?php /* Smarty version 2.6.9, created on 2020-08-24 13:40:56
         compiled from docuviewlist.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'docuviewlist.ajax.tpl', 2, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->assign('txdocu', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="<b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['DOCU']['serial']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['DOCU']['serial'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['DOCU']['year']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['DOCU']['year'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</b>") : smarty_modifier_cat($_tmp, "</b>")));  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => ((is_array($_tmp="списък дела за документ ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['txdocu']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['txdocu'])))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<table class="d_table" cellspacing='0' cellpadding='0' align=center>
				<tr class='header'>
			<td><span> номер </span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> деловодител </span></td>
	<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
				<tr>
<td align=right> <b><?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
</b>
			<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['username']; ?>

	<?php endforeach; endif; unset($_from); ?>
				</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>