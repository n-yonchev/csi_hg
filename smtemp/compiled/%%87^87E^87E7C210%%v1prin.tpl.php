<?php /* Smarty version 2.6.9, created on 2020-04-22 13:45:14
         compiled from v1prin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'v1prin.tpl', 20, false),)), $this); ?>
<br>
<br>
						<table align=center>
						<tr>
<td colspan=2>
ЧСИ <?php echo $this->_tpl_vars['SERIAL']; ?>
 <?php echo $this->_tpl_vars['SHNAME']; ?>

<br>
РЕГИСТРАЦИЯ НА НАБЛЮДАТЕЛ
<br>
<b><?php echo $this->_tpl_vars['V1POST']['name']; ?>
</b>
<br> &nbsp;
						<tr>
<td> входно име
<td> <b><u><?php echo $this->_tpl_vars['V1POST']['username']; ?>
</u></b>
						<tr>
<td> входна парола
<td> <b><u><?php echo $this->_tpl_vars['V1POST']['password']; ?>
</u></b>
						<tr>
<td> крайна дата
<td> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['V1POST']['expiration'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
						<tr>
<td> email
<td> <b><?php echo $this->_tpl_vars['V1POST']['email']; ?>
</b>
						</table>