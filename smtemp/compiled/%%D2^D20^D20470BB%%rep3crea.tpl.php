<?php /* Smarty version 2.6.9, created on 2020-11-16 17:17:06
         compiled from rep3crea.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoex', 'rep3crea.tpl', 25, false),)), $this); ?>
						<?php $this->assign('st6', "style='width:120px !important;vertical-align:middle !important;'"); ?>
				<table border=1>
				<tr>
<td colspan='15'> Обобщен отчет за ВСС
				<tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "rep3head.tpl", 'smarty_include_vars' => array('MODE' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "rep3head.tpl", 'smarty_include_vars' => array('MODE' => 2)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "rep3head.tpl", 'smarty_include_vars' => array('MODE' => 3)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_from = $this->_tpl_vars['ARDATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['indx'] => $this->_tpl_vars['elem']):
?>
				<tr>
<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h1']; ?>
"> <?php echo $this->_tpl_vars['elem']['c1']; ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h2']; ?>
"> <?php echo $this->_tpl_vars['elem']['c2']; ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h3']; ?>
" class="suma"> <?php echo $this->_tpl_vars['elem']['c3']; ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h4']; ?>
"> <?php echo $this->_tpl_vars['elem']['c4']; ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h5']; ?>
"> <?php echo $this->_tpl_vars['elem']['c5']; ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h6']; ?>
"> <?php echo $this->_tpl_vars['elem']['c6']; ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h7']; ?>
" class="suma"> <?php echo $this->_tpl_vars['elem']['c7']; ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h8']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['c8'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp)); ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h9']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['c9'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp)); ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h10']; ?>
" class="suma"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['c10'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp)); ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h11']; ?>
" class="suma"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['c11'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp)); ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h12']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['c12'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp)); ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h13']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['c13'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp)); ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h14']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['c14'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp)); ?>

<td <?php echo $this->_tpl_vars['st6']; ?>
 align=right title="<?php echo $this->_tpl_vars['ARHE']['h15']; ?>
" class="suma"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['c15'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp)); ?>

<?php endforeach; endif; unset($_from); ?>
				</table>
